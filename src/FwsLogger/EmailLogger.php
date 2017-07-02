<?php

Namespace FwsLogger;

use Zend\Mail\Message;
use Zend\Log\Writer\Mail;
use FwsLogger\Exception\NoFromEmailException;
use FwsLogger\Exception\NoToEmailException;
use Zend\Mail\Transport\Sendmail;

/**
 * FwsLogger email logger class
 *
 * @author Garry Childs (Freedom Web Services)
 */
final class EmailLogger extends AbstractLogger
{

    /**
     * Email address to send error message to
     * @var string
     */
    protected static $to = null;

    /**
     * Email address to send email from
     * @var string
     */
    protected static $from = null;

    /**
     * Email subject
     * @var string
     */
    protected static $subject = null;

    /**
     * @var Object EmailLogger
     */
    private static $instance = null;

    /**
     * Set the email address to send error message to
     * @param string $emailAddress
     */
    public static function setTo($emailAddress)
    {
        self::$to = $emailAddress;
    }

    /**
     * Set the email address to send email from
     * @param string $emailAddress
     */
    public static function setFrom($emailAddress)
    {
        self::$from = $emailAddress;
    }

    /**
     * Set the email subject line
     * @param string $subject
     */
    public static function setSubject($subject)
    {
        self::$subject = $subject;
    }

    /**
     * Returns an instance of this class
     * @return object EmailLogger
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
     * @throws NoFromEmailException
     * @throws NoToEmailException
     */
    public function __construct()
    {
        parent::__construct();

        if (self::$to) {
            if (self::$from) {
                $mail = new Message();
                $mail->setFrom(self::$from)
                        ->setTo(self::$to)
                        ->setSubject(self::$subject);

                $writer = new Mail($mail);

                $transport = new Sendmail();
                $writer->setTransport($transport);

                self::addWriter($writer);
            } else {
                throw new NoFromEmailException('No from email address set');
            }
        } else {
            throw new NoToEmailException('No to email address set');
        }
    }

    /**
     * Wrire a simple message or variable to the email log
     * @param string|number $message
     */
    public static function write($message)
    {
        self::getInstance()->log(self::ERR, $message);
    }

}
