<?php

namespace Cancio\Graph\Tests\Collection;

use Cancio\Graph\Collection\EdgeCollection;
use Cancio\Graph\Ds\Edge\Edge;
use Cancio\Graph\Ds\Node\Node;
use Cancio\Graph\Exception\EdgeNotFoundException;
use PHPUnit\Framework\TestCase;

class EdgeCollectionTest extends TestCase
{

    public function testEmptyConstructor(): void
    {
        $collection = new EdgeCollection();

        $this->assertSame([], $collection->toArray());
    }

    public function testConstructor(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $edge1 = new Edge($a, $b);
        $edge2 = new Edge($a, $c);
        $edges = [$edge1, $edge2];

        $collection = new EdgeCollection($edges);

        $this->assertSame($edges, $collection->toArray());
    }

    public function testAll(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $edge1 = new Edge($a, $b);
        $edge2 = new Edge($a, $c);
        $edges = [$edge1, $edge2];

        $collection = new EdgeCollection($edges);

        $this->assertSame($edges, $collection->all());
    }

    public function testCopy(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $edge1 = new Edge($a, $b);
        $edge2 = new Edge($a, $c);
        $edges = [$edge1, $edge2];

        $collection = new EdgeCollection($edges);
        $collectionCopy = $collection->copy();

        $this->assertSame($edges, $collectionCopy->all());
        $this->assertNotSame($collection, $collectionCopy);
    }

    public function testCount(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $edge1 = new Edge($a, $b);
        $edge2 = new Edge($a, $c);

        $collection = new EdgeCollection();

        // When empty
        $this->assertCount(0, $collection);

        // When not empty
        $collection->add($edge1);
        $collection->add($edge2);
        $this->assertCount(2, $collection);
    }

    public function testGetWhenEdgeIsMissing(): void
    {
        $a = new Node('A');
        $b = new Node('B');

        $collection = new EdgeCollection();

        $this->expectException(EdgeNotFoundException::class);

        $collection->get($a, $b);
    }

    public function testGet(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $edge1 = new Edge($a, $b);
        $edge2 = new Edge($a, $c);

        $collection = new EdgeCollection();

        $collection->add($edge1);

        $this->assertSame($edge1, $collection->get($a, $b));

        $collection->add($edge2);

        $this->assertSame($edge1, $collection->get($a, $b));
        $this->assertSame($edge2, $collection->get($a, $c));
    }

    public function testGetIterator(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $edge1 = new Edge($a, $b);
        $edge2 = new Edge($a, $c);
        $edges = [$edge1, $edge2];

        $collection = new EdgeCollection($edges);

        foreach ($collection as $value) {
            $this->assertContains($value, $edges);
        }
    }

    public function testHas(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $edge1 = new Edge($a, $b);
        $edge2 = new Edge($a, $c);

        $collection = new EdgeCollection();

        // When edge is missing
        $this->assertFalse($collection->has($edge1));
        $this->assertFalse($collection->has($edge2));

        $collection->add($edge1);

        $this->assertTrue($collection->has($edge1));
        $this->assertFalse($collection->has($edge2));

        $collection->add($edge2);

        $this->assertTrue($collection->has($edge1));
        $this->assertTrue($collection->has($edge2));
    }

    public function testRemoveWhenEdgeIsMissing(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $edge = new Edge($a, $b);

        $collection = new EdgeCollection();

        $this->expectException(EdgeNotFoundException::class);

        $collection->remove($edge);
    }

    public function testRemove(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $edge1 = new Edge($a, $b);
        $edge2 = new Edge($a, $c);
        $edges = [$edge1, $edge2];

        $collection = new EdgeCollection($edges);

        $collection->remove($edge1);

        $this->assertFalse($collection->has($edge1));
        $this->assertTrue($collection->has($edge2));

        $collection->remove($edge2);

        $this->assertFalse($collection->has($edge1));
        $this->assertFalse($collection->has($edge2));
    }

    public function testSet(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $edge1 = new Edge($a, $b);
        $edge2 = new Edge($a, $c);
        $edges = [$edge1, $edge2];

        $collection = new EdgeCollection();
        $collection->set($edges);

        $this->assertSame($edges, $collection->toArray());
    }

    public function testToArray(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $edge1 = new Edge($a, $b);
        $edge2 = new Edge($a, $c);
        $edges = [$edge1, $edge2];

        $collection = new EdgeCollection($edges);

        $this->assertSame($edges, $collection->toArray());
    }

}