<?php

namespace Magento\Codeception\Extension;

use Codeception\Events;
use Codeception\Extension;

class Magento extends Extension
{
	public static $events = [
        Events::SUITE_BEFORE    => 'beforeSuite'
    ];

    public function beforeSuite()
    {
    	\Magento\Codeception\Extension\Magento\App::init($this->config);
    }
}