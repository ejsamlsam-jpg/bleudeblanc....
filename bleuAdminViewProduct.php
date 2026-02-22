<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Product</title>
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
    border: 2px solid #000000;
    border-radius: 10px;
    width: 300px;
    padding: 20px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    text-align: center;
}

.bleucard:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
}

.bleucard img {
    display: block;
    margin: 0 auto 15px auto;
    border-radius: 7px;
    max-width: 100%;
}

.bleucard table {
    width: 100%;
    border-collapse: collapse;
}

.bleucard td {
    padding: 6px;
    vertical-align: middle;
}

.bleucard input[type="text"] {
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
<h1>Admin Product</h1>
<br><br>
<div class="bleucon">
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "bleuConnection.php";

$bleuprodid = $_GET['bleuprodid'];

// Use prepared statement for security
$stmt = mysqli_prepare($bleuConn, "SELECT * FROM bleuproducts WHERE bleuprodid = ?");
mysqli_stmt_bind_param($stmt, "i", $bleuprodid);
mysqli_stmt_execute($stmt);
$ressql = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($ressql) === 1){
    $bleuprod = mysqli_fetch_assoc($ressql);
    echo '
        <div class="bleucard">
            <img src="data:image/jpeg;base64,' . base64_encode($bleuprod['bleu_Image']) . '" width="200">
            <div>
                <table>
                    <tr>
                        <td><p>Product Name: </p></td>
                        <td><input type="text" name="bleuprodname" value="'. $bleuprod['bleu_ProductName'] .'" disabled></td>
                    </tr>
                    <tr>
                        <td><p>Unit: </p></td>
                        <td><input type="text" name="bleuunit" value="'. $bleuprod['bleu_Unit'] .'" disabled></td>
                    </tr>
                    <tr>
                        <td><p>Price per Unit: </p></td>
                        <td><input type="text" name="bleupriceunit" value="'. $bleuprod['bleu_PriceperUnit'] .'" disabled></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align:center;">
                            <button class="bleuviewbtn" onclick="window.location.href=\'bleuAdminEditProduct.php?bleuprodid='. $bleuprod['bleuprodid'] .'\'">Edit</button>
                            <button class="bleuviewbtn" onclick="window.location.href=\'bleuAdminDeleteProduct.php?bleuprodid='. $bleuprod['bleuprodid'] .'\'">Delete</button>
                            <button class="bleuviewbtn" onclick="window.location.href=\'bleuAdminProduct.php\'">Cancel</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    ';
}
?>
</div>
</body>
</html>
