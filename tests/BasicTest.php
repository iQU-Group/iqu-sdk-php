<?php

/**
 *
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */
class BasicTest extends PHPUnit_Framework_TestCase {
	private $tmpdir;
	/**
	 * @var \Iqu\Sdk\Event_Container
	 */
	private $eventContainer;
	/**
	 * @var \Iqu\Sdk\Transport_Container
	 */
	private $transportContainer;
	/**
	 * @var \Iqu\Sdk\Event_Identifiers
	 */
	private $identifiers;
	private $startTime;
	private $uniqueSdkId;

	public function setup() {
		$this->identifiers = new \Iqu\Sdk\Event_Identifiers();
		$this->uniqueSdkId = sha1(uniqid(mt_rand()));
		$this->identifiers->setIquSdkId($this->uniqueSdkId);

		$this->eventContainer = new \Iqu\Sdk\Event_Container('phpunit', 'phpunit');
	}

	/**
	 * @expectedException Iqu\Sdk\Event_Exception
	 * @expectedExceptionCode Iqu\Sdk\Event_Exception::NO_IDENTIFIERS_SET
	 */
	public function testEventWithoutIdentifiersException() {
		$identifiers = new \Iqu\Sdk\Event_Identifiers();
		$event = new Iqu\Sdk\Event\Heartbeat($identifiers);
	}
}

?>