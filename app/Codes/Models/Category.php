<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'table_category';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
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
