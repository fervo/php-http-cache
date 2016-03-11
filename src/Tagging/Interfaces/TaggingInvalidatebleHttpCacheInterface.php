<?php

namespace PhpHttpCache\Tagging\Interfaces;

use PhpHttpCache\Common\Interfaces\InvalidatebleHttpCacheInterface;

interface TaggingInvalidatebleHttpCacheInterface extends InvalidatebleHttpCacheInterface, TaggingHttpCacheInterface
{
    public function invalidateTags(array $tags);
}
