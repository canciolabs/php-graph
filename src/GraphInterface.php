<?php

namespace Cancio\Graph;

use Cancio\Graph\Ds\Edge\EdgeInterface;
use Cancio\Graph\Ds\Graph\EdgesAwareInterface;
use Cancio\Graph\Ds\Graph\NodesAwareInterface;
use Cancio\Graph\Ds\Node\NodeInterface;

interface GraphInterface extends EdgesAwareInterface, NodesAwareInterface
{

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
    public function getIncomingEdges(NodeInterface $u): array;

    /**
     * @return EdgeInterface[]
     */
    public function getOutgoingEdges(NodeInterface $u): array;

    public function hasEdgeBetween(NodeInterface $u, NodeInterface $v): bool;

}