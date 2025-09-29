<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'jenis_id',
        'departement_id',
        'serial_number',
        'usage',
        'usage_unit',
    ];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }

    public function departement()
    {
        return $this->belongsTo(Departement::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
