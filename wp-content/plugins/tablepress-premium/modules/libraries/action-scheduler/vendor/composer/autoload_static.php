<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit48f51bf1cc7f0010853b7c39db39a2db
{
	public static $classMap = array (
		'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
	);

	public static function getInitializer(ClassLoader $loader)
	{
		return \Closure::bind(function () use ($loader) {
			$loader->classMap = ComposerStaticInit48f51bf1cc7f0010853b7c39db39a2db::$classMap;

		}, null, ClassLoader::class);
	}
}
