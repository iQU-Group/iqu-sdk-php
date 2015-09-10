<?php
/**
 *
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */

namespace Iqu\Sdk\Event;

use Iqu\Sdk\Traits\EventGetData;

class Tutorial extends \Iqu\Sdk\Event {
	use EventGetData;

	const TYPE = 'tutorial';

	private $step;

	public function getStep() {
		return $this->step;
	}
	public function setStep($value) {
		$this->step = strval($value);
		return $this;
	}

}

?>