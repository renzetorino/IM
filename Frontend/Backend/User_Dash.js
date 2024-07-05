function showDetailFrame(safeHouseName) {
    const detailFrame = document.getElementById('detail-frame-' + safeHouseName);
    detailFrame.style.display = 'flex'; 
}

function hideDetailFrame(safeHouseName) {
    const detailFrame = document.getElementById('detail-frame-' + safeHouseName);
    detailFrame.style.display = 'none';
}

function setRoomID(safeHouseName) {
    const roomList = document.getElementById('roomList-' + safeHouseName);
    const selectedRoom = roomList.querySelector('.room.selected');

    if (selectedRoom) {
        document.getElementById('selected-room-id-' + safeHouseName).value = selectedRoom.id;
        hideDetailFrame(safeHouseName); 
    } else {
        alert("No room selected.");
    }
}

function filterRooms(safeHouseName) {
    var selectedRoomType = document.getElementById('roomType-' + safeHouseName).value;
    var roomList = document.getElementById('roomList-' + safeHouseName);
    var rooms = roomList.getElementsByClassName('room');

    for (var i = 0; i < rooms.length; i++) {
        if (selectedRoomType == 'all' || rooms[i].getAttribute('data-room-type') == selectedRoomType) {
            rooms[i].style.display = 'block';
        } else {
            rooms[i].style.display = 'none';
        }
    }
}
function toggleRoomSelection(roomElement) {
    const allRoomButtons = document.querySelectorAll('.input-box.room');
    allRoomButtons.forEach(btn => {
        btn.classList.remove('selected');
    });
    roomElement.classList.add('selected');
}