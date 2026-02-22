<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "bleuConnection.php";

// Ensure only admins can view
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: bleuLogin.php");
    exit;
}

// Get all clients
$bleusql = "SELECT * FROM users WHERE role = 'client'";
$bleuuserres = $bleuConn->query($bleusql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>View Clients</title>
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
    text-shadow: 2px 2px 3px rgba(255, 255, 255, 0.2);
}

table {
    width: 95%;
    margin: 0 auto;
    border-collapse: collapse;
    background: #ffffff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    border: 1px solid #000000;
}

table thead {
    background: #5b5656;
    color: #ffffff;
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
    background-color: #a8a8a8;
    transform: scale(1.01);
    transition: 0.2s ease;
}

.bleuappbtn {
    background: #ffffff;
    color: #000000;
    border: 2px solid #000000;
    padding: 6px 12px;
    font-size: 0.9rem;
    cursor: pointer;
    border-radius: 6px;
    transition: 0.3s ease;
}

.bleuappbtn:hover {
    background: #000000;
    transform: translateY(-2px);
    box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.2);
}

table td[colspan] {
    font-style: italic;
    color: #000000;
    padding: 20px;
}
</style>
</head>
<body>
<h1>View Clients</h1>
<br><br>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>E-mail</th>
            <th>Username</th>
            <th>Type</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if ($bleuuserres && $bleuuserres->num_rows > 0) {
        while ($bleuusers = $bleuuserres->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($bleuusers['id']) . "</td>";
            echo "<td>" . htmlspecialchars($bleuusers['fname']) . "</td>";
            echo "<td>" . htmlspecialchars($bleuusers['lname']) . "</td>";
            echo "<td>" . htmlspecialchars($bleuusers['email']) . "</td>";
            echo "<td>" . htmlspecialchars($bleuusers['username']) . "</td>";
            echo "<td>Client</td>";
            if ($bleuusers["status"] == 0)  {
                // Only show approve button if not approved
                echo "<td><button class='bleuappbtn' onclick=\"window.location.href='bleuAdminApproveClients.php?bleuid=" . $bleuusers['id'] . "'\">Approve</button></td>";
            } else {
                echo "<td>Approved</td>";
            }
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No clients found.</td></tr>";
    }
    ?>
    </tbody>
</table>
</body>
</html>
