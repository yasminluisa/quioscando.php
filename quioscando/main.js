var totalComidas = 0;
var totalBebidas = 0;
var totalGeral = 0;
var carrinhoTable = [];
var quantidade = [];
var idItem = [];

function toggleMenu(menuId) {
    var menu = document.getElementById(menuId);
    if (menu.style.display === 'none') {
        menu.style.display = 'block'; 
    } else {
        menu.style.display = 'none'; 
    }
}
var ordering = 0;
function addItemToCart(itemName, itemPrice, type, item_id) {
    var alreadyExist = false; // variavel se já existe na tabela
    var cart = document.getElementById('carrinho-items');
    var totalBebidasElement = document.getElementById('total-bebidas');
    var totalComidasElement = document.getElementById('total-comidas');
    var totalElement = document.getElementById('total');

    for (let i = 0; i < carrinhoTable.length; i++) {
        if (carrinhoTable[i] == itemName){ // se sim
            alreadyExist = true;
        }    
    }

    if (alreadyExist == false){
        var li = document.createElement('li');
        li.textContent = itemName + ' - R$' + itemPrice.toFixed(2);
        li.id = itemName;
        li.setAttribute("qt",1);
        li.setAttribute("ordered",ordering);
        cart.appendChild(li);
        carrinhoTable.push(itemName);
        idItem.push(type+"_"+item_id);
        quantidade[ordering] = 1;
        ordering++;
    }
    else{
        var itemExistente = document.getElementById(itemName);
        itemExistente.setAttribute("qt",parseInt(itemExistente.getAttribute("qt"))+1);
        itemExistente.textContent = itemName + ' ('+itemExistente.getAttribute("qt")+'x) - R$' + itemPrice.toFixed(2);
        quantidade[parseInt(itemExistente.getAttribute("ordered"))] = parseInt(itemExistente.getAttribute("qt"));
    }
 

    if (type === 'bebida') {
        totalBebidas += itemPrice;
        totalBebidasElement.textContent = totalBebidas.toFixed(2);
    } else {
        totalComidas += itemPrice;
        totalComidasElement.textContent = totalComidas.toFixed(2);
    }
    document.getElementById("mn-carrinho").value = idItem;
    document.getElementById("mn-quantidade").value = quantidade;

    totalGeral = totalBebidas + totalComidas;
    totalElement.textContent = totalGeral.toFixed(2);
}
    function selecionarMesa(numeroMesa) {
        localStorage.setItem('mesaSelecionada', numeroMesa);
        document.getElementById("mn-mesa").value = numeroMesa;
        var mesas = document.querySelectorAll('.mesa');
        mesas.forEach(function(mesa) {
            if (mesa.classList.contains('active')){
                mesa.classList.remove('active');
            }
        });
        var mesaSelecionada = document.getElementById(numeroMesa);
        mesaSelecionada.classList.add('active');
        document.getElementById('finalizar-pedido').removeAttribute('disabled');
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
    function finalizarPedido() { 
    var nomeGarcom = document.getElementById('nome-garcom').value; // Obtém o nome do garçom do campo de entrada
    var totalBebidas = parseFloat(document.getElementById('total-bebidas').textContent);
    var totalComidas = parseFloat(document.getElementById('total-comidas').textContent);
    var totalGeral = parseFloat(document.getElementById('total').textContent);
    var mesaSelecionada = localStorage.getItem('mesaSelecionada');
    
    var mensagem = 'Garçom: ' + nomeGarcom + '\nTotal de Bebidas: R$ ' + totalBebidas.toFixed(2) + '\nTotal de Comidas: R$ ' + totalComidas.toFixed(2) + '\nTotal Geral: R$ ' + totalGeral.toFixed(2);

    if (mesaSelecionada) {
        mensagem += "\nNúmero da Mesa: " + mesaSelecionada;
    }
    
}