<?php
require_once __DIR__ . '/../../includes/db.php';
header('Content-Type: application/json');
$pdo = getPDO();
$data = [
    'name' => $_POST['name'] ?? '',
    'email' => $_POST['email'] ?? '',
    'phone' => $_POST['phone'] ?? '',
    'destination' => $_POST['destination'] ?? '',
    'travel_date' => $_POST['travel_date'] ?? null,
    'num_persons' => $_POST['num_persons'] ?? null,
    'message' => $_POST['message'] ?? '',
    'package_id' => $_POST['package_id'] ?? null,
];
if (!$data['name'] || !$data['email']) {
    echo json_encode(['success'=>false,'message'=>'Name and Email are required']);
    exit;
}
try {
    $stmt = $pdo->prepare('INSERT INTO bookings (name,email,phone,package_id,destination,travel_date,num_persons,message) VALUES (?,?,?,?,?,?,?,?)');
    $stmt->execute([$data['name'],$data['email'],$data['phone'],$data['package_id'],$data['destination'],$data['travel_date'],$data['num_persons'],$data['message']]);
    echo json_encode(['success'=>true,'message'=>'Booking submitted. We will contact you soon.']);
} catch(Exception $e){
    echo json_encode(['success'=>false,'message'=>'Server error: '.$e->getMessage()]);
}
?>