<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mamacare</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>
        Welcome, <?= htmlspecialchars($_SESSION['user']) ?>!
        <?php if (!empty($currentweek)): ?>
            <br>
            You are currently in <strong>week <?= $currentweek ?></strong> of your pregnancy.
        <?php endif; ?>
    </h1>

    <?php if (empty($birthday)): ?>
        <form id="submitform">
            <label>Chọn ngày sinh:</label>
            <input type="date" name="birthday" required>
            <button type="submit">Lưu</button>
        </form>
        <p id="birthday_message"></p>
    <?php else: ?>
        <button id="check-in">Check-in</button>
        <p id="checkin_message"></p>
    <?php endif; ?>
    <button id="logout">Đăng xuất</button>
    <script src="js/index.js"></script>
    <script>
    document.getElementById("logout").onclick = function() {
        fetch("index.php?action=logout", { method: "POST" })
            .then(res => res.text())
            .then(msg => {
                alert(msg);
                window.location.href = "index.php?action=loginpage";
            });
    };
    </script>
</body>
</html>
