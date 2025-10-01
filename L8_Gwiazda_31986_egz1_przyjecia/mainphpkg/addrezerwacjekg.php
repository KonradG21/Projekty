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
        <form action="seerezerwacjekg.php" method="POST">
        Id klienta : <input type="number" name="klient_idkg"><br>
        Ilośc osób : <input type="number" name="iloscosobkg"><br>
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