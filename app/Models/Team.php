<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'recorded_at',
        'authority',
        'name',
        'club_id',
        'headquarter',
        'c/o',
        'postalAddress',
        'foundedAt',
    ];

    public function province(): Relation
    {
        return $this->belongsTo(Province::class);
    }

    public function officials(): Relation
    {
        return $this->hasMany(Official::class)->withPivot(['role', 'start_at', 'end_at']);
    }

    public function isClub(): bool
    {
        return !empty($this->clubId);
    }
}
