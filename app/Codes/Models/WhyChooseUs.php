<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    protected $table = 'why_choose_us';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'description',
        'image',
        'orders',
        'status',
        'created_at',
        'update_at'
    ];

    protected $appends = [
        'image_full',
    ];

    public function getImageFullAttribute()
    {
        if (strlen($this->image) > 0) {
            return env('OSS_URL').$this->image;
        }
        return asset('assets/cms/image/no-img.png');
    }
}
