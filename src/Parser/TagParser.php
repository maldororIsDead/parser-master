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

        if (count($matches ['value']) === 0) {
            throw $this->tagIsNotExist($this->tag);
        }

        return $matches ['value'];
    }

    protected function tagIsNotExist(string $tag): RuntimeException
    {
        return new RuntimeException(sprintf('Tag [`%s`] is not exist in this HTML file', $tag));
    }
}