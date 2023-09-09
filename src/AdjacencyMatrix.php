<?php

namespace Cancio\Graph;

use Cancio\Graph\Edge\EdgeInterface;
use Cancio\Graph\Node\NodeInterface;
use Webmozart\Assert\Assert;

class AdjacencyMatrix implements GraphInterface
{

    private array $matrix;

    /**
     * @var NodeInterface[]
     */
    private array $nodes;

    /**
     * @var EdgeInterface[]
     */
    private array $edges;

    public function __construct(array $nodes, array $edges)
    {
        Assert::allIsInstanceOf($nodes, NodeInterface::class);
        Assert::allIsInstanceOf($edges, EdgeInterface::class);

        $this->nodes = [];
        foreach ($nodes as $node) {
            $this->nodes[(string) $node] = $node;
        }

        $this->edges = [];
        foreach ($edges as $edge) {
            $this->edges[(string) $edge] = $edge;
        }

        $this->initMatrix();
    }

    private function initMatrix(): void
    {
        $this->matrix = [];

        foreach ($this->nodes as $u) {
            $fromId = $u->getId();

            $this->matrix[$fromId] = [];

            foreach ($this->nodes as $v) {
                $toId = $v->getId();
                $this->matrix[$fromId][$toId] = null;
            }
        }

        foreach ($this->edges as $edge) {
            $fromId = $edge->getFrom()->getId();
            $toId = $edge->getTo()->getId();
            $this->matrix[$fromId][$toId] = $edge;
        }
    }

    /**
     * @return NodeInterface[]
     */
    public function getNodes(): array
    {
        return $this->nodes;
    }

    public function getIncomingNodes(NodeInterface $u): array
    {
        $nodes = [];

        foreach ($this->nodes as $v) {
            if ($this->matrix[(string) $v][(string) $u] instanceof EdgeInterface) {
                $nodes[] = $v;
            }
        }

        return $nodes;
    }

    public function getOutgoingNodes(NodeInterface $u): array
    {
        $nodes = [];

        foreach ($this->nodes as $v) {
            if ($this->matrix[(string) $u][(string) $v] instanceof EdgeInterface) {
                $nodes[] = $v;
            }
        }

        return $nodes;
    }

    public function getEdges(): array
    {
        return $this->edges;
    }

    public function getIncomingEdges(NodeInterface $u): array
    {
        $edges = [];

        foreach ($this->nodes as $v) {
            $edge = $this->matrix[(string) $v][(string) $u];

            if ($edge instanceof EdgeInterface) {
                $edges[] = $edge;
            }
        }

        return $edges;
    }

    public function getOutgoingEdges(NodeInterface $u): array
    {
        $edges = [];

        foreach ($this->nodes as $v) {
            $edge = $this->matrix[(string) $u][(string) $v];

            if ($edge instanceof EdgeInterface) {
                $edges[] = $edge;
            }
        }

        return $edges;
    }

    public function hasEdgeBetween(NodeInterface $u, NodeInterface $v): bool
    {
        return $this->matrix[(string) $u][(string) $v] instanceof EdgeInterface;
    }

}