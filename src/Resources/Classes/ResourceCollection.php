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
     * @var array<int<0,max>, ResourceInterface|ResourceFilesInterface>
     */
    private array $storage;

    /**
     * @var int<0,max>
     */
    private int $counter = 0;

    public function __construct(ResourceInterface|ResourceFilesInterface ...$resources)
    {
        if (!empty($resources)) {
            foreach ($resources as $resource) {
                $this->storage[] = $resource;
                $this->counter++;
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
        return $this->counter;
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

    public function getLast(): ?ResourceInterface
    {
        if ($this->counter === 0) {
            return null;
        }

        return $this->storage[$this->counter] ?? null;
    }
}
