<?php
declare(strict_types=1);

require_once("Bar.php");

class Falling {
	private $bar;

	public function __construct(int $width, int $delay) {
		$this->bar = new Bar($width);

		while (true) {
			$this->loop();
			usleep($delay);
		}
	}

	private function loop() {
		$this->update();
		$this->draw();
	}

	private function update() {
		$this->bar->move();
	}

	private function draw() {
		$line = "";
		$line = $this->pad($line, $this->bar->pos - 1);
		$line .= $this->bar->char;
		
		print $line . PHP_EOL;
	}

	private function pad(string $input, int $amount) {
		$padding = "";

		for ($i = 0; $i < $amount + 1; $i++) $padding .= " ";

		$input = $padding . $input;

		return $input;
	}
}

$opts = array(
	"w" => 100, // maximum expansion width in characters
	"d" => 50 // delay between each iteration in milliseconds
);

$optsKeys = array_keys($opts);
$optsStr = "";

for ($i = 0; $i < count($optsKeys); $i++) {
	$optsStr .= $optsKeys[$i] . ":";
}

$givenOpts = getopt($optsStr);

foreach($givenOpts as $opt => $optval) {
	// input sanitization
	switch($opt) {
		case "w":
			if ($optval < 0) exit("Width must be a postive number");
			break;
		case "d":
			if ($optval < 0) exit("Delay must be a postive number");
			break;
	}

	$opts[$opt] = $optval;
}

new Falling(intval($opts["w"]), intval($opts["d"] * 1000));
