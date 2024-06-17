<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'created_at', 'updated_by','created_by','total_price'];

    public function isPaid()
    {

        return $this->status === OrderStatus::Paid->value;
    }

    public function payment() : HasOne
    {
        return $this->hasOne(Payment::class);

    }
}
