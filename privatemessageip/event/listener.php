<?php
/**
 *
 * phpBB Wesmere style integration extension for Wesnoth.org
 *
 * Based on RMcGirr83's Poster IP extension.
 *
 * @copyright (c) 2018 Iris Morelle, based on work by Rich McGirr (c) 2016
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace wesnoth\privatemessageip\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{
	protected $auth;
	protected $db;
	protected $template;

	static public function getSubscribedEvents()
	{
		return array('core.ucp_pm_view_message' => 'display_pm_ip');
	}

	/**
	 * Constructor
	 */
	public function __construct(\phpbb\auth\auth $auth)
	{
		$this->auth = $auth;
	}

	public function display_pm_ip($event)
	{
		if (!$this->auth->acl_gets('a_', 'm_'))
		{
			return;
		}

		$author_ip = $event['message_row']['author_ip'];
		$lookup_url = '';

		if (empty($author_ip))
		{
			$author_ip = '-';
		}
		else
		{
			$lookup_url = 'http://en.utrace.de/?query=' . $author_ip;
		}

		$event['msg_data'] = array_merge($event['msg_data'], array(
			'POSTER_IP_VISIBLE'	=> true,
			'POSTER_IP'			=> $author_ip,
			'POSTER_IP_WHOIS'	=> $lookup_url,
		));
	}
}
