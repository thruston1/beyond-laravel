<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;

class UserAgent extends Model
{
    protected $table = 'user_agent';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_name',
        'full_name',
        'email',
        'password',
        'campaign_id',
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

    protected $hidden = ['password'];

    public function getRole()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

}
