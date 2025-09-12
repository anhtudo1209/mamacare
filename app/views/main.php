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
    </h1>
    <h2>
        <?php if (!empty($currentweek)): ?>
        You are currently in <strong>week <?= $currentweek ?></strong> of your pregnancy.
        <?php endif; ?>
    </h2>
    <?php if (empty($firstday)): ?>
    <form id="submitfirstday">
        <label>Chọn ngày thụ thai:</label>
        <input type="date" name="firstday">
        <button type="submit">Lưu</button>
    </form>
    <p id="birthday_message"></p>
    <?php else: ?>
    <button id="check-in">Check-in</button>
    <p id="checkin_message"></p>
    <?php endif; ?>
    <button id="logout" href="index.php?action=logout">Đăng xuất</button>
    <script src="js/index.js"></script>
</body>

</html>