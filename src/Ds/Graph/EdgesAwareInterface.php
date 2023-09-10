<?php

namespace Cancio\Graph\Ds\Graph;

use Cancio\Graph\Ds\Collection\EdgeCollectionInterface;

interface EdgesAwareInterface
{

    public function getEdges(): EdgeCollectionInterface;

}