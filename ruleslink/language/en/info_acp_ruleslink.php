<?php
/**
 *
 * phpBB Navbar Rules Link extension for Wesnoth.org
 *
 * @copyright (c) 2016 - 2018 Iris Morelle
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters for use
// ’ » “ ” …

$lang = array_merge($lang, array(
	'ACP_RULESLINK'						=> 'Board rules link',
	'ACP_RULESLINK_SETTINGS'			=> 'Rules link settings',
	'ACP_RULESLINK_TOPIC_ID'			=> 'Rules topic number',
	'ACP_RULESLINK_TOPIC_ID_EXPLAIN'	=> 'Sets the topic number containing the board rules.',
	'ACP_RULESLINK_SETTINGS_SUCCESS'	=> 'The settings were successfully saved.',
));
