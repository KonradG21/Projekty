<!Doctype html>
<html lang = en>

<head>
    <?php include '../MAIN_INCLUDE31986/HEADPARTHTML31986.PHP'?>
</head>
<body>
    <header>
        <?php include '../MAIN_INCLUDE31986/HEADER31986.PHP'?>
    </header>
    <article>
    <h2>Dodaj nowy wpis</h2>
    <form action="SEE_FOTOGRAF_MAJSTER_UMIEJETNOSCI31986.PHP" method="POST">
        Rodzaj umiejetności : <input type="text" name="umiejetnosckg"><br>
        Id fotografa : <input type="number" name="foto_majster_idkg"><br>
        <button type="submit" value="save">Wyślij</button>
    </form><br>
        <?php include '../MAIN_INCLUDE31986/ARTICLE31986.PHP'?>
        <img src="..\IMG31986\fotografia31986.jpg" alt="image"><br>
        <?php include '../MAIN_INCLUDE31986/NAV31986.PHP'?>
    </article>
    
    <footer>
        <?php include '../MAIN_INCLUDE31986/FOOTER31986.PHP'?>
    </footer>
</body>
</html>