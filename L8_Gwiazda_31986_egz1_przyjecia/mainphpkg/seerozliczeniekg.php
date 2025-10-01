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
        <?php include '../mainincludekg/articlekg.php'?>
        <img src="..\imgkg\przyjecie.jpg" alt="image"><br>
        <?php include '../dbincludekg/dbkg.php'?>
        <?php include '../dbworkkg/addkg/czydodajrozliczeniekg.php'?>
        <?php include '../dbworkkg/addkg/dodajrozliczeniekg.php'?>
        <table>
        <tr>
            <th>ID rezerwacji</th>
            <th>Id sali</th>
            <th>Koszt całkowity</th>
        </tr>
        <?php include '../dbworkkg/selectkg/selectrozliczeniekg.php'?>
        </table>
        <?php include '../mainincludekg/navkg.php'?>
    </article>
    
    <footer>
        <?php include '../mainincludekg/footerkg.php'?>
    </footer>
</body>
</html>