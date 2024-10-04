<?php 
$pdo = new PDO('mysql:host=localhost;dbname=qr_sistemi', 'root', '');
$user_id=1;
$new_qr_token = md5(uniqid(rand(), true));
$stmt = $pdo->prepare('UPDATE users SET qr_token = ? WHERE user_id = ?');
$stmt->execute([$new_qr_token, $user_id]);
include('phpqrcode/qrlib.php');
$filename = 'qrcodes/user_' . $user_id . '.png';
QRcode::png($new_qr_token, $filename);
echo '<img src="' . $filename . '" alt="QR Kod">';

?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Kod Oluşturma</title>
</head>
<body>
    <!-- Form ve Buton -->
    <form method="post" action="">
        <button type="submit" name="generate_qr">QR Kod Oluştur</button>
    </form>
</body>
</html>