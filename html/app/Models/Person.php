<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Person extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'avatar'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    // Acessor para avatar padrão se não houver
    public function getAvatarUrlAttribute()
    {
        return $this->avatar ?: 'https://via.placeholder.com/100x100/007bff/ffffff?text=' . substr($this->name, 0, 1);
    }
}
