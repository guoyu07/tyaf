<?php
use League\BooBoo\Formatter\CommandLineFormatter;
use League\BooBoo\Runner;

require_once __DIR__ . "/vendor/autoload.php";


$runner = new Runner();
$runner->pushFormatter(new CommandLineFormatter());
$runner->register(); // Registers the handlers

echo $cc;

