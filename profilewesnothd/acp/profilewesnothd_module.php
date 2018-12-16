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

class profilewesnothd_module
{
	public	$u_action;

	function main($id, $mode)
	{
		global $db, $config, $request, $template, $user;
		global $phpbb_root_path, $phpbb_admin_path, $phpEx;

		$this->page_title = $user->lang['ACP_PROFILEWESNOTHD_SETTINGS'];
		$this->tpl_name = 'profilewesnothd_body';

		add_form_key('profilewesnothd');

		if ($request->is_set_post('submit'))
		{
			// Test if form key is valid
			if (!check_form_key('profilewesnothd'))
			{
				trigger_error($user->lang['FORM_INVALID'] . adm_back_link($this->u_action), E_USER_WARNING);
			}
			if (!function_exists('validate_data'))
			{
				include($phpbb_root_path . 'includes/functions_user.' . $phpEx);
			}

			$check_row = array('profilewesnothd_tblname' => $request->variable('profilewesnothd_tblname', '', true));
			$validate_row = array('profilewesnothd_tblname' => array('string', false, 1, 1000));
			$error = validate_data($check_row, $validate_row);

			// Replace "error" strings with their real, localised form
			$error = array_map(array($user, 'lang'), $error);

			if (!sizeof($error))
			{
				// Set the options the user configured
				$this->set_options();

				trigger_error($user->lang['ACP_PROFILEWESNOTHD_SETTINGS_SUCCESS'] . adm_back_link($this->u_action));
			}
		}

		$template->assign_vars(array(
			'ERROR'					=> isset($error) ? ((sizeof($error)) ? implode('<br />', $error) : '') : '',
			'PROFILEWESNOTHD_TABLE_NAME'	=> $config['profilewesnothd_tblname'],

			'U_ACTION'				=> $this->u_action,
		));
	}

	/**
	 * Set the options a user can configure
	 *
	 * @return null
	 * @access protected
	 */
	protected function set_options()
	{
		global $config, $request;

		$config->set('profilewesnothd_tblname', $request->variable('profilewesnothd_tblname', 'wesnothd_extra_data'));
	}
}

