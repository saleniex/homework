<?php

/*
 * Class LoggerAbstract
 *
 * Abstract Logger Class providing main functionality for logging messages.
 *
 */

class LoggerAbstract {
 
    /*
     * Default log file location and name.
     *
     */
    public $fileLocation = "application.log"; 

    /* 
     * File handler kept open 
     * 
     */
    private $handler; //file handler.
 
    /*
     * Write output flag (a/w)
     *
     */
    public $outputFlag = "w";


    /*
     * LoggerAbstract constructor.
     *
     */

    public function __construct() {
        $flag = $this->outputFlag;
        $this->handler = fopen($this->fileLocation, $flag);
    }
 
    /*
     * Method for logging success messages.
     *
     * @param   string  $message
     *
     * @return  $this
     */

    public function logError($message) {
        $this->logMessage("error", $message);
        return $this;
    }
    
    /*
     * Method for logging success messages.
     *
     * @param   string  $message
     *
     * @return  $this
     */

    public function logSuccess($message) {
        $this->logMessage("success", $message);
        return $this;
    }

    /*
     * Actual method that writes message to a file
     *
     * @param   string  $type
     * @param   string  $message
     *
     * @return  $this
     */

    public function logMessage($type, $message) {
        fwrite($this->handler, $type .': ' . $message . "\n");
        return $this;
    }

    /*
     * Method for explicitly clearing log file.
     *
     * @return  $this
     */

    public function clearLog() {
        $handler = fopen($this->fileLocation, 'w');
        fclose($handler);
        return $this;
    }

}

/*
 * Class Logger
 *
 * Extends LoggerAbstract.  
 *
 */

class Logger extends LoggerAbstract {

    /*
     * logger object
     *
     */

    private static $logger;

    /*
     * Create new instance if such not already initialized;
     *
     * @return      object
     */
    
    public static function get() {
        if(!self::$logger) {
            self::$logger = new Logger();
        }
        return self::$logger;
    }

}
