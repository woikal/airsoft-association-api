<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Province extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function clubs(): Relation
    {
        return $this->hasMany(Club::class);
    }
}
