<?php
/**
 * Fuel is a fast, lightweight, community driven PHP 5.4+ framework.
 *
 * @package    Fuel
 * @version    1.8.2
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2019 Fuel Development Team
 * @link       https://fuelphp.com
 */

namespace Email;

class Email_Driver_Mailgun extends \Email_Driver
{
	protected function _send()
	{
		$this->type = 'html';

		$message = $this->build_message();

		$mg = \Mailgun\Mailgun::create($this->config['mailgun']['key']);

		// Mailgun does not consider these "arbitrary headers"
		$exclude = array('From'=>'From', 'To'=>'To', 'Cc'=>'Cc', 'Bcc'=>'Bcc', 'Subject'=>'Subject', 'Content-Type'=>'Content-Type', 'Content-Transfer-Encoding' => 'Content-Transfer-Encoding');
		$headers = array_diff_key($this->headers, $exclude);

		foreach ($this->extra_headers as $header => $value)
		{
			$headers[$header] = $value;
		}

		// Standard required fields
		$post_data = array(
			'from'    => static::format_addresses(array(array('email' => $this->config['from']['email'], 'name' => $this->config['from']['name']))),
			'to'      => static::format_addresses($this->to),
			'subject' => $this->subject,
			'html'    => $message['body'],
			'attachment' => array(),
			'inline' => array()
		);

		// Optionally cc, bcc and alt_body
		$this->cc and $post_data['cc'] = static::format_addresses($this->cc);
		$this->bcc and $post_data['bcc'] = static::format_addresses($this->bcc);
		$this->alt_body and $post_data['text'] = $this->alt_body;

		// Mailgun's "arbitrary headers" are h: prefixed
		foreach ($headers as $name => $value)
		{
			$post_data["h:{$name}"] = $value;
		}

		foreach ($this->attachments['attachment'] as $cid => $file)
		{
			$post_data['attachment'][] = array('filePath' => $file['file'][0], 'remoteName' => $file['file'][1]);
		}

		foreach ($this->attachments['inline'] as $cid => $file)
		{
			$post_data['inline'][] = array('filePath' => $file['file'][0], 'remoteName' => substr($cid, 4));
		}

		// And send the message out
		$mg->messages()->send($this->config['mailgun']['domain'], $post_data);

		return true;
	}
}
