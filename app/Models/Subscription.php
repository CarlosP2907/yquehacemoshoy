<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'company_id', 
        'plan_id',
        'start_date',
        'end_date',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    /**
     * Relación con usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con empresa
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Relación con plan
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Verificar si la suscripción está activa
     */
    public function isActive()
    {
        return $this->status === 'active' 
            && $this->start_date <= now()
            && (is_null($this->end_date) || $this->end_date >= now());
    }
}
