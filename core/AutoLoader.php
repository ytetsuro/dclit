<?php
namespace DCLIT\core;

class AutoLoader
{

    const EXT = '.php';
    private $cache   = [];
    private $namespaceMap = [
        'DCLIT\\core'      => 'core',
        'DCLIT\\lib'       => 'lib',
        'DCLIT\\template'  => 'template',
        'DCLIT\\processes' => 'processes'
    ];

    public function register()
    {
        spl_autoload_register([$this, 'load']);
    }

    public function load($class)
    {
        if (isset($this->cache[$class])) {
            return true;
        }
        $loaded    = false;
        $namespace = rtrim(substr($class, 0, strrpos($class, '\\')), '\\');
        $className = ltrim(substr($class, strrpos($class, '\\')), '\\');
        if (isset($this->namespaceMap[$namespace])) {
            $path = FCPATH.$this->namespaceMap[$namespace] . '/' . $className;
            $this->requireClassFile($path, $class);
        }
    }

    private function requireClassFile($path, $class)
    {
        if (is_file($path.self::EXT)) {
            require($path.self::EXT);
            $this->cache[$class] = $path;
            return true;
        }
        return false;
    }
}
