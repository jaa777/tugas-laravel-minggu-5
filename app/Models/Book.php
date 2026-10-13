<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'author_id',
        'publisher_id',
        'title',
        'category',
        'isbn',
        'publication_year',
        'stock',
    ];

    protected $casts = [
        'publication_year' => 'integer',
        'stock' => 'integer',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }
}