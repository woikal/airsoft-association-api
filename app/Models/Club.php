<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Club extends Model
{
    use HasFactory;

    protected $fillable = [
        'recorded_at',
        'authority',
        'name',
        'ZVR',
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


}
