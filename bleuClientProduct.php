<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Available Products</title>

<style>
body.products-page {
    font-family: "Georgia", serif;
    background-color: #ffffff;
    color: #000000;
    padding: 30px;
}

h1 {
    text-align: center;
    color: #000000;
    font-size: 2.5rem;
    margin-bottom: 20px;
    letter-spacing: 1px;
}

.bleucon {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
}

.bleucard {
    background: #fff;
    box-shadow: 0 -2px 8px rgba(0,0,0,0.4);
    color: #000;
    border: 1px solid #000;
    border-radius: 10px;
    width: 220px;
    padding: 15px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0,0,0,0.5);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.bleucard:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.7);
}

.bleucard img {
    border-radius: 8px;
    max-width: 100%;
    height: auto;
    margin-bottom: 10px;
}

.bleucard h5 p {
    font-weight: bold;
    margin: 5px 0;
}

.bleuviewbtn {
    background: #000;
    color: #fff;
    border: 2px solid #fff;
    padding: 8px 15px;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.3s ease;
}

.bleuviewbtn:hover {
    background: #fff;
    color: #000;
    transform: translateY(-2px);
    box-shadow: 2px 2px 6px rgba(0,0,0,0.5);
}
</style>
</head>
<body class="products-page">

<h1>Available Products</h1>
<br><br>

<div class="bleucon">
    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    include "bleuConnection.php";

    $sql = "SELECT * FROM bleuProducts";
    $ressql = mysqli_query($bleuConn, $sql);

    if (mysqli_num_rows($ressql) > 0) {
        while ($bleuprod = mysqli_fetch_assoc($ressql)) {
            echo '
                <div class="bleucard">
                    <img src="data:image/jpeg;base64,' . base64_encode($bleuprod['bleu_Image']) . '" width="200">
                    <h5><p>' . htmlspecialchars($bleuprod['bleu_ProductName']) . '</p></h5>
                    <button class="bleuviewbtn" onclick="window.location.href=\'bleuClientBuyProduct.php?bleuprodid='. $bleuprod['bleuprodid'] .'\'">Buy</button>
                </div>
            ';
        }
    } else {
        echo '<p style="text-align:center; width:100%;">No products available.</p>';
    }
    ?>
</div>

</body>
</html>
