<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductUsageLog extends Model
{
    use HasFactory;

    protected $table = 'product_usage_logs';

    protected $guarded = ['id'];
}
