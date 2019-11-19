Magento Codeception
===================


Composer install
-------------

    composer require betooliveira/codeception-magento

----------

Config
-------------------

**codeception.yml**

    extensions:
        enabled:
            - Codeception\Extension\RunFailed
            - Magento\Codeception\Extension\Magento
        config:
            Magento\Codeception\Extension\Magento:
                magento-dir: 'src'

**unit.suite.yml**

    class_name: UnitTester
    modules:
        enabled:
            - Asserts
            - \Helper\Unit
            - \Magento\Codeception\Helper\Magento

----------


Mock Models
-------------

        $modelMock = $this->getMockBuilder('Custom_Custom_Model_Custom')
            ->setMethods(array('getData'))
            ->getMock();

        $modelMock->expects($this->once())
            ->method('getData')
            ->will($this->returnValue(array('teste)));

        $this->tester->replaceModelByMock('custom/custom', $modelMock);
        
        $result = Mage::getModel('custom/custom);
			
		$this->tester->assertSame($modelMock, $result);

Mock Singletons
-------------

        $singletonMock = $this->getMockBuilder('Custom_Custom_Model_Custom')
            ->setMethods(array('getData'))
            ->getMock();

        $singletonMock->expects($this->once())
            ->method('getData')
            ->will($this->returnValue(array('teste)));

        $this->tester->replaceSingletonByMock('custom/custom', $singletonMock);
		
		$result = Mage::getSingleton('custom/custom);
			
		$this->tester->assertSame($singletonMock, $result);

Mock Helper
-------------
        $helperMock = $this->getMockBuilder('Custom_Custom_helper_Custom')
            ->setMethods(array('getData'))
            ->getMock();

        $helperMock->expects($this->once())
            ->method('getData')
            ->will($this->returnValue(array('teste)));

        $this->tester->replaceHelperByMock('custom/custom', $helperMock);
		
		$result = Mage::helper('custom/custom);
			
		$this->tester->assertSame($helperMock, $result);

