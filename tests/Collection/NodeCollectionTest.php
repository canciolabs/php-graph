<?php

namespace Cancio\Graph\Tests\Collection;

use Cancio\Graph\Ds\Collection\NodeCollection;
use Cancio\Graph\Ds\Node\Node;
use Cancio\Graph\Exception\NodeNotFoundException;
use PHPUnit\Framework\TestCase;

class NodeCollectionTest extends TestCase
{

    public function testEmptyConstructor(): void
    {
        $collection = new NodeCollection();

        $this->assertSame([], $collection->toArray());
    }

    public function testConstructor(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $nodes = [$a, $b];

        $collection = new NodeCollection($nodes);

        $this->assertSame($nodes, $collection->toArray());
    }

    public function testAll(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $nodes = [$a, $b];

        $collection = new NodeCollection($nodes);

        $this->assertSame($nodes, $collection->all());
    }

    public function testCopy(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $nodes = [$a, $b];

        $collection = new NodeCollection($nodes);
        $collectionCopy = $collection->copy();

        $this->assertSame($nodes, $collectionCopy->all());
        $this->assertNotSame($collection, $collectionCopy);
    }

    public function testCount(): void
    {
        $a = new Node('A');
        $b = new Node('B');

        $collection = new NodeCollection();

        // When empty
        $this->assertCount(0, $collection);

        // When not empty
        $collection->add($a);
        $collection->add($b);
        $this->assertCount(2, $collection);
    }

    public function testGetWhenNodeIsMissing(): void
    {
        $a = new Node('A');

        $collection = new NodeCollection();

        $this->expectException(NodeNotFoundException::class);

        $collection->get($a);
    }

    public function testGet(): void
    {
        $a = new Node('A');
        $b = new Node('B');

        $collection = new NodeCollection();

        $collection->add($a);

        $this->assertSame($a, $collection->get($a));

        $collection->add($b);

        $this->assertSame($a, $collection->get($a));
        $this->assertSame($b, $collection->get($b));
    }

    public function testGetIterator(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $nodes = [$a, $b];

        $collection = new NodeCollection($nodes);

        foreach ($collection as $key => $value) {
            $this->assertContains($key, ['A', 'B']);
            $this->assertContains($value, $nodes);
        }
    }

    public function testHas(): void
    {
        $a = new Node('A');
        $b = new Node('B');

        $collection = new NodeCollection();

        // When node is missing
        $this->assertFalse($collection->has($a));
        $this->assertFalse($collection->has($b));

        $collection->add($a);

        $this->assertTrue($collection->has($a));
        $this->assertFalse($collection->has($b));

        $collection->add($b);

        $this->assertTrue($collection->has($a));
        $this->assertTrue($collection->has($b));
    }

    public function testRemoveWhenNodeIsMissing(): void
    {
        $a = new Node('A');

        $collection = new NodeCollection();

        $this->expectException(NodeNotFoundException::class);

        $collection->remove($a);
    }

    public function testRemove(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $nodes = [$a, $b];

        $collection = new NodeCollection($nodes);

        $collection->remove($a);

        $this->assertFalse($collection->has($a));
        $this->assertTrue($collection->has($b));

        $collection->remove($b);

        $this->assertFalse($collection->has($a));
        $this->assertFalse($collection->has($b));;
    }

    public function testSet(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $nodes = [$a, $b];

        $collection = new NodeCollection();
        $collection->set($nodes);

        $this->assertSame($nodes, $collection->toArray());
    }

    public function testToArray(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $nodes = [$a, $b];

        $collection = new NodeCollection($nodes);

        $this->assertSame($nodes, $collection->toArray());
    }

}