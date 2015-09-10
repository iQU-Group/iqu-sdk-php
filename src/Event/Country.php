<?php
/**
 *
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */

namespace Iqu\Sdk\Event;

use Iqu\Sdk\Traits\EventGetData;

class Country extends \Iqu\Sdk\Event {
	use EventGetData;

	const TYPE = 'country';

	private $value;

	public function getValue() {
		return $this->value;
	}
	public function setValue($value) {
		$this->value = strtoupper(substr($value, 0, 2));
		return $this;
	}
}

?>