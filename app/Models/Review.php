<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function book(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function booted(): void
    {
        static::deleted(function ($review) {
            //Heeft boek nog andere reviews?
            $book = $review->book;

            if ($book && $book->reviews()->count() <= 1) {
                //Verwijder boek zonder reviews ook
                $book->delete();
            }
        });
    }

    public function getActiveLabelAttribute(): string
    {
        return $this->active ? 'Actief' : 'Inactief';
    }
}
