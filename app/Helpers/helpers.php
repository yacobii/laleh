<?php

if (! function_exists('word_count')) {
    /**
     * Count words in a UTF-8 string (support for Farsi / Arabic / etc).
     *
     * @param string $text
     * @return int
     */
    function word_count($text)
    {
        preg_match_all('/\p{L}+/u', strip_tags($text), $matches);
        return count($matches[0]);
    }
}
