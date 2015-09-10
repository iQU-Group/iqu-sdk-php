<?php

/**
 *
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */
class BasicTransportTest extends PHPUnit_Framework_TestCase {
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
		$this->startTime = time();
		$this->tmpdir = "/tmp/iqu-php-sdk/".uniqid(mt_rand()).'/';
		mkdir($this->tmpdir, 0777, true);
		$this->transportContainer = new \Iqu\Sdk\Transport_Container();

		$curlTransport = new \Iqu\Sdk\Transport\Curl();
		$fileTransport = new \Iqu\Sdk\Transport\File($this->tmpdir);
		$fileTransport->setSendAlways(true);

		$this->transportContainer->add($curlTransport);
		$this->transportContainer->add($fileTransport);

		$this->identifiers = new \Iqu\Sdk\Event_Identifiers();
		$this->uniqueSdkId = sha1(uniqid(mt_rand()));
		$this->identifiers->setIquSdkId($this->uniqueSdkId);

		$this->eventContainer = new \Iqu\Sdk\Event_Container(getenv('API_KEY'), getenv('SECRET_KEY'));
	}
	private function rmdir_recursively($dir) {
		$files = array_diff(scandir($dir), array('.','..'));
		foreach ($files as $file) {
			(is_dir("$dir/$file")) ? $this->rmdir_recursively("$dir/$file") : unlink("$dir/$file");
		}
		return rmdir($dir);
	}
	private function dir_tree($dir) {
		$array = array();
		$d = dir($dir);
		while (false !== ($entry = $d->read())) {
			if($entry!='.' && $entry!='..') {
				$entry = $dir.'/'.$entry;
				if(is_dir($entry)) {
					$array = array_merge($array, $this->dir_tree($entry));
				} else {
					$array[] = $entry;
				}
			}
		}
		$d->close();
		return $array;
	}
	private function readTmpFiles() {
		$return = array();
		$result = $this->dir_tree($this->tmpdir);
		foreach($result AS $key => $file) {
			$return[$file] = file_get_contents($file);
		}
		return $return;
	}
	public function teardown() {
		$this->rmdir_recursively($this->tmpdir);
	}
	public function testHeartbeat() {
		$this->eventContainer->add(new \Iqu\Sdk\Event\Heartbeat($this->identifiers));

		$this->assertTrue($this->transportContainer->send($this->eventContainer));
		$data = $this->readTmpFiles();
		$data = json_decode(array_shift($data));
		$this->assertEquals(getenv('API_KEY'), $data->api_key);
		$this->assertEquals(1, sizeof($data->data));
		$eventData = array_shift($data->data);
		$this->assertAttributeEquals($this->uniqueSdkId, 'iqu_sdk_id', $eventData->identifiers);
		$this->assertEquals('heartbeat', $eventData->event->type);
		$this->assertGreaterThanOrEqual($this->startTime, strtotime($eventData->event->timestamp));
	}
}

?>