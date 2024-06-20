function mostrarPedidos() {
    var mesaNumero = document.getElementById('mesa-numero').value;
    var pedidos = JSON.parse(localStorage.getItem('pedidos')) || [];
    var pedidosMesa = pedidos.filter(pedido => pedido.mesa == mesaNumero);

    var pedidosMesaElement = document.getElementById('pedidos-mesa');
    var totalMesaElement = document.getElementById('total-mesa');

    pedidosMesaElement.innerHTML = '';
    var totalMesa = 0;

    pedidosMesa.forEach(function (pedido) {
        var li = document.createElement('li');
        li.textContent = `${pedido.item} (${pedido.qt}x) - R$${(pedido.price * pedido.qt).toFixed(2)}`;
        pedidosMesaElement.appendChild(li);
        totalMesa += pedido.price * pedido.qt;
    });

    totalMesaElement.textContent = totalMesa.toFixed(2);
}

function finalizarConta() {
    var mesaNumero = document.getElementById('mesa-numero').value;
    var pedidos = JSON.parse(localStorage.getItem('pedidos')) || [];
    var pedidosMesa = pedidos.filter(pedido => pedido.mesa == mesaNumero);

    if (pedidosMesa.length > 0) {
        var confirmacao = confirm('Deseja finalizar a conta e emitir a nota fiscal?');
        if (confirmacao) {
            var pedidosAtualizados = pedidos.filter(pedido => pedido.mesa != mesaNumero);
            localStorage.setItem('pedidos', JSON.stringify(pedidosAtualizados));
            alert('Conta finalizada. Nota fiscal emitida.');
            location.reload();
        }
    } else {
        alert('Nenhum pedido encontrado para esta mesa.');
    }
}
function limparPedido() {
    // Limpa o carrinho
    var cart = document.getElementById('carrinho-items');
    cart.innerHTML = "";

    // Reinicia os totais
    totalComidas = 0;
    totalBebidas = 0;
    totalGeral = 0;
    carrinhoTable = [];

    var totalBebidasElement = document.getElementById('total-bebidas');
    var totalComidasElement = document.getElementById('total-comidas');
    var totalElement = document.getElementById('total');
    totalBebidasElement.textContent = totalBebidas.toFixed(2);
    totalComidasElement.textContent = totalComidas.toFixed(2);
    totalElement.textContent = totalGeral.toFixed(2);
}