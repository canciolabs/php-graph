<?php

namespace Cancio\Graph\Exception;

use Cancio\Graph\Ds\Node\NodeInterface;
use Exception;
use Throwable;

class NodeNotFoundException extends Exception
{

    public function __construct(NodeInterface $node, $code = 0, Throwable $previous = null)
    {
        $message = sprintf('The node "%s" was not found.', $node->getId());

        parent::__construct($message, $code, $previous);
    }

}