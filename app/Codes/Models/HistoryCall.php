<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryCall extends Model
{
    protected $table = 'history_call';
    protected $primaryKey = 'id';
    protected $fillable = [
        'unique_id',
        'index_call',
        'no_telp',
        'campaign',
        'agent_id',
        'task_new_id',
        'data_info_id',
        'parameter_result',
        'status'
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
