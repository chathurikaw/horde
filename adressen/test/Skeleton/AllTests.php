<?php
/**
 * Adressen test suite.
 *
 * @author     Your Name <you@example.com>
 * @license    http://www.fsf.org/copyleft/gpl.html GPL
 * @category   Horde
 * @package    Adressen
 * @subpackage UnitTests
 */

/**
 * Define the main method
 */
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'Adressen_AllTests::main');
}

/**
 * Prepare the test setup.
 */
require_once 'Horde/Test/AllTests.php';

/**
 * @package    Adressen
 * @subpackage UnitTests
 */
class Adressen_AllTests extends Horde_Test_AllTests
{
}

Adressen_AllTests::init('Adressen', __FILE__);

if (PHPUnit_MAIN_METHOD == 'Adressen_AllTests::main') {
    Adressen_AllTests::main();
}
