<?php

namespace DutchCodingCompany\CachedValuestore\Events;

use Illuminate\Queue\SerializesModels;

class FlushValuestore
{
    use SerializesModels;

    public ?string $startingWith;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $startingWith = null)
    {
        $this->startingWith = $startingWith;
    }
}
