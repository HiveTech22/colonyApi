<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyCategory extends Model
{
    use HasFactory;

    const TABLE = 'property_categories';
    protected $table = self::TABLE;

    protected $fillable = [
        'name'
    ];

    // protected $with= [
    //     'properties'
    // ];

    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    public function id(): string
    {
        return (string) $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    
}