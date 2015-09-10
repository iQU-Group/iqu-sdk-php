<?php
/**
 *
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */

namespace Iqu\Sdk\Event;

use Iqu\Sdk\Traits\EventGetData;

class Platform extends \Iqu\Sdk\Event {
	use EventGetData;

	const TYPE = 'platform';

	private $manufacturer;
	private $device_brand;
	private $device_model;
	private $device_carrier;
	private $os_name;
	private $os_version;
	private $screen_size;
	private $screen_size_width;
	private $screen_size_height;
	private $screen_size_dpi;

	public function getManufacturer() {
		return $this->manufacturer;
	}
	public function setManufacturer($value) {
		$this->manufacturer = strval($value);
		return $this;
	}

	public function getDeviceBrand() {
		return $this->device_brand;
	}
	public function setDeviceBrand($value) {
		$this->device_brand = strval($value);
		return $this;
	}

	public function getDeviceModel() {
		return $this->device_model;
	}
	public function setDeviceModel($value) {
		$this->device_model = strval($value);
		return $this;
	}

	public function getDeviceCarrier() {
		return $this->device_carrier;
	}
	public function setDeviceCarrier($value) {
		$this->device_carrier = strval($value);
		return $this;
	}

	public function getOsName() {
		return $this->os_name;
	}
	public function setOsName($value) {
		$this->os_name = strval($value);
		return $this;
	}

	public function getOsVersion() {
		return $this->os_version;
	}
	public function setOsVersion($value) {
		$this->os_version = strval($value);
		return $this;
	}

	public function getScreenSize() {
		return $this->screen_size;
	}
	public function setScreenSize($value) {
		$this->screen_size = strval($value);
		return $this;
	}

	public function getScreenSizeWidth() {
		return $this->screen_size_width;
	}
	public function setScreenSizeWidth($value) {
		$this->screen_size = intval($value);
		return $this;
	}

	public function getScreenSizeHeight() {
		return $this->screen_size_height;
	}
	public function setScreenSizeHeight($value) {
		$this->screen_size_height = intval($value);
		return $this;
	}

	public function getScreenSizeDpi() {
		return $this->screen_size_dpi;
	}
	public function setScreenSizeDpi($value) {
		$this->screen_size_dpi = floatval($value);
		return $this;
	}

}

?>