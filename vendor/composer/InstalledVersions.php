<?php











namespace Composer;

use Composer\Autoload\ClassLoader;
use Composer\Semver\VersionParser;






class InstalledVersions
{
private static $installed = array (
  'root' =>
  array (
    'pretty_version' => 'dev-develop',
    'version' => 'dev-develop',
    'aliases' =>
    array (
    ),
    'reference' => '97df7f07df398531217bb36c35896f64c26df605',
    'name' => 'barn2/document-library-lite',
  ),
  'versions' =>
  array (
    'bamarni/composer-bin-plugin' =>
    array (
      'pretty_version' => 'v1.5.0',
      'version' => '1.5.0.0',
      'aliases' =>
      array (
      ),
      'reference' => '49934ffea764864788334c1485fbb08a4b852031',
    ),
    'barn2/document-library-lite' =>
    array (
      'pretty_version' => 'dev-develop',
      'version' => 'dev-develop',
      'aliases' =>
      array (
      ),
      'reference' => '97df7f07df398531217bb36c35896f64c26df605',
    ),
    'barn2/php-standards' =>
    array (
      'pretty_version' => 'dev-master',
      'version' => 'dev-master',
      'aliases' =>
      array (
        0 => '9999999-dev',
      ),
      'reference' => 'e1476dff450268b8d594fb309a0c282fce8fcc61',
    ),
    'barn2/setup-wizard' =>
    array (
      'pretty_version' => '0.4.1',
      'version' => '0.4.1.0',
      'aliases' =>
      array (
      ),
      'reference' => 'c4b625377cd66e346bb9299bdf8decb28dccc49b',
    ),
    'dealerdirect/phpcodesniffer-composer-installer' =>
    array (
      'pretty_version' => 'v0.7.2',
      'version' => '0.7.2.0',
      'aliases' =>
      array (
      ),
      'reference' => '1c968e542d8843d7cd71de3c5c9c3ff3ad71a1db',
    ),
    'phpcompatibility/php-compatibility' =>
    array (
      'pretty_version' => '9.3.5',
      'version' => '9.3.5.0',
      'aliases' =>
      array (
      ),
      'reference' => '9fb324479acf6f39452e0655d2429cc0d3914243',
    ),
    'phpcompatibility/phpcompatibility-paragonie' =>
    array (
      'pretty_version' => '1.3.1',
      'version' => '1.3.1.0',
      'aliases' =>
      array (
      ),
      'reference' => 'ddabec839cc003651f2ce695c938686d1086cf43',
    ),
    'phpcompatibility/phpcompatibility-wp' =>
    array (
      'pretty_version' => '2.1.3',
      'version' => '2.1.3.0',
      'aliases' =>
      array (
      ),
      'reference' => 'd55de55f88697b9cdb94bccf04f14eb3b11cf308',
    ),
    'squizlabs/php_codesniffer' =>
    array (
      'pretty_version' => '3.6.2',
      'version' => '3.6.2.0',
      'aliases' =>
      array (
      ),
      'reference' => '5e4e71592f69da17871dba6e80dd51bce74a351a',
    ),
    'wp-coding-standards/wpcs' =>
    array (
      'pretty_version' => '2.3.0',
      'version' => '2.3.0.0',
      'aliases' =>
      array (
      ),
      'reference' => '7da1894633f168fe244afc6de00d141f27517b62',
    ),
  ),
);
private static $canGetVendors;
private static $installedByVendor = array();







public static function getInstalledPackages()
{
$packages = array();
foreach (self::getInstalled() as $installed) {
$packages[] = array_keys($installed['versions']);
}


if (1 === \count($packages)) {
return $packages[0];
}

return array_keys(array_flip(\call_user_func_array('array_merge', $packages)));
}









public static function isInstalled($packageName)
{
foreach (self::getInstalled() as $installed) {
if (isset($installed['versions'][$packageName])) {
return true;
}
}

return false;
}














public static function satisfies(VersionParser $parser, $packageName, $constraint)
{
$constraint = $parser->parseConstraints($constraint);
$provided = $parser->parseConstraints(self::getVersionRanges($packageName));

return $provided->matches($constraint);
}










public static function getVersionRanges($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

$ranges = array();
if (isset($installed['versions'][$packageName]['pretty_version'])) {
$ranges[] = $installed['versions'][$packageName]['pretty_version'];
}
if (array_key_exists('aliases', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['aliases']);
}
if (array_key_exists('replaced', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['replaced']);
}
if (array_key_exists('provided', $installed['versions'][$packageName])) {
$ranges = array_merge($ranges, $installed['versions'][$packageName]['provided']);
}

return implode(' || ', $ranges);
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['version'])) {
return null;
}

return $installed['versions'][$packageName]['version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getPrettyVersion($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['pretty_version'])) {
return null;
}

return $installed['versions'][$packageName]['pretty_version'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getReference($packageName)
{
foreach (self::getInstalled() as $installed) {
if (!isset($installed['versions'][$packageName])) {
continue;
}

if (!isset($installed['versions'][$packageName]['reference'])) {
return null;
}

return $installed['versions'][$packageName]['reference'];
}

throw new \OutOfBoundsException('Package "' . $packageName . '" is not installed');
}





public static function getRootPackage()
{
$installed = self::getInstalled();

return $installed[0]['root'];
}







public static function getRawData()
{
return self::$installed;
}



















public static function reload($data)
{
self::$installed = $data;
self::$installedByVendor = array();
}




private static function getInstalled()
{
if (null === self::$canGetVendors) {
self::$canGetVendors = method_exists('Composer\Autoload\ClassLoader', 'getRegisteredLoaders');
}

$installed = array();

if (self::$canGetVendors) {

foreach (ClassLoader::getRegisteredLoaders() as $vendorDir => $loader) {
if (isset(self::$installedByVendor[$vendorDir])) {
$installed[] = self::$installedByVendor[$vendorDir];
} elseif (is_file($vendorDir.'/composer/installed.php')) {
$installed[] = self::$installedByVendor[$vendorDir] = require $vendorDir.'/composer/installed.php';
}
}
}

$installed[] = self::$installed;

return $installed;
}
}
