<?php

namespace Cancio\Graph\Algorithm\Cycle;

use Cancio\Graph\Algorithm\AbstractDFS;
use Cancio\Graph\Ds\Node\NodeInterface;

class CycleDetector extends AbstractDFS
{

    private bool $hasCycle = false;

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

        foreach ($this->graph->getOutgoingNodes($u) as $v) {
            // If this node was already visited, then there is a cycle.
            if ($this->visitedNodes->isVisited($v)) {
                $this->hasCycle = true;
                break;
            }

            $this->dfs($v, $depth + 1);

            // If any recursive call found a cycle, stop the loop.
            if ($this->hasCycle) {
                break;
            }
        }
    }

    protected function preRun(): void
    {
        parent::preRun();

        $this->hasCycle = false;
    }

}