<?php

	namespace App;

	use \App\Config;

	class Token
	{
		public $token;

		public function __construct($token=null)
		{
			if(is_null($token))
			{
				$this->token=bin2hex(openssl_random_pseudo_bytes(16));
			}
			else
			{
				$this->token=$token;
			}
		}

		// RETURNING THE TOKEN

		public function getToken()
		{
			return $this->token;
		}

		// RETURNING THE ENCRYPTED TOKEN

		public function getHash()
		{
			return hash_hmac('sha256', $this->token, Config::SECRET_KEY);
		}
	}

?>