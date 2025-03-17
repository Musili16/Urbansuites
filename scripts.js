// Function to get the correct page link based on room type
function getRoomTypePage(roomType) {
    if (!roomType) {
        console.warn("Missing roomType, using default page.");
        return "room_listings.html"; // Default fallback
    }

    let lowerCaseRoomType = roomType.toLowerCase();

    switch (lowerCaseRoomType) {
        case "single room":
            return "single_room.html";
        case "bedsitter":
            return "bedsitter.html";
        case "one bedroom":
            return "one_bedroom.html";
        case "two bedroom":
            return "two_bedroom.html";
        default:
            console.warn("Unknown room type:", roomType);
            return "room_listings.html"; // Fallback
    }
}

// Main function to fetch images and display them on the homepage
document.addEventListener("DOMContentLoaded", function () {
    fetch("get_images.php")
        .then(response => response.json())
        .then(data => {
            console.log("Fetched Data:", data); // Debugging: Log fetched data

            let gallery = document.getElementById("image-gallery");
            gallery.innerHTML = ""; // Clear existing content

            data.forEach(img => {
                console.log("Processing Image:", img); // Debugging: Log each image object

                let roomType = img.type; // Store room type
                console.log("Room Type:", roomType); // Debugging: Check if it's undefined

                let container = document.createElement("div");
                container.className = "image-container";

                // Create the link element
                let link = document.createElement("a");
                link.href = getRoomTypePage(roomType); // Call function
                link.target = "_blank"; // Open in a new tab

                // Create the image element
                let imgElement = document.createElement("img");
                imgElement.src = img.image_url;
                imgElement.alt = roomType;

                // Create the text details
                let details = document.createElement("div");
                details.className = "room-details";
                details.innerHTML = `<strong>${roomType}</strong><br>Status: ${img.status}`;

                // Nest elements properly
                link.appendChild(imgElement);
                container.appendChild(link);
                container.appendChild(details);
                gallery.appendChild(container);
            });
        })
        .catch(error => console.error("Error fetching images:", error));
});

document.addEventListener("DOMContentLoaded", function() {
    const sections = document.querySelectorAll(".image-text-section");

    function revealSections() {
        sections.forEach((section) => {
            const sectionTop = section.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;
            if (sectionTop < windowHeight - 50) {
                section.classList.add("show");
            }
        });
    }

    window.addEventListener("scroll", revealSections);
    revealSections(); // Initial check in case sections are already in view
});


