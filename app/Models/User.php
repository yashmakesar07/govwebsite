<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role'];
    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->role, ['super_admin', 'editor', 'publisher']);
    }

    public function isSuperAdmin(): bool { return $this->role === 'super_admin'; }
    public function isEditor(): bool { return $this->role === 'editor'; }
    public function isPublisher(): bool { return $this->role === 'publisher'; }

    public function notices() { return $this->hasMany(Notice::class, 'created_by'); }
    public function tenders() { return $this->hasMany(Tender::class, 'created_by'); }
}
