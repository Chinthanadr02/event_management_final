
document.getElementById("loginForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    fetch("login.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ username, password }),
    })
        .then((response) => response.json())
        .then((data) => {
            console.log(data); // Log server response for debugging
            if (data.success) {
                window.location.href = "events.html"; // Redirect on success
            } else {
                alert(data.error); // Show error message
            }
        })
        .catch((error) => console.error("Error:", error));
});
