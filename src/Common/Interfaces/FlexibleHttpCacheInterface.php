<?php

namespace PhpHttpCache\Common\Interfaces;

interface FlexibleHttpCacheInterface
{
    public function purgeOrInvalidate(array $urls);

    public function invalidateOrPurge(array $urls);
}
