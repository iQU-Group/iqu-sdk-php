<?php
/**
 *
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */

namespace Iqu\Sdk\Event;

use Iqu\Sdk\Traits\EventGetData;

class User_Attribute extends \Iqu\Sdk\Event {
	use EventGetData;

	const TYPE = 'user_attribute';

	private $name;
	private $value;

	public function getName() {
		return $this->name;
	}
	public function setName($value) {
		$this->name = strval($value);
		return $this;
	}

	public function getValue() {
		return $this->value;
	}
	public function setValue($value) {
		$this->value = strval($value);
		return $this;
	}
}

?>