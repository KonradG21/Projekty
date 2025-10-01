<?php $sql = "SELECT * FROM rodzajekg";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "Id: " . $row["rodzaje_idkg"]. "| Rodzaj: " . $row["rodzaje_nazwakg"]. "<br>";
            }
          } else {
            echo "0 results";
          }
          $conn->close();?>