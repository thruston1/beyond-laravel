<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerId extends Model
{
    protected $table = 'customer_id';
    protected $primaryKey = 'id';
    protected $fillable = [
        'Customer_ID',
        'uniqueId',
        'noKontrak',
        'tanggalLkd',
        'overdueDate',
        'paymentDate',
        'overdue',
        'markedBy',
        'callCounter',
        'callStatus',
        'isSimiliar',
        'isInvalid',
        'isPaid',
        'taskStatus',
        'timeStart',
        'jamCallBack',
        'dateStamp',
        'timeStamp',
        'ptpDedicated',
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
