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

class Curl extends Transport {
	const DEFAULT_TRANSPORT_URL = 'https://tracker.iqugroup.com/v3/?api_key=%%API_KEY%%&signature=%%SIGNATURE%%';

	private $remoteApiUrl;
	private $retryCount;

	public function __construct($remoteApiUrl = self::DEFAULT_TRANSPORT_URL, $retryCount = 3) {
		$this->remoteApiUrl = $remoteApiUrl;
		$this->retryCount = $retryCount;
		if(!preg_match('/%%API_KEY%%/', $this->remoteApiUrl)) {
			throw new Curl_Exception('api key placeholder missing in remote api url', Curl_Exception::URL_API_KEY_MISSING);
		}
		if(!preg_match('/%%SIGNATURE%%/', $this->remoteApiUrl)) {
			throw new Curl_Exception('signature placeholder missing in remote api url', Curl_Exception::URL_SIGNATURE_MISSING);
		}
	}
	public function send(Event_Container $events) {
		$apiKey = $events->getApiKey();
		$data = $events->getData();
		$data = json_encode($data);
		$signature = hash_hmac('sha512', $data, $events->getSecretKey());

		$requestSuccessful = false;
		$try = 0;
		do {
			$try++;
			$response = $this->sendReal($data, $apiKey, $signature);
			if($response) {
				$response = json_decode($response);
				if($response && isset($response->status) && $response->status === 'ok') {
					$requestSuccessful = true;
				}
			}
		} while($requestSuccessful !== true && $try <= $this->retryCount);

		return $requestSuccessful;
	}
	protected function sendReal($data, $apiKey, $signature) {
		try {
			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => str_replace(array('%%API_KEY%%', '%%SIGNATURE%%'), array($apiKey, $signature), $this->remoteApiUrl),
				CURLOPT_HEADER => 'Content-Type: application/json',
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => $data,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HEADER => false
			));
			$result = curl_exec($curl);
			if($result) {
				curl_close($curl);
				return $result;
			} else {
				throw new Curl_Exception(
					'returned content after transfering data to server is empty or broken',
					Curl_Exception::INVALID_RETURN_DATA
				);
			}
		} catch(\Exception $ex) {
			throw new Curl_Exception(
				'exception '.get_class($ex).' caught while transfering data to server: '.$ex->getMessage(),
				Curl_Exception::EXCEPTION_CAUGHT_WHILE_SENDING_DATA
			);
		}
	}
}

?>