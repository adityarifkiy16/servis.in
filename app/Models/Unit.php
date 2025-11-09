<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'units';
    protected $guarded = ['id'];

    public function products()
    {
        $this->hasMany(Product::class, 'unit_id', 'id');
    }

    public function jenis()
    {
        $this->hasMany(Jenis::class, 'unit_id', 'id');
    }

    public function services()
    {
        $this->hasMany(Service::class, 'unit_id', 'id');
    }
}
