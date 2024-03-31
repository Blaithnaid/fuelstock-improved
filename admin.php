<?php
session_start();
include_once "functions.php"; // Import createConnection(); function
redirectLogin(); // Check if user is logged in
if (!isset($_SESSION["isAdmin"])) {
    header("Location: select.php");
    exit();
}
$conn = createConnection(); // Create a connection to the database via createConnection();

if (isset($_POST["delete"])) {
    $username = $_POST["delete"];
    $sql = "DELETE FROM users WHERE username='$username'";
    mysqli_query($conn, $sql);
    header("Location: admin.php");
    exit();
} else if (isset($_POST["toggleAdmin"])) {
    $username = $_POST["toggleAdmin"];
    $sql = "SELECT isAdmin FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $isAdmin = $row["isAdmin"];
    if ($isAdmin == 1) {
        $sql = "UPDATE users SET isAdmin=0 WHERE username='$username'";
    } else {
        $sql = "UPDATE users SET isAdmin=1 WHERE username='$username'";
    }
    mysqli_query($conn, $sql);
    header("Location: admin.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Fuel Stock Interface - Admin Console</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div id="contextbox">
        <a href="logout.php"><div>Logout</div></a>
    </div>
    <div class="container">
        <div class="header">
            <h1>Fuel Stock Interface</h1>
            <ul id="menu">
                <li><a href="select.php"><u>Select/Delete/Update</u></a></li>
                <li><a href="insert.php"><u>Insert</u></a></li>
            </ul>
        </div>
        <div class="content">
            <h2>Admin Console</h2>
            <div class="admin">
                <h3>Users</h3>
                <table>
                    <tr>
                        <th>Username</th>
                        <th>Admin</th>
                        <th colspan="2">Actions</th>
                    </tr>
                    <?php
                    $sql = "SELECT * FROM users";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr><td>" . $row["username"] . "</td><td>" . $row["isAdmin"] . "</td>";
                            echo "<td><form method='post' action='admin.php'><input type='hidden' name='delete' value='" . $row["username"] . "'><input type='submit' value='Delete'></form></td>";
                            echo "<td><form method='post' action='admin.php'><input type='hidden' name='toggleAdmin' value='" . $row["username"] . "'><input type='submit' value='Toggle Admin'></form></td></tr>";
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>