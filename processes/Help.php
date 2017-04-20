<?php
namespace DCLIT\processes;

class Help extends \DCLIT\template\ToolClient
{

    public function run(...$args)
    {
        echo "can use ProcessList\n";
        $this->showProcesslist($args);
    }

    private function showProcesslist($help_process_list = [])
    {
        $process_list = glob(FCPATH.'processes/*.php');
        foreach ($process_list as $process) {
            $class_name = substr($process, (strrpos($process, '/') + 1), -4);
            if (! empty($help_process_list) && ! in_array($help_process_list, $class_name, 'TRUE')) {
                continue;
            }
            $this->showHelp($class_name);
        }
    }

    private function showHelp($class_name)
    {
        $fix_name_space = 'DCLIT\\processes\\' . $class_name;
        $instance   = new $fix_name_space;
        if (! $instance instanceof \DCLIT\template\ToolClient) {
            return;
        }
        $this->showLine(
          '',
          '##### Process #####',
          $class_name,
          '=============Help===============',
          $instance->help(),
          '================================',
          ''
        );
    }

    public function help():string
    {
        return '各コマンドのヘルプを表示します。引数でコマンドを絞り込んでヘルプの参照も可能です。';
    }
}
