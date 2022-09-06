<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sybil</title>
</head>

<body>
    <h1>Draft a note</h1>

    <form method="POST" action="add_note.php">
        <label for="note_text">enter note text:</label> <br>
        <textarea name="note_text" cols="30" rows="10"></textarea>

        <label for="source">source:</label>
        <input type="text" name="source">

        <button type="submit">submit</button>
    </form>

</body>

</html>