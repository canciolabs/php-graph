<?php

namespace Cancio\Graph\Ds\Collection;

use ArrayIterator;
use Cancio\Graph\Ds\Edge\Edge;
use Cancio\Graph\Ds\Edge\EdgeInterface;
use Cancio\Graph\Ds\Node\NodeInterface;
use Cancio\Graph\Exception\EdgeNotFoundException;
use Traversable;

class EdgeCollection implements EdgeCollectionInterface
{

    private array $edges;

    public function __construct(array $edges = [])
    {
        $this->set($edges);
    }

    public function add(EdgeInterface $edge): EdgeCollectionInterface
    {
        $this->edges[$edge->getId()] = $edge;

        return $this;
    }

    public function all(): array
    {
        return array_values($this->edges);
    }

    public function copy(): EdgeCollectionInterface
    {
        return clone $this;
    }

    public function count(): int
    {
        return count($this->edges);
    }

    public function get(NodeInterface $u, NodeInterface $v): EdgeInterface
    {
        foreach ($this->edges as $edge) {
            if ($edge->getFrom() === $u && $edge->getTo() === $v) {
                return $edge;
            }
        }

        throw new EdgeNotFoundException(new Edge($u, $v));
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->edges);
    }

    public function has(EdgeInterface $edge): bool
    {
        return array_key_exists($edge->getId(), $this->edges);
    }

    public function remove(EdgeInterface $edge): EdgeCollectionInterface
    {
        $this->assertEdgeExists($edge);

        unset($this->edges[$edge->getId()]);

        return $this;
    }

    public function set(array $edges): EdgeCollectionInterface
    {
        $this->edges = [];

        foreach ($edges as $edge) {
            $this->add($edge);
        }

        return $this;
    }

    public function toArray(): array
    {
        return array_values($this->edges);
    }

    private function assertEdgeExists(EdgeInterface $edge): void
    {
        if (!$this->has($edge)) {
            throw new EdgeNotFoundException($edge);
        }
    }

}