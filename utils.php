<?php
function term_to_like_text($term)
{
    return "text LIKE '%$term%'";
}

function get_categories($pdo)
{
    $cat_stmt = $pdo->prepare("SELECT * FROM categories");
    $cat_stmt->execute();
    return $cat_stmt->fetchAll();
}
