<?php


use App\Notas\models\Note;

// Verifica si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    $content = isset($_POST['content']) ? trim($_POST['content']) : '';

    // Verifica que el título y el contenido no estén vacíos
    if (!empty($title) && !empty($content)) {
        // Crea una nueva instancia de la nota y la guarda
        $note = new Note($title, $content);
        $note->save();
        
        echo "Note created successfully!";
    } else {
        echo "Title and content are required.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Note</title>
    <link rel="stylesheet" href="src/App/views/resources/main.css">

</head>
<body>
    <?php require 'resources/navbar.php'; ?>
    
    <h1>Create New Note</h1>


    <form action="?view=create" method="post">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" placeholder="Title..." required>
        <br>
        <label for="content">Content:</label>
        <textarea name="content" id="content" cols="30" rows="10" placeholder="Content..." required></textarea>
        <br>
        <input type="submit" value="Create Note">
    </form>
    <a href="?view=home">Back to Home</a>
</body>
</html>
