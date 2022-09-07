<?php
include_once 'database_init.php';
include_once 'utils.php';


var_dump($_REQUEST);

$note_id = $_REQUEST["note_id"];


$update_stmt = $pdo->prepare("UPDATE notes SET text = :text, category_id = :cat_id, source = :source WHERE id = :note_id");
$update_stmt->execute(["text" => $_REQUEST["note_text"], "cat_id" => $_REQUEST["category"], "source" => $_REQUEST["source"], "note_id" => $note_id]);

$note_id = $pdo->lastInsertId();

// $tag_arr = explode(", ", $_REQUEST["tags"]);
// foreach ($tag_arr as $tag_name) {
//     $tag_id = get_or_make_tag_id($pdo, $tag_name);
//     link_note_to_tag($pdo, $note_id, $tag_id);
// }

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