<?php

error_reporting(E_ALL ^ E_STRICT);
ini_set('display_errors', 0);

include_once 'define_local.php';
include_once 'define.php';

//include_once 'languages/vi.php';

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Setup autoloading
include PATH_ZEND_CORE . '/Zend/Loader/AutoloaderFactory.php';
Zend\Loader\AutoloaderFactory::factory(array(
    'Zend\Loader\StandardAutoloader' => array(
        'autoregister_zf' => true,
        'namespaces' => array(
            'Ocoder' => PATH_VENDOR . '/ocoder',
            'Block' => PATH_APPLICATION . '/block',
        ),
    )
));

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
