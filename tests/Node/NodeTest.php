<?php

namespace Cancio\Graph\Tests\Node;

use Cancio\Graph\Ds\Node\Node;
use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase
{

    public function testToString(): void
    {
        $node = new Node('A');
        $this->assertSame('A', (string) $node);
    }

    public function testGetId(): void
    {
        $node = new Node('B');
        $this->assertSame('B', $node->getId());
    }

    public function testGetData(): void
    {
        // When null
        $node = new Node('C');
        $this->assertNull($node->getData());

        // When not null
        $data = ['size' => 3];
        $node = new Node('D', $data);
        $this->assertSame($data, $node->getData());
    }

}