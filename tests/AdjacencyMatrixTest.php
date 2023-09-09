<?php

namespace Cancio\Graph\Tests;

use Cancio\Graph\AdjacencyMatrix;
use Cancio\Graph\Edge\Edge;
use Cancio\Graph\Node\Node;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class AdjacencyMatrixTest extends TestCase
{

    public function testConstructorWhenEdgesArrayIsInvalid(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $nodes = [$a, $b, $c];

        $edges = ['A-B', 'A-C'];

        new AdjacencyMatrix($nodes, $edges);
    }

    public function testEdgesAndNodesGetters(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $nodes = [$a, $b, $c];

        $edge1 = new Edge($a, $b);
        $edge2 = new Edge($a, $c);
        $edges = [$edge1, $edge2];

        $graph = new AdjacencyMatrix($nodes, $edges);

        $this->assertSame($nodes, $graph->getNodes()->toArray());

        $this->assertSame([
            $edge1->getId() => $edge1,
            $edge2->getId() => $edge2,
        ], $graph->getEdges());
    }

    public function testIncomingAndOutgoingGetters(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $d = new Node('D');
        $e = new Node('E');
        $nodes = [$a, $b, $c, $d, $e];

        $edge1 = new Edge($a, $b);
        $edge2 = new Edge($a, $c);
        $edge3 = new Edge($b, $c);
        $edge4 = new Edge($c, $d);
        $edge5 = new Edge($c, $e);
        $edge6 = new Edge($d, $c);
        $edges = [$edge1, $edge2, $edge3, $edge4, $edge5, $edge6];

        $graph = new AdjacencyMatrix($nodes, $edges);

        $this->assertSame([], $graph->getIncomingNodes($a));
        $this->assertSame([$a], $graph->getIncomingNodes($b));
        $this->assertSame([$a, $b, $d], $graph->getIncomingNodes($c));
        $this->assertSame([$c], $graph->getIncomingNodes($d));
        $this->assertSame([$c], $graph->getIncomingNodes($e));

        $this->assertSame([$b, $c], $graph->getOutgoingNodes($a));
        $this->assertSame([$c], $graph->getOutgoingNodes($b));
        $this->assertSame([$d, $e], $graph->getOutgoingNodes($c));
        $this->assertSame([$c], $graph->getOutgoingNodes($d));
        $this->assertSame([], $graph->getOutgoingNodes($e));

        $this->assertSame([], $graph->getIncomingEdges($a));
        $this->assertSame([$edge1], $graph->getIncomingEdges($b));
        $this->assertSame([$edge2, $edge3, $edge6], $graph->getIncomingEdges($c));
        $this->assertSame([$edge4], $graph->getIncomingEdges($d));
        $this->assertSame([$edge5], $graph->getIncomingEdges($e));

        $this->assertSame([$edge1, $edge2], $graph->getOutgoingEdges($a));
        $this->assertSame([$edge3], $graph->getOutgoingEdges($b));
        $this->assertSame([$edge4, $edge5], $graph->getOutgoingEdges($c));
        $this->assertSame([$edge6], $graph->getOutgoingEdges($d));
        $this->assertSame([], $graph->getOutgoingEdges($e));
    }

    public function testHasEdgeBetween(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $nodes = [$a, $b, $c];

        $edge1 = new Edge($a, $b);
        $edge2 = new Edge($a, $c);
        $edges = [$edge1, $edge2];

        $graph = new AdjacencyMatrix($nodes, $edges);

        $this->assertFalse($graph->hasEdgeBetween($a, $a));
        $this->assertTrue($graph->hasEdgeBetween($a, $b));
        $this->assertTrue($graph->hasEdgeBetween($a, $c));

        $this->assertFalse($graph->hasEdgeBetween($b, $a));
        $this->assertFalse($graph->hasEdgeBetween($b, $b));
        $this->assertFalse($graph->hasEdgeBetween($b, $c));

        $this->assertFalse($graph->hasEdgeBetween($c, $a));
        $this->assertFalse($graph->hasEdgeBetween($c, $b));
        $this->assertFalse($graph->hasEdgeBetween($c, $c));
    }

}