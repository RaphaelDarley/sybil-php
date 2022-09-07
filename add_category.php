<?php
include_once 'database_init.php';

var_dump($_REQUEST);

function get_category($pdo, $tag_name)
{
    $get_stmt = $pdo->prepare("SELECT * FROM categories WHERE name = ?");
    $get_stmt->execute([$tag_name]);
    $tag = $get_stmt->fetch();
    return $tag ? $tag : NULL;
}

if (is_null(get_category($pdo, $_REQUEST["category_name"]))) {
    $add_stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
    $add_stmt->execute([$_REQUEST["category_name"]]);
}

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