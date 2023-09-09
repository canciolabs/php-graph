<?php

namespace Cancio\Graph\Collection;

use ArrayIterator;
use Cancio\Graph\Exception\NodeNotFoundException;
use Cancio\Graph\Node\NodeInterface;
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

    public function get(NodeInterface $node): NodeInterface
    {
        return $this->getById($node->getId());
    }

    public function getById(string $id): NodeInterface
    {
        $this->assertNodeExists($id);

        return $this->nodes[$id];
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->nodes);
    }

    public function has(NodeInterface $node): bool
    {
        return $this->hasById($node->getId());
    }

    public function hasById(string $id): bool
    {
        return array_key_exists($id, $this->nodes);
    }

    public function remove(NodeInterface $node): NodeCollectionInterface
    {
        $this->removeById($node->getId());

        return $this;
    }

    public function removeById(string $id): NodeCollectionInterface
    {
        $this->assertNodeExists($id);

        unset($this->nodes[$id]);

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

    private function assertNodeExists(string $id): void
    {
        if (!$this->hasById($id)) {
            throw new NodeNotFoundException(sprintf(
                'The node "%s" was not found in the NodeCollection.',
                $id
            ));
        }
    }

}