<?php
// index.php
session_start();
if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">User Management</a>
            <div class="navbar-nav ms-auto">
                <span class="navbar-text me-3">
                    Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>
                </span>
                <?php if($_SESSION['is_admin']): ?>
                    <a class="nav-link" href="all_users.php">Manage Users</a>
                <?php endif; ?>
                <a class="nav-link" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <h1>Hello there, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
                        <p class="lead">Welcome to your dashboard</p>
                        <?php if($_SESSION['is_admin']): ?>
                            <div class="alert alert-info">
                                You have administrator privileges.
                            </div>
                            <a href="all_users.php" class="btn btn-primary">Manage Users</a>
                        <?php else: ?>
                            <div class="alert alert-secondary">
                                You have regular user privileges.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>