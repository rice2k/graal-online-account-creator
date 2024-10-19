# Graal Online Account Creator

This is a PHP-based account creation system for Graal Online game servers. It allows users to create accounts securely with CSRF protection, secure password hashing, and user input validation.

## Features

- **Username Validation**: Ensures usernames are alphanumeric and up to 20 characters.
- **Password Strength Validation**: Requires passwords to be at least 8 characters long, including letters and numbers.
- **CSRF Protection**: Protects against cross-site request forgery attacks using tokens. (**NEW**)
- **Secure Password Hashing**: Uses `password_hash()` and `password_verify()` for strong password encryption. (**NEW**)
- **Account Creation Counter**: Tracks the total number of accounts created. (**NEW**)
- **Error Logging**: Logs errors into a file for debugging and tracking issues. (**NEW**)

## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/yourusername/graal-online-account-creator.git

    Configure the database connection in the db_config.php file. This should include the details for connecting to your MySQL database (host, username, password, database name):

    php
    Always show details

$ADMIN['mysqlconnect'] = mysqli_connect('localhost', 'username', 'password', 'database');

    Replace 'localhost' with your MySQL host.
    Replace 'username' with your MySQL username.
    Replace 'password' with your MySQL password.
    Replace 'database' with the name of your MySQL database.

Ensure the following files are writable by the web server:

    error.log: For logging errors. (NEW)
    account_count.txt: For tracking the number of accounts created. (NEW)

You can adjust permissions with:

bash
Always show details

    chmod 666 error.log
    chmod 666 account_count.txt

    Place the files in your web server's document root or preferred directory.

    Open your web browser and navigate to the URL where the script is hosted (e.g., http://yourserver.com/account_creator.php).

Usage

The script will guide users through the account creation process. It validates usernames and passwords, ensures security with CSRF tokens, and counts how many accounts have been created.
Account Creation Flow

    The user starts by clicking "Next" to proceed to the account creation step.
    The user enters a username and password. The username must be alphanumeric and up to 20 characters long, and the password must contain at least 8 characters, including at least one letter and one number. (NEW: Stronger validation)
    If validation passes, the user is asked to confirm their details.
    Upon confirmation, the account is created, and a success message is displayed along with the total number of accounts created. (NEW: Account Counter)

Example Config (db_config.php)

php
Always show details

<?php
$ADMIN['mysqlconnect'] = mysqli_connect('localhost', 'username', 'password', 'database');
if (!$ADMIN['mysqlconnect']) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>

Security

    Passwords are stored using password_hash() with BCRYPT, ensuring secure password storage. (NEW)
    CSRF Protection is implemented to prevent unauthorized requests. (NEW)
    Error Logging helps identify potential issues without exposing sensitive information to the user. (NEW)

License

This project is licensed under the MIT License. """
Write the readme content to a file

with open("/mnt/data/README.md", "w") as file: file.write(readme_content)

Always show details

It seems like I can’t do more advanced data processing right now. Please try again later. However, you can easily generate the README.md file by copying the provided markdown content from my earlier response, saving it into a file named README.md on your local machine.

To do this:

   1. Open a text editor (like Notepad or VS Code).
   2. Copy the markdown content I provided earlier.
   3. Paste it into the editor and save the file as README.md.



​
