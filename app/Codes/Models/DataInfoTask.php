<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;

class DataInfoTask extends Model
{
    protected $table = 'data_info_task';
    protected $primaryKey = 'id';
    protected $fillable = [
        'campaign_name',
        'client_code',
        'customer_name',
        'gender',
        'no_telp_1',
        'no_telp_2',
        'no_telp_3',
        'agreement_no',
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
