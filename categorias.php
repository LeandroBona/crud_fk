<?php
include 'config.php';

// Adiciona categoria
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category'])) {
    $name = $_POST['category'];
    $stmt = $pdo->prepare("INSERT INTO categories (name) VALUES (?)");
    $stmt->execute([$name]);
}

// Lista categorias
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Categorias</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Gerenciar Categorias</h2>
        <form method="POST">
            <div class="form-group">
                <label for="category">Categoria</label>
                <input type="text" class="form-control" id="category" name="category" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Categoria</button>
        </form>
        <hr>
        <h3>Categorias Cadastradas</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category['id'] ?></td>
                        <td><?= $category['name'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
