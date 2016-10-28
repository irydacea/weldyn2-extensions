<?php
/**
 *
 * phpBB Navbar Rules Link extension for Wesnoth.org
 *
 * @copyright (c) 2016 Ignacio R. Morelle
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace wesnoth\ruleslink\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class main_listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header'	=> 'add_page_header_link',
		);
	}

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpEx */
	protected $php_ext;

	/**
	 * Constructor
	 *
	 * @param \phpbb\controller\helper	$helper		Controller helper object
	 * @param \phpbb\template\template	$template	Template object
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\user $user, $php_ext)
	{
		$this->config = $config;
		$this->helper = $helper;
		$this->template = $template;
		$this->user = $user;
		$this->php_ext = $php_ext;

		$this->user->add_lang_ext('wesnoth/ruleslink', 'ruleslink');
	}

	/**
	 * Adds the rules link to the navbar
	 */
	public function add_page_header_link()
	{
		$this->template->assign_vars(array(
			'U_RULESLINK_URL'		=> append_sid(generate_board_url() . '/viewtopic.' . $this->php_ext . '?t=' . (int)$this->config['ruleslink_topic_id']),
		));
	}
}
