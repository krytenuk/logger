<?php

namespace FwsLogger;

use Laminas\Log\Logger;

/**
 * FwsLogger abstract class
 *
 * @author Garry Childs (Freedom Web Services)
 */
abstract class AbstractLogger extends Logger
{

    /**
     * Performs a php var_dump to log
     *
     * @param mixed $var
     * @param string $label
     */
    public static function vardump($var, $label = null)
    {
        ob_start();
        var_dump($var);
        $exported = ob_get_contents();
        ob_end_clean();

        if (!is_null($label) && is_string($label)){
            $exported = $label . ': ' . $exported;
        }
        static::write(htmlspecialchars_decode(strip_tags($exported)));
    }

    /**
     * Performs a php print_r to log
     *
     * @param mixed $var
     * @param string $label
     */
    public static function printr($var, $label = null)
    {
        ob_start();
        print_r($var);
        $exported = ob_get_contents();
        ob_end_clean();

        if (!is_null($label) && is_string($label)) {
            $exported = $label . ': ' . $exported;
        }
        static::write(htmlspecialchars_decode(strip_tags($exported)));
    }

}
