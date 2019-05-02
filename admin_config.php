<?php

/**
 * G4HDU WeeWX Menu plugin
 *
 * Copyright (C) 2008-2016 Barry Keal G4HDU http://e107.keal.me.uk
 * blankd under the terms and conditions of the
 * GNU General Public License (http://www.gnu.org/licenses/gpl.txt)
 *
 * @author Barry Keal e107@keal.me.uk>
 * @copyright Copyright (C) 2008-2016 Barry Keal G4HDU
 * @license GPL
 * @version 1.0.0
 *
 * @todo
 */


// ***************************************************************
// *
// *		Plugin		:	Weewx Menu (e107 v2)
// *
// ***************************************************************
require_once ("../../class2.php");
if (!getperms("P")) {
    header("location:" . e_BASE . "index.php");
    exit;
}
e107::lan('gold_system', 'admin', true);
//require_once ("e_version.php");
/**
 * plugin_gold_system_admin
 * 
 * @package   
 * @author Weewx
 * @copyright Father Barry
 * @version 2016
 * @access public
 */
class gold_system_admin extends e_admin_dispatcher
{
    protected $modes = array(
        'main' => array(
            'controller' => 'gold_system_admin_ui',
            'path' => null,
            'ui' => 'gold_system_admin_form_ui',
            'uipath' => null),

        'plugins' => array(
            'controller' => 'gold_system_plugins_ui',
            'path' => null,
            'ui' => 'gold_system_plugins_form_ui',
            'uipath' => null),

        );

    /**
     *
     * @var array
     */
    protected $adminMenu = array(
        'main/prefs' => array('caption' => 'Settings', 'perm' => '0'),
        'other0' => array('divider' => true),
        'plugins/list' => array('caption' => 'Plugins', 'perm' => '0'),
        'plugins/scanGold' => array('caption' => 'Scan Directories', 'perm' => '0'),
        'other1' => array('divider' => true),
        'archive/motor' => array('caption' => 'Archive', 'perm' => '0'),
        'other2' => array('divider' => true),
        'bulk/motor' => array('caption' => 'Bulk Action', 'perm' => '0'),
        );

    /**
     * Optional, mode/action aliases, related with 'selected' menu CSS class
     * Format: 'MODE/ACTION' => 'MODE ALIAS/ACTION ALIAS';
     * This will mark active main/list menu item, when current page is main/edit
     * @var array
     */
    protected $adminMenuAliases = array('main/edit' => 'main/list');

    /**
     * Navigation menu title
     * @var string
     */
    protected $menuTitle = LAN_PLUGIN_GOLD_SYS_ADMIN_NAME;
}


/**
 * plugin_gold_system_admin_ui
 * 
 * @package   
 * @author Weewx
 * @copyright Father Barry
 * @version 2016
 * @access public
 */
class gold_system_admin_ui extends e_admin_ui
{

    protected $pluginTitle = LAN_PLUGIN_GOLD_SYS_ADMIN_NAME;

    /**
     * plugin name
     *
     * @var string
     */
    protected $pluginName = 'Gold System';
    /**
     * Array containing a list of tabs to be displayed on the page
     *
     * @var array of strings
     * @since 1.0.0
     *
     */
    protected $preftabs = array(
        0 => LAN_PLUGIN_GOLD_SYS_ADMIN_TAB0,
        1 => LAN_PLUGIN_GOLD_SYS_ADMIN_TAB1,
        2 => LAN_PLUGIN_GOLD_SYS_ADMIN_TAB2,
        3 => LAN_PLUGIN_GOLD_SYS_ADMIN_TAB3,
        4 => LAN_PLUGIN_GOLD_SYS_ADMIN_TAB4,
        5 => LAN_PLUGIN_GOLD_SYS_ADMIN_TAB5,
        6 => LAN_PLUGIN_GOLD_SYS_ADMIN_TAB6,
        7 => LAN_PLUGIN_GOLD_SYS_ADMIN_TAB7,


        );

    protected $prefs = array(
        'gold_currency_name' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__36,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_CUPDATE_HELP,
            'tab' => 0,
            'type' => 'text',
            'data' => 'str',
            // 'writeParms' => array( 'max' => 30, 'min' => 1 ),
            ),
        'gold_currency_decimal' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__88,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_TEMP_HELP,
            'tab' => 0,
            'type' => 'dropdown',
            'data' => 'int',
            'writeParms' => array(
                '0' => 0,
                '1' => 1,
                '2' => 2)),
        'gold_currency_point' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__C01,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_HUM_HELP,
            'tab' => 0,
            'type' => 'text',
            'data' => 'str'),
        'gold_currency_thou' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__C02,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_FEELS_HELP,
            'tab' => 0,
            'type' => 'text',
            'data' => 'str'),
        'gold_currency_abrev' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__37,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_WIND_HELP,
            'tab' => 0,
            'type' => 'text',
            'data' => 'str'),
        'gold_currency_formation' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__67,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_DIRN_HELP,
            'tab' => 0,
            'type' => 'dropdown',
            'data' => 'str',
            'writeParms' => array('prefix' => LAN_PLUGIN_GOLD_SYS__68, 'suffix' =>
                    LAN_PLUGIN_GOLD_SYS__69)),
        'gold_numchar' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__C14,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_BARO_HELP,
            'tab' => 0,
            'type' => 'text',
            'data' => 'str'),
        'gold_starting' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__38,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_RAIN_HELP,
            'tab' => 0,
            'type' => 'number',
            'data' => 'int'),
        'gold_pdftrans' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__C17,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_UV_HELP,
            'tab' => 0,
            'type' => 'dropdown',
            'data' => 'int',
            'writeParms' => array('0' => LAN_PLUGIN_GOLD_SYS__C18, '1' =>
                    LAN_PLUGIN_GOLD_SYS__C19)),

        'gold_arcloc' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__C15,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_WDPATH_HELP,
            'tab' => 0,
            'type' => 'text',
            'data' => 'str',
            ),
        // forum prefs
        'forum_addsub' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F01,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_DATAPATH_HELP,
            'tab' => 1,
            'type' => 'boolean',
            'data' => 'int',
            ),
        'gold_reward_type' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__33,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_NOAAPATH_HELP,
            'tab' => 1,
            'type' => 'dropdown',
            'data' => 'str',
            'writeParms' => array('post' => LAN_PLUGIN_GOLD_SYS__34, 'length' =>
                    LAN_PLUGIN_GOLD_SYS__35)),

        'gold_threadmin' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F02,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_WDPATH_HELP,
            'tab' => 1,
            'type' => 'number',
            'data' => 'int',
            'writeParms' => array(
                'max' => 50,
                'min' => 10,
                'step' => 10)),

        'gold_newthread_post' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F40,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_FORMAT_HELP,
            'tab' => 1,
            'type' => 'number',
            'data' => 'int',
            ),

        /*
        'weewx_showAge' => array(
        'title' => LAN_PLUGIN_GOLD_SYS_ADMIN_AGE,
        'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_AGE_HELP,
        'tab' => 3,
        'type' => 'boolean',
        'data' => 'int'),
        'weewx_linkUser' => array(
        'title' => LAN_PLUGIN_GOLD_SYS_ADMIN_LINK,
        'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_LINK_HELP,
        'tab' => 3,
        'type' => 'boolean',
        'data' => 'int'),
        'weewx_sendEmail' => array(
        'title' => LAN_PLUGIN_GOLD_SYS_ADMIN_EMAIL,
        'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_EMAIL_HELP,
        'tab' => 3,
        'type' => 'boolean',
        'data' => 'int'),
        */
        'gold_reply_post' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F41,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_FUPDATE_HELP,
            'tab' => 1,
            'type' => 'number',
            'data' => 'int',
            'writeParms' => array('max' => 1440, 'min' => 1),
            ),
        'gold_newthread_length' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F04,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_FORECASTAPIKEY_HELP,
            'tab' => 1,
            'type' => 'number',
            'data' => 'int',
            ),
        'gold_reply_length' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F05,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_LOCATION_NAME_HELP,
            'tab' => 1,
            'type' => 'number',
            'data' => 'int',
            ),
        'gold_threadbonus' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F03,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_FLATITUDE_HELP,
            'tab' => 1,
            'type' => 'number',
            'data' => 'int',
            ),
        'gold_threadrate' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F06,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_FLONGITUDE_HELP,
            'tab' => 1,
            'type' => 'number',
            'data' => 'int',
            ),
        'forum_layout_1' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F85,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_FSTATION_HELP,
            'tab' => 2,
            'type' => 'dropdown',
            'data' => 'str',
            'writeParms' => array(
                '' => '',
                'custom_title' => LAN_PLUGIN_GOLD_SYS__F70,
                'avatar' => LAN_PLUGIN_GOLD_SYS__F71),
            ),

        //         for ($j = 1; $j <= 2; $j++)
        //{
        //    $forum_layout_1[$j] = '<option></option>
        //	<option value="custom_title"' . $custom_title_s[$j] . '>' . LAN_PLUGIN_GOLD_SYS__F70 . '</option>
        //	<option value="LAN_PLUGIN_GOLD_SYS__F70"' . $avatar_s[$j] . '>' . LAN_PLUGIN_GOLD_SYS__F71 . '</option>';
        //}


        'forum_layout_2' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F85,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_AUPDATE_HELP,
            'tab' => 2,
            'type' => 'dropdown',
            'data' => 'str',
            'writeParms' => array(
                '' => '',
                'stars' => LAN_PLUGIN_GOLD_SYS__F72,
                'rank' => LAN_PLUGIN_GOLD_SYS__F73,
                'moderator' => LAN_PLUGIN_GOLD_SYS__F74,
                'member' => LAN_PLUGIN_GOLD_SYS__F75,
                'rpg' => LAN_PLUGIN_GOLD_SYS__F76,
                'joined' => LAN_PLUGIN_GOLD_SYS__F77,
                'location' => LAN_PLUGIN_GOLD_SYS__F78,
                'posts' => LAN_PLUGIN_GOLD_SYS__F79,
                'gold' => LAN_PLUGIN_GOLD_SYS__F80,
                'spent' => LAN_PLUGIN_GOLD_SYS__F81,
                ),
            ),
        'forum_layout_3' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F85,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_AUPDATE_HELP,
            'tab' => 2,
            'type' => 'dropdown',
            'data' => 'str',
            'writeParms' => array(
                '' => '',
                'stars' => LAN_PLUGIN_GOLD_SYS__F72,
                'rank' => LAN_PLUGIN_GOLD_SYS__F73,
                'moderator' => LAN_PLUGIN_GOLD_SYS__F74,
                'member' => LAN_PLUGIN_GOLD_SYS__F75,
                'rpg' => LAN_PLUGIN_GOLD_SYS__F76,
                'joined' => LAN_PLUGIN_GOLD_SYS__F77,
                'location' => LAN_PLUGIN_GOLD_SYS__F78,
                'posts' => LAN_PLUGIN_GOLD_SYS__F79,
                'gold' => LAN_PLUGIN_GOLD_SYS__F80,
                'spent' => LAN_PLUGIN_GOLD_SYS__F81,
                ),
            ),
        'forum_layout_4' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F85,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_AUPDATE_HELP,
            'tab' => 2,
            'type' => 'dropdown',
            'data' => 'str',
            'writeParms' => array(
                '' => '',
                'stars' => LAN_PLUGIN_GOLD_SYS__F72,
                'rank' => LAN_PLUGIN_GOLD_SYS__F73,
                'moderator' => LAN_PLUGIN_GOLD_SYS__F74,
                'member' => LAN_PLUGIN_GOLD_SYS__F75,
                'rpg' => LAN_PLUGIN_GOLD_SYS__F76,
                'joined' => LAN_PLUGIN_GOLD_SYS__F77,
                'location' => LAN_PLUGIN_GOLD_SYS__F78,
                'posts' => LAN_PLUGIN_GOLD_SYS__F79,
                'gold' => LAN_PLUGIN_GOLD_SYS__F80,
                'spent' => LAN_PLUGIN_GOLD_SYS__F81,
                ),
            ),
        'forum_layout_5' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F85,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_AUPDATE_HELP,
            'tab' => 2,
            'type' => 'dropdown',
            'data' => 'str',
            'writeParms' => array(
                '' => '',
                'stars' => LAN_PLUGIN_GOLD_SYS__F72,
                'rank' => LAN_PLUGIN_GOLD_SYS__F73,
                'moderator' => LAN_PLUGIN_GOLD_SYS__F74,
                'member' => LAN_PLUGIN_GOLD_SYS__F75,
                'rpg' => LAN_PLUGIN_GOLD_SYS__F76,
                'joined' => LAN_PLUGIN_GOLD_SYS__F77,
                'location' => LAN_PLUGIN_GOLD_SYS__F78,
                'posts' => LAN_PLUGIN_GOLD_SYS__F79,
                'gold' => LAN_PLUGIN_GOLD_SYS__F80,
                'spent' => LAN_PLUGIN_GOLD_SYS__F81,
                ),
            ),
        'forum_layout_6' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F85,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_AUPDATE_HELP,
            'tab' => 2,
            'type' => 'dropdown',
            'data' => 'str',
            'writeParms' => array(
                '' => '',
                'stars' => LAN_PLUGIN_GOLD_SYS__F72,
                'rank' => LAN_PLUGIN_GOLD_SYS__F73,
                'moderator' => LAN_PLUGIN_GOLD_SYS__F74,
                'member' => LAN_PLUGIN_GOLD_SYS__F75,
                'rpg' => LAN_PLUGIN_GOLD_SYS__F76,
                'joined' => LAN_PLUGIN_GOLD_SYS__F77,
                'location' => LAN_PLUGIN_GOLD_SYS__F78,
                'posts' => LAN_PLUGIN_GOLD_SYS__F79,
                'gold' => LAN_PLUGIN_GOLD_SYS__F80,
                'spent' => LAN_PLUGIN_GOLD_SYS__F81,
                ),
            ),
        'forum_layout_7' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F85,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_AUPDATE_HELP,
            'tab' => 2,
            'type' => 'dropdown',
            'data' => 'str',
            'writeParms' => array(
                '' => '',
                'stars' => LAN_PLUGIN_GOLD_SYS__F72,
                'rank' => LAN_PLUGIN_GOLD_SYS__F73,
                'moderator' => LAN_PLUGIN_GOLD_SYS__F74,
                'member' => LAN_PLUGIN_GOLD_SYS__F75,
                'rpg' => LAN_PLUGIN_GOLD_SYS__F76,
                'joined' => LAN_PLUGIN_GOLD_SYS__F77,
                'location' => LAN_PLUGIN_GOLD_SYS__F78,
                'posts' => LAN_PLUGIN_GOLD_SYS__F79,
                'gold' => LAN_PLUGIN_GOLD_SYS__F80,
                'spent' => LAN_PLUGIN_GOLD_SYS__F81,
                ),
            ),
        'forum_layout_8' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F85,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_AUPDATE_HELP,
            'tab' => 2,
            'type' => 'dropdown',
            'data' => 'str',
            'writeParms' => array(
                '' => '',
                'stars' => LAN_PLUGIN_GOLD_SYS__F72,
                'rank' => LAN_PLUGIN_GOLD_SYS__F73,
                'moderator' => LAN_PLUGIN_GOLD_SYS__F74,
                'member' => LAN_PLUGIN_GOLD_SYS__F75,
                'rpg' => LAN_PLUGIN_GOLD_SYS__F76,
                'joined' => LAN_PLUGIN_GOLD_SYS__F77,
                'location' => LAN_PLUGIN_GOLD_SYS__F78,
                'posts' => LAN_PLUGIN_GOLD_SYS__F79,
                'gold' => LAN_PLUGIN_GOLD_SYS__F80,
                'spent' => LAN_PLUGIN_GOLD_SYS__F81,
                ),
            ),
        'forum_layout_9' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F85,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_AUPDATE_HELP,
            'tab' => 2,
            'type' => 'dropdown',
            'data' => 'str',
            'writeParms' => array(
                '' => '',
                'stars' => LAN_PLUGIN_GOLD_SYS__F72,
                'rank' => LAN_PLUGIN_GOLD_SYS__F73,
                'moderator' => LAN_PLUGIN_GOLD_SYS__F74,
                'member' => LAN_PLUGIN_GOLD_SYS__F75,
                'rpg' => LAN_PLUGIN_GOLD_SYS__F76,
                'joined' => LAN_PLUGIN_GOLD_SYS__F77,
                'location' => LAN_PLUGIN_GOLD_SYS__F78,
                'posts' => LAN_PLUGIN_GOLD_SYS__F79,
                'gold' => LAN_PLUGIN_GOLD_SYS__F80,
                'spent' => LAN_PLUGIN_GOLD_SYS__F81,
                ),
            ),
        'forum_layout_10' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F85,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_AUPDATE_HELP,
            'tab' => 2,
            'type' => 'dropdown',
            'data' => 'str',
            'writeParms' => array(
                '' => '',
                'stars' => LAN_PLUGIN_GOLD_SYS__F72,
                'rank' => LAN_PLUGIN_GOLD_SYS__F73,
                'moderator' => LAN_PLUGIN_GOLD_SYS__F74,
                'member' => LAN_PLUGIN_GOLD_SYS__F75,
                'rpg' => LAN_PLUGIN_GOLD_SYS__F76,
                'joined' => LAN_PLUGIN_GOLD_SYS__F77,
                'location' => LAN_PLUGIN_GOLD_SYS__F78,
                'posts' => LAN_PLUGIN_GOLD_SYS__F79,
                'gold' => LAN_PLUGIN_GOLD_SYS__F80,
                'spent' => LAN_PLUGIN_GOLD_SYS__F81,
                ),
            ),
        'forum_layout_11' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F85,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_AUPDATE_HELP,
            'tab' => 2,
            'type' => 'dropdown',
            'data' => 'str',
            'writeParms' => array(
                '' => '',
                'stars' => LAN_PLUGIN_GOLD_SYS__F72,
                'rank' => LAN_PLUGIN_GOLD_SYS__F73,
                'moderator' => LAN_PLUGIN_GOLD_SYS__F74,
                'member' => LAN_PLUGIN_GOLD_SYS__F75,
                'rpg' => LAN_PLUGIN_GOLD_SYS__F76,
                'joined' => LAN_PLUGIN_GOLD_SYS__F77,
                'location' => LAN_PLUGIN_GOLD_SYS__F78,
                'posts' => LAN_PLUGIN_GOLD_SYS__F79,
                'gold' => LAN_PLUGIN_GOLD_SYS__F80,
                'spent' => LAN_PLUGIN_GOLD_SYS__F81,
                ),
            ),
        'forum_layout_12' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__F85,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_AUPDATE_HELP,
            'tab' => 2,
            'type' => 'dropdown',
            'data' => 'str',
            'writeParms' => array(
                '' => '',
                'stars' => LAN_PLUGIN_GOLD_SYS__F72,
                'rank' => LAN_PLUGIN_GOLD_SYS__F73,
                'moderator' => LAN_PLUGIN_GOLD_SYS__F74,
                'member' => LAN_PLUGIN_GOLD_SYS__F75,
                'rpg' => LAN_PLUGIN_GOLD_SYS__F76,
                'joined' => LAN_PLUGIN_GOLD_SYS__F77,
                'location' => LAN_PLUGIN_GOLD_SYS__F78,
                'posts' => LAN_PLUGIN_GOLD_SYS__F79,
                'gold' => LAN_PLUGIN_GOLD_SYS__F80,
                'spent' => LAN_PLUGIN_GOLD_SYS__F81,
                ),
            ),
        'buy_gold_account' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__PP02,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_FLOOD_UPDATE_HELP,
            'tab' => 3,
            'type' => 'text',
            'data' => 'str'),

        'buy_gold_notify_url' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__PP03,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_CSS_HELP,
            'tab' => 3,
            'type' => 'url',
            'data' => 'str'),
        'buy_gold_return_url' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__PP04,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_CSS_HELP,
            'tab' => 3,
            'type' => 'url',
            'data' => 'str'),
        'buy_gold_cancel_url' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__PP05,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_CSS_HELP,
            'tab' => 3,
            'type' => 'url',
            'data' => 'str'),
        'buy_gold_currency' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__PP06,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_AVATAR_HELP,
            'tab' => 3,
            'type' => 'dropdown',
            'data' => 'str',
            'writeParms' => array(
                'AUD' => LAN_PLUGIN_GOLD_SYS__PP11,
                'CAD' => LAN_PLUGIN_GOLD_SYS__PP12,
                'CHF' => LAN_PLUGIN_GOLD_SYS__PP13,
                'CZK' => LAN_PLUGIN_GOLD_SYS__PP14,
                'DKK' => LAN_PLUGIN_GOLD_SYS__PP15,
                'EUR' => LAN_PLUGIN_GOLD_SYS__PP16,
                'GBP' => LAN_PLUGIN_GOLD_SYS__PP17,
                'HKD' => LAN_PLUGIN_GOLD_SYS__PP18,
                'HUF' => LAN_PLUGIN_GOLD_SYS__PP19,
                'JPY' => LAN_PLUGIN_GOLD_SYS__PP20,
                'NOK' => LAN_PLUGIN_GOLD_SYS__PP21,
                'NZD' => LAN_PLUGIN_GOLD_SYS__PP22,
                'PLN' => LAN_PLUGIN_GOLD_SYS__PP21,
                'SEK' => LAN_PLUGIN_GOLD_SYS__PP24,
                'SGD' => LAN_PLUGIN_GOLD_SYS__PP25,
                'USD' => LAN_PLUGIN_GOLD_SYS__PP26,
                'ILS' => LAN_PLUGIN_GOLD_SYS__PP27,
                'MXN' => LAN_PLUGIN_GOLD_SYS__PP28,
                ),
            ),
        'buy_gold_item_name' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__PP07,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_WIDTH_HELP,
            'tab' => 3,
            'type' => 'text',
            'data' => 'str',
            ),
        'buy_gold_cost' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__PP08,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_FORMAT_HELP,
            'tab' => 1,
            'type' => 'number',
            'data' => 'int',
            ),
        'buy_gold_perunit' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__PP10,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_FORMAT_HELP,
            'tab' => 1,
            'type' => 'number',
            'data' => 'int',
            ),

        'gold_expanding' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__MS12,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_FORMAT_HELP,
            'tab' => 4,
            'type' => 'boolean',
            'data' => 'int',
            ),
        'gold_showpresent' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__MS13,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_FORMAT_HELP,
            'tab' => 4,
            'type' => 'boolean',
            'data' => 'int',
            ),
        'gold_mdonate' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__MS04,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_FORMAT_HELP,
            'tab' => 4,
            'type' => 'boolean',
            'data' => 'int',
            ),
        'gold_mbuy' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__MS05,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_FORMAT_HELP,
            'tab' => 4,
            'type' => 'boolean',
            'data' => 'int',
            ),
        'gold_mhistory' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__MS06,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_FORMAT_HELP,
            'tab' => 4,
            'type' => 'boolean',
            'data' => 'int',
            ),
        'gold_msummary' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__MS09,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_FORMAT_HELP,
            'tab' => 4,
            'type' => 'boolean',
            'data' => 'int',
            ),
        'gold_mrichest' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__MS10,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_FORMAT_HELP,
            'tab' => 4,
            'type' => 'number',
            'data' => 'int',
            'writeParms' => array('max' => 20, 'min' => 0),
            ),

        'shop_color' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__S04,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_WIDTH_HELP,
            'tab' => 7,
            'type' => 'boolean',
            'data' => 'int'),
        'shop_shadow' => array(
            'title' => 'shadow',
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_WIDTH_HELP,
            'tab' => 7,
            'type' => 'boolean',
            'data' => 'int'),
        'shop_customtitle' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__S05,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_WIDTH_HELP,
            'tab' => 7,
            'type' => 'boolean',
            'data' => 'int'),
        'shop_name' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__S06,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_WIDTH_HELP,
            'tab' => 7,
            'type' => 'boolean',
            'data' => 'int'),
        'shop_signature' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__S07,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_WIDTH_HELP,
            'tab' => 7,
            'type' => 'boolean',
            'data' => 'int'),
        'shop_avatar' => array(
            'title' => LAN_PLUGIN_GOLD_SYS__S08,
            'help' => LAN_PLUGIN_GOLD_SYS_ADMIN_WIDTH_HELP,
            'tab' => 7,
            'type' => 'boolean',
            'data' => 'int'),
        );
}


/**
 * plugin_gold_system_plugins_ui
 * 
 * @package   
 * @author Weewx
 * @copyright Father Barry
 * @version 2016
 * @access public
 */
class gold_system_plugins_ui extends e_admin_ui
{
    protected $message;
    protected $updated = 0;
    protected $inserted = 0;
    protected $unchanged = 0;
    protected $pluginTitle = "Gold System";

    /**
     * plugin name or 'core'
     * IMPORTANT: should be 'core' for non-plugin areas because this
     * value defines what CONFIG will be used. However, I think this should be changed
     * very soon (awaiting discussion with Cam)
     * Maybe we need something like $prefs['core'], $prefs['blank'] ... multiple getConfig support?
     *
     * @var string
     */
    protected $pluginName = 'gold_system';

    /**
     * DB Table, table alias is supported
     * Example: 'r.blank'
     * @var string
     */
    protected $table = "gold_system_plugins";

    /**
     * This is only needed if you need to JOIN tables AND don't wanna use $tableJoin
     * Write your list query without any Order or Limit.
     *
     * @var string [optional]
     */
    protected $listQry = "";
    //

    // optional - required only in case of e.g. tables JOIN. This also could be done with custom model (set it in init())
    //protected $editQry = "SELECT * FROM #blank WHERE blank_id = {ID}";

    // required - if no custom model is set in init() (primary id)
    protected $pid = "gold_plug_id";

    // optional
    protected $perPage = 20;

    protected $batchDelete = false;
    /**
     * 			
     * @var array
     */

    protected $fields = array(
        'checkboxes' => array(
            'title' => '',
            'type' => null,
            'data' => null,
            'width' => '5%',
            'thclass' => 'center',
            'forced' => true,
            'class' => 'center',
            'toggle' => 'e-multiselect'),
        'gold_plug_id' => array(
            'title' => LAN_ID,
            'type' => 'number',
            'data' => 'int',
            'width' => '5%',
            'thclass' => '',
            'class' => 'center',
            'forced' => false,
            'primary' => true),
        'gold_plug_name' => array(
            'title' => 'Plugin',
            'type' => 'text',
            'data' => 'str',
            'width' => '15%',
            'thclass' => '',
            'nolist' => false,
            'filter' => false,
            //   'writeParms' =>  $this->titles,
            'forced' => false),
        'gold_plug_version' => array(
            'title' => 'Version',
            'type' => 'text',
            'data' => 'str',
            'width' => 'auto',
            'nolist' => false,
            'forced' => true,
            'thclass' => '',
            'batch' => false,
            'filter' => false),
        'gold_plug_author' => array(
            'title' => 'Author',
            'type' => 'text',
            'data' => 'str',
            'width' => 'auto',
            'nolist' => false,
            'forced' => true,
            'thclass' => '',
            'batch' => true,
            'filter' => true),
        'gold_plug_path' => array(
            'title' => 'Path to Plugin',
            'type' => 'text',
            'data' => 'str',
            'width' => 'auto',
            'forced' => true,
            'thclass' => ''),
        'gold_plug_installed' => array(
            'title' => 'Installed',
            'type' => 'boolean',
            'data' => 'int',
            'width' => 'auto',
            'nolist' => false,
            'thclass' => ''),
        'gold_plug_active' => array(
            'title' => 'Active',
            'type' => 'boolean',
            'data' => 'int',
            'width' => 'auto',
            'nolist' => false,
            'thclass' => ''),
        'gold_plug_depends' => array(
            'title' => 'Dependencies',
            'type' => 'text',
            'data' => 'str',
            'width' => 'auto',
            'nolist' => true,
            'thclass' => ''),
        );
    function __construct()
    {
        $this->message = e107::getMessage();
        $args = func_get_args();
        call_user_func_array(array('parent', '__construct'), $args);
    }
    function scanGoldPage()
    {
        require_once (e_HANDLER . 'file_class.php');
        $fred = new e_file();
        $fred->setMode('all');
        //    echo e_PLUGIN_ABS;
        $files = $fred->get_files(e_PLUGIN, 'e_gold.*', 'standard', 2);
        print_a($fred->getErrorMessage());
        foreach ($files as $file) {
            $this->processEGold($file);

        }
        $this->message->addInfo($this->updated . " plugins updated");
        $this->message->addInfo($this->inserted . " plugins inserted");
        $this->message->addInfo(($this->unchanged - $this->updated - $this->inserted) .
            " plugins unchanged");
        //  print_a($files);

    }
    function processEGold($file = array())
    {


        $filePath = $file['path'] . $file['fname'];
        //   print_a($filePath);
        require_once ($filePath);

        // get filename
        $path_parts = pathinfo($filePath);

        if ($path_parts['extension'] === 'php') {
            $dirArray = array_reverse(explode('/', $path_parts['dirname']));
            $dirName = $dirArray[0];
            $className = 'plugin_' . $dirName . '_gold_class';
            if (class_exists($className, false)) {
                $this->unchanged++;
                $info = $className::getInfo();
                //print_a($info);
                // var_dump(e107::isInstalled($dirName));
                $qry = "SELECT * from #gold_system_plugins WHERE gold_plug_name ='" . $info['gold_plug_name'] .
                    "'";
                if (e107::getDB()->gen($qry, false)) {
                    // the record exists check if any fields have changed
                    $row = e107::getDB()->fetch('assoc');
                    //    print_a($row);
                    //    print_a($info);
                    $pluginstalled = (e107::isInstalled($info['gold_plug_name']) ? 1 : 0);

                    if (trim($info['gold_plug_version']) !== trim($row['gold_plug_version']) || trim
                        ($info['gold_plug_author']) !== trim($row['gold_plug_author']) || trim($path_parts['dirname'])
                        !== trim($row['gold_plug_path']) || trim($pluginstalled) != trim($row['gold_plug_installed']) ||
                        trim($info['gold_plug_depends']) !== trim($row['gold_plug_depends'])) {
                        $qry = "UPDATE #gold_system_plugins SET
                            gold_plug_version = '" . $info['gold_plug_version'] .
                            "', 
                            gold_plug_author = '" . $info['gold_plug_author'] .
                            "', 
                            gold_plug_path = '" . $path_parts['dirname'] . "',
                            gold_plug_installed = '" . $pluginstalled . "',
                            gold_plug_depends = '" . $info['gold_plug_depends'] .
                            "' WHERE
                            gold_plug_name = '" . $info['gold_plug_name'] . "'";
                        if (e107::getDB()->gen($qry, true)) {
                            $this->updated++;
                            $this->message->addSuccess("Updated " . $info['gold_plug_name']);
                        } else {
                            $this->message->addError("Unable to update " . $info['gold_plug_name']);
                        }
                    }

                } else {
                    $qry = "INSERT INTO #gold_system_plugins 
                    (gold_plug_name,
                    gold_plug_version,
                    gold_plug_author,
                    gold_plug_path,
                    gold_plug_installed,
                    gold_plug_depends) VALUES (
                    '" . $info['gold_plug_name'] . "',
                    '" . $info['gold_plug_version'] . "',
                    '" . $info['gold_plug_author'] . "',
                    '" . $path_parts['dirname'] . "',
                    '" . $pluginstalled . "',
                    '" . $info['gold_plug_depends'] . "') 
                    ";
                    if (e107::getDB()->gen($qry, true)) {
                        $this->inserted++;
                        $this->message->addSuccess("Added " . $info['gold_plug_name']);
                    } else {
                        $this->message->addError("Unable to add " . $info['gold_plug_name']);
                    }
                }


            }
        }
    }
}

class gold_system_plugins_scanGold_form_ui extends e_admin_form_ui
{

    function __construct()
    {


    }

}


//scan
new gold_system_admin();
require_once (e_ADMIN . "auth.php");
e107::getAdminUI()->runPage(); // Send page content
require_once (e_ADMIN . "footer.php");

/**
 *
 */
function e_help()
{
    // $helpArray = e_version::genUpdate('weewx');
    //  return $helpArray;
}
