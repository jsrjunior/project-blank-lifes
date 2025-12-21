<?php

namespace App\Models;

use App\Libraries\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Email extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'life_id',
        'email_type_id',
        'email',
        'is_primary',
        'is_verified'
    ];

    /**
     * Cast attributes.
     */
    protected $casts = [
        'is_primary' => 'boolean',
        'is_verified' => 'boolean'
    ];
}