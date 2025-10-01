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
        <?php include '../dbworkkg/addkg/czydodajsalekg.php'?>
        <?php include '../dbworkkg/addkg/dodajsalekg.php'?>
        <table>
        <tr>
            <th>ID spotkania</th>
            <th>Nazwa sali</th>
            <th>Limit osób</th>
            <th>Koszt sali</th>
        </tr>
        <?php include '../dbworkkg/selectkg/selectsalekg.php'?>
        </table>
        <?php include '../mainincludekg/navkg.php'?>
    </article>
    
    <footer>
        <?php include '../mainincludekg/footerkg.php'?>
    </footer>
</body>
</html>