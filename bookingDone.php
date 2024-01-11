<?php

function displayBookingInfo($guest, $arrival, $departure, $room)
{
    global $conn;

    $sql = "SELECT island, hotel, total_cost, stars, features FROM guests
            WHERE guest = '$guest' AND arrival = '$arrival' AND departure = '$departure' AND room = '$room'";

    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();


        echo "Island: " . $row['island'] . "<br>";
        echo "Hotel: " . $row['hotel'] . "<br>";
        echo "Arrival Date: " . $arrival . "<br>";
        echo "Departure Date: " . $departure . "<br>";
        echo "Total Cost: $" . $row['total_cost'] . "<br>";
        echo "Stars: " . $row['stars'] . "<br>";
        echo "Features: " . $row['features'] . "<br>";


        $logData = array(
            'guest' => $guest,
            'arrival' => $arrival,
            'departure' => $departure,
            'room' => $room,
            'island' => $row['island'],
            'hotel' => $row['hotel'],
            'total_cost' => $row['total_cost'],
            'stars' => $row['stars'],
            'features' => $row['features']
        );

        $logbookFile = __DIR__ . '/logbook.json';
        $logbookData = json_decode(file_get_contents($logbookFile), true);


        $logbookData[] = $logData;

        file_put_contents($logbookFile, json_encode($logbookData, JSON_PRETTY_PRINT));
    }
}
