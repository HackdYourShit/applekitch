<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8314c083a4764fb726647a909f0e51e9
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit8314c083a4764fb726647a909f0e51e9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit8314c083a4764fb726647a909f0e51e9::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
