<?php
/**
 * This file contains the EntityGetData trait
 *
 * @author Sebastian Lagemann <sebastian@iqu.com>
 */

namespace Iqu\Sdk\Traits;

/**
 * Class EntityGetData
 * This trait contains methods to deliver an easy way to return key/value arrays from objects with private properties and
 * corresponding get-methods
 *
 * @package Iqu\Sdk\Traits
 */
trait EventGetData {
	/**
	 * can be used within classes which has private properties and corresponding get methods to return the data
	 * this method will allow to get a whole array with all corresponding properties and values back
	 *
	 * @return array
	 */
	public function getData() {
		$result = array();
		if(defined('static::TYPE') && !is_null(static::TYPE)) {
			$result['type'] = static::TYPE;
			$result['timestamp'] = $this->getTimestamp();
		}

		foreach(array_keys(get_object_vars($this)) AS $property) {
			if(substr($property, 0, 1) != '_') {
				$method = 'get' . str_replace('_', '', $property);
				if (method_exists($this, $method)) {
					$value = $this->{$method}();
					if (is_scalar($value) || is_array($value)) {
						if (preg_match('/^timestamp$/i', $property)) {
							$value = gmdate('Y-m-d H:i:s', $value);
						}
						$result[$property] = $value;
					} elseif (is_object($value)) {
						$result[$property] = $value->getData();
					}
				}
			}
		}

		if(defined('static::TYPE')) {
			return (object)array(
				'identifiers' => $this->getIdentifiers()->getData(),
				'event' => $result
			);
		}
		return $result;
	}
}

?>