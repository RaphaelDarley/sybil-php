<?php
include_once 'database_init.php';

var_dump($_REQUEST);

function get_tag($pdo, $tag_name)
{
    $get_stmt = $pdo->prepare("SELECT * FROM tags WHERE name = ?");
    $get_stmt->execute([$tag_name]);
    $tag = $get_stmt->fetch();
    return $tag ? $tag : NULL;
}

function get_or_make_tag_id($pdo, $tag_name)
{
    $tag = get_tag($pdo, $tag_name);
    if (is_null($tag)) {
        $add_stmt = $pdo->prepare("INSERT INTO tags (name) VALUES (?)");
        $add_stmt->execute([$tag_name]);
        $tag = get_tag($pdo, $tag_name);
    }
    return $tag["id"];
}

function link_note_to_tag($pdo, $note_id, $tag_id)
{
    $link_stmt = $pdo->prepare("INSERT INTO tag_junction (note_id, tag_id) VALUES(:note_id, :tag_id);");
    $link_stmt->execute(["note_id" => $note_id, "tag_id" => $tag_id]);
}

$add_stmt = $pdo->prepare("INSERT INTO notes (text, category_id, source, timestamp) VALUES (:text, :cat_id, :source, CURRENT_TIMESTAMP())");
$add_stmt->execute(["text" => $_REQUEST["note_text"], "cat_id" => $_REQUEST["category"], "source" => $_REQUEST["source"]]);

$note_id = $pdo->lastInsertId();

$tag_arr = explode(", ", $_REQUEST["tags"]);
foreach ($tag_arr as $tag_name) {
    $tag_id = get_or_make_tag_id($pdo, $tag_name);
    link_note_to_tag($pdo, $note_id, $tag_id);
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