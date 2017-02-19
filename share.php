<?php session_start();?>
<style>
body{
    text-align: center;
    padding-top: 10%;
}
img{
border: 1px solid black;
    box-shadow: 0px 0px 30px 1px;
    margin-bottom: 30px;
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
<img src="photo/<?=$_GET['rnd']?>.png"><br/><br/>
<a href="http://aagneya.co.in/app/sharefb.php?rnd=<?=$_GET['rnd']?>">Share with Facebook!</a>
