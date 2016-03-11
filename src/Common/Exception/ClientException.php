<?php

namespace PhpHttpCache\Common\Exception;

/**
 * The attempted action failed because something is wrong with your request.
 * Retrying the same action with no changes will not work.
 *
 * Examples include malformed API requests, invalid authentication, or
 * attempting to clear invalid URLs.
 */
class ClientException extends \RuntimeException implements HttpCacheExceptionInterface
{

}
