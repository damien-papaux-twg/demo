<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb4536d6b6d6d837d0dd633f7243d14ca
{
    public static $files = array (
        '3a37ebac017bc098e9a86b35401e7a68' => __DIR__ . '/..' . '/mongodb/mongodb/src/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MongoDB\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MongoDB\\' => 
        array (
            0 => __DIR__ . '/..' . '/mongodb/mongodb/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb4536d6b6d6d837d0dd633f7243d14ca::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb4536d6b6d6d837d0dd633f7243d14ca::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
