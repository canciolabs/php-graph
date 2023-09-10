<?php

namespace Cancio\Graph\Algorithm\TopologicalSort;

use Cancio\Graph\Algorithm\AbstractDFS;
use Cancio\Graph\Ds\Node\NodeInterface;

class TopologicalSort extends AbstractDFS
{

    /**
     * @var NodeInterface[]
     */
    protected array $ts = [];

    /**
     * @return NodeInterface[]
     */
    public function getTopologicalSort(): array
    {
		return $this->ts;
	}
    
    protected function dfs(NodeInterface $u, int $depth = 0): void
    {
		$this->visitedNodes->visit($u);
		
        foreach ($this->graph->getIncomingNodes($u) as $v) {
            if (!$this->visitedNodes->isVisited($v)) {
                $this->dfs($v, $depth + 1);
            }
        }

        $this->ts[] = $u;
    }

    protected function preRun(): void
    {
        parent::preRun();

        $this->ts = [];
    }

}
