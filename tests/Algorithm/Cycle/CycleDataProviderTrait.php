<?php

namespace Cancio\Graph\Tests\Algorithm\Cycle;

use Cancio\Graph\Ds\Edge\Edge;
//use Cancio\Graph\Ds\Graph\AdjacencyHybrid;
use Cancio\Graph\Ds\Graph\AdjacencyList;
use Cancio\Graph\Ds\Graph\AdjacencyMatrix;
use Cancio\Graph\Ds\Node\Node;

trait CycleDataProviderTrait
{

    public function cycleDataProvider(): array
    {
        $graphs = [];

        // Create nodes
        $node1 = new Node(1);
        $node2 = new Node(2);
        $node3 = new Node(3);
        $node4 = new Node(4);

        // Create edges
        $edge1_2 = new Edge($node1, $node2);
        $edge1_3 = new Edge($node1, $node3);
        //$edge1_4 = new Edge($node1, $node4);
        $edge2_1 = new Edge($node2, $node1);
        $edge2_3 = new Edge($node2, $node3);
        //$edge2_4 = new Edge($node2, $node4);
        $edge3_1 = new Edge($node3, $node1);
        //$edge3_2 = new Edge($node3, $node2);
        $edge3_4 = new Edge($node3, $node4);
        $edge4_1 = new Edge($node4, $node1);
        $edge4_2 = new Edge($node4, $node2);
        $edge4_3 = new Edge($node4, $node3);

        $testCases = [];

        // Empty graph
        $testCases[] = [
            'nodes' => [],
            'edges' => [],
            'has_cycle' => false,
            'nb_cycles' => 0,
        ];

        // 1 node, 0 edge
        $testCases[] = [
            'nodes' => [$node1],
            'edges' => [],
            'has_cycle' => false,
            'nb_cycles' => 0,
        ];

        // 2 nodes, 0 edge
        $testCases[] = [
            'nodes' => [$node1, $node2],
            'edges' => [],
            'has_cycle' => false,
            'nb_cycles' => 0,
        ];

        // 2 nodes, 1 edge
        $testCases[] = [
            'nodes' => [$node1, $node2],
            'edges' => [$edge1_2],
            'has_cycle' => false,
            'nb_cycles' => 0,
        ];

        // 2 nodes, 2 edges (circle)
        $testCases[] = [
            'nodes' => [$node1, $node2],
            'edges' => [$edge1_2, $edge2_1],
            'has_cycle' => true,
            'nb_cycles' => 1,
        ];

        // 3 nodes, 3 edges (triangle)
        $testCases[] = [
            'nodes' => [$node1, $node2, $node3],
            'edges' => [$edge1_2, $edge2_3, $edge3_1],
            'has_cycle' => true,
            'nb_cycles' => 1,
        ];

        // 4 nodes, 3 edges (Y)
        $testCases[] = [
            'nodes' => [$node1, $node2, $node3, $node4],
            'edges' => [$edge1_3, $edge2_3, $edge3_4],
            'has_cycle' => false,
            'nb_cycles' => 0,
        ];

        // 4 nodes, 4 edges (square)
        $testCases[] = [
            'nodes' => [$node1, $node2, $node3, $node4],
            'edges' => [$edge1_2, $edge2_3, $edge3_4, $edge4_1],
            'has_cycle' => true,
            'nb_cycles' => 1,
        ];

        // 4 nodes, 4 edges (line + triangle)
        $testCases[] = [
            'nodes' => [$node1, $node2, $node3, $node4],
            'edges' => [$edge1_2, $edge2_3, $edge3_4, $edge4_2],
            'has_cycle' => true,
            'nb_cycles' => 1,
        ];

        // 4 nodes, 5 edges (square with a diagonal)
        $testCases[] = [
            'nodes' => [$node1, $node2, $node3, $node4],
            'edges' => [$edge1_2, $edge2_3, $edge3_4, $edge4_1, $edge4_2],
            'has_cycle' => true,
            'nb_cycles' => 2,
        ];

        // 4 nodes, 4 edges (circle) (disconnected graph)
        $testCases[] = [
            'nodes' => [$node1, $node2, $node3, $node4],
            'edges' => [$edge1_2, $edge2_1, $edge3_4, $edge4_3],
            'has_cycle' => true,
            'nb_cycles' => 2,
        ];

        $dataStructures = [
            AdjacencyList::class,
            AdjacencyMatrix::class,
            //AdjacencyHybrid::class,
        ];

        foreach ($testCases as $testCase) {
            foreach ($dataStructures as $dataStructure) {
                $graphs[] = [
                    'graph' => new $dataStructure($testCase['nodes'], $testCase['edges']),
                    'has_cycle' => $testCase['has_cycle'],
                    'nb_cycles' => $testCase['nb_cycles'],
                ];
            }
        }

        return $graphs;
    }

}