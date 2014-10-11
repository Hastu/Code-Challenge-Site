<?php 
use Symfony\Component\Process\Process;

$process = new Process('ls -lh ' . escapeshellarg(__DIR__));
$process->run();

// executes after the command finishes
if (!$process->isSuccessful()) {
    throw new \RuntimeException($process->getErrorOutput());
}

echo $process->getOutput();
