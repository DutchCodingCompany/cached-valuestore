<?php

namespace DutchCodingCompany\CachedValuestore;

use Spatie\Valuestore\Valuestore;

class CachedValuestore extends Valuestore
{
    public static ?string $cachedFileName = null;

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
    protected function setContent(array $values)
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
}
