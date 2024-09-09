<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit498314b7eaa0945bab1bc9e1f19a2ead
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit498314b7eaa0945bab1bc9e1f19a2ead', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit498314b7eaa0945bab1bc9e1f19a2ead', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit498314b7eaa0945bab1bc9e1f19a2ead::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
