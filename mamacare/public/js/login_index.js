const registerBtn = document.getElementById("register");
registerBtn.onclick = function () {
    document.getElementById("login_message").style.display = "none";
    document.getElementById("login_form").style.display = "none";
    document.getElementById("register_form").style.display = "block";
};
document.getElementById("showregister").onclick = function(event) {
    document.getElementById("login_message").style.display = "block";
    document.getElementById("login_form").style.display = "block";
    document.getElementById("register_form").style.display = "none";
}

document.getElementById("login_form").onsubmit = function(event) {
    event.preventDefault();  
    const formData = new FormData(this);
    fetch("index.php?action=login", { 
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        document.getElementById("login_message").textContent = result;
        if (result.includes("Login successful")) {
            window.location.href = "index.php?action=main";
        } else {
            this.reset();
        }
    })
    .catch(err => {
        console.error("Fetch error:", err);
        document.getElementById("login_message").textContent = "Đã có lỗi, vui lòng thử lại";
    });
};

document.getElementById("register_form").onsubmit = function (event) {
    document.getElementById("login_message").style.display = "block";
    event.preventDefault();
    const formData = new FormData(this);
    fetch("index.php?action=register", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        document.getElementById("login_message").textContent = result;
        if (result.includes("register success")) {
            window.location.href = "index.php?action=main";
        }
        else {
            this.reset();
        }
    })
    .catch(err => {
        console.error("Fetch error:", err);
        document.getElementById("login_message").textContent = "Đã có lỗi, vui lòng thử lại";
    });
};
