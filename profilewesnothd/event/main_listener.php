<?php
/**
 *
 * phpBB Wesnoth MP Profile Info extension for Wesnoth.org
 *
 * @copyright (c) 2018 Iris Morelle
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace wesnoth\profilewesnothd\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class main_listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.memberlist_view_profile'			=> 'update_profile_vars',
		);
	}

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config				$config		Board config object
	 * @param \phpbb\template\template			$template	Template object
	 * @param \phpbb\user						$user		User object
	 * @param \phpbb\auth						$auth		Auth object
	 * @param \phpbb\db\driver\driver_interface	$db			Database driver
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\template\template $template, \phpbb\user $user, \phpbb\auth\auth $auth, \phpbb\db\driver\driver_interface $db)
	{
		$this->config = $config;
		$this->template = $template;
		$this->user = $user;
		$this->auth = $auth;
		$this->db = $db;

		$this->user->add_lang_ext('wesnoth/profilewesnothd', 'profilewesnothd');
	}

	/**
	 * Adds the profile registration IP to template variables if applicable.
	 */
	public function update_profile_vars($event)
	{
		if ($event['member']['user_allow_viewonline'] || $this->auth->acl_get('u_viewonline'))
		{
			$wesnothd_tblname = $this->config['profilewesnothd_tblname'];
			$username = $event['member']['username'];

			$sql = 'SELECT user_lastvisit FROM ' . $this->db->sql_escape($wesnothd_tblname) . ' ' .
			       "WHERE username = '" . $this->db->sql_escape(utf8_clean_string($username)) . "'";
			$result = $this->db->sql_query($sql);
			$last_mp_join = (int)$this->db->sql_fetchfield('user_lastvisit');
			$this->db->sql_freeresult($result);
		}
		else
		{
			$last_mp_join = '';
		}

		$this->template->assign_vars(array(
			'PROFILEWESNOTHD_LASTLOGIN'	=> (empty($last_mp_join)) ? ' - ' : $this->user->format_date($last_mp_join),
		));
	}
}
