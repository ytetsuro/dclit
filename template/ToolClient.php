<?php
namespace DCLIT\template;

abstract class ToolClient
{

    protected $load_libs = [];

    public function __construct()
    {
        $this->autoload();
    }

    abstract public function run(...$arg);

    private function autoload()
    {
        foreach ($this->load_libs as $lib_name) {
            $class_name = 'DCLIT\\lib\\' . $lib_name;
            $this->{$lib_name} = new $class_name();
        }
    }

    abstract public function help():string;

    protected function showLine(...$str)
    {
        if (is_array($str)) {
            $str = implode("\n", $str);
        }
        echo $str . "\n";
    }
}
