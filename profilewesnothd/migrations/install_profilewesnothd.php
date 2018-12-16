<?php
/**
 *
 * phpBB Navbar Rules Link extension for Wesnoth.org
 *
 * @copyright (c) 2016 - 2018 Iris Morelle
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace wesnoth\profilewesnothd\migrations;

class install_profilewesnothd extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['profilewesnothd_tblname']);
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v314');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('profilewesnothd_tblname', 'wesnothd_extra_data')),

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_PROFILEWESNOTHD'
			)),

			array('module.add', array(
				'acp',
				'ACP_PROFILEWESNOTHD',
				array(
					'module_basename'	=> '\wesnoth\profilewesnothd\acp\profilewesnothd_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}
