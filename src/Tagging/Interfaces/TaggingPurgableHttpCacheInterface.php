<?php

namespace PhpHttpCache\Tagging\Interfaces;

use PhpHttpCache\Common\Interfaces\PurgableHttpCacheInterface;

interface TaggingPurgableHttpCacheInterface extends PurgableHttpCacheInterface, TaggingHttpCacheInterface
{
    public function purgeTags(array $tags);
}
