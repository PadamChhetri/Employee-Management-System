<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eSewa Payment</title>
</head>

<body>
    <?php
    // http://localhost/SummerProject/Employee/esewa/esewa.php
    session_start();
    $price = $_SESSION['loan_amount'];
    ?>
    <form method="post" id="shippingForm">
        <input type="hidden" id="amount" name="amount" value="<?php echo (int)$price; ?>" required>
        <input type="hidden" id="tax_amount" name="tax_amount" value="0" required>
        <input type="hidden" id="total_amount" name="total_amount" value="<?php echo (int)$price; ?>" required>
        <input type="hidden" id="transaction_uuid" name="transaction_uuid" required>
        <input type="hidden" id="product_code" name="product_code" value="EPAYTEST" required>
        <input type="hidden" id="product_service_charge" name="product_service_charge" value="0" required>
        <input type="hidden" id="product_delivery_charge" name="product_delivery_charge" value="0" required>
        <input type="hidden" id="success_url" name="success_url" value="http://localhost/Summerproject/Employee/success.php" required>
        <input type="hidden" id="failure_url" name="failure_url" value="http://localhost/Summerproject/Employee/failure.php?param1=value1" required>
        <input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>
        <input type="hidden" id="signature" name="signature" required>
    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/hmac-sha256.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/enc-base64.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var uuid = performance.now().toString().replace('.', '-');
            var tuid = document.getElementById('transaction_uuid');
            var secret = '8gBm/:&EnhH.1/q';
            var totalAmount = "<?php echo $price; ?>";
            var signatureString = `total_amount=${totalAmount},transaction_uuid=${uuid},product_code=EPAYTEST`;

            var hash = CryptoJS.HmacSHA256(signatureString, secret);
            var hashInBase64 = CryptoJS.enc.Base64.stringify(hash);

            var sig = document.getElementById('signature');
            tuid.value = uuid;
            sig.value = hashInBase64;

            if (hashInBase64) {
                submitForm();
            }

            function submitForm() {
                var formElem = document.getElementById('shippingForm');
                formElem.setAttribute('action', 'https://rc-epay.esewa.com.np/api/epay/main/v2/form');
                formElem.submit();
            }
        });
    </script>
</body>

</html>
