<?php
/**
 *
 * phpBB Registration Age extension for Wesnoth.org
 *
 * @copyright (c) 2016 - 2018 Iris Morelle
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace wesnoth\registrationage\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class main_listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array('core.ucp_register_agreement'	=> 'update_agreement_template_vars');
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

		$this->user->add_lang_ext('wesnoth/registrationage', 'registrationage');
	}

	/**
	 * Updates template variables.
	 *
	 * @param \phpbb\event\data	$event	Event object
	 */
	public function update_agreement_template_vars($event)
	{
		$this->template->append_var('L_TERMS_OF_USE', '<br /><br />' . $this->user->lang('REGISTRATIONAGE_WARNING'));
	}
}
