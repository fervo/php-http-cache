<?php

namespace PhpHttpCache\Common\Interfaces;

interface InvalidatebleHttpCacheInterface
{
    public function invalidate(array $urls);
}
