
const checkinbtn = document.getElementById("check-in");
if (checkinbtn) {
    checkinbtn.onclick = function() {
        fetch("index.php?action=checkin", {   
            method: "POST"
        })
        .then(response => response.text())
        .then(data => {
            document.getElementById("checkin_message").innerHTML = data;
        })
        .catch(err => {
            console.error("check-in failed", err);
            document.getElementById("checkin_message").textContent = "Đã có lỗi, vui lòng thử lại";
        });
    };
}

const submitform = document.getElementById("submitfirstday");
if (submitform) {
    submitform.onsubmit = function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        fetch("index.php?action=savefirstday", {
            method: "POST",
            body: formData
        })
        .then(response => {
            if (response.redirected) {
                window.location.href = response.url;
            } else {
                return response.text();
            }
        })
        .then(result => {
            if (result) {
                document.getElementById("birthday_message").textContent = result;
            }
        })
        .catch(err => {
            console.error("Fetch error:", err);
            document.getElementById("birthday_message").textContent = "Đã có lỗi, vui lòng thử lại";
        });
    };
}

document.getElementById("logout").onclick = () => {
    window.location.href = "index.php?action=logout";
};
