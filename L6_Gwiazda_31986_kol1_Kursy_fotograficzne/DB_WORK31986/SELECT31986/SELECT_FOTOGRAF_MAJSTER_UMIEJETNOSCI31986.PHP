<?php $sql = "SELECT * FROM fotograf_majster_umiejetonoscikg";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "Id: " . $row["foto_majster_umiejetnosci_idkg"]. "| Umiejętność: " . $row["umiejetnosckg"]. "| Fotograf Id: " . $row["foto_majster_idkg"]. "<br>";
            }
          } else {
            echo "0 results";
          }
          $conn->close();?>