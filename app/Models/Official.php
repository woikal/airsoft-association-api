<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Official extends Model
{
    use HasFactory;

    protected $fillable = '*';

    public function teams(): Relation
    {
        return $this->belongsToMany(Team::class)->withPivot(['role', 'start_at', 'end_at']);
    }
}
