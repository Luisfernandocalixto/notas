<?php

use App\Notas\Models\Note;

if (count($_POST) > 0) {
    // Actualizar nota
    $uuid = trim($_POST['id']);  // Elimina espacios adicionales
    echo "UUID recibido: $uuid"; // Verificar el UUID recibido

    $title = isset($_POST['title']) ? $_POST['title'] : '';
    echo "Title recibido: $title";

    $content = isset($_POST['content']) ? $_POST['content'] : '';
    echo "Content recibido: $content";

    // Obtener la nota por UUID antes de actualizar
    $note = Note::get($uuid);

    if ($note) {
        $note->setTitle($title);
        $note->setContent($content);
        $note->update();
        echo "Nota actualizada con éxito.";
    } else {
        echo "Error: La nota no existe."; // Si no encuentra la nota
    }
} else if (isset($_GET['id'])) {
    // Muestra el formulario de edición si se proporciona un ID
    $note = Note::get($_GET['id']);
} else {
    // Redirigir si no hay ID
    header('Location: http://localhost/notas/?view=home');
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View</title>
    <link rel="stylesheet" href="src/App/views/resources/main.css">

</head>

<body>
    Note

    <form action="?view=view&id=<?php echo $note->getUUID(); ?> " method="POST">
        <input type="text" name="title" id="title" placeholder="Title..." value="<?php echo $note->getTitle(); ?> " required>
        <input type="hidden" name="id" value="<?php echo $note->getUUID(); ?> ">
        <br>
        <textarea name="content" id="content" cols="30" rows="10" placeholder="Content..." required><?php echo $note->getContent(); ?></textarea>
        <br>
        <input type="submit" value="Update Note">
    </form>

    <a href="?view=home">Back to Home</a>


</body>

</html>