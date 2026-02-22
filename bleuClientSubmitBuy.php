<?php
session_start();
include "bleuConnection.php"; // updated

if (isset($_POST['bleubuybtn'])) {
    $bleuusername = $_SESSION['bleuusername'];

    $bleubuyername = $_POST['bleubuyername'];
    $bleuquantity = $_POST['bleuquantity'];
    $bleuprodid = $_GET['id'];

    $sql = "SELECT * FROM bleuproducts WHERE bleuprodid ='$bleuprodid'";
    $bleubuyq = mysqli_query($bleuConn, $sql);

    if (mysqli_num_rows($bleubuyq) === 1) {
        $bleuprod = mysqli_fetch_assoc($bleubuyq);

        $bleuproductname = $bleuprod['bleu_ProductName'];
        $bleupriceperunit = $bleuprod['bleu_PriceperUnit'];
        $bleucurrentunit = $bleuprod['bleu_Unit'];

        if ($bleucurrentunit >= $bleuquantity) {

            $newUnit = $bleucurrentunit - $bleuquantity;
            $updateStockSql = "UPDATE bleuproducts SET bleu_Unit = '$newUnit' WHERE bleuprodid='$bleuprodid'";
            mysqli_query($bleuConn, $updateStockSql);

            $bleutotalprice = $bleupriceperunit * $bleuquantity;

            $bleuinsertbuy = "INSERT INTO bleuorders 
                (bleu_BuyerName, bleu_ProductName, bleu_ProductPrice, bleu_Quantity, bleu_TotalPrice, bleu_Account) 
                VALUES ('$bleubuyername','$bleuproductname','$bleupriceperunit','$bleuquantity','$bleutotalprice','$bleuusername')";

            mysqli_query($bleuConn, $bleuinsertbuy);

            header("location: bleuClientProduct.php");
            exit;
        } else {

            echo "<script>alert('Not enough stock!'); window.location.href='bleuClientBuyProduct.php?id=$bleuprodid';</script>";
            exit;
        }
    }
}
?>
