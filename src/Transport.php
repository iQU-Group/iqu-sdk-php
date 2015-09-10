<?php
/**
 * 
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */

namespace Iqu\Sdk;

abstract class Transport {
	private $sendAlways = false;

	/**
	 * sends / saves / stores data
	 *
	 * @param Event_Container $event
	 * @return bool
	 */
	abstract public function send(Event_Container $event);

	public final function getSendAlways() {
		return $this->sendAlways;
	}
	public final function setSendAlways($value) {
		$this->sendAlways = boolval($value);
		return $this;
	}
}

?>