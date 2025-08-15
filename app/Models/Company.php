<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Company extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $guard_name = 'web';

    protected $fillable = [
        'name',
        'email',
        'password',
        'plan',
        'description',
        'logo',
        'location',
        'website',
        'phone',
        'verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'verified' => 'boolean',
        ];
    }

    /**
     * Relación con publicaciones
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Relación con suscripciones
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * Obtener el plan actual
     */
    public function currentPlan()
    {
        return $this->subscriptions()
            ->where('status', 'active')
            ->with('plan')
            ->first()?->plan;
    }

    /**
     * Verificar si puede crear más posts según su plan
     */
    public function canCreatePost()
    {
        $plan = $this->currentPlan();
        if (!$plan) return false;

        $postsThisMonth = $this->posts()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        return $postsThisMonth < $plan->allowed_posts;
    }
}
