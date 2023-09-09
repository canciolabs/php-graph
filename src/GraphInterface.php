<?php

namespace Cancio\Graph;

use Cancio\Graph\Collection\NodeCollection;
use Cancio\Graph\Edge\EdgeInterface;
use Cancio\Graph\Node\NodeInterface;

interface GraphInterface
{

    public function getNodes(): NodeCollection;

    /**
     * @return NodeInterface[]
     */
    public function getIncomingNodes(NodeInterface $u): array;

    /**
     * @return NodeInterface[]
     */
    public function getOutgoingNodes(NodeInterface $u): array;

    /**
     * @return EdgeInterface[]
     */
    public function getEdges(): array;

    /**
     * @return EdgeInterface[]
     */
    public function getIncomingEdges(NodeInterface $u): array;

    /**
     * @return EdgeInterface[]
     */
    public function getOutgoingEdges(NodeInterface $u): array;

    public function hasEdgeBetween(NodeInterface $u, NodeInterface $v): bool;

}