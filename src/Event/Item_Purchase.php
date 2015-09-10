<?php
/**
 *
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */

namespace Iqu\Sdk\Event;

use Iqu\Sdk\Traits\EventGetData;

class Item_Purchase extends \Iqu\Sdk\Event {
	use EventGetData;

	const TYPE = 'item_purchase';

	private $name;
	private $vc_amount;

	public function getName() {
		return $this->name;
	}
	public function setName($value) {
		$this->name = strval($value);
		return $this;
	}

	public function getVcAmount() {
		return $this->vc_amount;
	}
	public function setVcAmount($value) {
		$this->vc_amount = floatval($value);
		return $this;
	}
}

?>