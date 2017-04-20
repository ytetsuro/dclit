<?php
namespace DCLIT\lib;

class CLI
{
    public function getMess($mess, $hidden = false)
    {
        $result = '';
        while (1) {
            echo $mess . ' : ';
            if ($hidden == true && ! $this->is_win()) {
                system('stty -echo');
            }
            @flock(STDIN, LOCK_EX);
            $result = trim(fgets(STDIN));
            @flock(STDIN, LOCK_UN);
            if ($hidden == true && ! $this->is_win()) {
                system('stty echo');
            }
            echo "\n";
            break;
        }

        return $result;
    }

    public function getBool($mess)
    {
        $result = false;
        while (1) {
            echo $mess . ' [y/N]: ';
            @flock(STDIN, LOCK_EX);
            $tmp = trim(fgets(STDIN));
            @flock(STDIN, LOCK_UN);
            $low_tmp = strtolower($tmp);
            echo "\n";
            if (in_array($low_tmp, array('y', 'yes', 'n', 'no'))) {
                $result = (bool)in_array($low_tmp, array('y', 'yes'));
                break;
            }
        }

        return $result;
    }

    private function is_win()
    {
        return (bool)(strncasecmp(PHP_OS, 'WIN', 3) === 0);
    }
}
