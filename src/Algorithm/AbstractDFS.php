<?php

namespace Cancio\Graph\Algorithm;

use Cancio\Graph\Exception\NodeNotFoundException;
use Cancio\Graph\GraphInterface;
use Cancio\Graph\Node\NodeInterface;
use Cancio\Graph\Utils\VisitedNodesChecker;

abstract class AbstractDFS
{

    protected GraphInterface $graph;
    protected VisitedNodesChecker $visitedNodes;

    public function __construct(GraphInterface $graph)
    {
        $this->graph = $graph;
        $this->visitedNodes = new VisitedNodesChecker($graph->getNodes());
    }
    
    public function getGraph(): GraphInterface
    {
		return $this->graph;
	}
    
    final public function run(?NodeInterface $starting_node = null): void
    {
        $this->preRun();

        if ($starting_node) {
            $this->assertNodeExists($starting_node);
            $this->dfs($starting_node);
        } else {
            foreach ($this->graph->getNodes() as $node) {
                if (!$this->visitedNodes->isVisited($node)) {
                    $this->dfs($node);
                }
            }
        }
        
        $this->postRun();
    }

    protected function preRun(): void
    {
        $this->visitedNodes->reset();
    }

    abstract protected function dfs(NodeInterface $u, int $depth = 0): void;

    protected function postRun(): void
    {
		
	}

    protected function assertNodeExists(NodeInterface $u): void
    {
        if (!$this->graph->getNodes()->has($u)) {
            throw new NodeNotFoundException($u);
        }
    }

}
