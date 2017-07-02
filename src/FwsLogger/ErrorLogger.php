<?php

Namespace FwsLogger;

use Zend\Log\Writer\Stream;
use FwsLogger\Exception\NoFileException;

/**
 * FwsLogger email logger class
 *
 * @author Garry Childs (Freedom Web Services)
 */
final class ErrorLogger extends AbstractLogger
{

    /**
     * File and path to log file
     * @var string
     */
    private static $file = null;

    /**
     * @var Object ErrorLogger
     */
    private static $instance = null;

    /**
     * Set the file and path to log file
     * @param string $file
     */
    public static function setFile($file)
    {
        self::$file = $file;
    }

    /**
     * Returns an instance of this class
     * @return object ErrorLogger
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * Initialize logger
     * @throws NoFileException
     */
    public function __construct()
    {
        parent::__construct();
        if (self::$file) {
            $writer = new Stream(self::$file, 'a');
            self::addWriter($writer);
        } else {
            throw new NoFileException('No file set');
        }
    }

    /**
     * Wrire a simple message or variable to the error log file
     * @param string|number $message
     */
    public static function write($message)
    {
        self::getInstance()->log(self::ERR, $message);
    }

}
