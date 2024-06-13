<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;

class StrategyCallNew extends Model
{
    protected $table = 'strategy_call_new';
    protected $primaryKey = 'id';
    protected $fillable = [
        'campaign',
        'unique_id',
        'agreement_no',
        'task_new_id',
        'agent_id',
        'status',
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

    public function getRole()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

}
