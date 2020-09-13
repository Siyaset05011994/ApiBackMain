<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogisticFacility extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'lat', 'lng', 'parameters', 'type_id'];

    public function type()
    {
        return $this->belongsTo(LogisticFacilityType::class);
    }

}
