<?php
    class Vanillacoin {
        protected $rpc_host;
        protected $rpc_port;
        protected $rpc_user;
        protected $rpc_pass;

        public function __construct($rpc_host = '127.0.0.1', $rpc_port = '9195', $rpc_user = 'user', $rpc_pass = '') {
            $this->rpc_host = $rpc_host;
            $this->rpc_port = $rpc_port;
            $this->rpc_user = $rpc_user;
            $this->rpc_pass = $rpc_pass;
        }
    
        private function query($id, $method, $params = array('')) {
            $params = array_values($params);
            
            $request = json_encode(array(
                            'method' => strtolower($method),
                            'params' => $params,
                            'id' => $id
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

            if ($response['id'] != $id) {
                throw new Exception('Incorrect response id (request id: '.$id.', response id: '.$response['id'].')',1);
            }
            if (!empty($response['error'])) {
                throw new Exception('Request error: '.print_r($response['error'],1),2);
            }
            
            return $response_json;
        }


        // backupwallet
        public function backupwallet($id = 1) {
            return $this->query($id, 'backupwallet', array());
        }

        // checkwallet
        public function checkwallet($id = 1) {
            return $this->query($id, 'checkwallet', array());
        }

        // databasefind
        public function databasefind($dbFind, $id = 1) {
            return $this->query($id, 'databasefind', array($dbFind));
        }

        // databasestore
        public function databasestore($dbStore, $id = 1) {
            return $this->query($id, 'databasestore', array($dbStore));
        }

        // dumpprivkey
        public function dumpprivkey($address, $id = 1) {
            return $this->query($id, 'dumpprivkey', array($address));
        }

        // encryptwallet
        public function encryptwallet($password, $id = 1) {
            return $this->query($id, 'encryptwallet', array($password));
        }

        // getaccount
        public function getaccount($address, $id = 1) {
            return $this->query($id, 'getaccount', array($address));
        }

        // getaccountaddress
        public function getaccountaddress($account, $id = 1) {
            return $this->query($id, 'getaccountaddress', array($account));
        }

        // getbalance
        public function getbalance($id = 1) {
            return $this->query($id, 'getbalance', array());
        }

        // getblock
        public function getblock($hash, $id = 1) {
            return $this->query($id, 'getblock', array($hash));
        }

        // getblockcount
        public function getblockcount($id = 1) {
            return $this->query($id, 'getblockcount', array());
        }

        // getblockhash
        public function getblockhash($height, $id = 1) {
            return $this->query($id, 'getblockhash', array($height));
        }
        
        // getblocktemplate
        public function getblocktemplate($id = 1) {
            return $this->query($id, 'getblocktemplate', array());
        }

        // getdifficulty
        public function getdifficulty($id = 1) {
            return $this->query($id, 'getdifficulty', array());
        }

        // getincentiveinfo
        public function getincentiveinfo($id = 1) {
            return $this->query($id, 'getincentiveinfo', array());
        }

        // getinfo
        public function getinfo($id = 1) {
            return $this->query($id, 'getinfo', array());
        }

        // getmininginfo
        public function getmininginfo($id = 1) {
            return $this->query($id, 'getmininginfo', array());
        }

        // getnetworkhashps
        public function getnetworkhashps($id = 1) {
            return $this->query($id, 'getnetworkhashps', array());
        }

        // getnewaddress
        public function getnewaddress($id = 1) {
            return $this->query($id, 'getnewaddress', array($account));
        }

        // getpeerinfo
        public function getpeerinfo($id = 1) {
            return $this->query($id, 'getpeerinfo', array());
        }

        // getrawtransaction
        public function getrawtransaction ($txid, $id = 1) {
            return $this->query($id, 'getrawtransaction', array($txid));
        }

        // gettransaction
        public function gettransaction ($txid, $id = 1) {
            return $this->query($id, 'gettransaction', array($txid));
        }

        // importprivkey
        public function importprivkey($privkey, $id = 1) {
            return $this->query($id, 'importprivkey', array($privkey));
        }
        
        // listreceivedbyaccount
        public function listreceivedbyaccount($minconf, $empty, $id = 1) {
            return $this->query($id, 'listreceivedbyaccount', array($minconf, $empty));
        }

        // listreceivedbyaddress
        public function listreceivedbyaddress($minconf, $empty, $id = 1) {
            return $this->query($id, 'listreceivedbyaddress', array($minconf, $empty));
        }

        // listsinceblock
        public function listsinceblock($hash, $id = 1) {
            return $this->query($id, 'listsinceblock', array($hash));
        }

        // listtransactions
        public function listtransactions($id = 1) {
            return $this->query($id, 'listtransactions', array());
        }

        // repairwallet
        public function repairwallet($id = 1) {
            return $this->query($id, 'repairwallet', array());
        }

        // sendmany
        public function sendmany($to, $account = '', $id = 1) {
            return $this->query($id, 'sendmany', array($account, $to));
        }

        // sendtoaddress
        public function sendtoaddress($address, $amount, $id = 1) {
            return $this->query($id, 'sendtoaddress', array($address, $amount));
        }

        // settxfee
        public function settxfee($txfee, $id = 1) {
            return $this->query($id, 'settxfee', array($txfee));
        }

        // submitblock
        public function submitblock($block, $id = 1) {
            return $this->query($id, 'submitblock', array($block));
        }

        // validateaddress
        public function validateaddress($address, $id = 1) {
            return $this->query($id, 'validateaddress', array($address));
        }

        // walletlock
        public function walletlock($id = 1) {
            return $this->query($id, 'walletlock', array());
        }

        // walletpassphrase
        public function walletpassphrase($password, $id = 1) {
            return $this->query($id, 'walletpassphrase', array($password));
        }

        // walletpassphrasechange
        public function walletpassphrasechange($password, $newpassword, $id = 1) {
            return $this->query($id, 'walletpassphrasechange', array($password, $newpassword));
        }
    }
?>
