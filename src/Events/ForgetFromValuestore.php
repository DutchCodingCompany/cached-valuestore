<?php

namespace DutchCodingCompany\CachedValuestore\Events;

use Illuminate\Queue\SerializesModels;

class ForgetFromValuestore
{
    use SerializesModels;

    public string $key;

    /** @var string|int|null */
    public $oldValue;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $key, $oldValue)
    {
        $this->key = $key;
        $this->oldValue = $oldValue;
    }
}
