<?php
/**
 *
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */

namespace Iqu\Sdk\Event;

use Iqu\Sdk\Traits\EventGetData;

class Marketing extends \Iqu\Sdk\Event {
	use EventGetData;

	const TYPE = 'marketing';

	private $partner;
	private $campaign;
	private $ad;
	private $subid;
	private $subsubid;

	public function getPartner() {
		return $this->partner;
	}
	public function setPartner($value) {
		$this->partner = strval($value);
		return $this;
	}

	public function getCampaign() {
		return $this->campaign;
	}
	public function setCampaign($value) {
		$this->campaign = strval($value);
		return $this;
	}

	public function getAd() {
		return $this->ad;
	}
	public function setAd($value) {
		$this->ad = strval($value);
		return $this;
	}

	public function getSubId() {
		return $this->subid;
	}
	public function setSubId($value) {
		$this->subid = strval($value);
		return $this;
	}

	public function getSubSubId() {
		return $this->subsubid;
	}
	public function setSubSubId($value) {
		$this->subsubid = strval($value);
		return $this;
	}
}

?>