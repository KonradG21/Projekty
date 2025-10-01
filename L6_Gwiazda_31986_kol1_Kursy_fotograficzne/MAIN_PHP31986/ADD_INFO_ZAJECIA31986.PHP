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
    <form action="SEE_INFO_ZAJECIA31986.PHP" method="POST">
        Id rodzaj umiejetności : <input type="number" name="foto_majster_umiejetnosci_idkg"><br>
        Id kursu : <input type="number" name="kursy_idkg"><br>
        Koszt kursu : <input type="number" name="koszt_majstrakg"><br>
        Miejsce kursu : <input type="text" name="Miejsce_kursukg"><br>
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