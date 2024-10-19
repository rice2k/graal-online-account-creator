<?php
require("misc.php"); // Miscellaneous functions or configurations
require("db_config.php"); // Ensure database connection configurations are loaded

session_start(); // Start a session to manage the CSRF token

// CSRF Token generation - Protect against Cross-Site Request Forgery attacks
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generate a random CSRF token
}

// Default variables for handling page routing and input sanitization
$page = $_GET['page'] ?? ''; // Get 'page' from the URL, default to empty string if not set
$username = strtolower($_POST['username'] ?? ''); // Sanitize username input (convert to lowercase)
$password = $_POST['password'] ?? ''; // Get password input

// Process POST requests securely
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF protection - Ensure the token in form matches the session token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('Invalid CSRF token'); // Terminate the script if CSRF token doesn't match
    }
}

// Function to validate password strength
// Password must be at least 8 characters long, include at least one letter and one number
function is_valid_password($password) {
    return preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password);
}

// Function to validate username
// Username can only contain alphanumeric characters and must be between 1 and 20 characters
function is_valid_username($username) {
    return preg_match('/^[a-zA-Z0-9]{1,20}$/', $username);
}

// Function to create an account and insert it into the database securely
function create_account($username, $password) {
    global $ADMIN;

    // Secure password hashing using BCRYPT
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $query = "INSERT INTO graal_users (account, password, activated) VALUES (?, ?, 1)";

    // Use prepared statements to prevent SQL Injection
    $stmt = mysqli_prepare($ADMIN['mysqlconnect'], $query);
    mysqli_stmt_bind_param($stmt, 'ss', $username, $hashed_password);
    
    if (!mysqli_stmt_execute($stmt)) {
        log_error("Account creation failed for username: $username"); // Log any errors
        die('Error: Could not create account');
    }

    // Increment account counter after successful account creation
    increment_account_counter();
}

// Logging function for writing errors to a log file
function log_error($message) {
    $log_file = 'error.log';
    $current_time = date('Y-m-d H:i:s'); // Current timestamp
    $log_message = "[$current_time] $message\n"; // Format the log message
    file_put_contents($log_file, $log_message, FILE_APPEND); // Append log message to log file
}

// Function to safely escape HTML characters for output, preventing XSS attacks
function escape_html($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Function to count and track how many accounts have been created
function get_account_count() {
    $count_file = 'account_count.txt';
    if (!file_exists($count_file)) {
        file_put_contents($count_file, '0'); // Create the file if it doesn't exist
    }
    return (int)file_get_contents($count_file); // Read the current count
}

// Function to increment account counter
function increment_account_counter() {
    $count_file = 'account_count.txt';
    $current_count = get_account_count();
    $current_count++; // Increment the counter
    file_put_contents($count_file, (string)$current_count); // Save updated counter
}

// Handling account creation step 2 (form validation and confirmation)
if ($page === "createaccountstep2") {
    // Validate username and password
    if (empty($username)) {
        $error = "Username is required.";
    } elseif (!is_valid_username($username)) {
        $error = "Invalid username. Only alphanumeric characters allowed, max length 20.";
    } elseif (!is_valid_password($password)) {
        $error = "Password must contain at least 8 characters, including one letter and one number.";
    } else {
        // Check if the username already exists in the database
        $result = mysqli_query($ADMIN['mysqlconnect'], "SELECT * FROM graal_users WHERE account='" . mysqli_real_escape_string($ADMIN['mysqlconnect'], $username) . "'");
        if (mysqli_num_rows($result) > 0) {
            $error = "Username already taken.";
        }
    }

    // If there are validation errors, display them to the user
    if (!empty($error)) {
        echo "<p>Error: " . escape_html($error) . "</p>";
        echo "<p><a href='$PHP_SELF?page=createaccountstep1'>Go back</a></p>";
    } else {
        // If validation passes, confirm account details with the user
        echo "
        <form method='post' action='$PHP_SELF?page=createaccountstep3'>
            <input type='hidden' name='csrf_token' value='" . escape_html($_SESSION['csrf_token']) . "'>
            <input type='hidden' name='username' value='" . escape_html($username) . "'>
            <input type='hidden' name='password' value='" . escape_html($password) . "'>
            <p>Confirm details:<br>Username: " . escape_html($username) . "<br>Password: ********</p>
            <input type='submit' value='Confirm &gt;'>
        </form>";
    }
} elseif ($page === "createaccountstep3") {
    // Final account creation step, after confirmation
    create_account($username, $password); // Create the account
    echo "<p>Account successfully created for " . escape_html($username) . ".</p>";
    echo "<p>Total accounts created: " . get_account_count() . "</p>"; // Show total account count
} else {
    // Initial form displayed to start account creation
    echo "
    <form method='post' action='$PHP_SELF?page=createaccountstep1'>
        <input type='hidden' name='csrf_token' value='" . escape_html($_SESSION['csrf_token']) . "'>
        <input type='submit' value='Next &gt;'>
    </form>";
}
?>
