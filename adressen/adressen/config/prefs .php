<?php
/**
 * See horde/config/prefs.php for documentation on the structure of this file.
 *
 * $Id: 7e3aeb7eea0612b9b2215f43c43b7e1e7a65e3b8 $
 */

$prefGroups['Sample'] = array(
    'column' => _("Sample Prefs"),
    'label' => _("Sample Pref"),
    'desc' => _("Set your sample preference."),
    'members' => array('sample')
);

$_prefs['sample'] = array(
    'value' => '',
    'locked' => false,
    'type' => 'text',
    'desc' => _("This is your sample preference.")
);
