<?php

namespace Cancio\Graph\Ds\Stack;

use Cancio\Graph\Ds\Node\NodeInterface;
use Countable;

interface NodeStackInterface extends Countable
{

    public function clear(): self;

    public function copy(): self;

    public function count(): int;

    public function isEmpty(): bool;

    public function peek(): NodeInterface;

    public function pop(): NodeInterface;

    public function push(NodeInterface $node): self;

    public function toArray(): array;

}