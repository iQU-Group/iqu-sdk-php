<?php
/**
 *
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */

namespace Iqu\Sdk;

class Transport_Container {
	/**
	 * @var Transport[]
	 */
	private $list = array();

	public function add(Transport $transport) {
		$this->list[] = $transport;
	}

	/**
	 * sends the given event container to the assigned transports
	 *
	 * @param Event_Container $container
	 * @return bool
	 */
	public function send(Event_Container $container) {
		$successfulSent = false;
		foreach($this->list AS $transport) {
			if($successfulSent === false || $transport->getSendAlways() === true) {
				$sendResult = $transport->send($container);
				if($sendResult === true) {
					$successfulSent = true;
				}
			}
		}
		return $successfulSent;
	}
}

?>