<?php
/**
 *
 * phpBB Wesnoth MP Profile Info extension for Wesnoth.org
 *
 * @copyright (c) 2018 Iris Morelle
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace wesnoth\profilewesnothd\acp;

class profilewesnothd_info
{
	function module()
	{
		return array(
			'filename'	=> '\wesnoth\profilewesnothd\acp\profilewesnothd_module',
			'title'	=> 'ACP_PROFILEWESNOTHD_SETTINGS',
			'version'	=> '0.0.1-dev',
			'modes'	=> array(
				'settings'	=> array('title' => 'ACP_PROFILEWESNOTHD_SETTINGS', 'auth' => 'ext_wesnoth/profilewesnothd && acl_a_board', 'cat' => array('ACP_PROFILEWESNOTHD_SETTINGS')),
			),
		);
	}
}
