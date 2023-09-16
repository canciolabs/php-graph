<?php

namespace Cancio\Graph\Algorithm\Cycle;

use Cancio\Graph\Algorithm\AbstractDFS;
use Cancio\Graph\Ds\Graph\GraphInterface;
use Cancio\Graph\Ds\Node\NodeInterface;
use Cancio\Graph\Utils\VisitedNodesChecker;

class CycleDetector extends AbstractDFS
{

    private bool $hasCycle = false;
    private VisitedNodesChecker $recursiveStack;

    public function __construct(GraphInterface $graph)
    {
        parent::__construct($graph);

        $this->recursiveStack = new VisitedNodesChecker($graph->getNodes());
    }

    public function hasCycle(): bool
    {
        return $this->hasCycle;
    }

    protected function dfs(NodeInterface $u, int $depth = 0): void
    {
        if ($this->hasCycle) {
            return;
        }

        $this->visitedNodes->visit($u);
        $this->recursiveStack->visit($u);

        foreach ($this->graph->getOutgoingNodes($u) as $v) {
            // If this node was already visited, then there is a cycle.
            if ($this->visitedNodes->isVisited($v)) {
                if ($this->recursiveStack->isVisited($v)) {
                    $this->hasCycle = true;
                    break;
                }
            } else {
                $this->dfs($v, $depth + 1);
            }

            // If any recursive call found a cycle, stop the loop.
            if ($this->hasCycle) {
                break;
            }
        }

        $this->recursiveStack->unvisit($u);
    }

    protected function preRun(): void
    {
        parent::preRun();

        $this->hasCycle = false;
        $this->recursiveStack->reset();
    }

}