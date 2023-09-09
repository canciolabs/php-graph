<?php

namespace Cancio\Graph\Collection;

use Cancio\Graph\Node\NodeInterface;
use Countable;
use IteratorAggregate;

interface NodeCollectionInterface extends Countable, IteratorAggregate
{

    /**
     * Adds a node.
     * @param NodeInterface $node
     * @return self
     */
    public function add(NodeInterface $node): self;

    /**
     * Returns all nodes.
     * @return NodeInterface[]
     */
    public function all(): array;

    /**
     * Returns a copy of the Node Collection.
     * @return self
     */
    public function copy(): self;

    /**
     * Gets a node.
     * @param NodeInterface $node
     * @return NodeInterface
     */
    public function get(NodeInterface $node): NodeInterface;

    /**
     * Gets a node by id.
     * @param string $id
     * @return NodeInterface
     */
    public function getById(string $id): NodeInterface;

    /**
     * Checks if a node exists.
     * @param NodeInterface $node
     * @return bool
     */
    public function has(NodeInterface $node): bool;

    /**
     * Checks if a node exists by id.
     * @param string $id
     * @return bool
     */
    public function hasById(string $id): bool;

    /**
     * Removes a node.
     * @param NodeInterface $node
     * @return self
     */
    public function remove(NodeInterface $node): self;

    /**
     * Removes a node by id.
     * @param string $id
     * @return self
     */
    public function removeById(string $id): self;

    /**
     * Replaces the current node list by a new one.
     * @param NodeInterface[] $nodes
     * @return self
     */
    public function set(array $nodes): self;

    /**
     * Converts the node collection to array.
     * @return array
     */
    public function toArray(): array;

}