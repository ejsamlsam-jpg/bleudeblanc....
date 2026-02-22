<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Navigation</title>

<style>
body {
    margin: 0;
    padding: 20px;
    font-family: Georgia, serif;
    background-color: #fff;
    display: flex;
    flex-direction: column;
    gap: 15px;
    align-items: center;
}

a {
    text-decoration: none;
    width: 90%;
    max-width: 250px;
    padding: 12px 20px;
    border: 1px solid #000;
    box-shadow: 0 -2px 8px rgba(0,0,0,0.4);
    border-radius: 8px;
    text-align: center;
    color: #000;
    transition: 0.3s;
}

a:hover {
    background: #000;
    color: #fff;
    transform: translateX(5px);
}
</style>
</head>

<body>

<a href="bleuAdminViewOrders.php" target="column">
    View Orders
</a>

<a href="bleuAdminViewClients.php" target="column">
    View Clients
</a>

<a href="bleuAdminProduct.php" target="column">
    View Products
</a>

<a href="bleuAdminAddProduct.php" target="column">
    Add Products
</a>

<!-- IMPORTANT: _top for logout -->
<a href="bleuLogout.php" target="_top" onclick="return confirm('Are you sure you want to log out?');">
    Logout
</a>

</body>
</html>
