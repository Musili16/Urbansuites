document.addEventListener("DOMContentLoaded", function() {
    fetch("get_room_summary.php")
        .then(response => response.json())
        .then(data => {
            let tableBody = document.querySelector("#roomSummaryTable tbody");
            tableBody.innerHTML = ""; // Clear existing rows

            data.forEach(room => {
                let row = document.createElement("tr");
                row.innerHTML = `
                    <td>${room.type}</td>
                    <td>${room.available}</td>
                    <td>${room.booked}</td>
                `;
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error("Error fetching room summary:", error));
});
