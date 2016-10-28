<?php
/**
 *
 * phpBB Navbar Rules Link extension for Wesnoth.org
 *
 * @copyright (c) 2016 Ignacio R. Morelle
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace wesnoth\ruleslink\acp;

class ruleslink_info
{
	function module()
	{
		return array(
			'filename'	=> '\wesnoth\ruleslink\acp\ruleslink_module',
			'title'	=> 'ACP_RULESLINK_SETTINGS',
			'version'	=> '0.0.1-dev',
			'modes'	=> array(
				'settings'	=> array('title' => 'ACP_RULESLINK_SETTINGS', 'auth' => 'ext_wesnoth/ruleslink && acl_a_board', 'cat' => array('ACP_RULESLINK_SETTINGS')),
			),
		);
	}
}
