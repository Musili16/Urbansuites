document.getElementById("adminLoginForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    fetch("admin_login.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: `username=${username}&password=${password}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            window.location.href = "admin_dashboard.html";
        } else {
            document.getElementById("errorMessage").textContent = "Invalid Username or Password";
        }
    })
    .catch(error => console.error("Error:", error));
});
