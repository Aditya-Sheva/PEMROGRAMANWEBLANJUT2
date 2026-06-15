<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, Notifiable;

    protected $fillable = [
        'name','email','password','role','is_active'
    ];

    protected $hidden = ['password','remember_token'];

    protected $casts = ['email_verified_at' => 'datetime', 'is_active' => 'boolean'];

    public function proposals() { return $this->hasMany(Proposal::class); }
    public function reviews()   { return $this->hasMany(Review::class, 'reviewer_id'); }
    public function isSecretary(): bool { return $this->hasRole('sekretariat') || $this->role === 'sekretariat'; }
    public function isReviewer(): bool  { return $this->hasRole('reviewer') || $this->role === 'reviewer'; }
    public function isPeneliti(): bool  { return $this->hasRole('peneliti') || $this->role === 'peneliti'; }
    public function isAdmin(): bool     { return $this->hasRole('admin') || $this->role === 'admin'; }
    public function isKetua(): bool     { return $this->hasRole('ketua') || $this->role === 'ketua'; }
}