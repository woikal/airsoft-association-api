<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Club extends Model
{
    use HasFactory;

    public function province(): Relation
    {
        return $this->belongsTo(Province::class);
    }
}
