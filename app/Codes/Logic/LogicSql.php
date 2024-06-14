<?php

namespace App\Codes\Logic;

use App\Codes\Models\BucketLoad;
use App\Codes\Models\CollectionTaskNew;
use App\Codes\Models\DataInfoTask;
use App\Codes\Models\masterCampaign;
use App\Codes\Models\StrategyCallNew;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class LogicSql
{
    public function __construct()
    {
        
    }

    public function getMasterCampaign($type = 0)
    {   
        if(!$type){
            $data = masterCampaign::get();
        }
        else{   
            $data = masterCampaign::where('campaignName', '=', $type)
            ->get();
        }
        

        return $data;
    }

    public function getDataApplication($date, $campaign){
        $data = CollectionTaskNew::where('created_at','=', $date)
        ->where('campaign', '=', $campaign)
        ->get();

        return $data;
    }

    public function getDataInfoTask($campaign)
    {
        $data = DataInfoTask::where('campaign', '=', $campaign)->get();

        return $data;
    }

    public function insertCollectionNew($bulkData)
    {   
        foreach ($bulkData as $val) {
            $getCollection = CollectionTaskNew::where('unique_id', '=', $val['unique_id'])->first();
            // $validator = Validator::make($val, [
            //     "unique_id"    => "unique",
            // ]);

            if($getCollection){
                return[
                    'success'=> 0,
                    'message' => $val['unique_id'].' data already inserted'
                ];
            }
        }
        DB::beginTransaction();

        $insert = CollectionTaskNew::insert($bulkData);
        if(!$insert){
            DB::rollBack();
            return[
                'success'=> 0,
                'message' => 'failed insert data'
            ];
        }

        DB::commit();

        return[
            'success'=> 1,
            'message' => 'success insert data'
        ];
    }

    public function insertDataUploadBulk($dataInfo, $dataCollection){
        foreach ($dataCollection as $val) {
            $getCollection = StrategyCallNew::where('unique_id','=', $val['unique_id'])->first();

            // $validator = Validator::make($val, [
            //     "unique_id"    => "unique",
            // ]);

            if($getCollection){
                return[
                    'success'=> 0,
                    'message' => $val['unique_id'].' data already inserted'
                ];
            }
        }

        DB::beginTransaction();
        $getLastIdTask = DataInfoTask::orderBy('id', 'DESC')->first();
        $getId = $getLastIdTask->id ?? 0;
        $totalArray = count($dataInfo);
        $insert = DataInfoTask::insert($dataInfo);
        if(!$insert){
            DB::rollBack();
            return[
                'success'=> 0,
                'message' => 'failed insert data'
            ];
        }
        $insertedIds = [];
        for($i=1; $i<=$totalArray; $i++){
            array_push($insertedIds, $getId+$i);
        }; 
        foreach($insertedIds as $index => $val){
            $dataCollection[$index]['data_info_id'] = $val;
        }

        $insert = CollectionTaskNew::insert($dataCollection);
        if(!$insert){
            DB::rollBack();
            return[
                'success'=> 0,
                'message' => 'failed insert data'
            ];
        }
        DB::commit();
    }

    public function insertBucketStrategy($bucketData, $strategyData){
        
        foreach ($strategyData as $val) {
            $getCollection = StrategyCallNew::where('unique_id','=', $val['unique_id'])->first();

            // $validator = Validator::make($val, [
            //     "unique_id"    => "unique",
            // ]);

            if($getCollection){
                return[
                    'success'=> 0,
                    'message' => $val['unique_id'].' data already inserted'
                ];
            }
        }
        $getStrategyCall = StrategyCallNew::orderBy('id', 'DESC')->first();
        $getStrategyId = $getStrategyCall->id ?? 0;
        $totalArray = count($strategyData);
        DB::beginTransaction();

        $insert = StrategyCallNew::insert($strategyData);
        if(!$insert){
            DB::rollBack();
            return[
                'success'=> 0,
                'message' => 'failed insert data'
            ];
        }

        $insertedIds = [];
        for($i=1; $i<=$totalArray; $i++){
            array_push($insertedIds, $getStrategyId+$i);
        }; 

        foreach($insertedIds as $index => $val){
            $bucketData[$index]['strategy_call_new_id'] = $val;
        }

        DB::commit();

        return[
            'success'=> 1,
            'message' => 'success insert data'
        ];


    }

    


}   
