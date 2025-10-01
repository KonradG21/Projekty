<!-- select -->
<?php $sql = "SELECT * FROM rozliczenie";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<table>";
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["rezerwacja_idkg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["sale_idkg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["kosztcałykg"]) . "</td>";
                echo "</tr>";
                echo "</table>";
                
            }
          } else {
            echo "0 results";
          }?>
<!-- min -->
<?php $sql = "SELECT * FROM rozliczenie ORDER BY kosztcałykg LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<table>";
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["rezerwacja_idkg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["sale_idkg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["kosztcałykg"]) . "</td>";
                echo "<td>" . "Min" . "</td>";
                echo "</tr>";
                echo "</table>";
                
            }
          } else {
            echo "0 results";
          }?>
<!-- max -->
<?php $sql = "SELECT * FROM rozliczenie ORDER BY kosztcałykg DESC LIMIT 1";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<table>";
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["rezerwacja_idkg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["sale_idkg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["kosztcałykg"]) . "</td>";
                echo "<td>" . "Max" . "</td>";
                echo "</tr>";
                echo "</table>";
                
            }
          } else {
            echo "0 results";
          }?>
<!-- średnia -->
<?php $sql = "SELECT ROUND(AVG(kosztcałykg), 2) AS medium FROM rozliczenie";
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