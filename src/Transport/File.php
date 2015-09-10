<?php
/**
 * 
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */

namespace Iqu\Sdk\Transport;

use Iqu\Sdk\Event;
use Iqu\Sdk\Event_Container;
use Iqu\Sdk\Transport;

class File extends Transport {
	private $path;
	public function __construct($path) {
		if(!file_exists($path)) {
			throw new File_Exception(sprintf('path %1$s already exists.', $path), File_Exception::INVALID_PATH_NOT_FOUND);
		}
		if(!is_dir($path)) {
			throw new File_Exception(sprintf('path %1$s is not a directory.', $path), File_Exception::INVALID_PATH_NO_DIRECTORY);
		}
		if(!is_writeable($path)) {
			throw new File_Exception(sprintf('path %1$s is not writable.', $path), File_Exception::INVALID_PATH_NOT_WRITABLE);
		}
		$this->path = $path;
		if(substr($this->path, 1) != DIRECTORY_SEPARATOR) {
			$this->path .= DIRECTORY_SEPARATOR;
		}
	}
	public function send(Event_Container $events) {
		$result = false;
		$path = $this->createSubPath($this->path, $events->getApiKey(), time());
		$fp = fopen($path.uniqid(mt_rand()), 'a');
		if($fp) {
			flock($fp, LOCK_EX);
			$result = fputs($fp, json_encode(array(
				'api_key' => $events->getApiKey(),
				'data' => $events->getData()
			)));
			fflush($fp);
			flock($fp, LOCK_UN);
			fclose($fp);
		}
		return $result !== false;
	}

	private function createSubPath($path, $apiKey, $timestamp) {
		$path .= $apiKey;
		$path .= DIRECTORY_SEPARATOR;
		$path .= gmdate('Y-m-d_H-i', $timestamp);
		$path .= DIRECTORY_SEPARATOR;
		if(!file_exists($path)) {
			mkdir($path, 0777, true);
		}
		return $path;
	}
}

?>