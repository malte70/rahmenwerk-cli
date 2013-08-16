<?php

/**
 * print a string with a leading newline
 */
function println($string) {
	print $string."\n";
}

/**
 * PHP version of the Python function startswith
 * @see http://blog.malte-bublitz.de/php-startswith/
 */
function startswith($string, $start) {
	return (substr($string, 0, strlen($start))==$start);
}

/**
 * Application class
 * @author Malte Bublitz
 */
abstract class RahmenwerkCLIApplication {
	/**
	 * Application name
	 * @var string
	 */
	public $appname    = "Rahmenwerk-CLI";
	/**
	 * Application version
	 * @var string
	 */
	public $appversion = "0.1";
	/**
	 * An array of all options passed
	 */
	private $options   = array();
	/**
	 * constructor, parses command line arguments and appends options to $this->options
	 */
	public function __construct() {
		global $argv,$argc;
		if ($argc > 1) {
			if ($argv[1]=="--version") {
				$this->version();
				exit(0);
			}
			foreach ($argv as $arg) {
				if (startswith($arg, "-")) {
					if ($arg == "--")
						break;
					$this->options[] = $arg
				}
			}
		}
	}
	/**
	 * print out version string
	 */
	public function version() {
		println("$appname $appversion");
	}
	/**
	 * run the application
	 */
	abstract protected function run();
}
?>
