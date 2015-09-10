<?php
/**
 *
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */

namespace Iqu\Sdk\Transport;

class Curl_Exception extends \Iqu\Sdk\Exception {
	const EXCEPTION_CAUGHT_WHILE_SENDING_DATA = 1;
	const INVALID_RETURN_DATA = 2;
	const URL_API_KEY_MISSING = 3;
	const URL_SIGNATURE_MISSING = 4;
}

?>