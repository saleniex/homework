<?php

declare(strict_types=1);

namespace Tests\Logger;

use PHPUnit\Framework\TestCase;

abstract class AbstractLoggerTest extends TestCase
{
    const LOG_TYPE_SUCCESS = 'SUCCESS';
    const LOG_TYPE_ERROR = 'ERROR';

    private $successMessage;
    private $errorMessage;

    public function __construct()
    {
        $this->successMessage = 'successMessage';
        $this->errorMessage = 'errorMessage';

        parent::__construct();
    }

    /**
     * @return string
     */
    public function getExpectedSuccessMessage() : string
    {
        return $this->getExpectedMessage(
            self::LOG_TYPE_SUCCESS,
            $this->successMessage
        );
    }

    /**
     * @return string
     */
    public function getExpectedErrorMessage() : string
    {
        return $this->getExpectedMessage(
            self::LOG_TYPE_ERROR,
            $this->errorMessage
        );
    }

    /**
     * Get expected log message
     * @param string $logType
     * @param string $message
     *
     * @return string
     */
    protected function getExpectedMessage(string $logType, string $message) : string
    {
        return sprintf("%s: %s", $logType, $message);
    }

    /**
     * @return string
     */
    protected function getSuccessMessage()
    {
        return $this->successMessage;
    }

    /**
     * @return string
     */
    protected function getErrorMessage()
    {
        return $this->errorMessage;
    }
}