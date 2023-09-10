<?php

namespace Cancio\Graph\Ds\Edge;

use Cancio\Graph\Ds\Node\NodeInterface;

trait EdgeTrait
{

    private NodeInterface $from;
    private NodeInterface $to;
    private int $weight = 0;
    private $data;

    public function __construct(
        NodeInterface $from,
        NodeInterface $to,
        int $weight = 0,
        $data = null
    )
    {
        $this->from = $from;
        $this->to = $to;
        $this->weight = $weight;
        $this->data = $data;
    }

    public function __toString(): string
    {
        return $this->getId();
    }

    public function getId(): string
    {
        return sha1(serialize($this));
    }

    public function getFrom(): NodeInterface
    {
        return $this->from;
    }

    public function getTo(): NodeInterface
    {
        return $this->to;
    }

    public function getWeight(): int
    {
        return $this->weight;
    }

    public function getData()
    {
        return $this->data;
    }

}