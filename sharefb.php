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
else{getmeimg($accessToken);}

function getmeimg($a){
$fb = new Facebook\Facebook([
  'app_id' => '1775171229367166',
  'app_secret' => 'ba30983436e62a4b21d0cdcc525ef095',
  'default_graph_version' => 'v2.8',
  ]);
$data = [
  'message' => 'http://aagneya.co.in/app',
  'source' => $fb->fileToUpload('http://aagneya.co.in/app/photo/'.$_GET['rnd'].'.png'),
];

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->post('/me/photos', $data, $a);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$graphNode = $response->getGraphNode();

echo 'Photo ID: ' . $graphNode['id'];
}











function getmelogin(){
$fb = new Facebook\Facebook([
  'app_id' => '1775171229367166',
  'app_secret' => 'ba30983436e62a4b21d0cdcc525ef095',
  'default_graph_version' => 'v2.8',
  ]);
$helper = $fb->getRedirectLoginHelper();

$permissions = ['publish_actions','email','user_photos']; // Optional permissions
$loginUrl = $helper->getLoginUrl('http://aagneya.co.in/app/sharefb.php?rnd='.$_GET['rnd'], $permissions);

header("Location: $loginUrl");
//echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}

