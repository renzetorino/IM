<?php
session_start();

if (!isset($_SESSION['firstname'])) {
    header("Location: ADMIN-Log-In.php");
    exit();
}

include 'database.php'; 

if (isset($_POST['Logout'])) {
    session_destroy();
    header("Location: Admin-Log-In.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN-PANEL</title>
    <style>
        body {
            margin: 0px;
        }
        div.header {
            font-family: poppins;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0px 60px;
            background-color: lightblue;
        }
        div.header button {
            background-color: beige;
            font-size: 16px;
            font-weight: 550;
            padding: 8px 12px;
            border: 2px solid black;
            border-radius: 5px;
        }
        div.Panels {
            text-align: center;
            margin-top: 20px; 
            background-color: whitesmoke;
            border: 2px solid black;
        }
        div.Panels button {
            background-color: pink;
            font-size: 16px;
            font-weight: 550;
            padding: 12px 48px;
            border: 2px solid black;
            border-radius: 5px;
            margin: 100px; 
        }
        form {
            margin: 20px;
        }
        input, select {
            margin: 10px;
            padding: 10px;
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: lightgrey;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="header">
    <H1>Admin panel = <?php echo $_SESSION['firstname']?></H1>
        <form method="post">
            <button name="Logout">LOG OUT</button>
        </form>
    </div>

    <div class="Panels">
        <form method="post" action ="admin-panel.php" style="display: inline-block;">
            <button name="Button2">USER INFO</button>
        </form>
        <form method="post" action="admin-panel-safehouses.php" style="display: inline-block;">
            <button name="Button3">SAFEHOUSES</button>
        </form>
        <form method="post" action="admin-panel-assign.php" style="display: inline-block;">
            <button name="Button4">ASSIGN</button>
        </form>
    </div>

    <div class="Tables">
        <h2>Add Safehouse</h2>
        <form method="post" action="Safehouse-Admin-access.php">
            <input type="text" name="safehouse_name" placeholder="Safehouse Name" required>
            <input type="text" name="location" placeholder="Location" required>
            <input type="text" name="contact_number" placeholder="Contact Number" required>
            <label>
                Status:
                <select name="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </label>
            <button type="submit" name="add_safehouse">Add Safehouse</button>
        </form>

        <h2>Safehouses</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Contact Number</th>
                <th>Status</th>
            </tr>
            <?php
            include 'database.php';
            $result = $pdo->query("SELECT * FROM Safe_Houses");
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$row['SafeHouseID']}</td>
                        <td>{$row['SafeHouseName']}</td>
                        <td>{$row['Location']}</td>
                        <td>{$row['ContactNumber']}</td>
                        <td>" . ($row['Status'] ? 'Active' : 'Inactive') . "</td>
                      </tr>";
            }
            ?>
        </table>

        <h2>Add Room</h2>
        <form method="post" action="Room-Admin-access.php">
            <input type="text" name="room_name" placeholder="Room Name" required>
            <input type="number" name="capacity" placeholder="Capacity" required>
            <label>
                Safehouse:
                <select name="safehouse_id" required>
                    <?php
                    $result = $pdo->query("SELECT SafeHouseID, SafeHouseName FROM Safe_Houses");
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['SafeHouseID']}'>{$row['SafeHouseName']}</option>";
                    }
                    ?>
                </select>
            </label>
            <label>
                Room Type:
                <select name="room_type_id" required>
                    <?php
                    $result = $pdo->query("SELECT ROOMTYPE_ID, ROOMTYPE_NAME FROM ROOMTYPE");
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='{$row['ROOMTYPE_ID']}'>{$row['ROOMTYPE_NAME']}</option>";
                    }
                    ?>
                </select>
            </label>
            <button type="submit" name="add_room">Add Room</button>
        </form>

        <h2>Rooms</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Capacity</th>
                <th>Safehouse</th>
                <th>Room Type</th>
            </tr>
            <?php
            $result = $pdo->query("SELECT Rooms.*, Safe_Houses.SafeHouseName, ROOMTYPE.ROOMTYPE_NAME 
                                   FROM Rooms 
                                   JOIN Safe_Houses ON Rooms.SafeHouseID = Safe_Houses.SafeHouseID
                                   JOIN ROOMTYPE ON Rooms.ROOMTYPE_ID = ROOMTYPE.ROOMTYPE_ID");
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$row['RoomID']}</td>
                        <td>{$row['RoomName']}</td>
                        <td>{$row['CAPACITY']}</td>
                        <td>{$row['SafeHouseName']}</td>
                        <td>{$row['ROOMTYPE_NAME']}</td>
                      </tr>";
            }
            ?>
        </table>
    </div>

    <?php
    if (isset($_POST['Logout'])) {
        session_destroy();
        header("location: Admin-Log-In.php");
    }
    ?>
</body>
</html>
