<?php

namespace Cancio\Graph\Tests\Ds\Stack;

use Cancio\Graph\Ds\Node\Node;
use Cancio\Graph\Ds\Stack\NodeStack;
use PHPUnit\Framework\TestCase;
use UnderflowException;

class NodeStackTest extends TestCase
{

    public function testEmptyConstructor(): void
    {
        $stack = new NodeStack();

        $this->assertCount(0, $stack);
    }

    public function testConstructorWithInvalidArguments(): void
    {
        $nodes = [1, 2, 3];

        $this->expectException(\InvalidArgumentException::class);

        new NodeStack($nodes);
    }

    public function testConstructor(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $nodes = [$a, $b, $c];
        $reverse = array_reverse($nodes);

        $stack = new NodeStack($nodes);

        $this->assertSame($reverse, $stack->toArray());
    }

    public function testClear(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $nodes = [$a, $b, $c];

        $stack = new NodeStack($nodes);
        $stack->clear();

        $this->assertCount(0, $stack);
    }

    public function testCopy(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $nodes = [$a, $b, $c];

        $stack = new NodeStack($nodes);
        $copy = $stack->copy();

        $this->assertSame($stack->toArray(), $copy->toArray());
    }

    public function testCount(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $nodes = [$a, $b, $c];

        $stack = new NodeStack($nodes);

        $this->assertCount(3, $stack);
    }

    public function testIsEmpty(): void
    {
        $stack = new NodeStack();

        // Default
        $this->assertTrue($stack->isEmpty());

        // Not empty
        $stack->push(new Node('A'));
        $this->assertFalse($stack->isEmpty());
    }

    public function testPeekWhenStackIsEmpty(): void
    {
        $this->expectException(UnderflowException::class);

        $stack = new NodeStack();
        $stack->peek();
    }

    public function testPeek(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');

        $stack = new NodeStack();

        $stack->push($a);
        $this->assertSame($a, $stack->peek());

        $stack->push($b);
        $this->assertSame($b, $stack->peek());

        $stack->push($c);
        $this->assertSame($c, $stack->peek());
    }

    public function testPopWhenStackIsEmpty(): void
    {
        $this->expectException(UnderflowException::class);

        $stack = new NodeStack();
        $stack->pop();
    }

    public function testPop(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');

        $stack = new NodeStack();

        $stack->push($a);
        $stack->push($b);

        $this->assertSame($b, $stack->pop());
        $this->assertSame($a, $stack->pop());
    }

    public function testToArray(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $nodes = [$a, $b, $c];
        $reverse = array_reverse($nodes);

        $stack = new NodeStack($nodes);

        $this->assertSame($reverse, $stack->toArray());
    }

}