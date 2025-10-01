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
        <form action="seesalekg.php" method="POST">
        Id spotkania : <input type="number" name="spotkanie_idkg"><br>
        Nazwa sali : <input type="text" name="nazwa_salikg"><br>
        Limit osób w sali : <input type="number" name="limit_osobkg"><br>
        Koszt sali : <input type="number" name="koszt_salikg"><br>
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