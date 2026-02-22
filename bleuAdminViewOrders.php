<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Orders</title>
<style>
body {
    font-family: "Georgia", serif;
    background-color: #ffffff;
    color: #000000;
    margin: 0;
    padding: 30px;
}

h1 {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 20px;
    letter-spacing: 1px;
    text-shadow: 2px 2px 3px rgba(255,255,255,0.2);
}

table {
    width: 90%;
    margin: 0 auto;
    border-collapse: collapse;
    background: #ffffff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    border: 1px solid #fff;
}

table thead {
    background: #222;
    color: #fff;
}

table th {
    padding: 12px;
    font-size: 1rem;
    letter-spacing: 0.5px;
    border-bottom: 3px solid #000000;
}

table td {
    padding: 10px;
    text-align: center;
    color: #000000;
    border-bottom: 1px solid #000000;
}

table tbody tr:nth-child(even) {
    background-color: #ffffff;
}

table tbody tr:hover {
    background-color: #ffffff;
    transform: scale(1.01);
    transition: 0.2s ease;
}

table td[colspan] {
    font-style: italic;
    color: #000000;
    padding: 20px;
}
</style>
</head>
<body>
<h1>View Orders</h1>
<br><br>
<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Buyer Name</th>
            <th>Product</th>
            <th>Product Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Account</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        include "bleuConnection.php";

        $bleusql = "SELECT * FROM bleuorders";
        $bleures = mysqli_query($bleuConn, $bleusql);

        if(mysqli_num_rows($bleures) > 0){
            while($bleuorder = mysqli_fetch_assoc($bleures)){
                echo "<tr>
                <td><p>{$bleuorder['order_id']}</p></td>
                <td><p>{$bleuorder['bleu_BuyerName']}</p></td>
                <td><p>{$bleuorder['bleu_ProductName']}</p></td>
                <td><p>{$bleuorder['bleu_ProductPrice']}</p></td>
                <td><p>{$bleuorder['bleu_Quantity']}</p></td>
                <td><p>{$bleuorder['bleu_TotalPrice']}</p></td>
                <td><p>{$bleuorder['bleu_Account']}</p></td>
                </tr>";
            }
        } else {
            echo "
            <tr>
                <td colspan='7'>No orders found.</td>
            </tr>
            ";
        }
        ?>
    </tbody>
</table>
</body>
</html>
