<?php

namespace YiiFacebook;
use Yii;

class SFacebookRedirectLoginHelper extends \Facebook\FacebookRedirectLoginHelper
{
	/**
	 * @var string Prefix to use for session variables
	 */
	private $sessionPrefix = 'FBRLH_';

	/**
	 * Stores a state string in session storage for CSRF protection.
	 * Developers should subclass and override this method if they want to store
	 * this state in a different location.
	 *
	 * @param string $state
	 *
	 * @throws FacebookSDKException
	 */
	protected function storeState($state)
	{
		if ($this->checkForSessionStatus === true
			&& !Yii::app()->session) {
			throw new FacebookSDKException(
				'Session not active, could not store state.', 720
			);
		}
		Yii::app()->session[$this->sessionPrefix . 'state'] = $state;
	}

	/**
	 * Loads a state string from session storage for CSRF validation.  May return
	 * null if no object exists.  Developers should subclass and override this
	 * method if they want to load the state from a different location.
	 *
	 * @return string|null
	 *
	 * @throws FacebookSDKException
	 */
	protected function loadState()
	{
		if ($this->checkForSessionStatus === true
			&& !Yii::app()->session) {
			throw new FacebookSDKException(
				'Session not active, could not load state.', 721
			);
		}
		if (isset(Yii::app()->session[$this->sessionPrefix . 'state'])) {
			$this->state = Yii::app()->session[$this->sessionPrefix . 'state'];
			return $this->state;
		}
		return null;
	}
}