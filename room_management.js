document.addEventListener("DOMContentLoaded", function () {
    fetchRooms();
});

function fetchRooms() {
    fetch("get_rooms.php")
        .then(response => response.json())
        .then(data => {
            let tableBody = document.getElementById("roomTableBody");
            tableBody.innerHTML = "";

            data.forEach(room => {
                let row = document.createElement("tr");

                row.innerHTML = `
                    <td>${room.type}</td>
                    <td>${room.total_rooms}</td>
                    <td><input type="number" min="0" value="${room.available_rooms}" id="available_${room.id}" /></td>
                    <td><button onclick="updateRoom(${room.id})">Update</button></td>
                `;

                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error("Error fetching room data:", error));
}

function updateRoom(roomId) {
    let availableRooms = document.getElementById(`available_${roomId}`).value;

    fetch("update_room_count.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `room_id=${roomId}&available_rooms=${availableRooms}`
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        fetchRooms(); // Refresh the table
    })
    .catch(error => console.error("Error updating room:", error));
}
