<?php
class pep{
  
	//telefon numarası bunu (index.php de belirmelisiniz)
	public $user;
	
	//sifre bunu (index.php de belirtmelisniz)
	public $pass;
	
	//gönderilen sms id (belirtmenize gerek yok)
	public $sms;
	
	//token (belirtmenize gerek yok )
	public $token;
	
	//bakiye yükleme işleminde kullanılan type kodu (belirtmeniz gerekmiyor)
	public $transid;
	
	//türk lira hesabınınız (belirtmeniz gerekmiyor)
	public $hesapno;
	
	//hesabınız id (belirtmeniz gerekmiyor)
	public $hesapid;
	
public function login(){
	
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://onlineapi.peple.com.tr/onlineapi/v2.0/Authentication/Login');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"customerType\":1,\"internationalPhoneCode\":\"90\",\"cellPhoneNumber\":\"$this->user\",\"password\":\"$this->pass\"}");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$headers = array();
$headers[] = 'Authority: onlineapi.peple.com.tr';
$headers[] = 'Accept: application/json, text/plain, */*';
$headers[] = 'Accept-Language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7';
$headers[] = 'Content-Type: application/json;charset=UTF-8';
$headers[] = 'Language: tr';
$headers[] = 'Origin: https://online.peple.com.tr';
$headers[] = 'Referer: https://online.peple.com.tr/';
$headers[] = 'Sec-Ch-Ua: \" Not A;Brand\";v=\"99\", \"Chromium\";v=\"101\", \"Google Chrome\";v=\"101\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
$headers[] = 'Sec-Ch-Ua-Platform: \"Windows\"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-site';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$kah = json_decode($result, true);
$token = $kah['Token'];
$this->token = $token;
$oid = $kah['OtpId'];
$this->sms = $oid;
?>
<form action="smsopt.php" placeholder="Gelen Sms i yazınız" method="POST">
<input type="number" name="opt"/>
<input type="hidden" name="token" value="<?php echo $token ?>"/>
<input type="hidden" name="optid" value="<?php echo $oid ?>"/>
<input type="submit"/>
</form>


<?php
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
	
	
}

public function smsopt($code){
	$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://onlineapi.peple.com.tr/onlineapi/v2.0/Authentication/VerifyLoginSmsOtp');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"otp\":\"$code\",\"otpId\":\"$this->sms\"}");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$headers = array();
$headers[] = 'Authority: onlineapi.peple.com.tr';
$headers[] = 'Accept: application/json, text/plain, */*';
$headers[] = 'Accept-Language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7';
$headers[] = 'Authorization: Bearer '.$this->token.'';
$headers[] = 'Content-Type: application/json;charset=UTF-8';
$headers[] = 'Language: tr';
$headers[] = 'Origin: https://online.peple.com.tr';
$headers[] = 'Referer: https://online.peple.com.tr/';
$headers[] = 'Sec-Ch-Ua: \" Not A;Brand\";v=\"99\", \"Chromium\";v=\"101\", \"Google Chrome\";v=\"101\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
$headers[] = 'Sec-Ch-Ua-Platform: \"Windows\"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-site';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
//print_r($result);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
}
	
	public function showaccounts(){
	$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://onlineapi.peple.com.tr/onlineapi/v2.0/Account/AccountListWithWallets');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{}");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$headers = array();
$headers[] = 'Authority: onlineapi.peple.com.tr';
$headers[] = 'Accept: application/json, text/plain, */*';
$headers[] = 'Accept-Language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7';
$headers[] = 'Authorization: Bearer '.$this->token.'';
$headers[] = 'Content-Type: application/json;charset=UTF-8';
$headers[] = 'Language: tr';
$headers[] = 'Origin: https://online.peple.com.tr';
$headers[] = 'Referer: https://online.peple.com.tr/';
$headers[] = 'Sec-Ch-Ua: \" Not A;Brand\";v=\"99\", \"Chromium\";v=\"101\", \"Google Chrome\";v=\"101\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
$headers[] = 'Sec-Ch-Ua-Platform: \"Windows\"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-site';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$sonuc = json_decode($result, true);
$hesapno = $sonuc['Accounts'][0]['AccountNumber'];
$this->hesapno = $hesapno;
return $hesapno;
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

	
}
	
	
	
	//kredi kartı ile bakiye yükleme
public function AddBalanceStep1($cc, $miktar){
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://onlineapi.peple.com.tr/onlineapi/v2.0/MoneyTransfer/GetCreditCardMoneyUploadDetails');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"CreditCardNumber\":\"$cc\",\"CardId\":0,\"Amount\":$miktar,\"CurrencyCode\":\"\",\"FromAccountNumber\":\"$this->hesapno\"}");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$headers = array();
$headers[] = 'Authority: onlineapi.peple.com.tr';
$headers[] = 'Accept: application/json, text/plain, */*';
$headers[] = 'Accept-Language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7';
$headers[] = 'Authorization: Bearer '.$this->token.'';
$headers[] = 'Content-Type: application/json;charset=UTF-8';
$headers[] = 'Language: tr';
$headers[] = 'Origin: https://online.peple.com.tr';
$headers[] = 'Referer: https://online.peple.com.tr/';
$headers[] = 'Sec-Ch-Ua: \" Not A;Brand\";v=\"99\", \"Chromium\";v=\"101\", \"Google Chrome\";v=\"101\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
$headers[] = 'Sec-Ch-Ua-Platform: \"Windows\"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-site';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$kah = json_decode($result, true);
$ty = $kah['TransactionType'];
$this->transid = $ty;
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
}	

public function AddBalanceStep2($cc, $cm, $cy, $ccv, $miktar){
	
	$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://onlineapi.peple.com.tr/onlineapi/v2.0/MoneyTransfer/vpos');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"CardNumber\":\"$cc\",\"SecureCode\":\"$ccv\",\"ExpiryDate\":\"$cm$cy\",\"ToAccountNumber\":\"$this->hesapno\",\"Amount\":$miktar,\"TransactionType\":32,\"MoneyRequestId\":0,\"CardId\":0,\"SaveCard\":false,\"CardHolderName\":\"\",\"Fee\":2}");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$headers = array();
$headers[] = 'Authority: onlineapi.peple.com.tr';
$headers[] = 'Accept: application/json, text/plain, */*';
$headers[] = 'Accept-Language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7';
$headers[] = 'Authorization: Bearer '.$this->token.'';
$headers[] = 'Content-Type: application/json;charset=UTF-8';
$headers[] = 'Language: tr';
$headers[] = 'Origin: https://online.peple.com.tr';
$headers[] = 'Referer: https://online.peple.com.tr/';
$headers[] = 'Sec-Ch-Ua: \" Not A;Brand\";v=\"99\", \"Chromium\";v=\"101\", \"Google Chrome\";v=\"101\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
$headers[] = 'Sec-Ch-Ua-Platform: \"Windows\"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-site';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$kah = json_decode($result, true);
$ref = $kah['VPosPaymentInfo']['ReferenceNumber'];
return $ref;
//ekpos($tk, $ref);
//print_r($kah);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
	
}

public function AddBalanceStep3($ref){
	include("./load.php");
	$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://onlineapi.peple.com.tr/onlineapi/v2.0/vpos/index?ReferenceNumber=$ref");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Authority: onlineapi.peple.com.tr';
$headers[] = 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9';
$headers[] = 'Accept-Language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7';
$headers[] = 'Cookie: _gcl_au=1.1.939697389.1652268069; _fbp=fb.2.1652268071437.122717548; _gid=GA1.3.98542551.1652378479; _ga=GA1.3.660186043.1652268069; _ga_M3QB2F904M=GS1.1.1652465237.5.1.1652465307.0; __cf_bm=XQMlxR2Hxg1L0J855dRc_cqbeEZwTJqVPudVNT3QHGk-1652465315-0-AYyDzpoPOZG+ggfxRPQ+ngjF4RoUSDn4uRKCshs92LZb+n1mYns4SBsSqMi9oQym+NXGgPUFDjwbeb/QqT0hGcVPI5tl+5JO2INKqIgeKQJqkTDHDZmXYUIQxwAZmL69/g==';
$headers[] = 'Referer: https://online.peple.com.tr/';
$headers[] = 'Sec-Ch-Ua: \" Not A;Brand\";v=\"99\", \"Chromium\";v=\"101\", \"Google Chrome\";v=\"101\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
$headers[] = 'Sec-Ch-Ua-Platform: \"Windows\"';
$headers[] = 'Sec-Fetch-Dest: iframe';
$headers[] = 'Sec-Fetch-Mode: navigate';
$headers[] = 'Sec-Fetch-Site: same-site';
$headers[] = 'Upgrade-Insecure-Requests: 1';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.64 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$kah = json_decode($result, true);
$ig=str_get_html($result);
$src=$ig->find("form[name='prePostForm']",0)->action;
$src2=$ig->find("input[name='orderId']",0)->value;
$src3=$ig->find("input[name='amount']",0)->value;
$src4=$ig->find("input[name='cardNumber']",0)->value;
$src5=$ig->find("input[name='cardOwnerName']",0)->value;
$src6=$ig->find("input[name='userId']",0)->value;
$src7=$ig->find("input[name='cardId']",0)->value;
$src8=$ig->find("input[name='cardExpireMonth']",0)->value;
$src9=$ig->find("input[name='cardExpireYear']",0)->value;
$src10=$ig->find("input[name='installment']",0)->value;
$src11=$ig->find("input[name='cardCvc']",0)->value;
$src12=$ig->find("input[name='purchaserName']",0)->value;
$src13=$ig->find("input[name='purchaserSurname']",0)->value;
$src14=$ig->find("input[name='purchaserEmail']",0)->value;
$src15=$ig->find("input[name='successUrl']",0)->value;
$src16=$ig->find("input[name='failureUrl']",0)->value;
$src17=$ig->find("input[name='echo']",0)->value;
$src18=$ig->find("input[name='version']",0)->value;
$src19=$ig->find("input[name='transactionDate']",0)->value;
$src20=$ig->find("input[name='token']",0)->value;
$src24=$ig->find("input[name='mode']",0)->value;
$html = '
<form action="'.$src.'" method="POST" name="prePostForm">
<input type="hidden" name="orderId" value="'.$src2.'"/>
<input type="hidden" name="amount" value="'.$src3.'"/>
<input type="hidden" name="cardNumber" value="'.$src4.'"/>
<input type="hidden" name="cardOwnerName" value="'.$src5.'"/>
<input type="hidden" name="userId" value="'.$src6.'"/>
<input type="hidden" name="cardId" value="'.$src7.'"/>
<input type="hidden" name="cardExpireMonth" value="'.$src8.'"/>
<input type="hidden" name="cardExpireYear" value="'.$src9.'"/>
<input type="hidden" name="installment" value="'.$src10.'"/>
<input type="hidden" name="cardCvc" value="'.$src11.'"/>
<input type="hidden" name="mode" value="'.$src24.'"/>
<input type="hidden" name="purchaserName" value="'.$src12.'"/>
<input type="hidden" name="purchaserSurname" value="'.$src13.'"/>
<input type="hidden" name="purchaserEmail" value="'.$src14.'"/>
<input type="hidden" name="successUrl" value="'.$src15.'"/>
<input type="hidden" name="failureUrl" value="'.$src16.'"/>
<input type="hidden" name="echo" value="'.$src17.'"/>
<input type="hidden" name="version" value="'.$src18.'"/>
<input type="hidden" name="transactionDate" value="'.$src19.'"/>
<input type="hidden" name="token" value="'.$src20.'"/>
</form>
<script language="javascript">document.prePostForm.submit()</script>

';
echo $html;
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
	
	
}

public function getid(){
	$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://onlineapi.peple.com.tr/onlineapi/v2.0/customer/getcustomer');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{}");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$headers = array();
$headers[] = 'Authority: onlineapi.peple.com.tr';
$headers[] = 'Accept: application/json, text/plain, */*';
$headers[] = 'Accept-Language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7';
$headers[] = 'Authorization: Bearer '.$this->token.'';
$headers[] = 'Content-Type: application/json;charset=UTF-8';
$headers[] = 'Language: tr';
$headers[] = 'Origin: https://online.peple.com.tr';
$headers[] = 'Referer: https://online.peple.com.tr/';
$headers[] = 'Sec-Ch-Ua: \" Not A;Brand\";v=\"99\", \"Chromium\";v=\"101\", \"Google Chrome\";v=\"101\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
$headers[] = 'Sec-Ch-Ua-Platform: \"Windows\"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-site';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$sonuc = json_decode($result, true);
$id = $sonuc['Customer']['Id'];

$this->hesapid = $id;
return $id;
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

	
	
}


public function paywithlink($miktar, $text){
	$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://onlineapi.peple.com.tr/onlineapi/v2.0/MoneyRequest/ValidateMoneyRequest');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"Amount\":$miktar,\"CellCount\":0,\"Description\":\"$text\",\"IsEqual\":false}");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$headers = array();
$headers[] = 'Authority: onlineapi.peple.com.tr';
$headers[] = 'Accept: application/json, text/plain, */*';
$headers[] = 'Accept-Language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7';
$headers[] = 'Authorization: Bearer '.$this->token.'';
$headers[] = 'Content-Type: application/json;charset=UTF-8';
$headers[] = 'Language: tr';
$headers[] = 'Origin: https://online.peple.com.tr';
$headers[] = 'Referer: https://online.peple.com.tr/';
$headers[] = 'Sec-Ch-Ua: \" Not A;Brand\";v=\"99\", \"Chromium\";v=\"101\", \"Google Chrome\";v=\"101\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
$headers[] = 'Sec-Ch-Ua-Platform: \"Windows\"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-site';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);
	
	
}

public function paywithlink2($miktar, $text){
	
	$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://onlineapi.peple.com.tr/onlineapi/v2.0/MoneyRequest/InsertMoneyRequest');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"ListMoneyRequest\":[{\"Id\":1,\"CustomerId\":$this->hesapid,\"CustomerName\":\"Pep Üyesi Değil\",\"Currency\":\"TRY\",\"CurrencyCode\":\"00\",\"CurrencyLogo\":\"https://cdn.peple.com.tr/images/currencies/turkey.png\",\"CellPhoneNumber\":\"\",\"Email\":\"\",\"Amount\":$miktar,\"Fee\":0.02,\"Description\":\"$text\",\"SenderCustomerId\":0,\"SenderCustomerName\":null,\"CreateDate\":\"2022-05-24T12:16:28.6285661+03:00\",\"RequestStatus\":1,\"ModifiedDate\":\"0001-01-01T00:00:00\",\"ValidDate\":\"2022-05-31T12:16:28.6285685+03:00\",\"InternationalPhoneCode\":null,\"RequestCustomerName\":null,\"RemitterCustomerName\":\"Pep Üyesi Değil\",\"ReceiptId\":null,\"TransactionMinimum\":1,\"TransactionMaximum\":250,\"IsDefineTransactionCheck\":false,\"TransactionAlias\":null,\"PaymentCode\":null,\"IsExternalMoneyRequest\":null,\"ExternalCustomerId\":null,\"ReceiverName\":null,\"ExternalMoneyRequestId\":null}],\"Amount\":$miktar,\"CellCount\":0,\"Description\":\"$text\",\"IsEqual\":false}");
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$headers = array();
$headers[] = 'Authority: onlineapi.peple.com.tr';
$headers[] = 'Accept: application/json, text/plain, */*';
$headers[] = 'Accept-Language: tr-TR,tr;q=0.9,en-US;q=0.8,en;q=0.7';
$headers[] = 'Authorization: Bearer '.$this->token.'';
$headers[] = 'Content-Type: application/json;charset=UTF-8';
$headers[] = 'Language: tr';
$headers[] = 'Origin: https://online.peple.com.tr';
$headers[] = 'Referer: https://online.peple.com.tr/';
$headers[] = 'Sec-Ch-Ua: \" Not A;Brand\";v=\"99\", \"Chromium\";v=\"101\", \"Google Chrome\";v=\"101\"';
$headers[] = 'Sec-Ch-Ua-Mobile: ?0';
$headers[] = 'Sec-Ch-Ua-Platform: \"Windows\"';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-site';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
$sonuc = json_decode($result, true);
$url = $sonuc['Url'];
return $url;
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

	
}

	
	
}
