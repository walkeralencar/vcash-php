# Vcash Rpc Client for PHP

## how to use
```php
<?php
require_once('./vendor/autoload.php');
$server = '127.0.0.1';
$port   = '9195'; 
try {
    $myVcash = new Vcash\Rpc ($server, $port);

    $id = 1337;

    $myRpcGetinfo = $myVcash->getinfo($id);
    $myRpcGetincentiveinfo = $myVcash->getincentiveinfo();

    echo '<h2>Get Info:</h2><pre>'.$myRpcGetinfo.'</pre><br>';
    echo '<h2>Get Icentive Info:</h2><pre>'.$myRpcGetincentiveinfo.'</pre><br>';

}
catch (Exception $e) {
    echo 'Error: ', $e->getMessage() . PHP_EOL;
}
?>
```
## Donations
v.cash.: VoPf5tfZRwvypdT5eLjzmcrUL7fpE36i1U
Decred.: DsTipY2uLUWWHy8joQkhGRxnNygow9PZw5b
Bitcoin: 1FFvqvprQ1e6YBNoZHfDZvV3Qibph9s2dK
