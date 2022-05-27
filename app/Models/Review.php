<?php

namespace App\Models;

use App\Traits\HasAuthor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;
    use HasAuthor;

    const TABLE = 'reviews';
    protected $table = self::TABLE;

    protected $fillable = [
        'rating',
        'message',
        'property_id',
        'author_id'
    ];

    public function id(): string
    {
        return (string) $this->id;
    }

    public function message(): string
    {
        return $this->message;
    }

    public function rating(): string
    {
        return $this->rating;
    }

}