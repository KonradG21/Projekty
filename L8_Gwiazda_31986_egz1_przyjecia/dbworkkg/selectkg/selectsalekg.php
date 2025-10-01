<!-- select -->
<?php $sql = "SELECT * FROM sale_kg";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<table>";
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["spotkanie_idkg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["nazwa_salikg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["limit_osobkg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["koszt_salikg"]) . "</td>";
                echo "</tr>";
                echo "</table>";
                
            }
          } else {
            echo "0 results";
          }?>
<!-- min -->
<?php $sql = "SELECT * FROM sale_kg ORDER BY koszt_salikg LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<table>";
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["spotkanie_idkg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["nazwa_salikg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["limit_osobkg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["koszt_salikg"]) . "</td>";
                echo "<td>" . "Min" . "</td>";
                echo "</tr>";
                echo "</table>";
                
            }
          } else {
            echo "0 results";
          }?>
<!-- max -->
<?php $sql = "SELECT * FROM sale_kg ORDER BY koszt_salikg DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<table>";
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["spotkanie_idkg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["nazwa_salikg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["limit_osobkg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["koszt_salikg"]) . "</td>";
                echo "<td>" . "Max" . "</td>";
                echo "</tr>";
                echo "</table>";
                
            }
          } else {
            echo "0 results";
          }?>
<!-- średnia -->
<?php $sql = "SELECT ROUND(AVG(koszt_salikg), 2) AS medium FROM sale_kg";
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