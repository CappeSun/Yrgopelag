<?php

include 'hotelFunctions.php';

$dbName = 'yrgopelag.sqlite3';

$pdo = connect($dbName);

if (isRoomAvailable($pdo, 'standard', '2024-01-04', '2024-01-18')) {
    echo 'Room is available!';
} else {
    echo 'Room is not available!';
}

function isRoomAvailable(PDO $pdo, string $room, string $arrival, string $departure): bool
{
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM guests 
            WHERE room = :room 
            AND (
                (arrival >= :arrival AND arrival < :departure) OR
                (departure > :arrival AND departure <= :departure) OR
                (arrival <= :arrival AND departure >= :departure)
            )");

        $stmt->bindParam(':room', $room);
        $stmt->bindParam(':arrival', $arrival);
        $stmt->bindParam(':departure', $departure);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return ($result['count'] == 0);
    } catch (PDOException $e) {
        echo "Error checking room availability: " . $e->getMessage();
        throw $e;
    }
}

function bookRoom(PDO $pdo, $room, $arrival, $departure, $guest, $transferCode)
{
    if (!isRoomAvailable($pdo, $room, $arrival, $departure)) {
        return false;
    }


    $numberOfDays = (strtotime($departure) - strtotime($arrival)) / (60 * 60 * 24);


    $dailyRate = 10;


    $cost = $numberOfDays * $dailyRate;

    $insertSql = "INSERT INTO guests (arrival, departure, guest, room, cost, transfer_code)
        VALUES ('$arrival', '$departure', '$guest', '$room', '$cost', '$transferCode')";

    $stmt = $pdo->prepare($insertSql);
    if ($stmt->execute()) {

        echo "Total Cost: €$cost<br>";


        $response['total_cost'] = $cost;

        return true;
    } else {
        return false;
    }
}
