<?php

namespace Tests\Unit\Parser;

use App\Parser\TagParser;
use App\Parser\Parser;
use App\Parser\MetaParser;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class ParserTest extends TestCase
{
    /** @var Parser */
    public $parser;

    public function setUp()
    {
        parent::setUp();

        $this->parser = new Parser;
    }

    public function tearDown()
    {
        parent::tearDown();

        m::close();
    }

    /** @test */
    function it_returns_the_meta_data_keyed_by_name_and_tag_values()
    {
        $content = '
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="referrer" content="always">
    <body>
        <ul>
            <li>Laravel</li>
            <li>Zend</li>
        </ul>
    </body>
        ';
        $expected = [
            [
                'viewport' => 'width=device-width, initial-scale=1',
                'referrer' => 'always',
            ],
            [
                'Laravel',
                'Zend'
            ]
        ];

        $parsers = [new MetaParser, new TagParser('li')];

        $this->parser::setParsers($parsers);

        $this->assertEquals($expected, $this->parser->__invoke($content));
    }

    public function partial($object)
    {
        return m::mock($object)->makePartial()->shouldAllowMockingProtectedMethods();
    }
}