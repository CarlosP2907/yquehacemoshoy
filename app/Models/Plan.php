<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'price',
        'allowed_posts',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'allowed_posts' => 'integer',
        ];
    }

    /**
     * Relación con suscripciones
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Verificar si es plan gratuito
     */
    public function isFree()
    {
        return $this->price == 0;
    }
}
