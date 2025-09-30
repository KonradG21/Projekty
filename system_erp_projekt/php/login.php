<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="login-container">
        <h2>Logowanie</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        ?>
        <form action="verify_login.php" method="post">
            <label for="login">Login:</label>
            <input type="text" id="login" name="login" required>
            
            <label for="haslo">Hasło:</label>
            <input type="password" id="haslo" name="haslo" required>
            
            <button type="submit">Zaloguj się</button>
        </form>
    </div>
<?php if (isset($_GET['status']) && $_GET['status'] === 'wylogowano'): ?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        alert("Zostałeś  wylogowany.");

        if (window.history.replaceState) {
            const url = window.location.protocol + "//" + window.location.host + window.location.pathname;
            window.history.replaceState({}, document.title, url);
        }
    });
</script>
<?php endif; ?>


</body>
</html>
