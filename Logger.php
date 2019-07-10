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
     * CLI (Command Line Interface) switch
     *
     */
    private $cli;

    /*
     * LoggerAbstract constructor.
     *
     * @param   string   $cli
     *
     */

    public function __construct($cli = false) {
        $this->cli = $cli;
        $this->updateOutputHandler();
    }

    /*
     * Based on cli switch value we need to dynamically change the output handler.
     *
     * @return void
     */

    public function updateOutputHandler() {
        if($this->handler) {
            fclose($this->handler);
        } 
        
        $output = $this->cli ? "php://stdout" : $this->fileLocation;
        $flag = $this->outputFlag;
        $this->handler = fopen($output, $flag ) ;
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
        $allowedTypes = ["error", "success"];
        if(!in_array($type, $allowedTypes)) {
            throw new InvalidArgumentException("Invalid log message type");    
        }
        if($this->cli) {
            $type = $this->colorString($type);
        }

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

    /*
     * A small feature for coloring command line messages;
     * @param   string   $type
     *
     * @return  string
     */

    public function colorString($type) {
        $colors = [
            "error" => "0;31",
            "success" => "0;32"
        ];
        if(array_key_exists($type, $colors)) {
            return "\033[" . $colors[$type] . "m" . $type . "\033[0m";
        } else {
            return $type;
        }
    }

    /*
     * Method for dynamically switching CLI output on/off
     * @param   boolean  $cli
     *
     * @return  $this
     */

    public function setCLI($cli = true) {
        $this->cli = $cli;
        $this->outputFlag = "a";
        $this->updateOutputHandler();
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
    
    public static function get($cli = false) {
        if(!self::$logger) {
           self::$logger = new Logger($cli);
        }
        return self::$logger;
    }

}
