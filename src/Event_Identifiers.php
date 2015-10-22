<?php
/**
 *
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */

namespace Iqu\Sdk;

use Iqu\Sdk\Traits\EventGetData;

class Event_Identifiers {
	use EventGetData;

	private $iqu_sdk_id;
	private $facebook_user_id;
	private $google_plus_user_id;
	private $twitter_user_id;
	private $ios_vendor_id;
	private $ios_advertising_identifier;
	private $ios_ad_tracking;
	private $android_serial;
	private $android_id;
	private $android_advertising_id;
	private $android_ad_tracking;
	private $custom_user_id;

	public function getIquSdkId() {
		return $this->iqu_sdk_id;
	}
	public function setIquSdkId($value) {
		$this->iqu_sdk_id = strval($value);
		return $this;
	}

	public function getFacebookUserId() {
		return $this->facebook_user_id;
	}
	public function setFacebookUserId($value) {
		$this->facebook_user_id = strval($value);
		return $this;
	}

	public function getGooglePlusUserId() {
		return $this->google_plus_user_id;
	}
	public function setGooglePlusUserId($value) {
		$this->google_plus_user_id = strval($value);
		return $this;
	}

	public function getTwitterUserId() {
		return $this->twitter_user_id;
	}
	public function setTwitterUserId($value) {
		$this->twitter_user_id = strval($value);
		return $this;
	}

	public function getIosVendorId() {
		return $this->ios_vendor_id;
	}
	public function setIosVendorId($value) {
		$this->ios_vendor_id = strval($value);
		return $this;
	}

	public function getIosAdvertisingIdentifier() {
		return $this->ios_advertising_identifier;
	}
	public function setIosAdvertisingIdentifier($value) {
		$this->ios_advertising_identifier = strval($value);
		return $this;
	}

	public function getIosAdTracking() {
		return $this->ios_ad_tracking;
	}
	public function setIosAdTracking($value) {
		$this->ios_ad_tracking = boolval($value);
		return $this;
	}

	public function getAndroidSerial() {
		return $this->android_serial;
	}
	public function setAndroidSerial($value) {
		$this->android_serial = strval($value);
		return $this;
	}

	public function getAndroidId() {
		return $this->android_id;
	}
	public function setAndroidId($value) {
		$this->android_id = strval($value);
		return $this;
	}

	public function getAndroidAdvertisingId() {
		return $this->android_advertising_id;
	}
	public function setAndroidAdvertisingId($value) {
		$this->android_advertising_id = strval($value);
		return $this;
	}

	public function getAndroidAdTracking() {
		return $this->android_ad_tracking;
	}
	public function setAndroidAdTracking($value) {
		$this->android_ad_tracking = intval($value);
		return $this;
	}

	public function getCustomUserId() {
		return $this->custom_user_id;
	}
	public function setCustomerUserId($value) {
		$this->custom_user_id = strval($value);
		return $this;
	}

	public function hasIdentifiers() {
		return !(sizeof($this->getData()) == 0);
	}
}

?>