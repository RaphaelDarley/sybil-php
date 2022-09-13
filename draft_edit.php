<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sybil</title>
</head>

<body>
    <?php include_once "navbar.html" ?>
    <h1>Edit a note</h1>

    <?php
    include_once 'database_init.php';
    include_once 'utils.php';
    $cat_rows = get_categories($pdo);

    $note_id = $_REQUEST["note_id"];

    $get_stmt = $pdo->prepare("
    SELECT notes.id as note_id, text, source, timestamp, categories.name as category, category_id
    FROM notes
    INNER JOIN categories ON notes.category_id = categories.id
    WHERE notes.id = :note_id
    LIMIT 100
    ");
    $get_stmt->execute(["note_id" => $note_id]);
    $note = $get_stmt->fetch();
    if (!$note) {
        echo "<script>alert('ERROR: note not found!')</script>";
    }

    $text = $note["text"];
    $note_cat_id = $note["category_id"];
    $source = $note["source"];
    ?>

    <form method="POST" action="update_note.php">
        <label for="note_text">enter note text:</label> <br>
        <textarea name="note_text" cols="30" rows="10"><?php echo $text ?></textarea>

        <label for="category">category:</label>
        <select name="category">
            <?php foreach ($cat_rows as $cat) {
                $cat_id = $cat["id"];
                $cat_name = $cat["name"];
                $selected = $cat_id == $note_cat_id ? "selected" : "";
                echo "<option value='$cat_id' $selected>$cat_name</option>";
            } ?>
        </select>

        <label for="tags">tags:</label>
        <input type="text" name="tags" value="<?php echo get_tags($pdo, $note_id) ?>">

        <label for="source">source:</label>
        <input type="text" name="source" value="<?php echo $source; ?>">

        <input type="hidden" name="note_id" value="<?php echo $note_id; ?>">

        <button type="submit">submit</button>
    </form>
</body>

</html>