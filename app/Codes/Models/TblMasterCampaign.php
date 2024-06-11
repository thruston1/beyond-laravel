<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TblMasterCampaign extends Model
{
    protected $table = 'tblMasterCampaign';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'campaignName',
        'campaignDescription',
        'typeTask',
        'queueName',
        'campaignState',
        'relatedState',
    ];

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['updated_at'])
            ->format('Y-m-d H:i:s');
    }

    public function getMasterCampaign(){
        return TblMasterCampaign::where('campaignState', '=', 'Y')->get();
        // ->order_by('campaignName', 'ASC')->where('',array('campaignState'=>'Y'));
    }

    public function getValidatedCampaign($id){
        return TblMasterCampaign::where('campaignState', '=', 'Y')
            ->where('idTl' , '=', $id)
            ->get();
        // ->order_by('campaignName', 'ASC')->where('',array('campaignState'=>'Y'));
    }

    public static function boot()
    {
        parent::boot();

        self::updated(function($model){
            Cache::forget('role'.$model->id);
        });

        self::deleting(function($model){
            Cache::forget('role'.$model->id);
        });
    }

}
