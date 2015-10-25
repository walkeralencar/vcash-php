# Vanillacoin PHP Class

Basic example:
~~~
<?php
require_once('vanillacoin.php');

try {
    $myVanillacoin = new Vanillacoin('127.0.0.1', '9195');

	$id = 1337;

    $myRpcGetinfo = $myVanillacoin->getinfo($id);
    $myRpcGetincentiveinfo = $myVanillacoin->getincentiveinfo();

    echo '<h2>Get Info:</h2><pre>'.$myRpcGetinfo.'</pre><br>';
    echo '<h2>Get Icentive Info:</h2><pre>'.$myRpcGetincentiveinfo.'</pre><br>';

}
catch (Exception $e) {
    echo 'Error: ', $e->getMessage();
}
?>
~~~
