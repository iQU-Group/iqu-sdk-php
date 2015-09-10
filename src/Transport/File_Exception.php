<?php
/**
 *
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */

namespace Iqu\Sdk\Transport;

class File_Exception extends \Iqu\Sdk\Exception {
	const INVALID_PATH_NOT_FOUND = 1;
	const INVALID_PATH_NO_DIRECTORY = 2;
	const INVALID_PATH_NOT_WRITABLE = 3;
}

?>