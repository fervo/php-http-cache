<?php

namespace PhpHttpCache\Common\Interfaces;

interface PurgableHttpCacheInterface
{
    public function purge(array $urls);
}
