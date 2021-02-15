<?php

namespace DutchCodingCompany\CachedValuestore\Events;

use Illuminate\Queue\SerializesModels;

class PutIntoValuestore
{
    use SerializesModels;

    /** @var string|array */
    public $name;

    /** @var string|int|null */
    public $oldValue;

    /** @var string|int|null */
    public $newValue;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($name, $oldValue, $newValue)
    {
        $this->name = $name;
        $this->oldValue = $oldValue;
        $this->newValue = $newValue;
    }
}
