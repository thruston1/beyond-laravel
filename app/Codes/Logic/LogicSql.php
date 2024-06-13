<?php

namespace App\Codes\Logic;

use App\Codes\Models\CollectionTaskNew;
use App\Codes\Models\DataInfoTask;
use App\Codes\Models\masterCampaign;
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
        $data = DataInfoTask::where('campaign_name', '=', $campaign)->get();

        return $data;
    }

    public function insertCollectionNew($bulkData)
    {   
        foreach ($bulkData as $val) {

            $validator = Validator::make($val, [
                "unique_id"    => "unique",
            ]);

            if($validator){
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

    public function insertInfoTask($bulkData)
    {   
        
        DB::beginTransaction();

        $insert = DataInfoTask::insert($bulkData);
        if(!$insert){
            DB::rollBack();
            return[
                'status'=> 0,
                'message' => 'failed insert data'
            ];
        }

        DB::commit();

        return[
            'status'=> 1,
            'message' => 'success insert data'
        ];
    }


}   
