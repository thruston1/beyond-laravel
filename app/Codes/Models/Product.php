<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'table_product';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'price_sale',
        'qty',
        'image'
    ];

    // public function getImageAttribute()
    // {
    //     return strlen($this->image) > 0 ? env('OSS_URL').$this->image : asset('assets/web/img/Frame_49.png');
    // }
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
