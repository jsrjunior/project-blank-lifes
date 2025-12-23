<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'life_id',
        'address_type_id',
        'street',
        'number',
        'complement',
        'district',
        'city',
        'state',
        'zipcode',
        'country',
        'is_primary',
    ];

    /**
     * Cast attributes.
     */
    protected $casts = [
        'is_primary' => 'boolean',
    ];

    /**
     * Address belongs to a Live.
     */
    public function life(): BelongsTo
    {
        return $this->belongsTo(Life::class);
    }

    /**
     * Address type (Residential, Commercial, etc).
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(AddressType::class);
    }
}
