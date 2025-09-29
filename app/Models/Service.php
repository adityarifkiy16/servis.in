<?php

namespace App\Models;

use App\Models\ServiceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'services';
    protected $guarded = ['id'];

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class, 'service_type_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
