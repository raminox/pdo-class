<?php

namespace moofyme;

abstract class Singleton 
{
	protected static $instance = null;

	public static function getInstance()
	{
		if (is_null(static::$instance)) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	protected function __construct() {}
	private function __clone() {}
	private function __wakeup() {}
}
