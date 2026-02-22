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
    color: #000000;
    font-size: 2.5rem;
    margin-bottom: 20px;
    letter-spacing: 1px;
}

table {
    width: 90%;
    margin: 0 auto;
    border-collapse: collapse;
    background: #b8b8b8;
    color: #000;
    box-shadow: 0 4px 10px rgba(0,0,0,0.5);
    
}

table thead {
    background: #ffffff;
    color: #000000;
}

table th {
    padding: 12px;
    font-size: 1rem;
    letter-spacing: 0.5px;
    border-bottom: 3px solid #000;
}

table td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #ccc;
}

table tbody tr:nth-child(even) {
    background-color: #f0f0f0;
}

table tbody tr:hover {
    background-color: #ddd;
    transform: scale(1.01);
    transition: 0.2s ease;
}

table td[colspan] {
    font-style: italic;
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
            <th>Product</th>
            <th>Product Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        include "bleuConnection.php";

        $bleusql = "SELECT * FROM bleuOrders";
        $bleures = mysqli_query($bleuConn, $bleusql);

        if (mysqli_num_rows($bleures) > 0) {
            while ($bleuorders = mysqli_fetch_assoc($bleures)) {
                echo "<tr>
                    <td>{$bleuorders['bleu_ProductName']}</td>
                    <td>{$bleuorders['bleu_ProductPrice']}</td>
                    <td>{$bleuorders['bleu_Quantity']}</td>
                    <td>{$bleuorders['bleu_TotalPrice']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No orders found.</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>
