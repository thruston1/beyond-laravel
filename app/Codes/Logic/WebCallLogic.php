<?php

namespace App\Codes\Logic;

use App\Codes\Models\BucketLoad;
use App\Codes\Models\Customer;
use App\Codes\Models\DataInfoTask;
use App\Codes\Models\HistoryCall;
use App\Codes\Models\StrategyCallNew;
use App\Codes\Models\UserAgent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WebCallLogic
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

        // setup login dari settings
    }

    public function getDataCall(){

        $getCurrentBucketData = BucketLoad::selectRaw('bucket_load.id, bucket_load.unique_id, bucket_load.campaign, bucket_load.status,
            strategy_call_new.id AS strategy_id, strategy_call_new.agreement_no, 
            strategy_call_new.agent_id, strategy_call_new.task_new_id, strategy_call_new.data_info_id')
        ->join('strategy_call_new','strategy_call_new.id','=','bucket_load.strategy_call_new_id')
        ->where('bucket_load.status', '=', 2)
        ->where('strategy_call_new.agent_id', '=', $this->agentId)
        ->first();
        
        if(!$getCurrentBucketData){
            $getBucketData = BucketLoad::selectRaw('bucket_load.id, bucket_load.unique_id, bucket_load.campaign, bucket_load.status,
                strategy_call_new.id AS strategy_id, strategy_call_new.agreement_no, 
                strategy_call_new.agent_id, strategy_call_new.task_new_id, strategy_call_new.data_info_id')
                ->join('strategy_call_new','strategy_call_new.id','=','bucket_load.strategy_call_new_id')
                ->where('bucket_load.status', '=', 1)
                ->where('strategy_call_new.agent_id', '=', null)
                ->orderBy('bucket_load.id', 'ASC')
                ->first();

            if(!$getBucketData)
            {
                return[
                    'success' => 1,
                    'message' => __('general.bucket_is_empty')
                ];
            }

            DB::beginTransaction();
            // update data bucket
            $getBucketData->status = 2;
            $getBucketData->save();

            $getStrategyCall = StrategyCallNew::where('id', '=', $getBucketData->strategy_id)->first();
            $getStrategyCall->agent_id = $this->agentId;
            $getStrategyCall->status = 2;
            $getStrategyCall->save();

            DB::commit();
            $getNewTask = DataInfoTask::where('id', '=', $getBucketData->task_new_id)->first();
            $getCustomer = Customer::where('id', '=', $getNewTask->customer_id)->first();

            $noTelp = array();
            $noTelp[] = $getNewTask->no_telp_1;
            $noTelp[] = $getNewTask->no_telp_2;
            $noTelp[] = $getNewTask->no_telp_3;
            return[
                'success' => 1,
                'data' => $getNewTask,
                'telp' => $noTelp,
                'customer' => $getCustomer
            ];
        }

        $getNewTask = DataInfoTask::where('id', '=', $getCurrentBucketData->task_new_id)->first();
        $getCustomer = Customer::where('id', '=', $getNewTask->customer_id)->first();
        $getHistory = HistoryCall::where('data_info_id', '=', $getNewTask->id)
            ->orderBy('index_call', 'ASC')
            ->pluck('no_telp', 'index_call')
            ->toArray();

        // note agar di permudah saat bucket no telp no sudah masuk ke history tinggal setup status saja
        $noTelp = array();
        $noTelp[] = [
                'label' => 'no_telp_1',
                'active' => isset($getHistory[0]) ? true : false,
                'telp'=> $getNewTask->no_telp_1,
        ];
        $noTelp[] = [
                'label' => 'no_telp_2',
                'active' => isset($getHistory[1]) ? true : false,
                'telp'=> $getNewTask->no_telp_2,
        ];
        $noTelp[] = [
                'label' => 'no_telp_3',
                'active' => isset($getHistory[2]) ? true : false,
                'telp'=> $getNewTask->no_telp_3,
        ];

        return[
            'success' => 1,
            'data' => $getNewTask,
            'telp' => $noTelp,
            'customer' => $getCustomer,
            'bucket_data' => $getCurrentBucketData,
        ];
    }

    public function doSaveResult($index, $noTelp, $strategyId, $result)
    {
        $getStrategy = StrategyCallNew::where('id', '=', $strategyId)->first();
            $saveHistory = HistoryCall::create([
                'unique_id' => $getStrategy->unique_id,
                'index_call' => $index,
                'no_telp' => $noTelp,
                'campaign' => $getStrategy->campaign,
                'agent_id' => $this->agentId,
                'task_new_id' => $getStrategy->task_new_id,
                'data_info_id' => $getStrategy->data_info_id,
                'parameter_result' => $result,
                'status' => 80,
            ]); 
            if($saveHistory){
                return[
                    'success'=> 1,
                    'message' => __('general.result_report_is_saved')
                ];
            }else{
                return[
                    'success'=> 0,
                    'message' => __('general.result_report_failed_to_save')
                ];
            }
        
    }

    


}   
