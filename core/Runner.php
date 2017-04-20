<?php
namespace DCLIT\core;

class Runner
{

    private $processNameSpace = 'DCLIT\\processes';
    private $processName;
    private $args;

    public function run($process, ...$args)
    {
        $className = $this->processNameSpace . '\\' . $process;
        $process = new $className($args);
        if (! $process instanceof \DCLIT\template\ToolClient) {
            throw new \LogicException('Require ToolClient');
        }

        call_user_func_array([$process, 'run'], $args);
    }
}
