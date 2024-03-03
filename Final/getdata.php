<?php
  // Include the database connection class
  include 'database.php';

  // Check if POST data is not empty
  if (!empty($_POST['id'])) {
    // Store the id from POST data
    $id = $_POST['id'];

    // Create an empty object to store data
    $myObj = new stdClass();

    // Establish a database connection
    $pdo = Database::connect();

    // Prepare and execute the SQL query to retrieve data based on id
    $sql = 'SELECT * FROM esp32_table_dht11_leds_update WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Fetch the data and format it into JSON
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
      $date = date_create($row['date']);
      $dateFormat = date_format($date, "d-m-");

      // Populate the object with fetched data
      $myObj->id = $row['id'];
      $myObj->temperature = $row['temperature'];
      $myObj->humidity = $row['humidity'];
      $myObj->status_read_sensor_dht11 = $row['status_read_sensor_dht11'];
      $myObj->fertilizer = $row['fertilizer'];
      $myObj->Water_Level = $row['Water_level'];
      $myObj->FAN_01 = $row['FAN_01'];
      $myObj->FAN_02 = $row['FAN_02'];
      $myObj->ls_time = $row['time'];
      $myObj->ls_date = $dateFormat;

      // Convert the object to JSON format
      $myJSON = json_encode($myObj);

      // Output the JSON data
      echo $myJSON;
    } else {
      echo json_encode(array("message" => "No record found with the given id."));
    }

    // Close the database connection
    Database::disconnect();
  } else {
    echo json_encode(array("message" => "ID parameter is missing."));
  }
?>
