<?php
include_once 'database_init.php';

var_dump($_REQUEST);

$add_stmt = $pdo->prepare("INSERT INTO notes (text, source, timestamp) VALUES (:text, :source, CURRENT_TIMESTAMP())");
$add_stmt->execute(["text" => $_REQUEST["note_text"], "source" => $_REQUEST["source"]]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sybil</title>
</head>

<body>
    <h1>Note added</h1>

    <a href="display.php">
        <strong>see notes</strong>
    </a>
    &emsp;
    <a href="draft.php">
        <strong>add notes</strong>
    </a>
</body>

</html>