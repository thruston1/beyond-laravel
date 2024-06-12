<?php

namespace App\Codes\Logic;

use App\Codes\Models\CollectionTaskNew;
use App\Codes\Models\DataInfoTask;
use App\Codes\Models\masterCampaign;
use Illuminate\Support\Facades\Storage;

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


}   
