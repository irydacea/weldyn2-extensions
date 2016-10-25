<?php
/**
 *
 * phpBB Signature Line Cap extension for Wesnoth.org
 *
 * @copyright (c) 2016 Ignacio R. Morelle
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace wesnoth\signaturelinecap\migrations;

class install_signaturelinecap extends \phpbb\db\migration\migration
{
	public function effectively_installed()
	{
		return isset($this->config['signaturelinecap_max_line_count']);
	}

	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v31x\v314');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('signaturelinecap_max_line_count', 0)),
		);
	}
}
