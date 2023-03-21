<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Artist extends Model
{
    use HasUlids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'artist',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'user_id', 'deleted_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'artist' => 'array',
    ];

    /**
     * Scope a query using identifier to determine query
     */
    public function scopeIdentifier(Builder $query, string $artist): void
    {
        $query->when(str($artist)->isUuid(), function ($query) use ($artist) {
            return $query->whereJsonContains('artist->mbid', $artist);
        }, function ($query) use ($artist) {
            return $query->whereJsonContains('artist->name', $artist);
        });
    }
}
