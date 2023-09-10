<?php

namespace Cancio\Graph;

use Cancio\Graph\Ds\Collection\EdgeCollection;
use Cancio\Graph\Ds\Collection\EdgeCollectionInterface;
use Cancio\Graph\Ds\Collection\NodeCollection;
use Cancio\Graph\Ds\Collection\NodeCollectionInterface;
use Cancio\Graph\Ds\Edge\EdgeInterface;
use Cancio\Graph\Ds\Node\NodeInterface;

class AdjacencyMatrix implements GraphInterface
{

    private array $matrix;
    private NodeCollectionInterface $nodes;
    private EdgeCollectionInterface $edges;

    public function __construct(array $nodes, array $edges)
    {
        $this->nodes = new NodeCollection($nodes);
        $this->edges = new EdgeCollection($edges);

        $this->initMatrix();
    }

    private function initMatrix(): void
    {
        $this->matrix = [];

        foreach ($this->nodes as $fromId => $from) {
            $this->matrix[$fromId] = [];

            foreach ($this->nodes as $toId => $to) {
                $this->matrix[$fromId][$toId] = null;
            }
        }

        foreach ($this->edges as $edge) {
            $fromId = $edge->getFrom()->getId();
            $toId = $edge->getTo()->getId();
            $this->matrix[$fromId][$toId] = $edge;
        }
    }

    public function getNodes(): NodeCollection
    {
        return $this->nodes;
    }

    public function getIncomingNodes(NodeInterface $u): array
    {
        $nodes = [];

        $uid = $u->getId();

        foreach ($this->nodes as $vid => $v) {
            if ($this->matrix[$vid][$uid] instanceof EdgeInterface) {
                $nodes[] = $v;
            }
        }

        return $nodes;
    }

    public function getOutgoingNodes(NodeInterface $u): array
    {
        $nodes = [];

        $uid = $u->getId();

        foreach ($this->nodes as $vid => $v) {
            if ($this->matrix[$uid][$vid] instanceof EdgeInterface) {
                $nodes[] = $v;
            }
        }

        return $nodes;
    }

    public function getEdges(): EdgeCollectionInterface
    {
        return $this->edges;
    }

    public function getIncomingEdges(NodeInterface $u): array
    {
        $edges = [];

        $uid = $u->getId();

        foreach ($this->nodes as $vid => $v) {
            $edge = $this->matrix[$vid][$uid];

            if ($edge instanceof EdgeInterface) {
                $edges[] = $edge;
            }
        }

        return $edges;
    }

    public function getOutgoingEdges(NodeInterface $u): array
    {
        $edges = [];

        $uid = $u->getId();

        foreach ($this->nodes as $vid => $v) {
            $edge = $this->matrix[$uid][$vid];

            if ($edge instanceof EdgeInterface) {
                $edges[] = $edge;
            }
        }

        return $edges;
    }

    public function hasEdgeBetween(NodeInterface $u, NodeInterface $v): bool
    {
        $uid = $u->getId();
        $vid = $v->getId();

        return $this->matrix[$uid][$vid] instanceof EdgeInterface;
    }

}