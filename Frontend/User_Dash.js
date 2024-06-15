function on(safeHouseName) {
    document.getElementById('overlay-' + safeHouseName).style.display = 'flex';
}

function off(safeHouseName) {
    document.getElementById('overlay-' + safeHouseName).style.display = 'none';
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

function selectRoom(safeHouseName, roomId) {
    var roomList = document.getElementById('roomList-' + safeHouseName);
    var rooms = roomList.getElementsByClassName('room');

    for (var i = 0; i < rooms.length; i++) {
        rooms[i].classList.remove('selected-room');
    }
    document.getElementById(roomId).classList.add('selected-room');
}


function initRoomSelection() {
    var roomElements = document.querySelectorAll('.room');
    roomElements.forEach(function(room) {
        room.addEventListener('click', function() {
            var safeHouseName = room.getAttribute('data-safehouse');
            var roomId = room.getAttribute('id');
            selectRoom(safeHouseName, roomId);
        });
    });
}


document.addEventListener('DOMContentLoaded', function() {
    initRoomSelection();
});
