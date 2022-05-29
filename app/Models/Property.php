<?php

namespace App\Models;

use App\Cast\TitleCast;
use App\Traits\HasAuthor;
use Illuminate\Support\Str;
use App\Traits\ModelHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;
    use HasAuthor;
    use ModelHelpers;
    
    const TABLE = 'properties';
    protected $table = self::TABLE;

    protected $fillable = [
        'title',
        'slug',
        'price',
        'built',
        'bedroom',
        'bathroom',
        'purpose',
        'latitude',
        'longitude',
        'frequency',
        'description',
        'fence',
        'pool',
        'wifi',
        'park',
        'conditioning',
        'tiles',
        'furnish',
        'laundry',
        'isAvailable',
        'isVerified',
        'image',
        'image2',
        'image3',
        'video',
        'author_id',
    ];

    protected $casts = [
        'title'  =>  TitleCast::class,
        'frequency'  =>  TitleCast::class,
        'built' => 'datetime',
        'laundry' => 'boolean',
        'fence'         => 'boolean',
        'pool'          => 'boolean',
        'wifi'          => 'boolean',
        'park'          => 'boolean',
        'conditioning'          => 'boolean',
        'tiles'         => 'boolean',
        'furnish'           => 'boolean',
    ];

    public function id(): string
    {
        return (string) $this->id;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function price(): string
    {
        return $this->price;
    }

    public function excerpt(int $limit = 250): string
    {
        return Str::limit(strip_tags($this->description()), $limit);
    }

    public function description(): string
    {
        return $this->description;
    }

    public function createdAt()
    {
        return $this->created_at->format('M, d Y');
    }

    public function purpose(): string
    {
        return $this->purpose;
    }

    public function frequency(): string
    {
        return $this->frequency;
    }

    public function built(): string
    {
        return $this->built->format('Y');
    }

    public function bedroom(): ?string
    {
        return $this->bedroom;
    }

    public function bathroom(): ?string
    {
        return $this->bathroom;
    }

    public function address(): ?string
    {
        return $this->address;
    }

    public function latitude(): ?string
    {
        return $this->latitude;
    }

    public function longitude(): ?string
    {
        return $this->longitude;
    }

    public function image(): ?string
    {
        return $this->image;
    }

    public function video(): ?string
    {
        return $this->video;
    }

    public function scopeVerified(Builder $query): Builder
    {
        return $query->where('isVerified', 1);
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('isAvailable', 1);
    }
    
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function laundry(): bool
    {
        return $this->laundry;
    }

    public function fence(): bool
    {
        return $this->fence;
    }

    public function tiles(): bool
    {
        return $this->tiles;
    }

    public function furnish(): bool
    {
        return $this->furnish;
    }

    public function pool(): bool
    {
        return $this->pool;
    }

    public function wifi(): bool
    {
        return $this->wifi;
    }

    public function conditioning(): bool
    {
        return $this->conditioning;
    }

    public function park(): bool
    {
        return $this->park;
    }

}