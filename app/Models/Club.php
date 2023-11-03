<?php

namespace App\Models;

use App\Enums\GroupType;
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
        'zvr',
        'headquarter',
        'c/o',
        'postalAddress',
        'foundedAt',
    ];
    protected $casts = ['type' => GroupType::class];

    public function province(): Relation
    {
        return $this->belongsTo(Province::class);
    }

    public function officials(): Relation
    {
        return $this->hasMany(Official::class)->withPivot(['role', 'start_at', 'end_at']);
    }

}
