<?php
/**
 *
 * phpBB Wesmere style integration extension for Wesnoth.org
 *
 * @copyright (c) 2017 - 2018 Iris Morelle
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace wesnoth\wesmere\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class main_listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array();
	}

	/** @var \phpbb\controller\helper */
	protected $helper;

	/** @var \phpbb\template\template */
	protected $template;

	protected $user;

	protected $config;

	/**
	 * Constructor
	 *
	 * @param \phpbb\controller\helper	$helper		Controller helper object
	 * @param \phpbb\template\template	$template	Template object
	 */
	public function __construct(\phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\user $user)
	{
		$this->helper = $helper;
		$this->template = $template;
		$this->user = $user;

		$this->user->add_lang_ext('wesnoth/wesmere', 'wesmere');
	}
}
