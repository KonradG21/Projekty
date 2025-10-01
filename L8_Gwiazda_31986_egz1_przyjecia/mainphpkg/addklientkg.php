<!Doctype html>
<html lang = pl>

<head>
    <?php include '../mainincludekg/headPartHTMLkg.php'?>
</head>
<body>
    <header>
        <?php include '../mainincludekg/headerkg.php'?>
    </header>
    <article>
    <h2>Dodaj nowy wpis</h2>
        <form action="seeklientkg.php" method="POST">
        Imie klienta : <input type="text" name="klient_nazwakg"><br>
        Cena talerza : <input type="number" name="cena_talerza"><br>
        <button type="submit" value="save">Wyślij</button>
        </form> <br>
        <?php include '../mainincludekg/articlekg.php'?>
        <img src="..\imgkg\przyjecie.jpg" alt="image"><br>
        <?php include '../mainincludekg/navkg.php'?>
    </article>
    
    <footer>
        <?php include '../mainincludekg/footerkg.php'?>
    </footer>
</body>
</html>