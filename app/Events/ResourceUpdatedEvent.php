<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ResourceUpdatedEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;

    public $resource;
    public $resourceClass;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($resource, $resourceClass = null)
    {
        $this->resource = $resource;
        $this->resourceClass = $resourceClass;
    }
}
