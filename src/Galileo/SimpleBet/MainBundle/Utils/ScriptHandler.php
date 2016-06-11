<?php

namespace Galileo\SimpleBet\MainBundle\Utils;

use Sensio\Bundle\DistributionBundle\Composer\ScriptHandler as BaseScriptHandler;
use Symfony\Component\Process\Process;

class ScriptHandler extends BaseScriptHandler
{
    public static function installNode($event)
    {

        $process = new Process('cd node; npm install', null, null, null, 300);
        $process->run(function ($type, $buffer) { echo $buffer; });
        if (!$process->isSuccessful()) {
            throw new \RuntimeException(sprintf('An error occurred when executing the "%s" command.', escapeshellarg($cmd)));
        }
    }
}