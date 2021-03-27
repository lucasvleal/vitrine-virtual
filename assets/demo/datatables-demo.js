var traducao = {
  "sEmptyTable": "Nenhum registro encontrado",
  "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
  "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
  "sInfoFiltered": "(Filtrados de _MAX_ registros)",
  "sInfoPostFix": "",
  "sInfoThousands": ".",
  "sLengthMenu": "Mostrar _MENU_ resultados por página",
  "sLoadingRecords": "Carregando...",
  "sProcessing": "Processando...",
  "sZeroRecords": "Nenhum registro encontrado",
  "sSearch": "Pesquisar",
  "oPaginate": {
      "sNext": "Próximo",
      "sPrevious": "Anterior",
      "sFirst": "Primeiro",
      "sLast": "Último"
  },
  "oAria": {
      "sSortAscending": ": Ordenar colunas de forma ascendente",
      "sSortDescending": ": Ordenar colunas de forma descendente"
  },
  "select": {
      "rows": {
          "_": "Selecionado %d linhas",
          "0": "Nenhuma linha selecionada",
          "1": "Selecionado 1 linha"
      }
  }
}

var itemDelete = "";

var itemEdit = "";
var idItemEdit = "";

function trocarBtnDelete() {
  $('.btn-del').css("display", "block");
  $('.btn-add').css("display", "none");
  $('.btn-edit').css("display", "none");
}

function trocarBtnEditar() {
  $('.btn-del').css("display", "none");
  $('.btn-add').css("display", "none");
  $('.btn-edit').css("display", "block");
}

function trocarBtnRegistrar() {
  $('.btn-del').css("display", "none");
  $('.btn-add').css("display", "block");
  $('.btn-edit').css("display", "none");
}

function manipulatingInfo(data, url, title, action) {
  $.ajax({
      method: "POST",
      url: url,
      async: true,
      data: data,
  })
  .done(function(resp){
      const response = resp;
      console.log(response);
      
      if(response.success) {
          alert(`${title} ${action}do(a) com sucesso!`);

          setTimeout(document.location.reload(true), 1500);
      } else if(response.success == 3){
          alert(`Erro ao ${action}r imagem do produto.`);
      } else {
          alert(`Erro ao ${action}r ${title}.`);
      }
  })
  .fail(function(jqXHR, textStatus, msg){
      console.log(jqXHR.responseText);
      alert(`Ocorreu um erro ao ${action}r ${title}. Tente novamente mais tarde \n ${msg} \n ${textStatus}`);
  });
}

function editProd(data, url) {
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
        alert(`Produto editado com sucesso!`);

        setTimeout(document.location.reload(true), 1500);
    } else if(response.success == 3){
        alert(`Erro ao editar imagem do produto.`);
    } else {
        alert(`Erro ao editar o produto.`);
    }
})
.fail(function(jqXHR, textStatus, msg){
    console.log(jqXHR.responseText);
    alert(`Ocorreu um erro ao editar o produto. Tente novamente mais tarde \n ${msg} \n ${textStatus}`);
});
}

function rollToForm() {
  var target_offset = $(".card").offset();
  var target_top = target_offset.top;
  $('html, body').animate({ scrollTop: target_top }, 350);
}

// Call the dataTables jQuery plugin and functions
$(document).ready(function() {

  var tableCat = $('#categoriasTable').DataTable({
    "language": traducao,
    "columnDefs": [ {
      "targets": -1,
      "data": null,
      "defaultContent": "<button class='btnEditCategoria margin-bottom-sm-mobile btn btn-sm btn-outline-primary'><i class='far fa-edit'></i></button> <button class='btnDelCategoria btn btn-sm btn-outline-danger'><i class='far fa-trash-alt'></i></button>"
    }]
  });

  var tableProd = $('#produtosTable').DataTable({
    "language": traducao,
    "columnDefs": [ {
      "targets": -1,
      "data": null,
      "defaultContent": "<button class='btnEditProduto margin-bottom-sm btn btn-sm btn-outline-primary'><i class='far fa-edit'></i></button> <button class='btnDelProduto btn btn-sm btn-outline-danger'><i class='far fa-trash-alt'></i></button>"
    }]
  });

  var tableAdm = $('#adminTable').DataTable({
    "language": traducao,
    "columnDefs": [ {
      "targets": -1,
      "data": null,
      "defaultContent": "<button class='btnEditAdmin margin-bottom-sm-mobile btn btn-sm btn-outline-primary'><i class='far fa-edit'></i></button> <button class='btnDelAdmin btn btn-sm btn-outline-danger'><i class='far fa-trash-alt'></i></button>"
    }]
  });


  //ADMIN---------------------------
  $('.btnEditAdmin').click(function() { //Pega as infos da linha clicada para o forms e muda o botão
    trocarBtnEditar();

    var nTr = $(this).parents('tr')[0];
    var dados = tableAdm.row(nTr).data();

    $('#inputNomeAdm').val(dados[1]);
    $('#inputEmailAdm').val(dados[2]);
    $('#inputSenhaAdm').val(dados[3]);

    rollToForm();

    idItemEdit = dados[0];
  });

  $('#btnEditAdmin').click(function(){ //Envia os dados para o php para ser editado
    itemEdit = $('#admin').serialize();
    itemEdit += `&idAdmin=${idItemEdit}`;

    console.log(itemEdit);

    if(itemEdit != ""){
      manipulatingInfo(itemEdit, "../model/upd_admin.php", "Administrador", "edita");

      $('#inputNomeAdm').val("");
      $('#inputEmailAdm').val("");
      $('#inputSenhaAdm').val("");

      itemEdit = "";
      idItemEdit = "";
    } else {
      alert("Nada para ser editado. Escolha um administrador e tente novamente.");
    }

    trocarBtnRegistrar();
  })

  $('.btnDelAdmin').click(function() { //Pega as infos da linha clicada para o forms e muda o botão
    trocarBtnDelete();
      
    var nTr = $(this).parents('tr')[0];
    var dados = tableAdm.row(nTr).data();

    $('#inputNomeAdm').val(dados[1]);
    $('#inputEmailAdm').val(dados[2]);
    $('#inputSenhaAdm').val(dados[3]);

    itemDelete = $('#admin').serialize();
    itemDelete += `&idAdmin=${dados[0]}`;

    rollToForm();

    console.log(itemDelete);
  });

  $('#btnDelAdmin').click(function(){ //Envia os dados para o php para ser deletado
    if(itemDelete != ""){
      manipulatingInfo(itemDelete, "../model/del_admin.php", "Administrador", "deleta");

      $('#inputNomeAdm').val("");
      $('#inputEmailAdm').val("");
      $('#inputSenhaAdm').val("");

      itemDelete = "";
    } else {
      alert("Nada para ser deletado. Escolha um administrador e tente novamente.");
    }

    trocarBtnRegistrar();
  }); 
  //--------------------------------

  //CATEGORIAS------------------------
  $('.btnEditCategoria').click(function() {
    trocarBtnEditar();

    var nTr = $(this).parents('tr')[0];
    var dados = tableCat.row(nTr).data();

    $('#inputNomeCat').val(dados[1]);
    $('#inputDescricaoCat').val(dados[2]);

    rollToForm();

    idItemEdit = dados[0];
  });

  $('#btnEditCategoria').click(function() {
    itemEdit = $('#categoria').serialize();
    itemEdit += `&idCategoria=${idItemEdit}`;

    console.log(itemEdit);

    if(itemEdit != "") {
      manipulatingInfo(itemEdit, "../model/upd_categoria.php", "Categoria", "edita");

      $('#inputNomeCat').val("");
      $('#inputDescricaoCat').val("");
  
      itemEdit = "";
      idItemEdit = "";
    } else {
      alert("Nada para ser editado. Escolha uma categoria e tente novamente.");
    }

    

    trocarBtnRegistrar();
  });

  $('.btnDelCategoria').click(function() { //Pega as infos da linha clicada para o forms e muda o botão
    trocarBtnDelete();

    var nTr = $(this).parents('tr')[0];
    var dados = tableCat.row(nTr).data();

    $('#inputNomeCat').val(dados[1]);
    $('#inputDescricaoCat').val(dados[2]);

    itemDelete = $('#categoria').serialize();
    itemDelete += `&idCategoria=${dados[0]}`;

    rollToForm();

    console.log(itemDelete);
  });

  $('#btnDelCategoria').click(function(){ //Envia os dados para o php para ser deletado
    if(itemDelete != ""){
      manipulatingInfo(itemDelete, "../model/del_categoria.php", "Categoria", "deleta");

      $('#inputNomeCat').val("");
      $('#inputDescricaoCat').val("");

      itemDelete = "";    
      
    } else {
      alert("Nada para ser deletado. Escolha uma categoria e tente novamente.");
    }

    trocarBtnRegistrar();
  });
  //----------------------------------


  //PRODUTOS--------------------------
  $('.btnEditProduto').click(function() {
    trocarBtnEditar();

    var nTr = $(this).parents('tr')[0];
    var dados = tableProd.row(nTr).data();

    $('#inputNome').val(dados[1]);
    $('#inputDescricao').val(dados[2]);
    $('#inputCategoria').val(dados[3]);
    $('#inputAdress').val(dados[4]);
    $('#inputPrecoAtual').val(dados[5]);
    $('#inputPrecoAntigo').val(dados[6]);

    rollToForm();

    idItemEdit = dados[0];
  });

  $('#btnEditProduto').click(function() {
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
      editProd(data, "../model/upd_produto.php");

      $('#inputNome').val("");
      $('#inputDescricao').val("");
      $('#inputCategoria').val("");
      $('#inputAdress').val("");
      $('#inputPrecoAtual').val("");
      $('#inputPrecoAntigo').val("");
      $('#inputImagem').val("");

      itemEdit = "";
      idItemEdit = "";
    }

    trocarBtnRegistrar();
  });

  $('.btnDelProduto').click(function() {
    trocarBtnDelete();

    var nTr = $(this).parents('tr')[0];
    var dados = tableProd.row(nTr).data();
    
    $('#inputNome').val(dados[1]);
    $('#inputDescricao').val(dados[2]);
    $('#inputCategoria').val(dados[3]);
    $('#inputAdress').val(dados[4]);
    $('#inputPrecoAtual').val(dados[5]);
    $('#inputPrecoAntigo').val(dados[6]);
    // $('#inputImagem').val(dados[1]);

    itemDelete = $("#produto").serialize();
    itemDelete += `&idProduto=${dados[0]}`;

    rollToForm();

    console.log(itemDelete);
  });

  $('#btnDelProduto').click(function(){
    if(itemDelete != ""){
      manipulatingInfo(itemDelete, "../model/del_produto.php", "Produto", "deleta");

      $('#inputNome').val("");
      $('#inputDescricao').val("");
      $('#inputCategoria').val("");
      $('#inputAdress').val("");
      $('#inputPrecoAtual').val("");
      $('#inputPrecoAntigo').val("");

      itemDelete = "";
    } else {
      alert("Nada para deletar. Escolha um produto e tente novamente");
    }

    trocarBtnRegistrar();
  });
});