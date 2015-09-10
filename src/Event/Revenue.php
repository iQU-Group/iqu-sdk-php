<?php
/**
 *
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */

namespace Iqu\Sdk\Event;

use Iqu\Sdk\Traits\EventGetData;

class Revenue extends \Iqu\Sdk\Event {
	use EventGetData;

	const TYPE = 'revenue';

	private $amount;
	private $currency;
	private $vc_amount;
	private $reward;

	public function getAmount() {
		return $this->amount;
	}
	public function setAmount($value) {
		$this->amount = floatval($value);
		return $this;
	}

	public function getCurrency() {
		return $this->currency;
	}
	public function setCurrency($value) {
		$this->currency = strval($value);
		return $this;
	}

	public function getVcAmount() {
		return $this->vc_amount;
	}
	public function setVcAmount($value) {
		$this->vc_amount = floatval($value);
		return $this;
	}

	public function getReward() {
		return $this->reward;
	}
	public function setReward($value) {
		$this->reward = strval($value);
		return $this;
	}
}

?>