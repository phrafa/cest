<?php

namespace Magento\Codeception\Extension\Magento;

use \Mage;

class Mocker
{
    const HELPER = 'helper';
    const HELPER_REGISTER_KEY = '_helper/';
    const MODEL = 'model';
    const MODEL_REGISTER_KEY = '_model/';
    const SINGLETON = 'singleton';
    const SINGLETON_REGISTER_KEY = '_singleton/';

    public function replaceByMock($type, $name, $mock)
    {
        switch ($type) {
            case self::HELPER:
                return $this->replaceHelperByMock($name, $mock);
            case self::MODEL:
                return $this->replaceModelByMock($name, $mock);
            case self::SINGLETON:
                return $this->replaceModelByMock($name, $mock);
        }
    }

    public function replaceHelperByMock($name, $mock)
    {
        $registryKey = self::HELPER_REGISTER_KEY . $name;
        return $this->registerMock($registryKey, $mock);
    }

    public function replaceModelByMock($name, $mock)
    {
        $this->replaceSingletonByMock($name, $mock);
        $registryKey = self::MODEL_REGISTER_KEY . $name;
        return $this->registerMock($registryKey, $mock);
    }

    public function replaceSingletonByMock($name, $mock)
    {
        $registryKey = self::SINGLETON_REGISTER_KEY . $name;
        return $this->registerMock($registryKey, $mock);
    }

    public function removeModelMock($name)
    {
        $this->removeSingletonMock($name);
        $registryKey = self::MODEL_REGISTER_KEY . $name;
        return $this->unregisterMock($registryKey);
    }

    public function removeSingletonMock($name)
    {
        $registryKey = self::SINGLETON_REGISTER_KEY . $name;
        return $this->unregisterMock($registryKey);
    }

    public function removeHelperMock($name)
    {
        $registryKey = self::HELPER_REGISTER_KEY . $name;
        return $this->unregisterMock($registryKey);
    }

    public function registerMock($registryKey, $mock)
    {
        Mage::unregister($registryKey);
        Mage::register($registryKey, $mock);

        return Mage::registry($registryKey);
    }

    public function unregisterMock($registryKey)
    {
        Mage::unregister($registryKey);
    }
}
