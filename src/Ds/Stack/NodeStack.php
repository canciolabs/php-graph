<?php

namespace Cancio\Graph\Ds\Stack;

use Cancio\Graph\Ds\Node\NodeInterface;
use Ds\Stack;
use Webmozart\Assert\Assert;

class NodeStack implements NodeStackInterface
{

    private Stack $stack;

    public function __construct(array $nodes = [])
    {
        Assert::allIsInstanceOf($nodes, NodeInterface::class);

        $this->stack = new Stack($nodes);
    }

    public function clear(): self
    {
        $this->stack->clear();

        return $this;
    }

    public function copy(): self
    {
        return new self(array_reverse($this->toArray()));
    }

    public function count(): int
    {
        return $this->stack->count();
    }

    public function isEmpty(): bool
    {
        return $this->stack->isEmpty();
    }

    public function peek(): NodeInterface
    {
        return $this->stack->peek();
    }

    public function pop(): NodeInterface
    {
        return $this->stack->pop();
    }

    public function push(NodeInterface $node): self
    {
        $this->stack->push($node);

        return $this;
    }

    public function toArray(): array
    {
        return $this->stack->toArray();
    }

}