function manipulatingInfo(data, url, title, action) {
    $.ajax({
        method: "POST",
        url: url,
        async: true,
        data: data
    })
    .done(function(resp){
        const response = resp;
        
        if(response.success) {
            alert(`${title} ${action}do(a) com sucesso!`);
        } else if(response.success == 3){
            alert(`Erro ao ${action}r imagem do produto.`);
        } else {
            alert(`Erro ao ${action}r ${title}.`);
        }
    })
    .fail(function(jqXHR, textStatus, msg){
            alert(`Ocorreu um erro ao ${action}r ${title}. Tente novamente mais tarde`);
    });
}

function addProd(data, url) {
    $.ajax({
      method: "POST",
      url: url,
      async: true,
      data: data,
      processData: false,
      contentType: false,
  })
  .done(function(resp){
      const response = resp;
      console.log(response);
      
      if(response.success) {
          alert(`Produto cadastrado com sucesso!`);
  
          setTimeout(document.location.reload(true), 1500);
      } else if(response.success == 3){
          alert(`Erro ao cadastrar a imagem do produto.`);
      } else {
          alert(`Erro ao cadastrar o produto.`);
      }
  })
  .fail(function(jqXHR, textStatus, msg){
      console.log(jqXHR.responseText);
      alert(`Ocorreu um erro ao editar o produto. Tente novamente mais tarde \n ${msg} \n ${textStatus}`);
  });
  }

function login(data) {
    $.ajax({
        method: "POST",
        url: "../model/login.php",
        async: true,
        data: data
    })
    .done(function(resp){
        const response = resp;
        console.log(response);

        if(response.success) {
            window.location.href = "../admin/index.php";
            // console.log("entrou");
        } else {
            alert("Nenhum cadastro correspondente!");
        }
    })
    .fail(function(jqXHR, textStatus, msg){
        alert("Ocorreu um erro. Tente novamente mais tarde.");
    });
}

$(document).ready(function() {
    $('#btnLogin').click(function(){
        var dados = $('#login').serialize();
        console.log(dados);

        login(dados);
    })

    //CADASTRAR INFOS------
    $('#btnCadCategoria').click(function(){
        var dados = $('#categoria').serialize();
        console.log(dados);
        const url = "../model/add_categoria.php";

        manipulatingInfo(dados, url, "Categoria", "cadastra");

        $('#inputNomeCat').val("");
        $('#inputDescricaoCat').val("");
    });

    $('#btnCadProduto').click(function(){
        var data = new FormData();

        //Form data
        var form_data = $('#produto').serializeArray();

        $.each(form_data, function (key, input) {
            data.append(input.name, input.value);
        });

        //File data
        var file_data = $('#inputImagem')[0].files;
        
        //Custom data
        data.append('imgProduto', file_data[0]);
        data.append('idProduto', idItemEdit);

        console.log(data);

        if(data != null){
            editProd(data, "../model/add_produto.php");
        }
        
        $('#inputNome').val("");
        $('#inputCategoria').val("");
        $('#inputDescricao').val("");
        $('#inputImagem').val("");
        $('#inputAddress').val("");
        $('#inputPrecoAtual').val("");
        $('#inputPrecoAntigo').val("");
    });

    $('#btnCadAdmin').click(function(){
        var dados = $('#admin').serialize();
        console.log(dados);
        const url = "../model/add_admin.php";

        manipulatingInfo(dados, url, "Administrador(a)", "cadastra");
        $('#inputNomeAdm').val("");
        $('#inputEmailAdm').val("");
        $('#inputSenhaAdm').val("");
    });
    //---------------------

})