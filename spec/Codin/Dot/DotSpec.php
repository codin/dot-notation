<?php

declare(strict_types=1);

namespace spec\Codin\Dot;

use Codin\Dot\DotException;
use PhpSpec\ObjectBehavior;

class DotSpec extends ObjectBehavior
{
    protected $testData = [
        'foo' => [
            'bar' => 'baz',
        ],
    ];

    public function it_should_get_items()
    {
        $this->beConstructedWith($this->testData);
        $this->get(null)->shouldReturn($this->testData);
        $this->get('foo')->shouldReturn($this->testData['foo']);
        $this->get('foo.bar')->shouldReturn($this->testData['foo']['bar']);
    }

    public function it_should_set_items()
    {
        $this->get(null)->shouldReturn([]);

        $this->set('foo', $this->testData['foo']);
        $this->get(null)->shouldReturn($this->testData);

        $this->set('foo.bar', 'qux');
        $this->get('foo.bar')->shouldReturn('qux');

        $this->shouldThrow(DotException::class)->duringSet('foo.bar.baz', 'qux');
    }
}
