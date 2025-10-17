<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight request
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// Get the raw POST data from Fetch API
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Check if all required fields are present
if (!isset($data['cash']) || !isset($data['quantity']) || !isset($data['price'])) {
    echo json_encode([
        'success' => false,
        'message' => 'All fields (cash, quantity, price) are required.'
    ]);
    exit;
}

$cash = floatval($data['cash']);
$quantity = intval($data['quantity']);
$price = floatval($data['price']);

// Validate inputs for empty values
if (empty($cash) && $cash !== 0 || empty($quantity) || empty($price)) {
    echo json_encode([
        'success' => false,
        'message' => 'All fields must have a value. Cash, quantity, and price cannot be empty.'
    ]);
    exit;
}

// Validate amount values
if ($cash < 0 || $quantity < 1 || $price < 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid input values. Cash must be >= 0, quantity >= 1, and price >= 0.'
    ]);
    exit;
}

// Calculate total cost
$totalCost = $price * $quantity;

// Check if cash is sufficient
if ($cash < $totalCost) {
    echo json_encode([
        'success' => false,
        'message' => "Insufficient cash. Total cost is ₱" . number_format($totalCost, 2) . " but you only provided ₱" . number_format($cash, 2) . "."
    ]);
    exit;
}

// Calculate change
$change = $cash - $totalCost;

// Return success response with change
echo json_encode([
    'success' => true,
    'message' => 'Thank you for your purchase! Your order has been processed successfully.',
    'change' => $change,
    'total_cost' => $totalCost,
    'items_purchased' => $quantity
]);