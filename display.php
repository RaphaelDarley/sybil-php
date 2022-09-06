<!DOCTYPE html>

<?php
include_once 'utils.php';
include_once 'database_init.php';

$get_stmt = $pdo->prepare("
    SELECT *
    FROM notes
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
    <?php
    $result_num = count($rows);
    echo "$result_num results found";
    var_dump($rows)
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

        <?php foreach ($rows as $db_row) {
            $id = $db_row["id"];

            $timestamp = $db_row["timestamp"];

            $text = $db_row["text"];

            $source = $db_row["source"];

            $category = $db_row["category"];

            $tags = $db_row["tags"];
            if ($tags !== NULL) {
                $tags = join(", ", json_decode($tags));
            }

            $html_row = "<tr> <td>$id</td> <td>$timestamp</td> <td>$text</td> <td>$source</td> <td>$category</td> <td>$tags</td> </tr>";

            echo $html_row;
        }
        ?>

    </table>

</body>

</html>