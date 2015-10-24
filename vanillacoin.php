<?php
	class Vanillacoin {
		protected $rpc_host;
		protected $rpc_port;
		protected $rpc_user;
		protected $rpc_pass;

		public function __construct($rpc_host, $rpc_port) {
			$this->rpc_host = $rpc_host;
			$this->rpc_port = $rpc_port;
			$this->rpc_user = 'user';
			$this->rpc_pass = '';
			$this->id = 1;
		}

		private function query($method,$params = array('')) {
			$params = array_values($params);
			
			$request = json_encode(array(
							'method' => strtolower($method),
							'params' => $params,
							'id' => $this->id
							));

			$curl = curl_init();     
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
			curl_setopt($curl, CURLOPT_HTTPHEADER, Array("Content-type: application/json"));
			curl_setopt($curl, CURLOPT_URL, $this->rpc_host.":".$this->rpc_port);  
			curl_setopt($curl, CURLOPT_USERPWD, $this->rpc_user.":".$this->rpc_pass);
			curl_setopt($curl, CURLOPT_POST, TRUE);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
			$response_json = curl_exec($curl);
			curl_close($curl);

			if (!$response_json) {
				throw new Exception('Unable to connect to '.$this->rpc_host, 0);
			}
			$response = json_decode($response_json,true);

			if ($response['id'] != $this->id) {
				throw new Exception('Incorrect response id (request id: '.$this->id.', response id: '.$response['id'].')',1);
			}
			if (!empty($response['error'])) {
				throw new Exception('Request error: '.print_r($response['error'],1),2);
			}
			$this->id++;
			
			return $response_json;
		}


		// backupwallet
		public function backupwallet() {
			return $this->query('backupwallet', array());
		}

		// checkwallet
		public function checkwallet() {
			return $this->query('checkwallet', array());
		}

		// databasefind
		public function databasefind($dbFind) {
			return $this->query('databasefind', array($dbFind));
		}

		// databasestore
		public function databasestore($dbStore) {
			return $this->query('databasestore', array($dbStore));
		}

		// dumpprivkey
		public function dumpprivkey($address) {
			return $this->query('dumpprivkey', array($address));
		}

		// encryptwallet
		public function encryptwallet($password) {
			return $this->query('encryptwallet', array($password));
		}

		// getaccount
		public function getaccount($address) {
			return $this->query('getaccount', array($address));
		}

		// getaccountaddress
		public function getaccountaddress($account) {
			return $this->query('getaccountaddress', array($account));
		}

		// getbalance
		public function getbalance() {
			return $this->query('getbalance', array());
		}

		// getblock
		public function getblock($hash) {
			return $this->query('getblock', array($hash));
		}

		// getblockcount
		public function getblockcount() {
			return $this->query('getblockcount', array());
		}

		// getblockhash
		public function getblockhash($height) {
			return $this->query('getblockhash', array($height));
		}
		
		// getblocktemplate
		public function getblocktemplate() {
			return $this->query('getblocktemplate', array());
		}

		// getdifficulty
		public function getdifficulty() {
			return $this->query('getdifficulty', array());
		}

		// getincentiveinfo
		public function getincentiveinfo() {
			return $this->query('getincentiveinfo', array());
		}

		// getinfo
		public function getinfo() {
			return $this->query('getinfo', array());
		}

		// getmininginfo
		public function getmininginfo() {
			return $this->query('getmininginfo', array());
		}

		// getnetworkhashps
		public function getnetworkhashps() {
			return $this->query('getnetworkhashps', array());
		}

		// getnewaddress
		public function getnewaddress() {
			return $this->query('getnewaddress', array($account));
		}

		// getpeerinfo
		public function getpeerinfo() {
			return $this->query('getpeerinfo', array());
		}

		// getrawtransaction
		public function getrawtransaction ($txid) {
			return $this->query('getrawtransaction', array($txid));
		}

		// gettransaction
		public function gettransaction ($txid) {
			return $this->query('gettransaction', array($txid));
		}

		// importprivkey
		public function importprivkey($privkey) {
			return $this->query('importprivkey', array($privkey));
		}
		
		// listreceivedbyaccount
		public function listreceivedbyaccount($minconf, $empty) {
			return $this->query('listreceivedbyaccount', array($minconf, $empty));
		}

		// listreceivedbyaddress
		public function listreceivedbyaddress($minconf, $empty) {
			return $this->query('listreceivedbyaddress', array($minconf, $empty));
		}

		// listsinceblock
		public function listsinceblock($hash) {
			return $this->query('listsinceblock', array($hash));
		}

		// listtransactions
		public function listtransactions() {
			return $this->query('listtransactions', array());
		}

		// repairwallet
		public function repairwallet() {
			return $this->query('repairwallet', array());
		}

		// sendmany
		public function sendmany($to, $account = '') {
			return $this->query('sendmany', array($account, $to));
		}

		// sendtoaddress
		public function sendtoaddress($address, $amount) {
			return $this->query('sendtoaddress', array($address, $amount));
		}

		// settxfee
		public function settxfee($txfee) {
			return $this->query('settxfee', array($txfee));
		}

		// submitblock
		public function submitblock($block) {
			return $this->query('submitblock', array($block));
		}

		// validateaddress
		public function validateaddress($address) {
			return $this->query('validateaddress', array($address));
		}

		// walletlock
		public function walletlock() {
			return $this->query('walletlock', array());
		}

		// walletpassphrase
		public function walletpassphrase($password) {
			return $this->query('walletpassphrase', array($password));
		}

		// walletpassphrasechange
		public function walletpassphrasechange($password, $newpassword) {
			return $this->query('walletpassphrasechange', array($password, $newpassword));
		}
	}
?>
