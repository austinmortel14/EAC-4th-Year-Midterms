<?php
// api.php
session_start();
require_once 'config.php';

header('Content-Type: application/json');

$action = $_POST['action'] ?? '';

try {
    switch($action) {
        case 'register':
            registerUser($pdo);
            break;
        case 'login':
            loginUser($pdo);
            break;
        case 'get_users':
            getUsers($pdo);
            break;
        case 'add_user':
            addUser($pdo);
            break;
        case 'check_username':
            checkUsername($pdo);
            break;
        default:
            echo json_encode(['success' => false, 'message' => 'Invalid action']);
    }
} catch(Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}

function registerUser($pdo) {
    $username = trim($_POST['username']);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if(empty($username) || empty($firstname) || empty($lastname) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        return;
    }

    if(strlen($password) < 8) {
        echo json_encode(['success' => false, 'message' => 'Password must be at least 8 characters']);
        return;
    }

    if($password !== $confirm_password) {
        echo json_encode(['success' => false, 'message' => 'Passwords do not match']);
        return;
    }

    // Check if username exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Username already exists']);
        return;
    }

    // Insert user (PLAIN TEXT PASSWORD)
    $stmt = $pdo->prepare("INSERT INTO users (username, firstname, lastname, password) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $firstname, $lastname, $password]);

    $_SESSION['user_id'] = $pdo->lastInsertId();
    $_SESSION['username'] = $username;
    $_SESSION['is_admin'] = false;

    echo json_encode(['success' => true, 'message' => 'Registration successful']);
}

function loginUser($pdo) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if(empty($username) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Username and password are required']);
        return;
    }

    $stmt = $pdo->prepare("SELECT id, username, password, is_admin FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // PLAIN TEXT PASSWORD COMPARISON
    if($user && $password === $user['password']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['is_admin'] = $user['is_admin'];
        echo json_encode(['success' => true, 'message' => 'Login successful']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
    }
}

function getUsers($pdo) {
    if(!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        return;
    }

    $search = $_POST['search'] ?? '';
    
    if($search) {
        $stmt = $pdo->prepare("SELECT id, username, firstname, lastname, is_admin, date_added FROM users 
                              WHERE username LIKE ? OR firstname LIKE ? OR lastname LIKE ? 
                              ORDER BY date_added DESC");
        $searchTerm = "%$search%";
        $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
    } else {
        $stmt = $pdo->prepare("SELECT id, username, firstname, lastname, is_admin, date_added FROM users ORDER BY date_added DESC");
        $stmt->execute();
    }

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(['success' => true, 'users' => $users]);
}

function addUser($pdo) {
    if(!isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        return;
    }

    $username = trim($_POST['username']);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $password = $_POST['password'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    // Validation
    if(empty($username) || empty($firstname) || empty($lastname) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        return;
    }

    if(strlen($password) < 8) {
        echo json_encode(['success' => false, 'message' => 'Password must be at least 8 characters']);
        return;
    }

    // Check if username exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Username already exists']);
        return;
    }

    // Insert user (PLAIN TEXT PASSWORD)
    $stmt = $pdo->prepare("INSERT INTO users (username, firstname, lastname, password, is_admin) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$username, $firstname, $lastname, $password, $is_admin]);

    echo json_encode(['success' => true, 'message' => 'User added successfully']);
}

function checkUsername($pdo) {
    $username = trim($_POST['username']);
    
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $exists = $stmt->fetch() ? true : false;
    
    echo json_encode(['exists' => $exists]);
}