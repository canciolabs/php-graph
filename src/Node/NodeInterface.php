<?php

namespace Cancio\Graph\Node;

interface NodeInterface
{

    public function __toString(): string;

    public function getId(): string;

    /**
     * @return mixed
     */
    public function getData();

}