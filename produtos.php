<?php
include 'config.php';

// Adiciona produto
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product']) && isset($_POST['category_id'])) {
    $name = $_POST['product'];
    $category_id = $_POST['category_id'];
    $stmt = $pdo->prepare("INSERT INTO products (name, category_id) VALUES (?, ?)");
    $stmt->execute([$name, $category_id]);
}

// Lista categorias e produtos
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();
$products = $pdo->query("SELECT products.*, categories.name as category_name FROM products JOIN categories ON products.category_id = categories.id")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produtos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Gerenciar Produtos</h2>
        <form method="POST">
            <div class="form-group">
                <label for="product">Produto</label>
                <input type="text" class="form-control" id="product" name="product" required>
            </div>
            <div class="form-group">
                <label for="category_id">Categoria</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Produto</button>
        </form>
        <hr>
        <h3>Produtos Cadastrados</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Categoria</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['category_name'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
