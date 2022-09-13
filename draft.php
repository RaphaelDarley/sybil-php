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
    include_once 'utils.php';
    $cat_rows = get_categories($pdo);
    ?>

    <form method="POST" action="add_note.php">
        <label for="note_text">enter note text:</label> <br>
        <textarea name="note_text" cols="100" rows="20"></textarea>

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

    <h2>Add a category</h2>

    <form action="add_category.php" method="post">
        <label for="category_name">category name:</label>
        <input type="text" name="category_name">
        <button type="submit">add</button>
    </form>

</body>

</html>