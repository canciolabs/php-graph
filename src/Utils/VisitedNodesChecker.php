<?php

namespace Cancio\Graph\Utils;

use Cancio\Graph\Collection\NodeCollectionInterface;
use Cancio\Graph\Exception\NodeNotFoundException;
use Cancio\Graph\Node\NodeInterface;

class VisitedNodesChecker
{

    public const VISITED = true;
    public const UNVISITED = false;

    private NodeCollectionInterface $nodes;

    /**
     * @var bool[]
     */
    private array $visitedNodes = [];

    public function __construct(NodeCollectionInterface $nodes)
    {
        $this->nodes = $nodes;

        $this->reset();
    }

    public function reset(): self
    {
        foreach ($this->nodes as $node) {
            $this->visitedNodes[$node->getId()] = self::UNVISITED;
        }

        return $this;
    }

    public function isVisited(NodeInterface $node): bool
    {
        $this->assertNodeExists($node);

        return $this->visitedNodes[$node->getId()] === self::VISITED;
    }

    public function unvisit(NodeInterface $node): self
    {
        $this->assertNodeExists($node);

        $this->visitedNodes[$node->getId()] = self::UNVISITED;

        return $this;
    }

    public function visit(NodeInterface $node): self
    {
        $this->assertNodeExists($node);

        $this->visitedNodes[$node->getId()] = self::VISITED;

        return $this;
    }

    private function assertNodeExists(NodeInterface $node): void
    {
        if (!$this->nodes->has($node)) {
            throw new NodeNotFoundException($node);
        }
    }

}