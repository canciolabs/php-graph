<?php

namespace Cancio\Graph\Tests\Algorithm\Cycle;

use Cancio\Graph\Algorithm\Cycle\CycleDetector;
use Cancio\Graph\Ds\Graph\AdjacencyMatrix;
use Cancio\Graph\Ds\Graph\GraphInterface;
use PHPUnit\Framework\TestCase;

class CycleDetectorTest extends TestCase
{

    use CycleDataProviderTrait;

    public function testInitialState(): void
    {
        $cycleDetector = new CycleDetector(new AdjacencyMatrix([], []));

        $this->assertFalse($cycleDetector->hasCycle());
    }

    /**
     * @dataProvider cycleDataProvider
     */
    public function testAlgorithm(GraphInterface $graph, bool $hasCycle): void
    {
        $cycleDetector = new CycleDetector($graph);
        $cycleDetector->run();

        $this->assertSame($hasCycle, $cycleDetector->hasCycle());
    }

}