<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$country = $_GET['country'] ?? '';
$lookup = $_GET['lookup'] ?? '';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);


    if ($lookup === 'cities') {
      $stmt = $conn->prepare("
      SELECT cities.name AS Name, cities.district AS District, cities.population AS Population
      FROM cities
      INNER JOIN countries ON countries.code = cities.country_code
      WHERE countries.name LIKE :country
      ");
      $stmt->execute(['country' => "%$country%"]);
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table>
                <tr>
                    <th>Name</th>
                    <th>District</th>
                    <th>Population</th>
                </tr>";
        foreach ($results as $row) {
            echo "<tr>
                    <td>{$row['Name']}</td>
                    <td>{$row['District']}</td>
                    <td>{$row['Population']}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
      $stmt = $conn->prepare("
      SELECT *
      FROM countries
      WHERE name LIKE :country");
      $stmt->execute(['country' => "%$country%"]);
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table>
                <tr>
                    <th>Name</th>
                    <th>Continent</th>
                    <th>Independence</th>
                    <th>Head of State</th>
                </tr>";
        foreach ($results as $row) {
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['continent']}</td>
                    <td>{$row['independence_year']}</td>
                    <td>{$row['head_of_state']}</td>
                  </tr>";
        }
        echo "</table>";
    }
?>
