<?php

namespace Cancio\Graph\Collection;

use Cancio\Graph\Edge\EdgeInterface;
use Cancio\Graph\Node\NodeInterface;
use Countable;
use IteratorAggregate;

interface EdgeCollectionInterface extends Countable, IteratorAggregate
{

    /**
     * Adds an edge.
     * @param EdgeInterface $edge
     * @return self
     */
    public function add(EdgeInterface $edge): self;

    /**
     * Returns all edges.
     * @return EdgeInterface[]
     */
    public function all(): array;

    /**
     * Returns a copy of the Edge Collection.
     * @return self
     */
    public function copy(): self;

    /**
     * Gets an edge between two nodes.
     * @param NodeInterface $u
     * @param NodeInterface $v
     * @return EdgeInterface
     */
    public function get(NodeInterface $u, NodeInterface $v): EdgeInterface;

    /**
     * Checks if an edge exists.
     * @param EdgeInterface $edge
     * @return bool
     */
    public function has(EdgeInterface $edge): bool;

    /**
     * Removes an edge.
     * @param EdgeInterface $edge
     * @return self
     */
    public function remove(EdgeInterface $edge): self;

    /**
     * Replaces the current node list by a new one.
     * @param EdgeInterface[] $edges
     * @return self
     */
    public function set(array $edges): self;

    /**
     * Converts the node collection to array.
     * @return array
     */
    public function toArray(): array;

}