<?php

namespace App\Models;

use App\Events\ResourceCreatedEvent;
use App\Events\ResourceUpdatedEvent;
use App\Libraries\Database\Eloquent\Model;
use App\Models\Concerns\WithIdAdminColumn;
use App\Models\Concerns\WithNameAdminColumn;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{

    use SoftDeletes;
    use HasFactory;

    protected $dispatchesEvents = [
        'created' => ResourceCreatedEvent::class,
        'updated' => ResourceUpdatedEvent::class,
        'deleted' => ResourceUpdatedEvent::class,
    ];

    protected $fillable = [
        'ddi',
        'ddd',
        'number',
        'is_primary',
        'life_id',
        'phone_type_id',
    ];

    protected $casts = [
        'is_primary' => 'boolean'
    ];
}