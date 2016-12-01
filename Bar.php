<?php
declare(strict_types=1);

class Bar {
	public $pos = 0;
	public $endPos = 0;
	public $maxPos;
	public $direction;
	public $char;
	
	public function __construct($maxPos) {
		$this->maxPos = $maxPos;
	}

	public function move() {
		if ($this->pos < $this->endPos) {
			$this->pos++;

			$this->direction = 1; // right
		} else if ($this->pos > $this->endPos) {
			$this->pos--;

			$this->direction = 2; // left
		} else if ($this->pos == $this->endPos) {
			$this->endPos = rand(0, $this->maxPos);

			$this->direction = 0;
		}
		
		switch($this->direction) {
			case 1:
				$this->char = "\\";
				break;
			case 2:
				$this->char = "/";
				break;
			case 0:
				$this->char = "|";
				break;
		}
	}
}

