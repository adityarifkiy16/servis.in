<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jenis extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'jenis';
    protected $guarded = ['id'];

    public function products()
    {
        return $this->hasMany(Product::class, 'jenis_id');
    }
    public function servicetypes()
    {
        return $this->hasMany(Servicetype::class, 'jenis_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
