<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function customer()
    {
    	return $this->belongsTo(User::class);
    }

    public function processor()
    {
    	return $this->hasOne(User::class, 'processed_by');
    }
}
