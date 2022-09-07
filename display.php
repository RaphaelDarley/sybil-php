<!DOCTYPE html>

<?php
include_once 'utils.php';
include_once 'database_init.php';

$get_stmt = $pdo->prepare("
    SELECT notes.id as note_id, text, source, timestamp, categories.name as category
    FROM notes
    INNER JOIN categories ON notes.category_id = categories.id
    LIMIT 100
    ");
$get_stmt->execute();

$rows = $get_stmt->fetchAll();
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

    <?php
    $result_num = count($rows);
    echo "$result_num results found";
    // var_dump($rows)
    ?>

    <table>
        <tr>
            <th>ID</th>
            <th>timestamp</th>
            <th>text</th>
            <th>source</th>
            <th>category</th>
            <th>tags</th>
        </tr>

        <?php

        function get_tags($pdo, $note_id)
        {
            // $tag_stmt = $pdo->prepare("
            // SELECT tags.name as tag
            // FROM notes
            // INNER JOIN tag_junction
            //     ON notes.id = tag_junction.note_id
            // INNER JOIN tag_junction
            //     ON tag_junction.tag_id = tags.id
            // ");
            $tag_stmt = $pdo->prepare("
            SELECT tags.name as tag
            FROM tag_junction
            INNER JOIN tags
                ON tag_junction.tag_id = tags.id
            WHERE note_id = :note_id
            ");
            $tag_stmt->execute(["note_id" => $note_id]);
            $rows = $tag_stmt->fetchAll();
            // var_dump($rows);
            $tags = array_map(function ($t) {
                return $t["tag"];
            }, $rows);
            return join(", ", $tags);
            // return $tags;
        }



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

            $html_row = "<tr> <td>$id</td> <td>$timestamp</td> <td>$text</td> <td>$source</td> <td>$category</td> <td>$tags</td> </tr>";

            echo $html_row;
        }
        ?>

    </table>

</body>

</html>