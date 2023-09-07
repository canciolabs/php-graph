<?php

namespace Cancio\Graph\Tests\Edge;

use Cancio\Graph\Edge\Edge;
use Cancio\Graph\Node\Node;
use PHPUnit\Framework\TestCase;

class EdgeTest extends TestCase
{

    public function testGetId(): void
    {
        $a = new Node('A');
        $b = new Node('B');

        // When weight and data are not defined
        $edge = new Edge($a, $b);
        $hash = sha1(serialize($edge));
        $this->assertSame($hash, $edge->getId());
        $this->assertSame($hash, (string) $edge);

        // When data is not defined
        $edge = new Edge($a, $b, 1);
        $hash = sha1(serialize($edge));
        $this->assertSame($hash, $edge->getId());
        $this->assertSame($hash, (string) $edge);

        // When data is defined
        $edge = new Edge($a, $b, 1, ['size' => 3]);
        $hash = sha1(serialize($edge));
        $this->assertSame($hash, $edge->getId());
        $this->assertSame($hash, (string) $edge);
    }

    public function testGetFrom(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $edge = new Edge($a, $b);

        $this->assertSame($a, $edge->getFrom());
    }

    public function testGetTo(): void
    {
        $a = new Node('A');
        $b = new Node('B');
        $edge = new Edge($a, $b);

        $this->assertSame($b, $edge->getTo());
    }

    public function testGetWeight(): void
    {
        $a = new Node('A');
        $b = new Node('B');

        // When not defined
        $edge = new Edge($a, $b);
        $this->assertSame(0, $edge->getWeight());

        // When defined
        $edge = new Edge($a, $b, 1);
        $this->assertSame(1, $edge->getWeight());
    }

    public function testGetData(): void
    {
        $a = new Node('A');
        $b = new Node('B');

        // When not defined
        $edge = new Edge($a, $b, 0);
        $this->assertNull($edge->getData());

        // When defined
        $data = ['size' => 789];
        $edge = new Edge($a, $b, 0, $data);
        $this->assertSame($data, $edge->getData());
    }

}