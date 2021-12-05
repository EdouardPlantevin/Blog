<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitb98eb130755e4b528ce6577a41cfad6f
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitb98eb130755e4b528ce6577a41cfad6f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitb98eb130755e4b528ce6577a41cfad6f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitb98eb130755e4b528ce6577a41cfad6f::$classMap;

        }, null, ClassLoader::class);
    }
}
