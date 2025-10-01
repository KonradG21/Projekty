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
        <?php include '../dbworkkg/addkg/czydodajklienta.php'?>
        <?php include '../dbworkkg/addkg/dodajklientakg.php'?>
        <table>
        <tr>
            <th>Imie</th>
            <th>Cena talerza</th>
        </tr>
        <?php include '../dbworkkg/selectkg/selectklientakg.php'?>
        </table>
        <?php include '../mainincludekg/navkg.php'?>
    </article>
    
    <footer>
        <?php include '../mainincludekg/footerkg.php'?>
    </footer>
</body>
</html>