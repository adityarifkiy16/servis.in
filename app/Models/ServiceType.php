<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServiceType extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'service_type';
    protected $guarded = ['id'];

    public function jenis()
    {
        return $this->belongsTo(Jenis::class, 'jenis_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'service_type_id');
    }
}
