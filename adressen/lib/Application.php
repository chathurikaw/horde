<?php
/**
 * Adressen application API.
 *
 * This file defines Horde's core API interface. Other core Horde libraries
 * can interact with Adressen through this API.
 *
 * Copyright 2010 The Horde Project (http://www.horde.org/)
 *
 * See the enclosed file COPYING for license information (GPL). If you
 * did not receive this file, see http://www.fsf.org/copyleft/gpl.html.
 *
 * @package Adressen
 */

/* Determine the base directories. */
if (!defined('ADRESSEN_BASE')) {
    define('ADRESSEN_BASE', dirname(__FILE__) . '/..');
}

if (!defined('HORDE_BASE')) {
    /* If Horde does not live directly under the app directory, the HORDE_BASE
     * constant should be defined in config/horde.local.php. */
    if (file_exists(ADRESSEN_BASE . '/config/horde.local.php')) {
        include ADRESSEN_BASE . '/config/horde.local.php';
    } else {
        define('HORDE_BASE', ADRESSEN_BASE . '/..');
    }
}

/* Load the Horde Framework core (needed to autoload
 * Horde_Registry_Application::). */
require_once HORDE_BASE . '/lib/core.php';

// Registry.
$registry = &Registry::singleton();
if (is_a(($pushed = $registry->pushApp('adressen', !defined('AUTH_HANDLER'))), 'PEAR_Error')) {
    if ($pushed->getCode() == 'permission_denied') {
        Horde::authenticationFailureRedirect();
    }
    Horde::fatal($pushed, __FILE__, __LINE__, false);
}
$conf = &$GLOBALS['conf'];
@define('ADRESSEN_TEMPLATES', $registry->get('templates'));

// Notification system.
$notification = &Notification::singleton();
$notification->attach('status');

//echo 'lak';

class Adressen_Application 
{

    /**
     * The application's version.
     *
     * @var string
     */
    public $version = 'H4 (0.1-git)';

    /**
     * Add additional items to the menu.
     *
     * @param Horde_Menu $menu  The menu object.
     */
   public function menu($menu)
    {
        $menu->add(Horde::url('list.php'), _("List"), 'user.png');
    }
    
     /**
     * Returns values for <configspecial> configuration settings.
     *
     * @param string $what  The configuration setting to return.
     *
     * @return array  The values for the requested configuration setting.
     */

   

}

// Start compression.
if (!Util::nonInputVar('no_compress')) {
     Horde::compressOutput();
}


// Horde libraries.
require_once 'Horde/Help.php';
require_once 'Horde/Secret.php';
