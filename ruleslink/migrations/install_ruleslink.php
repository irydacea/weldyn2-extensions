<?php
/**
 *
 * phpBB Navbar Rules Link extension for Wesnoth.org
 *
 * @copyright (c) 2016 Ignacio R. Morelle
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace wesnoth\ruleslink\migrations;

class install_ruleslink extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['ruleslink_topic_id']);
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v314');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('ruleslink_topic_id', 0)),

			array('module.add', array(
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_RULESLINK'
			)),

			array('module.add', array(
				'acp',
				'ACP_RULESLINK',
				array(
					'module_basename'	=> '\wesnoth\ruleslink\acp\ruleslink_module',
					'modes'				=> array('settings'),
				),
			)),
		);
	}
}
