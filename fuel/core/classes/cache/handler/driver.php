<?php
/**
 * Fuel is a fast, lightweight, community driven PHP 5.4+ framework.
 *
 * @package    Fuel
 * @version    1.8.2
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2019 Fuel Development Team
 * @link       https://fuelphp.com
 */

namespace Fuel\Core;

interface Cache_Handler_Driver {
	/**
	 * Should make the contents readable
	 *
	 * @param   mixed
	 * @return  mixed
	 */
	public function readable($contents);

	/**
	 * Should make the contents writable
	 *
	 * @param   mixed
	 * @return  mixed
	 */
	public function writable($contents);
}
