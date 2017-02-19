<style>
body{
    padding-top: 20%;
    padding-left: 35%;
}
a{
    color: #1173af;
    box-shadow: 0px 0px 60px 0px inset;
    padding: 20px;
    border-radius: 20px;
    text-shadow: 5px 1px 10px #000000;
    text-decoration: none;
    font-size: 30px;
    font-family: monospace;
}
</style>

<?php
session_start();
require_once 'Facebook/autoload.php';

$fb = new Facebook\Facebook([
  'app_id' => '1775171229367166',
  'app_secret' => 'ba30983436e62a4b21d0cdcc525ef095',
  'default_graph_version' => 'v2.8',
  ]);

$helper = $fb->getRedirectLoginHelper();

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if(!isset($accessToken)){getmelogin();}
else{getmeimg();}


function getmelogin(){
$fb = new Facebook\Facebook([
  'app_id' => '1775171229367166',
  'app_secret' => 'ba30983436e62a4b21d0cdcc525ef095',
  'default_graph_version' => 'v2.8',
  ]);
$helper = $fb->getRedirectLoginHelper();

$permissions = ['publish_actions','email','user_photos']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://aagneya.co.in/app/myapp.php', $permissions);

echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}


function getmeimg(){
$fb = new Facebook\Facebook([
  'app_id' => '1775171229367166',
  'app_secret' => 'ba30983436e62a4b21d0cdcc525ef095',
  'default_graph_version' => 'v2.8',
  ]);
try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name', '{access-token}');
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();
print_r($user);
}





