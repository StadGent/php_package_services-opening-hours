<?php

namespace StadGent\Services\OpeningHours\Handler\Exception;

/**
 * Exception when no supporting Handler is found by the client.
 *
 * @package StadGent\Services\OpeningHours\Handler\Exception
 */
class NoHandlerException extends \Exception
{
    /**
     * Construct the exception from the class name that has no handler.
     *
     * @param string $className
     *   The class name without handler.
     *
     * @return NoHandlerException
     */
    public static function fromClassName($className)
    {
        $message = sprintf('No handler found that supports request "%s".', $className);
        return new static($message);
    }
}
