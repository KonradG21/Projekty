<?php $sql = "SELECT * FROM rezerwacje_klientakg";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<table>";
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["klient_idkg"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["iloscosobkg"]) . "</td>";
                echo "</tr>";
                echo "</table>";
                
            }
          } else {
            echo "0 results";
          }
          $conn->close();?>