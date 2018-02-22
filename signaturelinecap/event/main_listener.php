<?php
/**
 *
 * phpBB Signature Line Cap extension for Wesnoth.org
 *
 * @copyright (c) 2016 - 2018 Iris Morelle
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace wesnoth\signaturelinecap\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class main_listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.message_parser_check_message'	=> 'check_signature_line_count',
			'core.acp_board_config_edit_add'	=> 'ext_acp_board_config',
		);
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
	public function __construct(\phpbb\controller\helper $helper, \phpbb\template\template $template, \phpbb\user $user, \phpbb\config\config $config)
	{
		$this->helper = $helper;
		$this->template = $template;
		$this->user = $user;
		$this->config = $config;

		$this->user->add_lang_ext('wesnoth/signaturelinecap', 'signaturelinecap');
	}

	/**
	 * Adds an option under ACP Signature Settings for setting the signature line cap.
	 */
	public function ext_acp_board_config($event)
	{
		if ($event['mode'] != 'signature')
		{
			return;
		}

		$display_vars = $event['display_vars'];
		$old_cfg = $display_vars['vars'];
		$cfg = array();

		foreach ($old_cfg as $cfg_id => $data)
		{
			$cfg[$cfg_id] = $data;

			if ($cfg_id == 'max_sig_chars')
			{
				$cfg['max_sig_lines'] = array(
					'lang'			=> 'SIGNATURELINECAP_MAX_SIG_LINES',
					'validate'		=> 'int:0:9999',
					'type'			=> 'number:0:9999',
					'explain'		=> true,
				);
			}
		}

		$display_vars['vars'] = $cfg;
		$event['display_vars'] = $display_vars;
	}

	/**
	* Verifies a signature against the line cap on submit.
	*
	* @param \phpbb\event\data	$event	Event object
	*/
	public function check_signature_line_count($event)
	{
		if ($event['mode'] !== 'sig')
		{
			return;
		}

		$max_sig_line_count = (int)$this->config['max_sig_lines'];

		if ($max_sig_line_count == 0)
		{
			return;
		}

		$sig_line_count = substr_count($event['message'], "\n") + 1;

		if ($sig_line_count > $max_sig_line_count)
		{
			$warn_msg = $event['warn_msg'];
			$warn_msg[] = $this->user->lang('SIGNATURELINECAP_TOO_MANY_LINES', $sig_line_count, $max_sig_line_count);
			$event['warn_msg'] = $warn_msg;
		}
	}
}
