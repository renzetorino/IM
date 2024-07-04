<?php include 'User-Dash-access.php'; ?>
<?php include 'fetch_data.php'; ?>
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
                <div class="logo">
                    <img src ="css/logo.png" alt = "Logo" class = "logo-img">
                </div>
                <div class="logo-name">Safe Disaster Center</div>
            </div>
            <div class="profile-frame">
                <div class="profile-picture-frame">
                    <div class="ellipse-2"></div>
                    <img class="profile-vector" src="css/Vector0.png" alt="Profile Picture" />
                    <img class="add" src="css/Component 1.png" alt="Add Component" />
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
                <img class="vector2" src="css/Vector1.png" alt="Header Image" />
            </div>
            <div class="frame-14">
                <div class="text-24">Dashboard</div>
            </div>
            <div class="frame-12">
                <div class="frame-13">
                    <?php if ($assignedRoom): ?>
                        <table class="assigned-room">
                        <caption class="text-18">You are assigned to Room <?php echo $assignedRoom['RoomName']; ?> in Safehouse <?php echo $assignedRoom['SafeHouseName']; ?></caption>
                        <thead>
                            <tr>
                                <th>Safehouse Name</th>
                                <th>Room Name</th>
                                <th>Room ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?php echo $assignedRoom['SafeHouseName']; ?></td>
                                <td><?php echo $assignedRoom['RoomID']; ?></td>
                                <td><?php echo $assignedRoom['RoomName']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php else: ?>
                        <div class="text-18">List of Safehouses</div>
                        <?php foreach ($safeHouses as $safeHouse): ?>
                            <div class="sh-box" id="safehouse-<?php echo $safeHouse['SafeHouseName']; ?>">
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
                                    <button class="text-16" onclick="showDetailFrame('<?php echo $safeHouse['SafeHouseName']; ?>')">Register</button>
                                </div>
                            </div>
                            <div id="detail-frame-<?php echo $safeHouse['SafeHouseName']; ?>" class="detail-frame">
                                <div class="sh-detail">
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
                                    <div id="roomList-<?php echo $safeHouse['SafeHouseName']; ?>" class="room-list">
                                        <?php foreach ($safeHouse['rooms'] as $room): ?>
                                            <button class="input-box room" 
                                                    id="<?php echo $room['RoomID']; ?>" 
                                                    data-room-type="<?php echo $room['ROOMTYPE_NAME']; ?>" 
                                                    data-safehouse="<?php echo $safeHouse['SafeHouseName']; ?>"
                                                    onclick="toggleRoomSelection(this)">
                                                <?php echo $room['RoomName'] . ' - ' . $room['ROOMTYPE_NAME']; ?>
                                            </button>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="register">
                                        <form method="POST">
                                            <input type="hidden" name="room_id" value="" id="selected-room-id-<?php echo $safeHouse['SafeHouseName']; ?>">
                                            <button type="submit" name="register" class="text-16" onclick="setRoomID('<?php echo $safeHouse['SafeHouseName']; ?>')">Register</button>
                                        </form>
                                    </div>
                                    <div class="register">
                                        <button type="button" class="text-16" onclick="hideDetailFrame('<?php echo $safeHouse['SafeHouseName']; ?>')">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div> 
        </div>
    </div>
    <script src="User_Dash.js" defer></script>
</body>
</html>
