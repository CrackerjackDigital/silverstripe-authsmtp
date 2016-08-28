<?php

/**
 *  Email queuing extension for Email
 */
class AuthSMTPQueueEmail extends Email {

	public function queueOrSend($templateData = null, $attachmentArray = null) {
		$queue = AuthSMTPConfig::config()->get('queue');
		if (!$queue) {
			$this->send();
		}
		$templateData = serialize($templateData);
		AuthSMTPQueueModel::addMessage(
			$this->To(),
			$this->Subject(),
			$this->Body(),
			$this->getTemplate(),
			$templateData,
			$attachmentArray,
			$this->customHeaders
		);

		return true;
	}

}