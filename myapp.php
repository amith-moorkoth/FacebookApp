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

if(isset($accessToken)){

$fb = new Facebook\Facebook([
  'app_id' => '1775171229367166',
  'app_secret' => 'ba30983436e62a4b21d0cdcc525ef095',
  'default_graph_version' => 'v2.8',
  ]);
$helper = $fb->getRedirectLoginHelper();

try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,name,picture.height(600).width(600)', $accessToken->getValue());
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();
//print_r($user);
//echo $user['picture']['url'];

$dest = imagecreatefrompng('xx.png');
//$dest1 = imagecreatefrompng('xxxxx.png');
$src = imagecreatefromjpeg($user['picture']['url']);

imagealphablending($dest, false);
imagesavealpha($dest, true);


//imagescale($src,500,500);
$src=resizeJpg($src,600,600);

//imagecopymerge($dest,$src, 10, 10, 0, 0, 580, 490, 95); //have to play with these numbers for it to work for you, etc.
//imagecopymerge($dest,$dest1, 0, 0, 0, 0, 100, 100, 100); //have to play with these numbers for it to work for you, etc.
//imagecopy($dest, $dest1, 0, 0, 0, 103, 100, 300);

imagecopyresampled( $src,$dest, 0, 0, 0, 0, 550, 550, 600, 600); 


header('Content-Type: image/png');
//imagepng($dest);

//imagedestroy($dest);
//imagedestroy($src);
$rnd=genRand(60);

$save = "photo/". $rnd.".png";
imagepng($src, $save);
header('Location: http://aagneya.co.in/app/share.php?rnd='.$rnd);
//echo"<script>location.href = "http://aagneya.co.in/app/share.php?rnd=$rnd";</script>";
}



function genRand($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}




function resizePng($im, $dst_width, $dst_height) {
    $width = imagesx($im);
    $height = imagesy($im);

    $newImg = imagecreatetruecolor($dst_width, $dst_height);

    imagealphablending($newImg, false);
    imagesavealpha($newImg, true);
    $transparent = imagecolorallocatealpha($newImg, 255, 255, 255, 127);
    imagefilledrectangle($newImg, 0, 0, $width, $height, $transparent);
    imagecopyresampled($newImg, $im, 0, 0, 0, 0, $dst_width, $dst_height, $width, $height);

    return $newImg;
}




function resizeJpg($im, $dst_width, $dst_height) {
    $width = imagesx($im);
    $height = imagesy($im);

    $image_p = imagecreatetruecolor($dst_width, $dst_height);
    imagecopyresampled($image_p, $im, 0, 0, 0, 0, $dst_width, $dst_height, $width , $height );


    return $image_p;
}






