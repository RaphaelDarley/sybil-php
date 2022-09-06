INSERT INTO
    categories (name)
VALUES
    ("miscellaneous");

SET
    @cat_id = LAST_INSERT_ID();

INSERT INTO
    tags (name)
VALUES
    ("test tag");

SET
    @tag_id = LAST_INSERT_ID();

INSERT INTO
    notes (text, category_id, source, timestamp)
VALUES
    (
        "test text",
        @cat_id,
        "good book",
        CURRENT_TIMESTAMP()
    );

SET
    @note_id = LAST_INSERT_ID();

INSERT INTO
    tag_junction (note_id, tag_id)
VALUES
    (@note_id, @tag_id);