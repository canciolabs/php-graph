<?php

namespace Cancio\Graph\Ds\Graph;

use Cancio\Graph\Ds\Collection\EdgeCollectionInterface;

trait EdgesAwareTrait
{

    private EdgeCollectionInterface $edges;

    public function getEdges(): EdgeCollectionInterface
    {
        return $this->edges;
    }

}