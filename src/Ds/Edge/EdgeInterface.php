<?php

namespace Cancio\Graph\Ds\Edge;

use Cancio\Graph\Ds\Node\NodeInterface;

interface EdgeInterface
{

    public function __toString(): string;

    public function getId(): string;

    public function getFrom(): NodeInterface;

    public function getTo(): NodeInterface;

    public function getWeight(): int;

    /**
     * @return mixed
     */
    public function getData();

}