<?php

namespace Cancio\Graph\Tests\Algorithm\TopologicalSort;

use Cancio\Graph\AdjacencyMatrix;
use Cancio\Graph\Algorithm\TopologicalSort\TopologicalSort;
use Cancio\Graph\Ds\Edge\Edge;
use Cancio\Graph\Ds\Node\Node;
use PHPUnit\Framework\TestCase;

class TopologicalSortTest extends TestCase
{

    public function testTopologicalSortDefaultValue(): void
    {
        $graph = new AdjacencyMatrix([], []);

        $algo = new TopologicalSort($graph);

        $this->assertSame([], $algo->getTopologicalSort());
    }

    /**
     * Graph: A
     */
    public function testGraph1(): void
    {
        $a = new Node('A');
        $nodes = [$a];

        $edges = [];

        $graph = new AdjacencyMatrix($nodes, $edges);

        $algo = new TopologicalSort($graph);
        $algo->run();

        $this->assertSame([$a], $algo->getTopologicalSort());
    }

    /**
     * Graph: A -> B
     */
    public function testGraph2(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $nodes = [$a, $b];

        $edge1 = new Edge($a, $b);
        $edges = [$edge1];

        $graph = new AdjacencyMatrix($nodes, $edges);

        $algo = new TopologicalSort($graph);
        $algo->run();

        $this->assertSame([$a, $b], $algo->getTopologicalSort());
    }

    /**
     * Graph: A <-> B
     */
    public function testGraph3(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $nodes = [$a, $b];

        $edge1 = new Edge($a, $b);
        $edge2 = new Edge($b, $a);
        $edges = [$edge1, $edge2];

        $graph = new AdjacencyMatrix($nodes, $edges);

        $algo = new TopologicalSort($graph);
        $algo->run();

        $this->assertSame([$b, $a], $algo->getTopologicalSort());
    }

    /**
     * Graph: A -> B -> C
     */
    public function testGraph4(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $nodes = [$a, $b, $c];

        $edge1 = new Edge($a, $b);
        $edge2 = new Edge($b, $c);
        $edges = [$edge1, $edge2];

        $graph = new AdjacencyMatrix($nodes, $edges);

        $algo = new TopologicalSort($graph);
        $algo->run();

        $this->assertSame([$a, $b, $c], $algo->getTopologicalSort());
    }

    /**
     * Graph: A -> C; A -> B
     */
    public function testGraph5(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $nodes = [$a, $b, $c];

        $edge1 = new Edge($a, $c);
        $edge2 = new Edge($a, $b);
        $edges = [$edge1, $edge2];

        $graph = new AdjacencyMatrix($nodes, $edges);

        $algo = new TopologicalSort($graph);
        $algo->run();

        $this->assertSame([$a, $b, $c], $algo->getTopologicalSort());
        //$this->assertSame([$a, $c, $b], $algo->getTopologicalSort()); // with adj list!
    }

    /**
     * Graph:
     * A -> B; A -> C;
     * C -> D; C -> E;
     * H -> D;
     * D -> F; D -> G;
     * I
     * J -> K; J -> L
     */
    public function testGraph6(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $c = new Node('C');
        $d = new Node('D');
        $e = new Node('E');
        $f = new Node('F');
        $g = new Node('G');
        $h = new Node('H');
        $i = new Node('I');
        $j = new Node('J');
        $k = new Node('K');
        $l = new Node('L');
        $nodes = [$a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l];

        $edge1 = new Edge($a, $b);
        $edge2 = new Edge($a, $c);
        $edge3 = new Edge($c, $d);
        $edge4 = new Edge($c, $e);
        $edge5 = new Edge($d, $f);
        $edge6 = new Edge($d, $g);
        $edge7 = new Edge($h, $d);
        $edge8 = new Edge($j, $k);
        $edge9 = new Edge($j, $l);
        $edges = [$edge1, $edge2, $edge3, $edge4, $edge5, $edge6, $edge7, $edge8, $edge9];

        $graph = new AdjacencyMatrix($nodes, $edges);

        $algo = new TopologicalSort($graph);
        $algo->run();

        $this->assertSame([$a, $b, $c, $h, $d, $e, $f, $g, $i, $j, $k, $l], $algo->getTopologicalSort());
    }

}