<?php
/**
 * autoload_psr4.php
 */

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'TodosProject\\' => array($baseDir . '/includes'),
);
