# Hướng dẫn sử dụng 

Trong hướng dẫn này yêu cầu là các bạn đã có tài liệu support từ bên cung cấp dịch vụ. mã nguồn thư viện Alepay đã được mình custome lại từ bên nhà cung cấp dịch vụ. Bạn nào custome lại tốt hơn thì đóng góp luôn để mọi người có thư viện hay để dùng.

Tiên quyết:<br/>
Tạo thư mục Lib trong thư mục app của dự án laravel<br/>
Sau đó pull code thư viện này về.<br/>
Do trước đây mình không nghĩ làm thành thư viện nên đã thiết kế thư mục như vậy với namespace là namespace App\Lib\Alepays;<br/>
1. Tạo hàm helper cấu hình như sau

Dưới đây là tài khoản sandbox của mình các bạn có thể dùng bình thường

```PHP
function config_alepay()
    {    
        $configAlepay = array(
                "apiKey" => "kz8fXmt3iCvNngaxqkiywhZgkRkCp6",
                "encryptKey" => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCMwnqarPvrWA1G9Xy2o8MZmxPH/BkAOZmAeTkG3WxZGsqG53IX1qqmzMFIRTBNfLPW4w+BhVksYQRX7gsfe/UynjxkwEZxSL+EwPhsBJ/1mL3HrjT9Yy3FKYFIWqTaXNgvZ2mmn2XqYAbI47ra/FEW0qoz74s+YC8g+N2gtzbMKQIDAQAB",
                "checksumKey" => "kULJVwirQ0olKYY9EEJSbCFKpMuGwf",
                "callbackUrl" => route('payment.result'), // Đường dẫn sẽ xử lý khi thanh toán xong.
                "env" => "test", // or live
            );
    	return $configAlepay;
}
```
2. Trong hàm xử lý thanh toán 

Data bao gồm các trường như dưới đây.

```PHP
$config = config_alepay();
$alepay = new Alepay($config);
$data = [];

$data['cancelUrl'] = ;
$data['amount'] = ;
$data['orderCode'] = ;
$data['currency'] =  ;
$data['orderDescription'] =  ;
$data['totalItem'] =  ;
$data['checkoutType'] = 1; // 0 : cho phép thanh toán bằng cả 2 cách, 1 : chỉ thanh toán thường , 2: chỉ thanh toán trả góp
$data['buyerName'] = ;
$data['buyerEmail'] = ;
$data['buyerPhone'] = ;
$data['buyerAddress'] = ;
$data['buyerCity'] = ;
$data['buyerCountry'] = ;
$data['month'] = 0;
$data['paymentHours'] = 12; // 12 tiếng :  Thời gian cho phép thanh toán (tính bằng giờ)

$result = $alepay->sendOrderToAlepay($data); // Khởi tạo

if (isset($result) && !empty($result->checkoutUrl)) {
	return redirect($result->checkoutUrl);
} else {
	return back()->with("error", $result->errorDescription);
}
```

Như vậy chỉ cần 2 bước như trên và mã nguồn thư viện các bạn đã làm chủ được Alepay :D
