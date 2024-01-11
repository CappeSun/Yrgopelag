<?php
include 'hotelFunctions.php';

$dbName = 'yrgopelag.sqlite3';
$pdo = connect($dbName);

header('Content-Type: application/json');
$response = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $room = $_POST['room'];
    $arrival = $_POST['arrival'];
    $departure = $_POST['departure'];
    $guest = $_POST['guest'];
    $transferCode = $_POST['transferCode']; // Retrieve transfer code from the form

    if (verifyTransferCode($transferCode)) { // Add a function to verify the transfer code
        if (bookRoom($pdo, $room, $arrival, $departure, $guest, $transferCode)) {
            $response['success'] = true;
            $response['message'] = "Booking Successful!";
            $response['booking_info'] = getBookingInfo($guest, $arrival, $departure, $room);
        } else {
            $response['success'] = false;
            $response['message'] = "Booking Failed. Room not available or an error occurred.";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Invalid Transfer Code.";
    }

    echo json_encode($response);
    exit();
}

function verifyTransferCode($transferCode)
{
    return true;
}

function getBookingInfo($guest, $arrival, $departure, $room)
{
    global $pdo;

    $sql = "SELECT island, hotel, arrival, departure, total_cost, stars, features FROM guests
            WHERE guest = '$guest' AND arrival = '$arrival' AND departure = '$departure' AND room = '$room'";

    $result = $pdo->query($sql);

    if ($result && $result->rowCount() > 0) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    return null;
}
