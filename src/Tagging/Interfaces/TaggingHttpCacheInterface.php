<?php

namespace PhpHttpCache\Tagging\Interfaces;

interface TaggingHttpCacheInterface
{
    public function tagUrl($url, array $tags);
}
