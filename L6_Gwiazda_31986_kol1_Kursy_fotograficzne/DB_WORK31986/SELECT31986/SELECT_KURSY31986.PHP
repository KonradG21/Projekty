<?php $sql = "SELECT * FROM kursykg";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              echo "Id: " . $row["kursy_idkg"]. "| Nazwa kursu: " . $row["kursy_nazwakg"]. "| Rodzaje Id: " . $row["rodzaje_idkg"]."<br>";
            }
          } else {
            echo "0 results";
          }
          $conn->close();?>