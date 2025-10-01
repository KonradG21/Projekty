<?php $sql = "SELECT * FROM fotograf_majsterkg";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "Id: " . $row["foto_majster_idkg"]. "| Umiejętność: " . $row["foto_majster_imiekg"]. "<br>";
            }
          } else {
            echo "0 results";
          }
          $conn->close();?>