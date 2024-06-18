<?php

namespace App\Codes\Logic;

use App\Codes\Models\BucketLoad;
use App\Codes\Models\Customer;
use App\Codes\Models\DataInfoTask;
use App\Codes\Models\StrategyCallNew;
use App\Codes\Models\UserAgent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AsteriskLogic
{   
    protected $getAgent;
    protected $agentId;
    public $config;
    public $socket = NULL;
    public $server;
    public $port;
    private $pagi;
    private $event_handlers;
    private $_logged_in = FALSE;
    public function __construct($agentId, $dataAgent = null)
    {       
        $this->agentId = $agentId;
        if($dataAgent == null) {
            $this->getAgent = UserAgent::where('id', '=', $agentId)->first();
        }
        else{
            $this->getAgent = $dataAgent;
        }

        if(!isset($this->config['asmanager']['server'])) $this->config['asmanager']['server'] = '127.0.0.1';
        if(!isset($this->config['asmanager']['port'])) $this->config['asmanager']['port'] = 5038;
        if(!isset($this->config['asmanager']['username'])) $this->config['asmanager']['username'] = 'asterisk';
        if(!isset($this->config['asmanager']['secret'])) $this->config['asmanager']['secret'] = 'pkp123456';

        // setup login dari settings
    }

    function Originate($channel,
    $exten=NULL, $context=NULL, $priority=NULL,
    $application=NULL, $data=NULL,
    $timeout=NULL, $callerid=NULL, $variable=NULL, $account=NULL, $async=NULL, $actionid=NULL)
    {   
        $parameters = array('Channel'=>$channel);

        if($exten) $parameters['Exten'] = $exten;
        if($context) $parameters['Context'] = $context;
        if($priority) $parameters['Priority'] = $priority;

        if($application) $parameters['Application'] = $application;
        if($data) $parameters['Data'] = $data;

        if($timeout) $parameters['Timeout'] = $timeout;
        if($callerid) $parameters['CallerID'] = $callerid;
        if($variable) $parameters['Variable'] = $variable;
        if($account) $parameters['Account'] = $account;
        if(!is_null($async)) $parameters['Async'] = ($async) ? 'true' : 'false';
        if($actionid) $parameters['ActionID'] = $actionid;
        // dd($parameters);
        return $this->send_request('Originate', $parameters);
    }	
    function connect($server=NULL, $username=NULL, $secret=NULL)
    {
      // use config if not specified
      if(is_null($server)) $server = $this->config['asmanager']['server'];
      if(is_null($username)) $username = $this->config['asmanager']['username'];
      if(is_null($secret)) $secret = $this->config['asmanager']['secret'];

      // get port from server if specified
      if(strpos($server, ':') !== false)
      {
        $c = explode(':', $server);
        $this->server = $c[0];
        $this->port = $c[1];
      }
      else
      {
        $this->server = $server;
        $this->port = $this->config['asmanager']['port'];
      }

      // connect the socket
      $errno = $errstr = NULL;
      $this->socket = @fsockopen($this->server, $this->port, $errno, $errstr);
      if($this->socket == false)
      {
        $this->log("Unable to connect to manager {$this->server}:{$this->port} ($errno): $errstr");
        return false;
      }
     
      // read the header
      $str = fgets($this->socket);
      if($str == false)
      {
        // a problem.
        $this->log("Asterisk Manager header not received.");
        return false;
      }
      else
      {
        // note: don't $this->log($str) until someone looks to see why it mangles the logging
      }

      // login
      $res = $this->send_request('login', array('Username'=>$username, 'Secret'=>$secret));
      if($res['Response'] != 'Success')
      {
        $this->_logged_in = FALSE;
        $this->log("Failed to login.");
        $this->disconnect();
        return false;
      }
      $this->_logged_in = TRUE;
      return true;
    }

    function disconnect()
    {
      if($this->_logged_in==TRUE)
        $this->logoff();
      fclose($this->socket);
    }

    function log($message, $level=1)
    {
        error_log(date('r') . ' - ' . $message);
    }

    function Logoff()
    {
      return $this->send_request('Logoff');
    }

    function send_request($action, $parameters=array())
    {   
    
      $req = "Action: $action\r\n";
      foreach($parameters as $var=>$val)
        $req .= "$var: $val\r\n";
      $req .= "\r\n";
      fwrite($this->socket, $req);
      return $this->wait_response();
    }

    function wait_response($allow_timeout=false)
    {   
      $timeout = false;
      do
      {
        $type = NULL;
        $parameters = array();

        $buffer = trim(fgets($this->socket, 4096));
        while($buffer != '')
        {
          $a = strpos($buffer, ':');
          if($a)
          {
            if(!count($parameters)) // first line in a response?
            {
              $type = strtolower(substr($buffer, 0, $a));
              if(substr($buffer, $a + 2) == 'Follows')
              {
                // A follows response means there is a miltiline field that follows.
                $parameters['data'] = '';
                $buff = fgets($this->socket, 4096);
                while(substr($buff, 0, 6) != '--END ')
                {
                  $parameters['data'] .= $buff;
                  $buff = fgets($this->socket, 4096);
                }
              }
            }

            // store parameter in $parameters
            $parameters[substr($buffer, 0, $a)] = substr($buffer, $a + 2);
          }
          $buffer = trim(fgets($this->socket, 4096));
        }

        // process response
        switch($type)
        {
          case '': // timeout occured
            $timeout = $allow_timeout;
            break;

          case 'response':
            break;
          default:
            $this->log('Unhandled response packet from Manager: ' . print_r($parameters, true));
            break;
        }
      } while($type != 'response' && !$timeout);
      return $parameters;
    }


    


}   
