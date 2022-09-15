<?php

namespace Barn2\Plugin\Document_Library\Dependencies;

// autoload_real.php @generated by Composer
class ComposerAutoloaderInit8f46b741b3fc545944ffe0b77210fba6
{
    private static $loader;
    public static function loadClassLoader($class)
    {
        if ('Composer\\Autoload\\ClassLoader' === $class) {
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
        \spl_autoload_register(array('Barn2\\Plugin\\Document_Library\\Dependencies\\ComposerAutoloaderInit8f46b741b3fc545944ffe0b77210fba6', 'loadClassLoader'), \true, \true);
        self::$loader = $loader = new \Barn2\Plugin\Document_Library\Dependencies\Composer\Autoload\ClassLoader(\dirname(__DIR__));
        \spl_autoload_unregister(array('ComposerAutoloaderInit8f46b741b3fc545944ffe0b77210fba6', 'loadClassLoader'));
        require __DIR__ . '/autoload_static.php';
        \call_user_func(\Barn2\Plugin\Document_Library\Dependencies\Composer\Autoload\ComposerStaticInit8f46b741b3fc545944ffe0b77210fba6::getInitializer($loader));
        $loader->register(\true);
        $includeFiles = \Barn2\Plugin\Document_Library\Dependencies\Composer\Autoload\ComposerStaticInit8f46b741b3fc545944ffe0b77210fba6::$files;
        foreach ($includeFiles as $fileIdentifier => $file) {
            composerRequire8f46b741b3fc545944ffe0b77210fba6($fileIdentifier, $file);
        }
        return $loader;
    }
}
/**
 * @param string $fileIdentifier
 * @param string $file
 * @return void
 */
function composerRequire8f46b741b3fc545944ffe0b77210fba6($fileIdentifier, $file)
{
    if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
        $GLOBALS['__composer_autoload_files'][$fileIdentifier] = \true;
        require $file;
    }
}
