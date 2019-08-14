<?php

class Vstudio_Vebug_Adminhtml_Vebug_ManageController
extends Mage_Adminhtml_Controller_Action {

	const HINT_PATH = 'dev/debug/template_hints';
	const BLOCK_PATH = 'dev/debug/template_hints_blocks';
	const DSCOPE = 'default';
	const WSCOPE = 'websites';

	public function indexAction() {
		$this->_redirect('*/dashboard');
		return;
	}

	public function enableAction() {
		$on = 1;
		$this->__switch($on, self::DSCOPE);
		$message = $this->__('Admin paths have been successfully enable!');
		Mage::getSingleton('core/session')->addSuccess($message);
		$this->_redirect('*/dashboard');
		return;
	}

	public function disableAction() {

		$off = 0;
		$this->__switch($off, self::DSCOPE);
		$message = $this->__('Admin paths have been successfully disabled!');
		Mage::getSingleton('core/session')->addSuccess($message);
		$this->_redirect('*/dashboard');

		return;
	}

	public function enableFrontAction() {

		$on = 1;
		$this->__switch($on, self::WSCOPE, $on);
		$message = $this->__('Frontend paths have been successfully enable! Please make sure to refresh your website.');
		Mage::getSingleton('core/session')->addSuccess($message);
		$this->_redirect('*/dashboard');
		return;
	}

	public function disableFrontAction() {
		$off = 0;
		$this->__switch($off, self::WSCOPE, 1);
		$message = $this->__('Frontend paths have been successfully disabled!');
		Mage::getSingleton('core/session')->addSuccess($message);
		$this->_redirect('*/dashboard');
		return;
	}

	protected function __switch($switch, $scope, $value = 0) {
		$this->__switchPaths(self::HINT_PATH, $switch, $scope, $value);
		$this->__switchPaths(self::BLOCK_PATH, $switch, $scope, $value);
	}

	/**
	 * Turn on/off hint path
	 *
	 * @param string $path configuration path
	 * @param int $scopeId scope id
	 * @param string $scope
	 * @param int $value
	 */
	protected function __switchPaths($path, $scopeId, $scope, $value) {
		$switch = Mage::getModel('core/config');
		$switch->saveConfig($path, $scopeId, $scope, $value);

		# refresh magento configuration cache
		Mage::app()->getCacheInstance()->cleanType('config');
		Mage::app()->getConfig()->reinit();
		return;
	}

}
