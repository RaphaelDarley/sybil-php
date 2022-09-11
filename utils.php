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



function get_tags($pdo, $note_id)
{
    $tag_stmt = $pdo->prepare("
    SELECT tags.name as tag
    FROM tag_junction
    INNER JOIN tags
        ON tag_junction.tag_id = tags.id
    WHERE note_id = :note_id
    ");
    $tag_stmt->execute(["note_id" => $note_id]);
    $rows = $tag_stmt->fetchAll();
    $tags = array_map(function ($t) {
        return $t["tag"];
    }, $rows);
    return join(", ", $tags);
}


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



function default_val($value, $default)
{
    if (isset($value)) {
        return $value;
    } else {
        return $default;
    }
}

function persist_value($value)
{
    if (isset($value)) {
        echo "value=\"$value\"";
    }
}
