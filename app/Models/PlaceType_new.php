<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceType extends Model
{
    use HasFactory;

    protected $table = 'place_type';

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * Relación con lugares
     */
    public function places()
    {
        return $this->hasMany(Place::class);
    }
}
