<!-- select -->
<?php $sql = "SELECT * FROM klientkg";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<table>";
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["klient_nazwakg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["cena_talerza"]) . "</td>";
                echo "</tr>";
                echo "</table>";
                
            }
          } else {
            echo "0 results";
          }
?>
<!-- select min -->
<?php $sql = "SELECT * FROM klientkg ORDER BY cena_talerza LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<table>";
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["klient_nazwakg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["cena_talerza"]) . "</td>";
                echo "<td>" . "Min" . "</td>";
                echo "</tr>";
                echo "</table>";
                
            }
          } else {
            echo "0 results";
          }
?>
<!-- select max -->
          <?php $sql = "SELECT * FROM klientkg ORDER BY cena_talerza DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<table>";
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["klient_nazwakg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["cena_talerza"]) . "</td>";
                echo "<td>" . "Max" . "</td>";
                echo "</tr>";
                echo "</table>";
                
            }
          } else {
            echo "0 results";
          }
?>

<!-- AVG -->
<?php $sql = "SELECT ROUND(AVG(cena_talerza), 2) AS medium FROM klientkg";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<table>";
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["medium"]) . "</td>";
                echo "<td>" . "Średnia" . "</td>";
                echo "</tr>";
                echo "</table>";
                
            }
          } else {
            echo "0 results";
          }

          $conn->close();?>


