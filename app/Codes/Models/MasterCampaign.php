<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;

class masterCampaign extends Model
{
    protected $table = 'master_campaign';
    protected $primaryKey = 'id';
    protected $fillable = [
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

    protected $hidden = ['password'];

    public function getRole()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

}
