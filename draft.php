<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sybil</title>
</head>

<body>
    <h1>Draft a note</h1>

    <?php
    include_once 'database_init.php';
    $cat_stmt = $pdo->prepare("SELECT * FROM categories");
    $cat_stmt->execute();
    $cat_rows = $cat_stmt->fetchAll();
    ?>

    <form method="POST" action="add_note.php">
        <label for="note_text">enter note text:</label> <br>
        <textarea name="note_text" cols="30" rows="10"></textarea>

        <label for="category">category:</label>
        <select name="category">
            <?php foreach ($cat_rows as $cat) {
                $cat_id = $cat["id"];
                $cat_name = $cat["name"];
                echo "<option value='$cat_id'>$cat_name</option>";
            } ?>
        </select>

        <label for="tags">tags:</label>
        <input type="text" name="tags">

        <label for="source">source:</label>
        <input type="text" name="source">

        <button type="submit">submit</button>
    </form>

</body>

</html>