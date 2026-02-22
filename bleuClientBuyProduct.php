<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Buy Product</title>
<style>
body.products-page {
    font-family: "Georgia", serif;
    background-color: #ffffff;
    color: #000000;
    padding: 30px;
}

h1 {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 20px;
    letter-spacing: 1px;
    text-shadow: 2px 2px 3px rgba(0, 0, 0, 0.2);
}

.bleucon {
    display: flex;
    justify-content: center;
    gap: 20px;
    padding-bottom: 30px;
}

.bleucard {
    background: #ffffff;
    border: 1px solid #000000;
    border-radius: 10px;
    width: 350px;
    padding: 20px;
    box-shadow:  5px 10px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
}

.bleucard:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 15px rgba(255,255,255,0.3);
}

.bleucard img {
    display: block;
    margin: 0 auto 15px auto;
    max-width: 100%;
    border-radius: 8px;
}

.bleucard table {
    width: 100%;
    border-collapse: collapse;
}

.bleucard td {
    padding: 6px;
    vertical-align: middle;
}

.bleucard input[type="text"],
.bleucard input[type="number"] {
    width: 90%;
    padding: 5px;
    border: 1px solid #000000;
    border-radius: 5px;
    background-color: #ffffff;
    color: #000000;
    font-family: "Georgia", serif;
}

.bleuviewbtn {
    padding: 8px 15px;
    border-radius: 6px;
    border: 2px solid #fff;
    cursor: pointer;
    transition: 0.3s ease;
    font-family: "Georgia", serif;
    color: #fff;
    background-color: #000;
}

.bleuviewbtn:hover {
    background-color: #fff;
    color: #000;
    transform: translateY(-2px);
    box-shadow: 2px 2px 6px rgba(255,255,255,0.2);
}
</style>
</head>
<body class="products-page">
<h1>Add to Cart</h1>
<br><br>
<div class="bleucon">
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "bleuConnection.php";

// Check if bleuprodid exists in GET parameters
if (!isset($_GET['bleuprodid']) || empty($_GET['bleuprodid'])) {
    echo "<script>
        setTimeout(function() {
            window.location.href = 'bleuClientProduct.php';
        }, 1000);
    </script>";
    exit;
}

// Sanitize and validate the input
$bleuprodid = filter_var($_GET['bleuprodid'], FILTER_SANITIZE_NUMBER_INT);

if (!is_numeric($bleuprodid) || $bleuprodid <= 0) {
    echo '<div class="bleucard"><p>Invalid product ID.</p></div>';
    exit;
}

// Use prepared statement to prevent SQL injection
$sql = "SELECT * FROM bleuproducts WHERE bleuprodid = ?";
$stmt = mysqli_prepare($bleuConn, $sql);
mysqli_stmt_bind_param($stmt, "i", $bleuprodid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result) === 1){
    $bleuprod = mysqli_fetch_assoc($result);
    echo '
        <div class="bleucard">
            <img src="data:image/jpeg;base64,' . base64_encode($bleuprod['bleu_Image']) . '" width="200">
            <div>
                <form action="bleuClientSubmitBuy.php?id=' . $bleuprodid . '" method="post">
                    <table>
                        <tr>
                            <td><p>Name: </p></td>
                            <td><input type="text" name="bleubuyername" required></td>
                        </tr>
                        <tr>
                            <td><p>Quantity: </p></td>
                            <td><input type="number" name="bleuquantity" required></td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center;">
                                <button class="bleuviewbtn" name="bleubuybtn" type="submit">Add to cart</button>
                                <button class="bleuviewbtn" type="button" onclick="window.location.href=\'bleuClientProduct.php\'">Cancel</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    ';
} else {
    echo '<div class="bleucard"><p>Product not found.</p></div>';
}
?>
</div>
</body>
</html>
