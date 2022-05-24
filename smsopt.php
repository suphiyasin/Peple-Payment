<?php
require("./src.php");

$opt = $_POST['opt'];
$optid = $_POST['optid'];
$token = $_POST['token'];
$use = new pep();
$use->sms = $optid;
$use->token = $token;
$use->smsopt($opt);


//Link İle Para Alma Fonksyionu (işlem kesim ücreti 0.02 tl olması laızm pep tarafından kesilmekte)
//paywithlink2 fonksiyonunda önce alıcağınız miktar (örnekte 10) sonra linke tıklanınca gözükücek açıklaam (örenkte Merhaba bana destek olmak istermisiniz ?) 
$use->showaccounts();
$use->getid();
echo "Link Budur : <a href='".$use->paywithlink2("10", "Merhaba bana destek olmak istermisiniz ? ")."' target='_blank'>TIKLA</a>";



/*
//kredi karti ile ödeme alma  örnekelrde belirtilen 3 miktardır (işlem kesim ücreti : 2tl pep tarafından kesilmekte)
$use->AddBalanceStep1("kredi kart numarası", "yatırılcak rakam");
echo "Hesap no : ".$use->showaccounts();
$ref = $use->AddBalanceStep2("kredi kart numarası", "2 haneli ay", "2 haneli yıl", "ccv", "yatırılcak rakam");
$use->AddBalanceStep3($ref);
*/

