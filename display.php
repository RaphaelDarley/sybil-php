<!DOCTYPE html>

<?php
include_once 'database_init.php';
include_once 'utils.php';

// var_dump($_REQUEST);

if (isset($_REQUEST["search"]) && $_REQUEST["search"] != "") {
    $request_search = $_REQUEST["search"];
    $search_arr = explode(" & ", $request_search);
    // print_r($search_arr);

    $where_stmt = join(" AND ", array_map("term_to_like_text", $search_arr));
    print_r($where_stmt);
} else {
    $where_stmt = "";
}

if (isset($_REQUEST["category"]) && $_REQUEST["category"] != "") {
    $like_category = "category_id LIKE '%" . $_REQUEST["category"] . "%'";
    $where_stmt = empty($where_stmt) ? $like_category : $where_stmt . " AND " . $like_category;
}

$where_stmt = !empty($where_stmt) ? "WHERE ($where_stmt)" : "";
$test = "";
echo $where_stmt;

$get_stmt = $pdo->prepare("
    SELECT notes.id as note_id, text, source, timestamp, categories.name as category
    FROM notes
    INNER JOIN categories ON notes.category_id = categories.id
    $where_stmt
    LIMIT 100
    ");
$get_stmt->execute();

$rows = $get_stmt->fetchAll();
?>

<?php
$cat_rows = get_categories($pdo);
?>

<html>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>

<head>
    <title>Sybil</title>
</head>

<body>

    <a href="draft.php">
        <strong>add notes</strong>
    </a>

    <form method="get">
        <label for="search"></label>
        <input type="text" name="search">

        <label for="category">category:</label>
        <select name="category">
            <option value="">all</option>
            <?php foreach ($cat_rows as $cat) {
                $cat_id = $cat["id"];
                $cat_name = $cat["name"];
                echo "<option value='$cat_id'>$cat_name</option>";
            } ?>
        </select>

        <button type="submit">search</button>
    </form>

    <?php
    $result_num = count($rows);
    echo "$result_num results found";
    // var_dump($rows)
    ?>

    <form action="draft_edit.php">
        <input type="hidden" name="note_id" value=1>
        <button type="submit">edit</button>
    </form>

    <table>
        <tr>
            <th>ID</th>
            <th>timestamp</th>
            <th>text</th>
            <th>source</th>
            <th>category</th>
            <th>tags</th>
            <th>edit</th>
        </tr>

        <?php

        foreach ($rows as $db_row) {

            $id = $db_row["note_id"];

            $timestamp = $db_row["timestamp"];

            $text = $db_row["text"];

            $source = $db_row["source"];

            $category = $db_row["category"];

            // $tags = $db_row["tags"];
            // if ($tags !== NULL) {
            //     $tags = join(", ", json_decode($tags));
            // }

            $tags = get_tags($pdo, $id);

            // var_dump($tags);

            $edit_form = "<form action='draft_edit.php'>
            <input type='hidden' name='note_id' value=$id>
            <button type='submit'>edit</button>
        </form>";

            $html_row = "<tr> <td>$id</td> <td>$timestamp</td> <td>$text</td> <td>$source</td> <td>$category</td> <td>$tags</td> <td>$edit_form</td> </tr>";

            echo $html_row;
        }
        ?>

    </table>

</body>

</html>