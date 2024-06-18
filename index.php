<?php
include 'db.php';

if (isset($_POST['action'])) {
    if ($_POST['action'] == "add") {
        $nome = $_POST['nome'];
        $data_lancamento = $_POST['data_lancamento'];
        $numero_paginas = $_POST['numero_paginas'];
        $autor = $_POST['autor'];
        
        $sql = "INSERT INTO livros (nome, data_lancamento, numero_paginas, autor) VALUES ('$nome', '$data_lancamento', '$numero_paginas' ,'$autor')";
        $conn->query($sql);
    } elseif ($_POST['action'] == "update") {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $data_lancamento = $_POST['data_lancamento'];
        $numero_paginas = $_POST['numero_paginas'];
        $autor = $_POST['autor'];

        $sql = "UPDATE livros SET nome='$nome', data_lancamento='$data_lancamento', numero_paginas='$numero_paginas' , autor= '$autor' WHERE id=$id";
        $conn->query($sql);
    } elseif ($_POST['action'] == "delete") {
        $id = $_POST['id'];
        
        $sql = "DELETE FROM livros WHERE id=$id";
        $conn->query($sql);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD Library</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <span id="s1">Biblioteca CRUD</span>
    
    <form action="index.php" method="POST">
        <input type="hidden" name="action" value="add">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required>
        <label for="data_lancamento">Data de Lançamento:</label>
        <input type="date" name="data_lancamento" required>
        <label for="numero_paginas">Número de Páginas:</label>
        <input type="number" name="numero_paginas" required>
        <label for="autor">Autor:</label>
        <input type="text" name="autor" required>
        <button type="submit">Adicionar Livro</button>
    </form>
    
    <h2>Livros</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Data de Lançamento</th>
            <th>Número de Páginas</th>
            <th>Autor</th>
            <th>Ações</th>
        </tr>
        <?php
        $sql = "SELECT * FROM livros";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['nome']}</td>
                    <td>{$row['data_lancamento']}</td>
                    <td>{$row['numero_paginas']}</td>
                    <td>{$row['autor']}</td>
                    <td>
                        <form style='display:inline-block;' action='index.php' method='POST'>
                            <input type='hidden' name='action' value='delete'>
                            <input type='hidden' name='id' value='{$row['id']}'>
                            <button type='submit' class='delete-button'>Deletar</button>
                        </form>
                        <button onclick='editBook({$row['id']}, \"{$row['nome']}\", \"{$row['data_lancamento']}\", \"{$row['numero_paginas']}\", \"{$row['autor']}\")'>Editar</button>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum livro encontrado</td></tr>";
        }
        ?>
    </table>
    
    <div id="editForm" class="hide">
        <h2>Editar Livro</h2>
        <form action="index.php" method="POST">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" id="editId">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="editNome" required>
            <label for="data_lancamento">Data de Lançamento:</label>
            <input type="date" name="data_lancamento" id="editDataLancamento" required>
            <label for="numero_paginas">Número de Páginas:</label>
            <input type="number" name="numero_paginas" id="editNumeroPaginas" required>
            <label for="autor">Autor:</label>
            <input type="text" name="autor" id="editAutor" required>
            <button type="submit">Atualizar Livro</button>
        </form>
    </div>
    
    <script>
        function editBook(id, nome, dataLancamento, numeroPaginas, autor) {
            document.getElementById('editId').value = id;
            document.getElementById('editNome').value = nome;
            document.getElementById('editDataLancamento').value = dataLancamento;
            document.getElementById('editNumeroPaginas').value = numeroPaginas;
            document.getElementById('editAutor').value = autor;
            document.getElementById('editForm').style.display = 'block';
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
