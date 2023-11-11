<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extract extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable = [
        'original_filename',
        'filename',
        'uploaded_by',
        'club_id',
    ];
}
