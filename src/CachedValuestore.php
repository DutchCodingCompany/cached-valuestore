<?php

namespace DutchCodingCompany\CachedValuestore;

use Spatie\Valuestore\Valuestore;
use Illuminate\Container\Container;
use Illuminate\Contracts\Events\Dispatcher;

class CachedValuestore extends Valuestore
{
    public static ?string $cachedFileName = null;

    protected ?Dispatcher $dispatcher = null;

    protected ?array $cachedData = null;

    /**
     * Get all values from the store.
     *
     * @param  bool  $reloadCache wether or not to reload data from the store
     * @return array
     */
    public function all(bool $reloadCache = false): array
    {
        if (! is_null($this->cachedData) && $reloadCache === false) {
            return $this->cachedData;
        }

        return $this->cachedData = parent::all();
    }

    /**
     * {@inheritdoc}
     */
    protected function setContent(array $values): static
    {
        $this->clearCache();

        return parent::setContent($values);
    }

    /**
     * Clears the cached data.
     *
     * @return $this
     */
    public function clearCache(): self
    {
        $this->cachedData = null;

        return $this;
    }

    /**
     * Upgrade from regular valuestore.
     *
     * @param  \Spatie\Valuestore\Valuestore $store
     * @param  array                         $values
     * @return $this
     */
    public static function fromValuestore(Valuestore $store, array $values = null): self
    {
        return static::make($store->fileName, $values);
    }

    /**
     * Gets the dispatcher from the container
     *
     * @return \Illuminate\Contracts\Events\Dispatcher
     */
    protected function dispatcher(): Dispatcher
    {
        if (is_null($this->dispatcher)) {
            $this->dispatcher = Container::getInstance()->make(Dispatcher::class);
        }

        return $this->dispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function put(array|string $name, mixed $value = null): static
    {
        // Get arguments to event
        $oldValue = parent::get($name);
        $newValue = $value;

        // Execute method
        $result = parent::put($name, $value);

        // Trigger event
        $this->dispatcher()->dispatch(new Events\PutIntoValuestore($name, $oldValue, $newValue));

        // Return stuff
        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function forget(string $key): static
    {
        // Get arguments to event
        $oldValue = parent::get($key);

        // Execute method
        $result = parent::forget($key);

        // Trigger event
        $this->dispatcher()->dispatch(new Events\ForgetFromValuestore($key, $oldValue));

        // Return stuff
        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function flush(): static
    {
        $result = parent::flush();

        // Trigger event
        $this->dispatcher()->dispatch(new Events\FlushValuestore());

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function flushStartingWith(string $startingWith = ''): static
    {
        $result = parent::flushStartingWith($startingWith);

        // Trigger event
        $this->dispatcher()->dispatch(new Events\FlushValuestore($startingWith));

        return $result;
    }
}
