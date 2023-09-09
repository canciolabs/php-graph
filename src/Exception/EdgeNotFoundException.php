<?php

namespace Cancio\Graph\Exception;

use Cancio\Graph\Edge\EdgeInterface;
use Exception;
use Throwable;

class EdgeNotFoundException extends Exception
{

    public function __construct(EdgeInterface $edge, $code = 0, Throwable $previous = null)
    {
        $message = sprintf(
            'The edge between "%s" and "%s" was not found.',
            $edge->getFrom()->getId(),
            $edge->getTo()->getId(),
        );

        parent::__construct($message, $code, $previous);
    }

}