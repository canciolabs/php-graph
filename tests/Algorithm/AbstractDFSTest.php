<?php

namespace Cancio\Graph\Tests\Algorithm;

use Cancio\Graph\AdjacencyMatrix;
use Cancio\Graph\Algorithm\AbstractDFS;
use Cancio\Graph\Algorithm\TopologicalSort;
use Cancio\Graph\Ds\Edge\Edge;
use Cancio\Graph\Ds\Node\Node;
use Cancio\Graph\GraphInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AbstractDFSTest extends TestCase
{

    public function testGetGraph(): void
    {
        $graph = $this->getGraph();

        $algo = new TopologicalSort($graph);

        $this->assertSame($graph, $algo->getGraph());
    }

    protected function getGraph(): GraphInterface
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $nodes = [$a, $b, $c];

        $edge1 = new Edge($a, $b);
        $edge2 = new Edge($a, $c);
        $edges = [$edge1, $edge2];

        return new AdjacencyMatrix($nodes, $edges);
    }

    protected function getAbstractDFSInstance(GraphInterface $graph): MockObject
    {
        return $this->getMockForAbstractClass(AbstractDFS::class, $graph);
    }

}