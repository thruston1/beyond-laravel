<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionTaskNew extends Model
{
    protected $table = 'collection_task_new';
    protected $primaryKey = 'id';
    protected $fillable = [
        'unique_id',
        'agreementNo',
        'last_result',
        'is_bucket',
        'Blank',
        'campaign',
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
