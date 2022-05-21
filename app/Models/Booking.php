<?php

namespace App\Models;

use App\Traits\HasUser;
use App\Models\Property;
use App\Models\Amenities;
use App\Traits\HasAuthor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Booking extends Model
{
    use HasFactory;
    use HasAuthor;

    const TABLE = 'bookings';
    protected $table = self::TABLE;

    protected $fillable = [
        'property_id',
        'user_id',
        'isAccepted',
        'paymentStatus',
    ];

    protected $with = [
        'authorRelation', 'property'
    ];

    protected $casts = [
        'isAccepted' => 'boolean',
        'paymentStatus' => 'boolean',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function id(): string
    {
        return (string) $this->id;
    }

    public function createdAt()
    {
        return $this->created_at->format('M, d Y');
    }

    public function payment(): bool
    {
        return (bool) $this->paymentStatus;
    }

    public function verification(): bool
    {
        return (bool) $this->isAccepted;
    }

}