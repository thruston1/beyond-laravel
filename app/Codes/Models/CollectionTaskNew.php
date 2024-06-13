<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionTaskNew extends Model
{
    protected $table = 'collection_task_new';
    protected $primaryKey = 'id';
    protected $fillable = [
        'unique_id',
        'agreement_no',
        // 'is_bucket',
        'data_info_id',
        'campaign',
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
