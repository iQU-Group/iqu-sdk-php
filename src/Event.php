<?php
/**
 *
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */

namespace Iqu\Sdk;

abstract class Event {
	const TYPE = null;

	private $sequenceId;
	private $identifiers;
	private $timestamp;

	public function __construct(Event_Identifiers $identifiers) {
		$this->sequenceId = microtime(true).'_'.uniqid(mt_rand());
		$this->identifiers = $identifiers;
		$this->setTimestamp(time());
	}

	public function getSequenceId() {
		return $this->sequenceId;
	}

	public function getIdentifiers() {
		return $this->identifiers;
	}
	public function getTimestamp() {
		return $this->timestamp;
	}
	public function setTimestamp($value) {
		if(is_numeric($value)) {
			$this->timestamp = gmdate('Y-m-d H:i:s', $value).' UTC';
		} else {
			$this->timestamp = $value;
		}
		return $this;
	}

	public function getType() {
		return static::TYPE;
	}

	abstract public function getData();

}

?>