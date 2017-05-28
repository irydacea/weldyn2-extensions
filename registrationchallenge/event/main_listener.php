<?php
/**
 *
 * phpBB Account Registration Challenge extension for Wesnoth.org
 *
 * @copyright (c) 2017 Ignacio R. Morelle
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace wesnoth\registrationchallenge\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class main_listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.ucp_register_data_before'			=> 'registration_challenge_setup',
			'core.ucp_register_data_after'			=> 'registration_challenge_validate',
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
	 */
	public function __construct(\phpbb\template\template $template,
								\phpbb\user $user,
								\phpbb\request\request $request)
	{
		$this->template = $template;
		$this->user = $user;
		$this->request = $request;
	}

	/**
	 * Sets up the registration challenge field
	 *
	 * @param object $event The event object
	 */
	public function registration_challenge_setup($event)
	{
		$event['data'] = array_merge($event['data'], array(
			'wo_regchallenge'		=> $this->request->variable('wo_confirm', '', true),
		));

		$this->user->add_lang_ext('wesnoth/registrationchallenge', 'registrationchallenge');

		$this->template->assign_vars(array(
			'REGISTRATION_CHALLENGE_ANSWER'		=> $event['data']['wo_regchallenge'],
		));
	}

	/**
	 * Validates registration challenge data
	 *
	 * @param object $event The event object
	 */
	public function registration_challenge_validate($event)
	{
		if (!$event['submit']) {
			return;
		}

		$challenge_answer = utf8_substr(html_entity_decode($event['data']['username']), 0, 3) .
							utf8_substr(html_entity_decode($event['data']['email']), 0, 3);

		if (html_entity_decode($event['data']['wo_regchallenge'] != $challenge_answer))
		{
			$error_array = $event['error'];
			$error_array[] = $this->user->lang('REGISTRATION_CHALLENGE_FAILED');
			$event['error'] = $error_array;
		}
	}
}
