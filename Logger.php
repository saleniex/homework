<?php

declare(strict_types=1);

use Homework\LoggerInterface;
use Homework\ReferenceLogger;
use Homework\BaseLogger;

require __DIR__ . '/vendor/autoload.php';

/**
 * Class Logger
 */
class Logger
{

    /** @var LoggerInterface */
    private static $loggers = [];


    /**
     * This is very naive but we are not sure what it supposed to be;
     * get() is rather vague interface: could be factory, singleton, facade, etc..
     *
     * @param string|null $name
     * @return LoggerInterface
     */
    public static function get(string $name = null): LoggerInterface
    {
        if ($name === null) {
            $name = getenv("LOGGER");
            if (!$name) {
                $name = "default";
            }
        }

        if (in_array($name, static::$loggers)) {
            return static::$loggers[$name];
        }

        if ($name === 'default') {
            $logger = new ReferenceLogger();
        } elseif ($name === 'console') {
            $logger = new BaseLogger(
                new \Homework\Output\StreamHandler(fopen("php://stdout", "w")),
                new \Homework\Format\FancyFormatter()
            );
        } else {
            throw new InvalidArgumentException("Unknown logger: " . $name);
        }

        $static[$name] = $logger;

        return $logger;
    }

}