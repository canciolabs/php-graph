<?php

namespace Cancio\Graph\Tests\Utils;

use Cancio\Graph\Collection\NodeCollection;
use Cancio\Graph\Exception\NodeNotFoundException;
use Cancio\Graph\Node\Node;
use Cancio\Graph\Utils\VisitedNodesChecker;
use PHPUnit\Framework\TestCase;

class VisitedNodesCheckerTest extends TestCase
{

    public function testIsVisitedWhenNodeIsMissing(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $nodes = [$a];
        $nodesCollection = new NodeCollection($nodes);

        $visitedNodesChecker = new VisitedNodesChecker($nodesCollection);

        $this->expectException(NodeNotFoundException::class);

        $visitedNodesChecker->isVisited($b);
    }

    public function testReset(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $nodes = [$a, $b, $c];
        $nodesCollection = new NodeCollection($nodes);

        $visitedNodesChecker = new VisitedNodesChecker($nodesCollection);

        $this->assertSame(VisitedNodesChecker::UNVISITED, $visitedNodesChecker->isVisited($a));
        $this->assertSame(VisitedNodesChecker::UNVISITED, $visitedNodesChecker->isVisited($b));
        $this->assertSame(VisitedNodesChecker::UNVISITED, $visitedNodesChecker->isVisited($c));
    }

    public function testVisitWhenNodeIsMissing(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $nodes = [$a];
        $nodesCollection = new NodeCollection($nodes);

        $visitedNodesChecker = new VisitedNodesChecker($nodesCollection);

        $this->expectException(NodeNotFoundException::class);

        $visitedNodesChecker->visit($b);
    }

    public function testVisit(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $nodes = [$a, $b, $c];
        $nodesCollection = new NodeCollection($nodes);

        $visitedNodesChecker = new VisitedNodesChecker($nodesCollection);

        $visitedNodesChecker->visit($a);

        $this->assertSame(VisitedNodesChecker::VISITED, $visitedNodesChecker->isVisited($a));
        $this->assertSame(VisitedNodesChecker::UNVISITED, $visitedNodesChecker->isVisited($b));
        $this->assertSame(VisitedNodesChecker::UNVISITED, $visitedNodesChecker->isVisited($c));

        $visitedNodesChecker->visit($b);

        $this->assertSame(VisitedNodesChecker::VISITED, $visitedNodesChecker->isVisited($a));
        $this->assertSame(VisitedNodesChecker::VISITED, $visitedNodesChecker->isVisited($b));
        $this->assertSame(VisitedNodesChecker::UNVISITED, $visitedNodesChecker->isVisited($c));

        $visitedNodesChecker->visit($c);

        $this->assertSame(VisitedNodesChecker::VISITED, $visitedNodesChecker->isVisited($a));
        $this->assertSame(VisitedNodesChecker::VISITED, $visitedNodesChecker->isVisited($b));
        $this->assertSame(VisitedNodesChecker::VISITED, $visitedNodesChecker->isVisited($c));
    }

    public function testUnvisitWhenNodeIsMissing(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $nodes = [$a];
        $nodesCollection = new NodeCollection($nodes);

        $visitedNodesChecker = new VisitedNodesChecker($nodesCollection);

        $this->expectException(NodeNotFoundException::class);

        $visitedNodesChecker->unvisit($b);
    }

    public function testUnvisit(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $nodes = [$a, $b, $c];
        $nodesCollection = new NodeCollection($nodes);

        $visitedNodesChecker = new VisitedNodesChecker($nodesCollection);

        $visitedNodesChecker->visit($a);
        $visitedNodesChecker->visit($b);
        $visitedNodesChecker->visit($c);

        $visitedNodesChecker->unvisit($a);

        $this->assertSame(VisitedNodesChecker::UNVISITED, $visitedNodesChecker->isVisited($a));
        $this->assertSame(VisitedNodesChecker::VISITED, $visitedNodesChecker->isVisited($b));
        $this->assertSame(VisitedNodesChecker::VISITED, $visitedNodesChecker->isVisited($c));

        $visitedNodesChecker->unvisit($b);

        $this->assertSame(VisitedNodesChecker::UNVISITED, $visitedNodesChecker->isVisited($a));
        $this->assertSame(VisitedNodesChecker::UNVISITED, $visitedNodesChecker->isVisited($b));
        $this->assertSame(VisitedNodesChecker::VISITED, $visitedNodesChecker->isVisited($c));

        $visitedNodesChecker->unvisit($c);

        $this->assertSame(VisitedNodesChecker::UNVISITED, $visitedNodesChecker->isVisited($a));
        $this->assertSame(VisitedNodesChecker::UNVISITED, $visitedNodesChecker->isVisited($b));
        $this->assertSame(VisitedNodesChecker::UNVISITED, $visitedNodesChecker->isVisited($c));
    }

}