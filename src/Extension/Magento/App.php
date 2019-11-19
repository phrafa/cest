<?php

namespace Magento\Codeception\Extension\Magento;

use \Mage;

class App
{
    const MAGENTO_FILE = 'app/Mage.php';
    const CONFIG_MAGENTO_DIR = 'magento-dir';
    const CONFIG_MAGENTO_DIR_VALUE = 'src';

    private static $_instance;
    protected $_config = array(
        self::CONFIG_MAGENTO_DIR => self::CONFIG_MAGENTO_DIR_VALUE,
    );

    public static function init(array $config = array())
    {
        if (null === static::$_instance) {
            static::$_instance = new static;
            static::$_instance->initMagento($config);
        }

        return static::$_instance;
    }

    protected function initMagento(array $config = array())
    {
        $this->_config = array_merge($this->_config, $config);

        $this->loadMagentoFile();

        Mage::app(null, 'website', array('config_model' => 'Magento\Codeception\Extension\Magento\Config'));

        return $this;
    }

    protected function loadMagentoFile()
    {
        $baseDir = getcwd();
        $mageDir = $this->_config[self::CONFIG_MAGENTO_DIR];
        $file = self::MAGENTO_FILE;

        $file = "{$baseDir}/{$mageDir}/{$file}";

        require_once $file;

        return $this;
    }

    public function reset()
    {
        \Mage::reset();
    }

    /**
     * is not allowed to call from outside: private!
     *
     */
    private function __construct()
    {
    }
    /**
     * prevent the _instance from being cloned
     *
     * @return void
     */
    private function __clone()
    {
    }
    /**
     * prevent from being unserialized
     *
     * @return void
     */
    private function __wakeup()
    {
    }
}
