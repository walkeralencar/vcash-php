<?php
/**
 * PHP RPC Client for v.cash
 * Based on https://github.com/xCoreDev/vanillacoin-php
 *
 * @author     xCoreDev <@xcoredev>
 * @author     Walker de Alencar <@walkeralencar>
 * @license    https://opensource.org/licenses/LGPL-3.0 LGPL 3.0
 * @link       https://github.com/walkeralencar/vcash-php
 * @version    0.1
 */

namespace Vcash;

/**
 * Class Rpc
 */
class Rpc
{
    /**
     * @var string
     */
    protected $rpc_host;
    /**
     * @var string
     */
    protected $rpc_port;
    /**
     * @var string
     */
    protected $rpc_user;
    /**
     * @var string
     */
    protected $rpc_pass;

    /**
     * Vcash constructor.
     * @param string $rpc_host
     * @param string $rpc_port
     * @param string $rpc_user
     * @param string $rpc_pass
     */
    public function __construct($rpc_host = '127.0.0.1', $rpc_port = '9195', $rpc_user = 'user',$rpc_pass = '')
    {
        $this->rpc_host = $rpc_host;
        $this->rpc_port = $rpc_port;
        $this->rpc_user = $rpc_user;
        $this->rpc_pass = $rpc_pass;
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function backupwallet($id = 1)
    {
        return $this->query($id, 'backupwallet', array());
    }


    /**
     * @param $id
     * @param $method
     * @param array $params
     * @return mixed
     * @throws Exception
     */
    private function query($id, $method, $params = array(''))
    {
        $params = array_values($params);

        $request = json_encode(
            array(
                'method' => strtolower($method),
                'params' => $params,
                'id' => $id
            )
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER    , Array("Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL           , $this->rpc_host . ":" . $this->rpc_port);
        curl_setopt($curl, CURLOPT_USERPWD       , $this->rpc_user . ":" . $this->rpc_pass);
        curl_setopt($curl, CURLOPT_POST          , true);
        curl_setopt($curl, CURLOPT_POSTFIELDS    , $request);
        $response_json = curl_exec($curl);
        curl_close($curl);

        if (!$response_json) {
            throw new Exception('Unable to connect to ' . $this->rpc_host, 0);
        }
        $response = json_decode($response_json, true);

        if ($response['id'] != $id) {
            throw new Exception('Incorrect response id (request id: ' . $id .
                                ', response id: ' . $response['id'] . ')', 1);
        }
        if (!empty($response['error'])) {
            throw new Exception('Request error: ' . print_r($response['error'], 1), 2);
        }

        return $response_json;
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function checkwallet($id = 1)
    {
        return $this->query($id, 'checkwallet', array());
    }

    /**
     * @param $dbFind
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function databasefind($dbFind, $id = 1)
    {
        return $this->query($id, 'databasefind', array($dbFind));
    }

    /**
     * @param $dbStore
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function databasestore($dbStore, $id = 1)
    {
        return $this->query($id, 'databasestore', array($dbStore));
    }

    /**
     * @param $address
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function dumpprivkey($address, $id = 1)
    {
        return $this->query($id, 'dumpprivkey', array($address));
    }

    /**
     * @param $password
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function encryptwallet($password, $id = 1)
    {
        return $this->query($id, 'encryptwallet', array($password));
    }

    /**
     * @param $address
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function getaccount($address, $id = 1)
    {
        return $this->query($id, 'getaccount', array($address));
    }

    /**
     * @param $account
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function getaccountaddress($account, $id = 1)
    {
        return $this->query($id, 'getaccountaddress', array($account));
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function getbalance($id = 1)
    {
        return $this->query($id, 'getbalance', array());
    }

    /**
     * @param $hash
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function getblock($hash, $id = 1)
    {
        return $this->query($id, 'getblock', array($hash));
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function getblockcount($id = 1)
    {
        return $this->query($id, 'getblockcount', array());
    }

    /**
     * @param $height
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function getblockhash($height, $id = 1)
    {
        return $this->query($id, 'getblockhash', array($height));
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function getblocktemplate($id = 1)
    {
        return $this->query($id, 'getblocktemplate', array());
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function getdifficulty($id = 1)
    {
        return $this->query($id, 'getdifficulty', array());
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function getincentiveinfo($id = 1)
    {
        return $this->query($id, 'getincentiveinfo', array());
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function getinfo($id = 1)
    {
        return $this->query($id, 'getinfo', array());
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function getmininginfo($id = 1)
    {
        return $this->query($id, 'getmininginfo', array());
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function getnetworkhashps($id = 1)
    {
        return $this->query($id, 'getnetworkhashps', array());
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function getnewaddress($id = 1)
    {
        return $this->query($id, 'getnewaddress', array($account));
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function getpeerinfo($id = 1)
    {
        return $this->query($id, 'getpeerinfo', array());
    }

    /**
     * @param $txid
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function getrawtransaction($txid, $id = 1)
    {
        return $this->query($id, 'getrawtransaction', array($txid));
    }

    /**
     * @param $txid
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function gettransaction($txid, $id = 1)
    {
        return $this->query($id, 'gettransaction', array($txid));
    }

    /**
     * @param $privkey
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function importprivkey($privkey, $id = 1)
    {
        return $this->query($id, 'importprivkey', array($privkey));
    }

    /**
     * @param $minconf
     * @param $empty
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function listreceivedbyaccount($minconf, $empty, $id = 1)
    {
        return $this->query($id, 'listreceivedbyaccount',
            array($minconf, $empty));
    }

    /**
     * @param $minconf
     * @param $empty
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function listreceivedbyaddress($minconf, $empty, $id = 1)
    {
        return $this->query($id, 'listreceivedbyaddress',
            array($minconf, $empty));
    }

    /**
     * @param $hash
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function listsinceblock($hash, $id = 1)
    {
        return $this->query($id, 'listsinceblock', array($hash));
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function listtransactions($id = 1)
    {
        return $this->query($id, 'listtransactions', array());
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function repairwallet($id = 1)
    {
        return $this->query($id, 'repairwallet', array());
    }

    /**
     * @param $to
     * @param string $account
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function sendmany($to, $account = '', $id = 1)
    {
        return $this->query($id, 'sendmany', array($account, $to));
    }

    /**
     * @param $address
     * @param $amount
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function sendtoaddress($address, $amount, $id = 1)
    {
        return $this->query($id, 'sendtoaddress', array($address, $amount));
    }

    /**
     * @param $txfee
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function settxfee($txfee, $id = 1)
    {
        return $this->query($id, 'settxfee', array($txfee));
    }

    /**
     * @param $block
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function submitblock($block, $id = 1)
    {
        return $this->query($id, 'submitblock', array($block));
    }

    /**
     * @param $address
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function validateaddress($address, $id = 1)
    {
        return $this->query($id, 'validateaddress', array($address));
    }

    /**
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function walletlock($id = 1)
    {
        return $this->query($id, 'walletlock', array());
    }

    /**
     * @param $password
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function walletpassphrase($password, $id = 1)
    {
        return $this->query($id, 'walletpassphrase', array($password));
    }

    /**
     * @param $password
     * @param $newpassword
     * @param int $id
     * @return mixed
     * @throws Exception
     */
    public function walletpassphrasechange($password, $newpassword, $id = 1)
    {
        return $this->query($id, 'walletpassphrasechange',
            array($password, $newpassword));
    }
}
