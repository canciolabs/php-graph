<?php

namespace Cancio\Graph\Node;

trait NodeTrait
{

    protected string $id;

    /**
     * @var mixed
     */
    protected $data;

    public function __construct(string $id, $data = null)
    {
        $this->id = $id;
        $this->data = $data;
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getData()
    {
        return $this->data;
    }

}