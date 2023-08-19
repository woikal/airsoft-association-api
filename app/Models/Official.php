<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Official extends Model
{
    use HasFactory;

    protected $fillable = '*';

    public function clubs(): Relation
    {
        return $this->belongsToMany(Club::class)->withPivot(['role', 'start_at', 'end_at']);
    }
}
