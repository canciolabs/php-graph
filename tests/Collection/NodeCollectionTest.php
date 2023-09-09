<?php

namespace Cancio\Graph\Tests\Collection;

use Cancio\Graph\Collection\NodeCollection;
use Cancio\Graph\Exception\NodeNotFoundException;
use Cancio\Graph\Node\Node;
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

    public function testGetByIdWhenNodeIsMissing(): void
    {
        $collection = new NodeCollection();

        $this->expectException(NodeNotFoundException::class);

        $collection->getById('A');
    }

    public function testGetAndGetById(): void
    {
        $a = new Node('A');
        $b = new Node('B');

        $collection = new NodeCollection();

        $collection->add($a);

        $this->assertSame($a, $collection->get($a));
        $this->assertSame($a, $collection->getById('A'));

        $collection->add($b);

        $this->assertSame($a, $collection->get($a));
        $this->assertSame($a, $collection->getById('A'));
        $this->assertSame($b, $collection->get($b));
        $this->assertSame($b, $collection->getById('B'));
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

    public function testHasAndHasById(): void
    {
        $a = new Node('A');
        $b = new Node('B');

        $collection = new NodeCollection();

        // When node is missing
        $this->assertFalse($collection->has($a));
        $this->assertFalse($collection->hasById('A'));
        $this->assertFalse($collection->has($b));
        $this->assertFalse($collection->hasById('B'));

        $collection->add($a);

        $this->assertTrue($collection->has($a));
        $this->assertTrue($collection->hasById('A'));
        $this->assertFalse($collection->has($b));
        $this->assertFalse($collection->hasById('B'));

        $collection->add($b);

        $this->assertTrue($collection->has($a));
        $this->assertTrue($collection->hasById('A'));
        $this->assertTrue($collection->has($b));
        $this->assertTrue($collection->hasById('B'));
    }

    public function testRemoveWhenNodeIsMissing(): void
    {
        $a = new Node('A');

        $collection = new NodeCollection();

        $this->expectException(NodeNotFoundException::class);

        $collection->remove($a);
    }

    public function testRemoveByIdWhenNodeIsMissing(): void
    {
        $collection = new NodeCollection();

        $this->expectException(NodeNotFoundException::class);

        $collection->removeById('A');
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

    public function testRemoveById(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $nodes = [$a, $b];

        $collection = new NodeCollection($nodes);

        $collection->removeById('A');

        $this->assertFalse($collection->has($a));
        $this->assertTrue($collection->has($b));

        $collection->removeById('B');

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