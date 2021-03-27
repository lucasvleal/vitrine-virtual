// função para redirecionar para a pagina do produto enviando seu id para recuperar as informações
function redirectionItem(idProd){
    window.location.href = `./item_page.php?id=${idProd}`;
}

// função pra ler querystring
function queryString(parameter) {  
    console.log(location.search);
    var loc = location.search.substring(1, location.search.length); 
    var param_value = false;   
    var params = loc.split("&");   
    for (i=0; i<params.length;i++) {   
        param_name = params[i].substring(0,params[i].indexOf('='));   
        if (param_name == parameter) {                                          
            param_value = params[i].substring(params[i].indexOf('=')+1)   
        }   
    }   
    if (param_value) {   
        return param_value;
        // console.log("id: " + param_value);   
    }   
    else {   
        return undefined;
        // console.log(undefined);   
    }   
}

// função para mudar a categoria
function changeCategoria(idCat) {
    console.log(idCat);

    $.ajax({
        method: "POST",
        url: "model/get_categoria.php",
        async: true,
        data: `idCategoria=${idCat}`,
    })
    .done(function(resp){
        const response = JSON.parse(resp);
        console.log(response);
        
        // Caso tenha ocorrido tudo certo com a recuperação e formação da response do php
        if(response.success) {
            var categoria = response.categoria;
            var produtos = response.produtos;

            // 'Zera' o html das categorias anteriores
            $('#box-produtos').html('<div />');            

            // Muda o nome e descrição da categoria atual
            $('.title-categoria').text(categoria.nome);
            $('.description-categoria').text(categoria.descricao);

            // Caso não haja produtos na categoria printa uma div informando isso, caso contrario printa os produtos
            if(produtos.length > 0){
                // Pra cada produto da categoria adiciona mais um item de produto com as infos dele
                for(var i = 0; i < produtos.length; i++){
                    $('#box-produtos').append(`
                        <div class='col-lg-4 col-md-6 mb-4'>
                            <div class='card h-100'>
                                <a href='#' onclick='redirectionItem(${produtos[i].id_produto})' class='box-image-card d-flex align-items-center justify-content-center'>
                                    <img class='image-card' src='./model/getImage.php?id_produto=${produtos[i].id_produto}' alt='${produtos[i].nome}'>
                                </a>
                
                                <div class='card-body' onclick='redirectionItem("${produtos[i].id_produto}")'>
                                    <h4 class='card-title'>
                                        <a class='title-produto' href='#' onclick='redirectionItem('${produtos[i].id_produto}')'>
                                        ${produtos[i].nome}
                                        </a>
                                    </h4>
                                    <div class='row promocao-box'>
                                        <h5 class='text-roboto-slab promocao-atual'>R$${produtos[i].preco_atual}</h5>
                                        <h5 class='text-roboto-slab promocao-antigo'>R$${produtos[i].preco_antigo}</h5>                  
                                    </div>  
                                    <div class='normal-preco-box'><h5 class='text-roboto-slab'>R$${produtos[i].preco_atual}</h5></div>
                                    <p class='card-text text-muted'>${produtos[i].descricao}</p>
                                </div>
                
                                <div class='card-footer' data-toggle='modal' data-target='#exampleModalCenter'>
                                    <div class='row justify-content-center'>
                                    <small class='text-muted text-card-contato'>ENTRAR EM CONTATO</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                    
                    if(produtos[i].promocao == "1"){
                        $('.promocao-antigo').css("display", "inline");
                        $('.normal-preco-box').css("display", "none");
                    } else {
                        $('.promocao-box').css("display", "none");
                    }
                }
            } else {
                $('#box-produtos').html(`
                    <div class='row box-sem-produtos d-flex align-items-center justify-content-center'>
                        <h6 class='text-muted text-roboto-slab'>Sem produtos cadastrados por enquanto!</h6>
                    </div>                
                `);
            }            
        } else {
            alert(`Ocorreu um erro ao carregar a categoria. \n\n Por favor, tente novamente mais tarde.`);
            console.log("Erro ao carregar a categoria.");
        }
    })
    .fail(function(jqXHR, textStatus, msg){
        console.log(jqXHR.responseText);
        console.log(`Ocorreu um erro ao carregar a categoria. Tente novamente mais tarde`);
        console.log(textStatus);
    });
}

// função para mudar a url com o id da categoria para recuperar as informações
function redirectionChangeCategoria(idCat){
    window.location.href = `./index.php?idCategoria=${idCat}`;    
}

$(document).ready(function() {
    $('#myList a').on('click', function (e) {
        e.preventDefault()
        $(this).tab('show')
    });
});