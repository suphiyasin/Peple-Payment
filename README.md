# Peple Payment
Peple İle Ödemelerinizi Alıcak Yeni Bir Sistem . (Click To Pay  )
<br>
PEPLE Resmi Site link : https://www.peple.com.tr/
<br/>
<br/>
<h1>Kullanım / Usage</h1>
<br/>
Üye olunuz, ardından üye olduğunuz telefon numarası ve şifrenizi aşağıdaki kod bloğunda  (veya index.php de) uygun şekilde doldurunuz.

```
require("./src.php");
$use = new pep();
$use->user = "TELEFON NUMARANIZ +90 SIZ SEKILDE";
$use->pass = "6 HANELI SIFRENIZ";
$use->login();

```
<br/>
yazmanız yeterlidir.
Gelicek olan form doldurma kısmına telefon numaranıza gelen sms girmeniz gerekmektedir

```
//Link İle Para Alma Fonksyionu (işlem kesim ücreti 0.02 tl olması laızm pep tarafından kesilmekte)
//paywithlink2 fonksiyonunda önce alıcağınız miktar (örnekte 10) sonra linke tıklanınca gözükücek açıklama
//(örenkte Merhaba bana destek olmak istermisiniz ?) 
$use->showaccounts(); //burda hesabımızın numarasını alıyoruz
$use->getid(); //burda da hesabımızın id sini
echo "Link Budur : <a href='".$use->paywithlink2("10", "Merhaba bana destek olmak istermisiniz ? ")."' target='_blank'>TIKLA</a>";

```

```
//kredi karti ile ödeme alma  örnekelrde belirtilen 3 miktardır (işlem kesim ücreti : 2tl pep tarafından kesilmekte)
$use->AddBalanceStep1("kredi kart numarası", "yatırılcak rakam");
echo "Hesap no : ".$use->showaccounts();
$ref = $use->AddBalanceStep2("kredi kart numarası", "2 haneli ay", "2 haneli yıl", "ccv", "yatırılcak rakam");
$use->AddBalanceStep3($ref);
```
