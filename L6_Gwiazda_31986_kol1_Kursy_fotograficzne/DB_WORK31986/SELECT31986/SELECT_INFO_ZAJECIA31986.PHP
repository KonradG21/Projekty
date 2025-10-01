<?php $sql = "SELECT * FROM info_zajeciakg";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "Id: " . $row["info_zajecia_idkg"]. "| Id umiejętność: " . $row["foto_majster_umiejetnosci_idkg"]. "| Kurs Id: " . $row["kursy_idkg"]."| Koszt: " . $row["koszt_majstrakg"]."| Miejscowośc: " . $row["Miejsce_kursukg"]."<br>";
            }
          } else {
            echo "0 results";
          }
          $conn->close();?>