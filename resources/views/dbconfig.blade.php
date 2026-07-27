<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel & DB Connection</title>
</head>
<body>
    <div>
    <?php
        if (DB::connection()->getDatabaseName()) {
            echo "Connected to database: " . DB::connection()->getDatabaseName();
        } else {
            echo "Not connected to any database.";
        }
    ?>   
    </div>
</body>
</html>