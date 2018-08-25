<?php

namespace FwsLogger;

use Zend\Mvc\MvcEvent;
use FwsLogger\EmailLogger;
use FwsLogger\InfoLogger;
use FwsLogger\ErrorLogger;

class Module
{

    public function onBootstrap(MvcEvent $event)
    {
        $config = $event->getApplication()->getServiceManager()->get('config');

        InfoLogger::setFile($config['fwsLogger']['infoLogger']['file']);

        ErrorLogger::setFile($config['fwsLogger']['errorLogger']['file']);

        EmailLogger::setTo($config['fwsLogger']['emailLogger']['to']);
        EmailLogger::setFrom($config['fwsLogger']['emailLogger']['from']);
        EmailLogger::setSubject($config['fwsLogger']['emailLogger']['subject']);
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

}
