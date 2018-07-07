<?php

namespace Tests\Unit\Parser;

use App\Parser\TagParser;
use PHPUnit\Framework\TestCase;
use Mockery as m;

class TagParserTest extends TestCase
{
    /** @var TagParser */
    public $parser;

    public function setUp()
    {
        parent::setUp();

        $this->parser = new TagParser('li');
    }

    public function tearDown()
    {
        parent::tearDown();

        m::close();
    }

    /** @test */
    function it_returns_the_tag_data()
    {
        $content = '<ul>' . PHP_EOL . '<li>Laravel</li> ' . PHP_EOL . '<li>Zend</li> ' . PHP_EOL . '</ul>';

        $expected = ['Laravel', 'Zend'];

        $this->assertEquals($expected, $this->parser->__invoke($content));
    }

    public function partial($object)
    {
        return m::mock($object)->makePartial()->shouldAllowMockingProtectedMethods();
    }
}