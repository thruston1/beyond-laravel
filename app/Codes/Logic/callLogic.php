<?php

namespace App\Codes\Logic;

use App\Codes\Models\CollectionTaskNew;
use App\Codes\Models\DataInfoTask;
use App\Codes\Models\masterCampaign;
use App\Codes\Models\StrategyCallNew;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CallLogic
{
    public function __construct()
    {
        
    }
    public function bucketData($campaign)
    {   
        $logicSql = new LogicSql();
        $getCollection = CollectionTaskNew::where('campaign', '=', $campaign)
            ->where('status', '=', 1)
            ->get();
        if(count($getCollection) == 0){
            return [
                'success' => 0,
                'message' => __('general.error_not_found_', ['field' => 'Collection']),
            ];
        }
        $bulkInputStrategy = array();
        $bulkInputBucket = array();
        foreach($getCollection as $val){
            array_push($bulkInputStrategy, [
                'task_new_id' => $val->id,
                'data_info_id' => $val->data_info_id,
                'campaign' => $val->campaign,
                'unique_id' => $val->unique_id,
                'agreement_no' => $val->agreement_no
            ]);
            array_push($bulkInputBucket, [
                'campaign' => $val->campaign,
                'unique_id' => $val->unique_id,
            ]);
        }
        $getResult = $logicSql->insertBucketStrategy($bulkInputBucket, $bulkInputStrategy);
        if($getResult['success'] == 0){
            return $getResult;
        }

        $updateStatus = CollectionTaskNew::where('campaign', '=', $campaign)
        ->where('status', '=', 1)
        ->update(['status' => 80]);


        return [
            'success' => 1,
            'message' => 'bucket has been created',
        ];
         
    }

    


}   
