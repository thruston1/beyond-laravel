<?php

namespace App\Http\Controllers\Website;

use App\Codes\Logic\WebCallLogic;
use App\Codes\Logic\AsteriskLogic;
use App\Codes\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CallCenterController extends _BaseController
{
    protected $request;
    protected $data;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $settings = Cache::remember('settings', env('SESSION_LIFETIME'), function () {
            return Settings::pluck('value', 'key')->toArray();
        });

        $this->data = [
            'settings' => $settings
        ];
    }

    public function index()
    {   

        $this->request->attributes->get('_account');
        $data = $this->data;
        $data = [
            'content' => 'doAction',
            // 'perform' => $perform,
            // 'totalPerform' => $totalPerform,
        ];

        return view('website.page.callCenter.index', $data);
    }

    public function callCenter()
    {   
        $agent =  $this->request->attributes->get('_agent');
        $agentid = $agent->id;

        $webLogic = new WebCallLogic($agentid, $agent);
        // get data bucket
        $getDataBucket = $webLogic->getDataCall();

        $data = $this->data;
        $data['campaign'] = $agent->campaign_id;
        if($getDataBucket['success'] == 1){
            $data['result'] = get_list_result();
            $data['data'] = true;
            $data['telp'] = $getDataBucket['telp'];
            $data['dataValidation'] = $getDataBucket['data'];
            $data['customer'] = $getDataBucket['customer'];
            $data['bucketData'] = $getDataBucket['bucket_data'];
        }
        else{
            $data['data'] = false;
        }
        
 
        return view('website.page.callCenter.callScreen', $data);
    }

    public function doCall(){
        $agent =  $this->request->attributes->get('_agent');
        $agentid = $agent->id;

            $user = $agent->user_name;
			// $an = $agent->full_name;
			$nk = str_replace('-','',$this->request->get('kontrak'));
			$cn = 'static name';
			$cmp =  $this->request->get('campaign');

			$PassedInfo = 'PassedInfo='.$user.'-'.$user.'-'.$nk.'-'.$cn.'-'.$cmp;
                
			$number = '0'.$this->request->get('number');			
				
			/* DEFINE_VARIABLE_FOR_AGI_ORIGINATE */
			$channel = "SIP/".$user;
            // dd($channel);
			$exten = "77".$number;
			$context ="TESTTINGANGGA";
			$priority = 1;
			$application = NULL;
			$data = NULL;
			$timeout = 3000;
			$callerid = $user." <".$user.">";
			$variable = $PassedInfo;
			$account = NULL;
			$async = NULL;
			$actionid = NULL;

            /* OPEN_CONNECTION */
            $asteriskLogic = new AsteriskLogic($agentid, $agent);
			$res = $asteriskLogic->connect("10.10.8.38", "asterisk", "pkp123456");

            if($res == FALSE) {
				echo(0);
			}

            elseif($res == TRUE){
				echo($PassedInfo.$number);

				$has = $asteriskLogic->Originate($channel, $exten, $context, $priority, $application, $data, $timeout, $callerid, $variable, $account, $async, $actionid);				
				
				// print_r($has);
                
				$asteriskLogic->disconnect();
                if($has['Response'] == 'success'){
                    return response()->json([
                        'success' => 1,
                        'message' => __('general.call_created'),
                    ]);
                }
                else{
                    return response()->json([
                        'success' => 0,
                        'message' => __('general.failed_call'),
                    ]);
                }

			}
    }

    public function saveResult(){
        $agent =  $this->request->attributes->get('_agent');
        $agentId = $agent->id;

        $noTelp= $this->request->get('no_telp');
        $index= $this->request->get('index');
        $result= $this->request->get('result');
        $strategyId = $this->request->get('strategy_id');

        $webLogic = new WebCallLogic($agentId, $agent);
        $result = $webLogic->doSaveResult($index, $noTelp, $strategyId, $result);

        return response()->json([
            'success'=> $result['success'],
            'index' => $index,
            'message' => $result['message']
        ]);
    }

}
