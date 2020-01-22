<?php


class Logger
{
    /**
     * Log file path.
     *
     * @var string
     */
    var $logFile = 'application.log';

    /**
     * Holds the class instance.
     *
     * @var self
     */
    private static $instance = null;

    /**
     * Output indicator
     *
     * @var bool
     */
    protected $consoleOutput = false;

    /**
     * Static variable and not a constant to serve as an extension point for custom levels
     *
     * @var string[]
     */
    protected static $levels = [
        0  => 'ERROR',
        1  => 'SUCCESS',
    ];

    /**
     * Initialize Logger class by singleton principle.
     *
     * @return self
     */
    public static function get()
    {
        if (self::$instance == null)
            self::$instance = new Logger();

        return self::$instance;
    }

    /**
     * Set output to console log.
     *
     * @return void
     */
    public function setConsoleOutput()
    {
        if($this->consoleOutput == false)
            $this->consoleOutput = true;
    }

    /**
     * Set output to logfile.
     *
     * @return void
     */
    public function setLogOutput()
    {
        if($this->consoleOutput == true)
            $this->consoleOutput = false;
    }

    /**
     * Creates date and time timestamp.
     *
     * @return string
     */
    protected function timeStamp()
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * Sets Log error message.
     *
     * @param  string  $msg
     * @return void
     */
    public function logError($msg)
    {
        $this->createRecord(0, $msg);
    }

    /**
     * Sets Log success message.
     *
     * @param  string  $msg
     * @return void
     */
    public function logSuccess($msg)
    {
        $this->createRecord(1, $msg);
    }

    /**
     * Creates record for output.
     *
     * @param  string  $level
     * @param  string  $msg
     * @return void
     */
    public function createRecord($level, $msg)
    {
        $timestamp = $this->timeStamp();
        $levelsName = $this->levelsName($level);

        $record = $timestamp . ' [' . $levelsName . '] ' . $msg . PHP_EOL;

        if ($this->consoleOutput)
            $this->consoleLogOutput($record);

        else
            $this->logFileOutput($record);

    }

    /**
     * Get logging level name.
     *
     * @param  int  $level
     * @return string
     */
    public function levelsName($level)
    {
        return static::$levels[$level];
    }

    /**
     * Write log record to a console.
     *
     * @param  string  $outputText
     * @return void
     */
    public function consoleLogOutput($outputText) {
        $js_code = 'console.log(' . json_encode($outputText, JSON_HEX_TAG) . ');';  //prepares javascript code that will be executed

        $output = '<script>' . $js_code . '</script>';  //prepares html code to be executed

        echo $output; //outputs prepared code
    }

    /**
     * Write log record to a file.
     *
     * @param  string  $record
     * @return void
     */
    protected function logFileOutput($record)
    {
        $return = file_put_contents($this->logFile, $record, FILE_APPEND | LOCK_EX);

        if(!$return){
            // Record not saved choose some sort of error msg of something
        }
    }
}