<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class LetterTemplate extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'slug',
        'letter_id',
        'name',
        'email',
        'date',
    ];


    protected function casts(): array
    {
        return [
            'date' => 'date'
        ];
    }

    protected static function boot(): void
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function (LetterTemplate $letterTemplate) {
            $letterTemplate->slug = Str::uuid()->toString();
        });
    }

    public function letter(): BelongsTo
    {
        return $this->belongsTo(Letter::class);
    }
}
