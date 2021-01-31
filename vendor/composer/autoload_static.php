<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita29ffd99b314de04211bb325424e9782
{
    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'Utilities\\' => 10,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Utilities\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Utilities',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita29ffd99b314de04211bb325424e9782::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita29ffd99b314de04211bb325424e9782::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita29ffd99b314de04211bb325424e9782::$classMap;

        }, null, ClassLoader::class);
    }
}
