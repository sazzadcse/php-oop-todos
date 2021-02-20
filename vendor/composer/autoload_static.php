<?php
/**
 * autoload-static.php
 */
namespace Composer\Autoload;

class ComposerStaticInit2fbcb097c948d67f727bf006a459ae36
{
    public static $prefixLengthsPsr4 = array (
        'T' => 
        array (
            'TodosProject\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'TodosProject\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit2fbcb097c948d67f727bf006a459ae36::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit2fbcb097c948d67f727bf006a459ae36::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
