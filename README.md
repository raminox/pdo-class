# PDO Class

A PDO class

## Usage

In order to use this class you will have to:

1. Require the class: `require 'database.class.php';`.
2. Define the configuration for your database:
```php
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "notebook");
```
3. Instantiate database class: `$database = new Database();`

Here's to copy paste:

````php
// Require the class
require 'database.class.php';

// Define configuration
define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "notebook");

// Instantiate database.
$database = new Database();
```