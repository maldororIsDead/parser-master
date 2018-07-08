<?php

namespace App\Parser;
use RuntimeException;

class TagParser implements ParserInterface
{
    const PATTERN = '/<%s[^>]*>(?P<value>.*)<\/%s>/';

    /** @var string */
    protected $tag;

    public function __construct(string $tag)
    {
        $this->tag = $tag;
    }

    public function __invoke(string $content)
    {
        preg_match_all(sprintf(self::PATTERN, $this->tag, $this->tag), $content, $matches);

        return $matches ['value'];
    }

}