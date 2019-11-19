<?php
namespace Magento\Codeception\Helper;

class Magento extends \Codeception\Module
{
    protected $mocker;

    public function replaceModelByMock($name, $mock)
    {
        $this->getMocker()->replaceModelByMock($name, $mock);

        return $this;
    }

    public function replaceHelperByMock($name, $mock)
    {
        $this->getMocker()->replaceHelperByMock($name, $mock);

        return $this;
    }

    public function replaceSingletonByMock($name, $mock)
    {
        $this->getMocker()->replaceSingletonByMock($name, $mock);

        return $this;
    }

    public function removeModelMock($name)
    {
        $this->getMocker()->removeModelMock($name);

        return $this;
    }

    public function removeSingletonMock($name)
    {
        $this->getMocker()->removeSingletonMock($name);

        return $this;
    }

    public function removeHelperMock($name)
    {
        $this->getMocker()->removeHelperMock($name);

        return $this;
    }

    public function loadControllerClass($module, $controller)
    {
        // @codingStandardsIgnoreStart
        require_once \Mage::getModuleDir('controllers', $module) . DS . $controller;
        // @codingStandardsIgnoreEnd

        return $this;
    }

    protected function getMocker()
    {
        if (!$this->mocker) {
            $this->mocker = new \Magento\Codeception\Extension\Magento\Mocker;
        }

        return $this->mocker;
    }
}
