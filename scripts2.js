//Admin Login
document.getElementById("adminLoginForm").addEventListener("submit", function (event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch("admin_login.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.includes("Invalid")) {
            document.getElementById("error-message").textContent = "Invalid Username or Password!";
        } else {
            window.location.href = "admin_dashboard.php";
        }
    })
    .catch(error => console.error("Error:", error));
});