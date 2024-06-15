<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: Log-In.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout'])) {
    session_destroy();
    header("Location: Log-In.php");
    exit();
}

include 'fetch_data.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard | Codehal</title>
    <link rel="stylesheet" href="CSS/User_dash.css">
  
</head>
<body>
    <div class="tab">
        <div class="sidebar">
            <div class="logo-tab">
                <div class="logo"></div>
                <div class="logo-name">Logo Name</div>
            </div>
            <div class="profile-frame">
                <div class="profile-picture-frame">
                    <div class="ellipse-2"></div>
                    <img class="profile-vector" src="images/Vector0.png" alt="Profile Picture" />
                    <img class="add" src="images/Component1.png" alt="Add Component" />
                </div>
                <div class="text-18"><?php echo $_SESSION['username']; ?></div>
            </div>
        </div>
        <div class="main">
            <div class="header">
                <div class="group-2">
                    <form method="POST">
                        <button type="submit" name="logout" class="next">LOG OUT</button>
                    </form>
                </div>
                <img class="vector2" src="images/Vector1.png" alt="Header Image" />
            </div>
            <div class="frame-14">
                <div class="text-24">Dashboard</div>
            </div>
            <div class="frame-12">
                <div class="frame-13">
                    <div class="text-18">List of Safehouses</div>
                    <?php foreach ($safeHouses as $safeHouse): ?>
                        <div class="sh-box">
                            <div class="sh-name">
                                <div class="text-18"><?php echo $safeHouse['SafeHouseName']; ?></div>
                                <div class="status">
                                    <div class="text-18"><?php echo $safeHouse['Status'] ? 'Open' : 'Closed'; ?></div>
                                    <div class="input-box"></div>
                                </div>
                            </div>
                            <div class="sh-detail">
                                <div class="text-18">Contact Number</div>
                                <div class="input-box"><?php echo $safeHouse['ContactNumber']; ?></div>
                                <div class="text-18">Location</div>
                                <div class="input-box"><?php echo $safeHouse['Location']; ?></div>
                            </div>
                            <div class="register">
                                <button class="text-16" onclick="on('<?php echo $safeHouse['SafeHouseName']; ?>')">Register</button>
                            </div>
                            <div id="overlay-<?php echo $safeHouse['SafeHouseName']; ?>" class="overlay" style="display:none;" onclick="off('<?php echo $safeHouse['SafeHouseName']; ?>')">
                                <div class="sh-detail" onclick="event.stopPropagation()">
                                    <div class="text-18">Safehouse: <?php echo $safeHouse['SafeHouseName']; ?></div>
                                    <div class="text-18">Rooms</div>
                                    <select id="roomType-<?php echo $safeHouse['SafeHouseName']; ?>" onchange="filterRooms('<?php echo $safeHouse['SafeHouseName']; ?>')">
                                        <option value="all">All</option>
                                        <?php 
                                        $roomTypes = array_unique(array_column($safeHouse['rooms'], 'ROOMTYPE_NAME'));
                                        foreach ($roomTypes as $roomType): ?>
                                            <option value="<?php echo $roomType; ?>"><?php echo $roomType; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div id="roomList-<?php echo $safeHouse['SafeHouseName']; ?>">
                                        <?php foreach ($safeHouse['rooms'] as $room): ?>
                                            <div class="input-box room" data-room-type="<?php echo $room['ROOMTYPE_NAME']; ?>">
                                                <?php echo $room['RoomName'] . ' - ' . $room['ROOMTYPE_NAME']; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="register">
                                        <button class="text-16">Register</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <script src="User_Dash.js" defer></script>
                </div>
            </div> 
        </div>
    </div>
</body>
</html>

</html>
