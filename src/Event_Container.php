<?php
/**
 *
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */

namespace Iqu\Sdk;

class Event_Container implements \IteratorAggregate {
	/**
	 * @var Event[]
	 */
	private $list = array();

	private $apiKey;
	private $secretKey;
	private static $instances = array();

	public function __construct($apiKey, $secretKey) {
		$this->apiKey = $apiKey;
		$this->secretKey = $secretKey;
	}
	public function Singleton() {
		if(sizeof(self::$instances) == 1) {
			return reset(self::$instances);
		} else {
			throw new Event_Container_Exception(
				"no or to many instances, please ensure that only one instance was created with the Event_Container::Factory()-method before using the Singleton()-method",
				Event_Container_Exception::NO_OR_TOO_MANY_INSTANCES
			);
		}
	}
	public function Factory($apiKey, $secretKey) {
		if(!isset(self::$instances[$apiKey])) {
			self::$instances[$apiKey] = new self($apiKey, $secretKey);
		}
		return self::$instances[$apiKey];
	}

	public function getApiKey() {
		return $this->apiKey;
	}
	public function getSecretKey() {
		return $this->secretKey;
	}

	public function add(Event $event) {
		$this->list[$event->getSequenceId()] = $event;
	}
	public function delete(Event $event) {
		$sequenceId = $event->getSequenceId();
		if(isset($this->list[$sequenceId])) {
			unset($this->list[$sequenceId]);
			return true;
		}
		return false;
	}

	public function getData() {
		$data = array();
		foreach($this->list AS $entity) {
			$data[] = $entity->getData();
		}
		return $data;
	}

	public function getIterator() {
		return new \ArrayIterator($this->list);
	}
}

?>