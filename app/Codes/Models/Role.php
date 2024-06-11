<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'permission_data',
        'permission_route'
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

    public function getAdmin()
    {
        $this->hasMany(Admin::class, 'role_id', 'id');
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
