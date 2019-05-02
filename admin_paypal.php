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
require_once("../../class2.php");
if (!defined('e107_INIT'))
{
    exit;
}
if (!getperms("P"))
{
    header("location:" . e_HTTP . "index.php");
    exit;
}
require_once(e_ADMIN . "auth.php");
if (!defined('ADMIN_WIDTH'))
{
    define(ADMIN_WIDTH, "width:100%;");
}
include_lan(e_PLUGIN . 'gold_system/languages/' . e_LANGUAGE . '_admin_gold_system.php');

if (isset($_POST['updatesettings']))
{
    $GOLD_PREF['buy_gold_account'] = $_POST['buy_gold_account'];
    $GOLD_PREF['buy_gold_notify_url'] = $_POST['buy_gold_notify_url'];
    $GOLD_PREF['buy_gold_return_url'] = $_POST['buy_gold_return_url'];
    $GOLD_PREF['buy_gold_cancel_url'] = $_POST['buy_gold_cancel_url'];
    $GOLD_PREF['buy_gold_currency'] = $_POST['buy_gold_currency'];
    $GOLD_PREF['buy_gold_item_name'] = $_POST['buy_gold_item_name'];
    $GOLD_PREF['buy_gold_cost'] = $_POST['buy_gold_cost'];
    $GOLD_PREF['buy_gold_perunit'] = $_POST['buy_gold_perunit'];
    $gold_obj->save_prefs();
    $gold_msg = LAN_PLUGIN_GOLD_SYS__PP09;
}
$selected = " selected='selected'";
switch ($GOLD_PREF['buy_gold_currency'])
{
    case "AUD":
        $aud = $selected;
        break;
    case "CAD":
        $cad = $selected;
        break;
    case "CHF":
        $chf = $selected;
        break;
    case "CZK":
        $czk = $selected;
        break;
    case "DKK":
        $dkk = $selected;
        break;
    case "EUR":
        $eur = $selected;
        break;
    case "GBP":
        $gbp = $selected;
        break;
    case "HKD":
        $hkd = $selected;
        break;
    case "HUF":
        $huf = $selected;
        break;
    case "JPY":
        $jpy = $selected;
        break;
    case "NOK":
        $nok = $selected;
        break;
    case "NZD":
        $nzd = $selected;
        break;
    case "PLN":
        $pln = $selected;
        break;
    case "SEK":
        $sek = $selected;
        break;
    case "SGD":
        $sgd = $selected;
        break;
    case "USD":
        $usd = $selected;
        break;
    case "ILS":
        $ils = $selected;
        break;
    case "MXN":
        $mxn = $selected;
        break;
}
$gold_text = "
<form method='post' id='gold_paypal' action='" . e_SELF . "' >
	<table class='fborder' style='" . ADMIN_WIDTH . "'>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>" . LAN_PLUGIN_GOLD_SYS__PP01 . "</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2' style='text-align:left'><b>" . $gold_msg . "</b>&nbsp;</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%'>" . LAN_PLUGIN_GOLD_SYS__PP02 . "</td>
			<td class='forumheader3' style='width:70%'>
				<input type='text' class='tbox' name='buy_gold_account' size='35' value='" . $GOLD_PREF['buy_gold_account'] . "' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%'>" . LAN_PLUGIN_GOLD_SYS__PP03 . "</td>
			<td class='forumheader3' style='width:70%'>
				<input type='text' class='tbox' name='buy_gold_notify_url' size='35' value='" . $GOLD_PREF['buy_gold_notify_url'] . "' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%'>" . LAN_PLUGIN_GOLD_SYS__PP04 . "</td>
			<td class='forumheader3' style='width:70%'>
				<input type='text' class='tbox' name='buy_gold_return_url' size='35' value='" . $GOLD_PREF['buy_gold_return_url'] . "' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%'>" . LAN_PLUGIN_GOLD_SYS__PP05 . "</td>
			<td class='forumheader3' style='width:70%'>
				<input type='text' class='tbox' name='buy_gold_cancel_url' size='35' value='" . $GOLD_PREF['buy_gold_cancel_url'] . "' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%'>" . LAN_PLUGIN_GOLD_SYS__PP06 . "</td>
			<td class='forumheader3' style='width:70%'>
				<select name='buy_gold_currency' class='tbox' >
					<option value='AUD'" . $aud . ">".LAN_PLUGIN_GOLD_SYS__PP11."</option>
					<option value='CAD'" . $cad . ">".LAN_PLUGIN_GOLD_SYS__PP12."</option>
					<option value='CHF'" . $chf . ">".LAN_PLUGIN_GOLD_SYS__PP13."</option>
					<option value='CZK'" . $czk . ">".LAN_PLUGIN_GOLD_SYS__PP14."</option>
					<option value='DKK'" . $dkk . ">".LAN_PLUGIN_GOLD_SYS__PP15."</option>
					<option value='EUR'" . $eur . ">".LAN_PLUGIN_GOLD_SYS__PP16."</option>
					<option value='GBP'" . $gbp . ">".LAN_PLUGIN_GOLD_SYS__PP17."</option>
					<option value='HKD'" . $hkd . ">".LAN_PLUGIN_GOLD_SYS__PP18."</option>
					<option value='HUF'" . $huf . ">".LAN_PLUGIN_GOLD_SYS__PP19."</option>
					<option value='JPY'" . $jpy . ">".LAN_PLUGIN_GOLD_SYS__PP20."</option>
					<option value='NOK'" . $nok . ">".LAN_PLUGIN_GOLD_SYS__PP21."</option>
					<option value='NZD'" . $nzd . ">".LAN_PLUGIN_GOLD_SYS__PP22."</option>
					<option value='PLN'" . $pln . ">".LAN_PLUGIN_GOLD_SYS__PP23."</option>
					<option value='SEK'" . $sek . ">".LAN_PLUGIN_GOLD_SYS__PP24."</option>
					<option value='SGD'" . $sgd . ">".LAN_PLUGIN_GOLD_SYS__PP25."</option>
					<option value='USD'" . $usd . ">".LAN_PLUGIN_GOLD_SYS__PP26."</option>
					<option value='ILS'" . $ils . ">".LAN_PLUGIN_GOLD_SYS__PP27."</option>
					<option value='MXN'" . $mxn . ">".LAN_PLUGIN_GOLD_SYS__PP28."</option>
				</select>
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%'>" . LAN_PLUGIN_GOLD_SYS__PP07 . "</td>
			<td class='forumheader3' style='width:70%'>
				<input type='text' class='tbox' name='buy_gold_item_name' value='" . $GOLD_PREF['buy_gold_item_name'] . "' />
			</td>
		</tr>
				<tr>
			<td class='forumheader3' style='width:30%'>" . LAN_PLUGIN_GOLD_SYS__PP08 . "</td>
			<td class='forumheader3' style='width:70%'>
				<input type='text' class='tbox' name='buy_gold_cost' value='" . $GOLD_PREF['buy_gold_cost'] . "' />
			</td>
		</tr>
		<tr>
			<td class='forumheader3' style='width:30%'>" . LAN_PLUGIN_GOLD_SYS__PP10 . "</td>
			<td class='forumheader3' style='width:70%'>
				<input type='text' class='tbox' name='buy_gold_perunit' value='" . $GOLD_PREF['buy_gold_perunit'] . "' />
			</td>
		</tr>
		<tr>
			<td class='forumheader2' colspan='2' style='text-align:left'>
				<input type='submit' class='button' name='updatesettings' value='" . LAN_PLUGIN_GOLD_SYS__18 . "' />
			</td>
		</tr>
		<tr>
			<td class='fcaption' colspan='2' style='text-align:left'>&nbsp;</td>
		</tr>
	</table>
</form>
	";

$ns->tablerender(LAN_PLUGIN_GOLD_SYS_, $gold_text);
require_once(e_ADMIN . "footer.php");
