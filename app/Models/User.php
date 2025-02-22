<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Basic user relationship - tickets they created
    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'user_id');
    }

    // Agent relationship - tickets they're assigned to
    public function assignedTickets()
    {
        return $this->hasMany(Ticket::class, 'agent_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function agentRequest()
    {
        return $this->hasOne(AgentRequest::class);
    }
}
