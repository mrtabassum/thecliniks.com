<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    use HasFactory;
    protected $table = 'services_payment';
    protected $fillable = [
        'patient_id', 'service_id','orderNo', 'status', 'description', 'payable_amount', 'appointment_unique_id', 'payment_type', 'payment_method', 'created_at', 'updated_at'
    ];
}
