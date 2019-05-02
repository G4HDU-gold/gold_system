<?php
/*
+---------------------------------------------------------------+
|        Gold System for e107 v7xx - by Father Barry
|			Based on the original by AznDevil
|        This module for the e107 .7+ website system
|        Copyright Barry Keal 2004-2008
|
|        Released under the terms and conditions of the
|        GNU General Public License (http://gnu.org).
|
+---------------------------------------------------------------+
*/
require_once('../../class2.php');
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms('P'))
{
    header('location:' . e_HTTP . 'index.php');
    exit;
}
require_once(e_ADMIN . 'auth.php');
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, 'width:100%;');
}
include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '_admin_gold_system.php');

if (isset($_POST['updatesettings']))
{
    $GOLD_PREF['shop_color'] = $tp->toDB($_POST['shop_color']);
    $GOLD_PREF['shop_customtitle'] = $tp->toDB($_POST['shop_customtitle']);
    $GOLD_PREF['shop_name'] = $tp->toDB($_POST['shop_name']);
    $GOLD_PREF['shop_signature'] = $tp->toDB($_POST['shop_signature']);
    $GOLD_PREF['shop_avatar'] = $tp->toDB($_POST['shop_avatar']);
    $gold_obj->save_prefs();

    if (!is_numeric($GOLD_PREF['shop_color']))
    {
        $gold_msg = LAN_PLUGIN_GOLD_SYS__S11;
    } elseif (!is_numeric($GOLD_PREF['shop_name']))
    {
        $gold_msg = LAN_PLUGIN_GOLD_SYS__S12;
    } elseif (!is_numeric($GOLD_PREF['shop_signature']))
    {
        $gold_msg = LAN_PLUGIN_GOLD_SYS__S03;
    } elseif (!is_numeric($GOLD_PREF['shop_avatar']))
    {
        $gold_msg = LAN_PLUGIN_GOLD_SYS__S01;
    }
    else
    {
        $gold_msg = LAN_PLUGIN_GOLD_SYS__S10;
    }
}

$gold_text = '
	<form method="post" action="' . e_SELF . '" id="gold_form" >
	<table class="fborder" style="' . ADMIN_WIDTH . '">
		<tr>
		<td class="fcaption" colspan="2" style="text-align:left">' . LAN_PLUGIN_GOLD_SYS__S09 . '</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2" style="text-align:left"><b>' . $gold_msg . '</b>&nbsp;</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . LAN_PLUGIN_GOLD_SYS__S04 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="shop_color" value="' . $GOLD_PREF['shop_color'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . LAN_PLUGIN_GOLD_SYS__S05 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="shop_customtitle" value="' . $GOLD_PREF['shop_customtitle'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . LAN_PLUGIN_GOLD_SYS__S06 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="shop_name" value="' . $GOLD_PREF['shop_name'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . LAN_PLUGIN_GOLD_SYS__S07 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="shop_signature" value="' . $GOLD_PREF['shop_signature'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader3" style="width:30%">' . LAN_PLUGIN_GOLD_SYS__S08 . '</td>
		<td class="forumheader3" style="width:70%">
			<input type="text" class="tbox" name="shop_avatar" value="' . $GOLD_PREF['shop_avatar'] . '" />
		</td>
	</tr>
	<tr>
		<td class="forumheader2" colspan="2" style="text-align:left">
			<input type="submit" class="button" name="updatesettings" value="' . LAN_PLUGIN_GOLD_SYS__18 . '" />
		</td>
	</tr>
	<tr>
		<td class="fcaption" colspan="2" style="text-align:left">&nbsp;</td>
	</tr>
	</table>
</form>';

$ns->tablerender(LAN_PLUGIN_GOLD_SYS_, $gold_text);
require_once(e_ADMIN . 'footer.php');
?>