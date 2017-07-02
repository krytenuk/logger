FwsLogger
============

ZF2 Debugging and Logging Module

This module can send debugging information from your code to either a temporary file, email or permanent error log.

Installation
------------

### Main Setup

#### By cloning project

1. Install the [FwsLogger](https://github.com/krytenuk/logger) ZF2 module
   by cloning it into `./vendor/`.
2. Clone this project into your `./vendor/` directory.

#### With composer

1. Add this project in your composer.json:

    ```json
    "require": {
        "krytenuk/logger": "1.*"
    }
    ```

2. Now tell composer to download FwsLogger by running the command:

    ```bash
    $ php composer.phar update
    ```

#### Post installation

1. Enabling it in your `application.config.php` file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'FwsLogger',
        ),
        // ...
    );
    ```
	
2. Copy `./vendor/krytenuk/logger/config/fwslogger.local.php.dist` to `./config/autoload/fwslogger.local.php`.

3. In `./config/autoload/fwslogger.local.php` change the following.
	'emailLogger'
	'to' => the email address to receive log reports
	'from' => the email address of the server, shows as sender of email.  If unsure use the same email address as 'to'.
	'subject' => the subject line of the email (optional).
	
	'infoLogger'
	'file' => the log-file and path of the info logger.  Default to 'logs/variable_event.log' relative to the root folder of your ZF2 application
	
	'errorLogger'
	'file' => the log-file and path of the error logger.  Default to 'logs/error.log' relative to the root folder of your ZF2 application
	
4. Create the folder(s) for the log files.  As mentioned above by default this is a folder called 'logs' in the route of your application.

### Usage

There are three separate logging classes that can log to either a temporary file '\FwsLogger\InfoLogger', a permanent log file '\FwsLogger\ErrorLogger' or to an email '\FwsLogger\EmailLogger'.
As these all use static functions they can be used anywhere in your application.  As these loggers don't use php STDOUT nothing is rendered to the browser, ideal for debugging live websites.

1. Logging to a temporary file.
	'\FwsLogger\InfoLogger' logs to a temporary file, by default this is 'variable_event.log' (see post installation above).  This is possibly the most common logger used during development.
	This temporary file is overwritten each call to your ZF2 application, Each call to '\FwsLogger\InfoLogger' during this is added to the log file.
	
	Usage:
	'\FwsLogger\InfoLogger::vardump($variable);' - Performs a php var_dump to the log file.
	'\FwsLogger\InfoLogger::printr($variable);' - Performs a php print_r to the log file.
	'\FwsLogger\InfoLogger::write($variable);' - Sends a simple message or variable to the log file.
	
2. Logging to a permanent file.
	'\FwsLogger\ErrorLogger' like '\FwsLogger\InfoLogger' logs to a file, however this file is permanent and is not overwritten.  By default this is 'error.log' (see post installation above).
	
	Usage:
	'\FwsLogger\ErrorLogger::vardump($variable);' - Performs a php var_dump to the log file.
	'\FwsLogger\ErrorLogger::printr($variable);' - Performs a php print_r to the log file.
	'\FwsLogger\ErrorLogger::write($variable);' - Sends a simple message or variable to the log file.
	
	Note:
	At present the size of this file is not monitored and needs to be periodically checked as it can get large.
	
3. Logging to email.
	'\FwsLogger\EmailLogger' as it's name suggests sends log info in an email.
	Currently uses php sendmail.
	
	Usage:
	'\FwsLogger\EmailLogger::vardump($variable);' - Performs a php var_dump to the log email.
	'\FwsLogger\EmailLogger::printr($variable);' - Performs a php print_r to the log email.
	'\FwsLogger\EmailLogger::write($variable);' - Sends a simple message or variable to the log email.