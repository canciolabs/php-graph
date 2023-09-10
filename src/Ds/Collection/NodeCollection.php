<?php

namespace Cancio\Graph\Ds\Collection;

use ArrayIterator;
use Cancio\Graph\Ds\Node\Node;
use Cancio\Graph\Ds\Node\NodeInterface;
use Cancio\Graph\Exception\NodeNotFoundException;
use Traversable;

class NodeCollection implements NodeCollectionInterface
{

    private array $nodes;

    public function __construct(array $nodes = [])
    {
        $this->set($nodes);
    }

    public function add(NodeInterface $node): NodeCollectionInterface
    {
        $this->nodes[$node->getId()] = $node;

        return $this;
    }

    public function all(): array
    {
        return array_values($this->nodes);
    }

    public function copy(): NodeCollectionInterface
    {
        return clone $this;
    }

    public function count(): int
    {
        return count($this->nodes);
    }

    public function get(string $id): NodeInterface
    {
        $this->assertNodeExists(new Node($id));

        return $this->nodes[$id];
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->nodes);
    }

    public function has(NodeInterface $node): bool
    {
        return array_key_exists($node->getId(), $this->nodes);
    }

    public function remove(NodeInterface $node): NodeCollectionInterface
    {
        $this->assertNodeExists($node);

        unset($this->nodes[$node->getId()]);

        return $this;
    }

    public function set(array $nodes): NodeCollectionInterface
    {
        $this->nodes = [];

        foreach ($nodes as $node) {
            $this->add($node);
        }

        return $this;
    }

    public function toArray(): array
    {
        return array_values($this->nodes);
    }

    private function assertNodeExists(NodeInterface $node): void
    {
        if (!$this->has($node)) {
            throw new NodeNotFoundException($node);
        }
    }

}