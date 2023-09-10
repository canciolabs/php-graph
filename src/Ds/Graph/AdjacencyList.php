<?php

namespace Cancio\Graph\Ds\Graph;

use Cancio\Graph\Ds\Collection\EdgeCollection;
use Cancio\Graph\Ds\Collection\NodeCollection;
use Cancio\Graph\Ds\Edge\EdgeInterface;
use Cancio\Graph\Ds\Node\NodeInterface;

class AdjacencyList implements GraphInterface
{

    use NodesAwareTrait;
    use EdgesAwareTrait;

    /**
     * List of outgoing edges indexed by node id.
     * @var EdgeInterface[][]
     */
    private array $list;

    public function __construct(array $nodes, array $edges)
    {
        $this->nodes = new NodeCollection($nodes);
        $this->edges = new EdgeCollection($edges);

        $this->initList();
    }

    private function initList(): void
    {
        $this->list = [];

        foreach ($this->nodes as $fromId => $from) {
            $this->list[$fromId] = [];
        }

        foreach ($this->edges as $edge) {
            $fromId = $edge->getFrom()->getId();
            $this->list[$fromId][] = $edge;
        }
    }

    public function getIncomingNodes(NodeInterface $u): array
    {
        $incomingNodes = [];

        foreach ($this->list as $edges) {
            foreach ($edges as $edge) {
                if ($edge->getTo() === $u) {
                    $incomingNodes[] = $edge->getFrom();
                }
            }
        }

        return $incomingNodes;
    }

    public function getOutgoingNodes(NodeInterface $u): array
    {
        $outgoingNodes = [];

        $uid = $u->getId();

        foreach ($this->list[$uid] as $edge) {
            $to = $edge->getTo();
            $outgoingNodes[$to->getId()] = $to;
        }

        return array_values($outgoingNodes);
    }

    public function getIncomingEdges(NodeInterface $u): array
    {
        $incomingEdges = [];

        foreach ($this->list as $edges) {
            foreach ($edges as $edge) {
                if ($edge->getTo() === $u) {
                    $incomingEdges[] = $edge;
                }
            }
        }

        return $incomingEdges;
    }

    public function getOutgoingEdges(NodeInterface $u): array
    {
        return $this->list[$u->getId()];
    }

    public function hasEdgeBetween(NodeInterface $u, NodeInterface $v): bool
    {
        $uid = $u->getId();

        foreach ($this->list[$uid] as $edge) {
            if ($edge->getTo() === $v) {
                return true;
            }
        }

        return false;
    }

}