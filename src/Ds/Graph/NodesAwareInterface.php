<?php

namespace Cancio\Graph\Ds\Graph;

use Cancio\Graph\Ds\Collection\NodeCollection;

interface NodesAwareInterface
{

    public function getNodes(): NodeCollection;

}