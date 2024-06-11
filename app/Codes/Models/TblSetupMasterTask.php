<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class TblSetupMasterTask extends Model
{
    protected $table = 'tblSetupMasterTask';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'typeName',
        'fieldName',
        'fieldOrder',
        'isPhone',
        'isOverdue',
        'isCusName',
        'isCusID',
        'isKey',
        'phPriority',
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
