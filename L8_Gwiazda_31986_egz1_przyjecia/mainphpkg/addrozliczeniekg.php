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
        <form action="seerozliczeniekg.php" method="POST">
        Id rezerwacji : <input type="number" name="rezerwacja_idkg"><br>
        Id sali : <input type="number" name="sale_idkg"><br>
        Koszt całkowity : <input type="number" name="kosztcałykg"><br>
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