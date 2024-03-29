<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit06343d279846a4ac890b833686c35134
{
    public static $prefixLengthsPsr4 = array (
        'a' => 
        array (
            'app\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit06343d279846a4ac890b833686c35134::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit06343d279846a4ac890b833686c35134::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit06343d279846a4ac890b833686c35134::$classMap;

        }, null, ClassLoader::class);
    }
}
