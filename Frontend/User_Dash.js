function on(safehouseName) {
    document.getElementById('overlay-' + safehouseName).style.display = "block";
}

function off(safehouseName) {
    document.getElementById('overlay-' + safehouseName).style.display = "none";
}

function filterRooms(safehouseName) {
    const selectedType = document.getElementById('roomType-' + safehouseName).value;
    const rooms = document.querySelectorAll('#roomList-' + safehouseName + ' .room');
    
    rooms.forEach(room => {
        if (selectedType === 'all' || room.getAttribute('data-room-type') === selectedType) {
            room.style.display = 'block';
        } else {
            room.style.display = 'none';
        }
    });
}
