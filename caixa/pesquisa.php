<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUIOSCANDO - Caixa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Caixa - Gestão de Pedidos</h1>
    </header>

    <main>
        <section id="controle-pedidos">
            <h2>Pedidos por Mesa</h2>
            <form action="caixa.php" method="post">
                <label for="mesa-numero">Número da Mesa:</label>
                <?php
                $numero = $_POST['mesa-numero'];
                echo '<input type="number" id="mesa-numero" name="mesa-numero" value="'.$numero.'" placeholder="Digite o número da mesa" required>'
                ?>
                <button type="submit">Mostrar Pedidos</button>
                <?php
                    include "..\quioscando\config.php";
                    $sql = "SELECT * FROM tb_pedido where numero_mesa = $numero";
                    $total = 0;
                    $result = $conn->query($sql);

                    echo "<div id='resultados'>";
                    if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        $sqlBebidas = "SELECT * FROM tb_bebidas where id_bebidas = ".$row['fk_id_bebidas']."";
                        $resultB = $conn->query($sqlBebidas); 
                        if ($resultB->num_rows > 0){
                            while($row2 = $resultB->fetch_assoc()) {
                                echo "<hr>Item: " . $row2['nm_bebidas']." (x". $row['qt_bebidas'] .")<br>Preço: ". ($row2['vl_bebidas']*$row['qt_bebidas']) ."<br>Status: ". $row['status'] .""; // mudar para o atual;
                                $total += $row2['vl_bebidas']*$row['qt_bebidas'];
                            }
                        }
                      }
                    } else {
                      echo "Nenhuma Bebidas";
                    }

                    $sql = "SELECT * FROM tb_pedido where numero_mesa = $numero";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                      // output data of each row
                      while($row = $result->fetch_assoc()) {
                        $sqlBebidas = "SELECT * FROM tb_comidas where id_comidas = ".$row['fk_id_comidas']."";
                        $resultB = $conn->query($sqlBebidas); 
                        if ($resultB->num_rows > 0){
                            while($row2 = $resultB->fetch_assoc()) {
                                echo "<hr>Item: " . $row2['nm_comidas']." (x". $row['qt_comidas'] .")<br>Preço: ". ($row2['vl_comidas']*$row['qt_comidas']) ."<br>Status: ". $row['status'] .""; // mudar para o atual;
                                $total += $row2['vl_comidas']*$row['qt_comidas'];
                            }
                        }
                      }
                    } else {
                      echo "Nenhuma Comida";
                    }
                    echo "<hr>";
                    echo "</div>";
                ?>
                <div id="detalhes-pedidos">
                    <h3>Detalhes do Pedido</h3>
                    <ul id="pedidos-mesa">
                        <!-- Detalhes dos pedidos da mesa serão exibidos aqui -->
                    </ul>
                    <?php
                        echo "<p>Total: R$ <span id='total-mesa'>$total</span></p>";
                    ?>
                    
                    <button type="submit" name="finalizar">Finalizar Conta</button>

                </div>
            </form>
        </section>
    </main>
<style>
    button{
        color: white;
        background-color: black;
        border-radius: 20px;
        padding: 5px 20px
        }
#mesa-numero{
    text-align: center;

    
}
    h1,h2, p1 {
        text-align: center;
        box-shadow: blue;
        

    }
    
    body{
        background-color:#F79F1F;

    }
#controle-pedidos {
    border: 1px solid #ccc;
    padding: 20px;
    background-color: #fff;
}

#mesa-numero {
    margin-bottom: 10px;
    border-radius: 25px;
}

#detalhes-pedidos {
    margin-top: 20px;
}

#detalhes-pedidos h3 {
    margin-top: 0;
}

#total-mesa {
    font-weight: bold;
}

#finalizar-conta {
    background-color: #FF5733;
    color: #fff;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 25px;
    margin-top: 10px;
    
}

                    </style>
    <script src="caixa.js"></script>
</body>
</html>
