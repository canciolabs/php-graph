<?php

namespace Cancio\Graph\Ds\Graph;

use Cancio\Graph\Ds\Collection\NodeCollection;
use Cancio\Graph\Ds\Collection\NodeCollectionInterface;

trait NodesAwareTrait
{

    private NodeCollectionInterface $nodes;

    public function getNodes(): NodeCollection
    {
        return $this->nodes;
    }

}