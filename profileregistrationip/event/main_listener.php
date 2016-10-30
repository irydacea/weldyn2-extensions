<?php
/**
 *
 * phpBB Profile Registration IP extension for Wesnoth.org
 *
 * @copyright (c) 2016 Ignacio R. Morelle
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace wesnoth\profileregistrationip\event;

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

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/**
	 * Constructor
	 *
	 * @param \phpbb\controller\helper	$helper		Controller helper object
	 * @param \phpbb\template\template	$template	Template object
	 */
	public function __construct(\phpbb\template\template $template, \phpbb\user $user, \phpbb\auth\auth $auth)
	{
		$this->template = $template;
		$this->user = $user;
		$this->auth = $auth;

		$this->user->add_lang_ext('wesnoth/profileregistrationip', 'profileregistrationip');
	}

	/**
	 * Adds the profile registration IP to template variables if applicable.
	 */
	public function update_profile_vars($event)
	{
		$can_see_ip = $this->auth->acl_get('a_user');
		$user_ip = $event['member']['user_ip'];

		$this->template->assign_vars(array(
			'S_USER_IP'			=> ($can_see_ip ? true : false),
			'REGISTERED_IP'		=> ($can_see_ip && !empty($user_ip) ? $user_ip : '-'),
		));
	}
}
