<?php
/**
 *
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */

namespace Iqu\Sdk\Event;

use Iqu\Sdk\Traits\EventGetData;

class Heartbeat extends \Iqu\Sdk\Event {
	use EventGetData;

	const TYPE = 'heartbeat';

	private $is_payable = true;

	public function getIsPayable() {
		return $this->is_payable;
	}
	public function setIsPayable($value) {
		$this->is_payable = boolval($value);
		return $this;
	}
}

?>