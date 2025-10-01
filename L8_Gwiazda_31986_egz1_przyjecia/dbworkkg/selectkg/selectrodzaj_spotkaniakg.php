<?php $sql = "SELECT * FROM rodzaje_spotkankg";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<table>";
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["spotkanie_nazwakg"]) . "</td>";
                echo "</tr>";
                echo "</table>";
                
            }
          } else {
            echo "0 results";
          }
          $conn->close();?>