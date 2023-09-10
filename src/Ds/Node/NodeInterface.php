<?php

namespace Cancio\Graph\Ds\Node;

interface NodeInterface
{

    public function __toString(): string;

    public function getId(): string;

    /**
     * @return mixed
     */
    public function getData();

}