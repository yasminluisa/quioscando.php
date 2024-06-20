<?php
include "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mesaNumero = $_POST['menu-mesa'];
    $mesaCarrinho = $_POST['menu-carrinho'];
    $mesaQuantidade = $_POST['menu-quantidade'];

    $carrinho = explode(',',$mesaCarrinho);
    $quantia = explode(',',$mesaQuantidade);

    function getPedidosPorMesa($mesaNumero) {
        include "config.php";
        $mesaCarrinho = $_POST['menu-carrinho'];
        $mesaQuantidade = $_POST['menu-quantidade'];

        $carrinho = explode(',',$mesaCarrinho);
        $quantia = explode(',',$mesaQuantidade);
        //print_r($carrinho);
        //print_r($quantia);

        $sqlBebida = "SELECT * FROM tb_bebidas";
        $resultB = $conn->query($sqlBebida);
        if ($resultB->num_rows > 0) {
            while($row = $resultB->fetch_assoc()) {
                for ($i=0; $i < count($carrinho); $i++) {
                    if (substr($carrinho[$i],0,6) == "bebida"){
                        if ($row['id_bebidas'] == intval(substr($carrinho[$i],7))){
                            $sqlInsert = "INSERT into tb_pedido values(null,$mesaNumero,'pendente',0,".intval(substr($carrinho[$i],7)).",".$quantia[$i].",0)";
                            //print_r($sqlInsert);
                            $resultTeste = $conn->query($sqlInsert);
                        }
                    }
                }
            }
        }

        $sqlComida = "SELECT * FROM tb_comidas";
        $resultC = $conn->query($sqlComida);
        if ($resultC->num_rows > 0) {
            while($row = $resultC->fetch_assoc()) {
                for ($i=0; $i < count($carrinho); $i++) {
                    if (substr($carrinho[$i],0,6) == "comida"){
                        if ($row['id_comidas'] == intval(substr($carrinho[$i],7))){
                            $sqlInsert = "INSERT into tb_pedido values(null,$mesaNumero,'pendente',".intval(substr($carrinho[$i],7)).",0,0,".$quantia[$i].")";
                            $resultTeste = $conn->query($sqlInsert);
                        }
                    }
                }
            }
        }


        $sql = "SELECT * FROM tb_pedido WHERE numero_mesa = $mesaNumero";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          // output data of each row
          echo "<ul>";
          while($row = $result->fetch_assoc()) {
            echo '<li>Mesa: '.$row['numero_mesa'].' :
            <br>Comida: '.$row['fk_id_comidas'].' - R$ '.$row['qt_comidas'].'
            <br>Bebidas: '.$row['fk_id_bebidas'].' - R$ '.$row['qt_bebidas'].'</li>';
        }
          echo "<hr>";
          echo "</ul>";
        }
    }

    echo "<h3>Detalhes do Pedido para Mesa $mesaNumero</h3>";
    getPedidosPorMesa($mesaNumero);
    
    if (isset($_POST['finalizar'])) {
        if (true) {
            echo "<p>Conta finalizada com sucesso!</p>";
        } else {
            echo "<p>Erro ao finalizar a conta.</p>";
        }
    }
    header("location: http://localhost/caixa/caixa.php");
}
?>
