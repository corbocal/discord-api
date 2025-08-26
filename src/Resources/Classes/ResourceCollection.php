<?php

declare(strict_types=1);

namespace Corbocal\DiscordApi\Resources\Classes;

use ArrayIterator;
use Corbocal\DiscordApi\Resources\ResourceFilesInterface;
use Corbocal\DiscordApi\Resources\ResourceInterface;
use Countable;
use IteratorAggregate;
use Traversable;

/**
 * @template TKey of int
 * @template TValue of ResourceInterface|ResourceFilesInterface
 * @implements IteratorAggregate<TKey, TValue>
 * @implements Traversable<TKey, TValue>
 */
class ResourceCollection implements IteratorAggregate, Countable, Traversable
{
    /**
     * @var array<int, ResourceInterface|ResourceFilesInterface>
     */
    private array $storage;

    public function __construct(ResourceInterface|ResourceFilesInterface ...$resources)
    {
        if (!empty($resources)) {
            foreach ($resources as $resource) {
                $this->storage[] = $resource;
            }
        }
    }

    /**
     * @return array<mixed>
     */
    public function toArray(): array
    {
        $result = [];
        foreach ($this as $key => $value) {
            $result[$key] = $value->toArray();
        }
        return $result;
    }

    /**
     * @return ArrayIterator<int, ResourceInterface|ResourceFilesInterface>
     */
    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->storage);
    }


    public function count(): int
    {
        return count($this->storage);
    }

    /**
     * @param ResourceInterface|ResourceFilesInterface $resource
     * @return self<int,ResourceInterface|ResourceFilesInterface>
     */
    public function append(ResourceInterface $resource): self
    {
        $this->storage[] = $resource;

        return $this;
    }
}
