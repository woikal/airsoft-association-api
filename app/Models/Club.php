<?php

namespace App\Models;

use App\Enums\GroupType;
use Carbon\Carbon;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
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
    protected $casts = [
        'founded_at' => 'datetime',
        'type'       => GroupType::class,
    ];

    public function province(): Relation
    {
        return $this->belongsTo(Province::class);
    }

    public function officials(): Relation
    {
        return $this->hasMany(Official::class)->withPivot(['role', 'start_at', 'end_at']);
    }

    public function form(Form $form): Form
    {
        $years = range(today()->format('Y'), 2000);

        return $form->schema([
                TextInput::make('name'),
                TextInput::make('abbreviation'),
                TextInput::make('club_id'),
                TextInput::make('location'),
                TextInput::make('website'),
                TextInput::make('facebook'),
                TextInput::make('instagram'),
                TextInput::make('email'),
                Select::make('founded_at')->options($years),
            ]);
        /*
        $table->date('founded_at');
        $table->foreignId('checked_by')->nullable()->constrained('users');
        $table->date('checked_at');*/
    }
}
