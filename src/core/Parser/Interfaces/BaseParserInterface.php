<?php

namespace App\Parser\Interfaces;

interface BaseParserInterface
{
	public function read(callable $callable);
}