<?php

namespace PhpHttpCache\Common;

use InvalidArgumentException;
use PhpHttpCache\Common\Interfaces\FlexibleHttpCacheInterface;
use PhpHttpCache\Common\Interfaces\InvalidatebleHttpCacheInterface;
use PhpHttpCache\Common\Interfaces\PurgableHttpCacheInterface;

class FlexibleHttpCache implements FlexibleHttpCacheInterface
{
    protected $httpCache;

    public function __construct($httpCache)
    {
        if (!$httpCache instanceOf InvalidatableHttpCacheInterface && !$httpCache instanceOf PurgableHttpCaceInsterface) {
            throw new InvalidArgumentException(sprintf("HttpCache must implement at least one of the following interfaces: %s, %s", InvalidatableHttpCacheInterface::class, PurgableHttpCaceInsterface::class));
        }

        $this->httpCache = $httpCache;
    }

    public function purgeOrInvalidate(array $urls)
    {
        if ($this->httpCache instanceOf PurgableHttpCacheInsterface) {
            $this->purge($urls);
        } else {
            $this->invalidate($urls);
        }
    }

    public function invalidateOrPurge(array $urls)
    {
        if ($this->httpCache instanceOf InvalidateHttpCacheInsterface) {
            $this->invalidate($urls);
        } else {
            $this->purge($urls);
        }
    }
}
