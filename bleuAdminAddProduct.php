<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "bleuConnection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="bleuStyle_1.css">
<title>Add Product</title>
<style>
body.products-page {
    font-family: "Georgia", serif;
    background-color: #f0f4f8; /* light blue background */
    padding: 30px;
}

h1 {
    text-align:center;
    color: #0a1f44; /* dark navy blue */
    font-size: 2.5rem;
    margin-bottom: 20px;
    letter-spacing: 1px;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
}

.bleucon {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 20px;
}

.bleucard button {
    margin: 0 7px;
}

.bleucard {
    background: #ffffff; /* white card */
    border: 2px solid #0a1f44; /* dark navy border */
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    padding: 20px;
    width: 400px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.bleucard:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,0.3);
}

.bleucard table {
    width: 100%;
    border-collapse: collapse;
}

.bleucard td {
    padding: 8px;
    vertical-align: middle;
}

.bleucard input[type="text"],
.bleucard input[type="file"] {
    width: 95%;
    padding: 6px;
    font-size: 0.95rem;
    border: 1px solid #0a1f44; /* dark border */
    border-radius: 5px;
    background-color: #f0f4f8; /* light blue input background */
    color: #0a1f44;
    font-family: "Georgia", serif;
}

.bleuviewbtn {
    padding: 8px 15px;
    font-size: 0.95rem;
    border-radius: 6px;
    border: 2px solid #0a1f44; /* dark border */
    cursor: pointer;
    transition: 0.3s ease;
    color: #ffffff;
    background-color: #0a1f44; /* dark navy button */
}

.bleuviewbtn:hover {
    background-color: #122a66; /* slightly lighter navy on hover */
    transform: translateY(-2px);
    box-shadow: 2px 2px 6px rgba(0,0,0,0.2);
}

.bleuviewbtn[style*="background-color: green"] {
    background-color: #1e90ff; /* blue action button */
    color: white;
    border: 2px solid #0a1f44;
}

.bleuviewbtn[style*="background-color: green"]:hover {
    background-color: #187bcd;
}

.bleuviewbtn[style*="background-color: blue"] {
    background-color: #0a1f44; /* dark navy */
    color: white;
    border: 2px solid #0a1f44;
}

.bleuviewbtn[style*="background-color: blue"]:hover {
    background-color: #122a66;
}
</style>
</head>
<body class="products-page">
<h1>Add Product</h1>
<br><br>
<div class="bleucon">
    <div class="bleucard">
        <form action="" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td colspan='2'><input type="file" name="img" style="padding: 5px; font-size: 15px;"></td>
                </tr>
                <tr>
                    <td><p>Product Name: </p></td>
                    <td><input type="text" name="bleuprodname" required></td>
                </tr>
                <tr>
                    <td><p>Unit: </p></td>
                    <td><input type="text" name="bleuunit" required></td>
                </tr>
                <tr>
                    <td><p>Price per Unit: </p></td>
                    <td><input type="text" name="bleupriceunit" required></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                       <button class="bleuviewbtn" name="bleuaddbtn" type="submit">Add</button>
                        <button class="bleuviewbtn"
                                type="button"
                                style="background: #000000; color: white; border: 2px solid #0a1f44;"
                                onclick="window.location.href='bleuAdminProduct.php'">
                            Cancel
                        </button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php
if (isset($_POST['bleuaddbtn']) && isset($_FILES['img'])) {
    $bleuprodname = $_POST['bleuprodname'];
    $bleuunit = $_POST['bleuunit'];
    $bleupriceunit = $_POST['bleupriceunit']; 
    $bleuimage = file_get_contents($_FILES['img']['tmp_name']); 

    $stmt = $bleuConn->prepare("INSERT INTO bleuproducts (bleu_ProductName, bleu_Unit, bleu_PriceperUnit, bleu_Image) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $bleuConn->error);
    }

    $stmt->bind_param("ssds", $bleuprodname, $bleuunit, $bleupriceunit, $bleuimage);

    if ($stmt->execute()) {
        echo "<script>
                alert('Added successfully');
                setTimeout(() => { window.location.href = 'bleuAdminAddProduct.php'; }, 1000);
              </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>
</body>
</html>

