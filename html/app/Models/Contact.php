<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'person_id',
        'country_code',
        'number'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function getFormattedNumberAttribute()
    {
        return '+' . $this->country_code . ' ' . chunk_split($this->number, 3, ' ');
    }
}
