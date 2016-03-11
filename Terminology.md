Cache terminology is rarely standardized. This document aims to clarify what certain terms used in this library means, in the context of this library.

## Fresh
The cached object is not expired.

## Stale
The cached object is expired. If it has appropriate headers, the cache MAY attempt to revalidate it.

## Cache hit
The requested object was found in the cache and is fresh. It will be served to the client.

## Cache miss
The requested object was not found in the cache. The cache will pass the request on to the parent server, MAY store the response for future requests, and will serve the response to the client.

## Invalidate
Cause the cache to mark an object as stale. The next time the cache receives a request for the object, it MAY use a If-Modified-Since request to revalidate the object.

## Purge
Cause the cache to remove an object from the cache. The next time the cache receives a request for the object, it MUST treat it as a cache miss.

