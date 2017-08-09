/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function () {

    "use strict";

    //Make the dashboard widgets sortable Using jquery UI
    $(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".box-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999
    });
    $(".connectedSortable .box-header, .connectedSortable .nav-tabs-custom").css("cursor", "move");

    //jQuery UI sortable for the todo list
    $(".todo-list").sortable({
        placeholder: "sort-highlight",
        handle: ".handle",
        forcePlaceholderSize: true,
        zIndex: 999999
    });

    /* The todo list plugin */
    $(".todo-list").todolist({
        onCheck: function (ele) {
            window.console.log("The element has been checked");
            return ele;
        },
        onUncheck: function (ele) {
            window.console.log("The element has been unchecked");
            return ele;
        }
    });

    $(document).ready(function(){
        //chama função para pegar as Tasks
        GetAll();
    });

    //pega todos os registros na tabela
    function GetAll() 
    { 
        var url_action = $("#task-list").data('url');
        var item = '';
        var check = '';

        return $.ajax({
            type: 'GET',
            url: url_action,
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            success: function(response) {

                if(response !== undefined) {
            
                    $.each(response.data, function(key,val){

                        if (val.status == 0) {
                            check = 'done';
                        } else {
                            check = '';
                        }

                        item += '<li class="'+ check +'" >'+
                                    '<span class="handle">'+
                                        '<i class="fa fa-ellipsis-v"></i> '+
                                        '<i class="fa fa-ellipsis-v"></i> '+
                                    '</span>'+
                                    '<input type="checkbox" value="'+ val.status +'" name="status" class="check-item" data-item="'+ val.id +'">'+
                                    '<span class="text">'+ val.titulo +'</span>'+
                                    '<div class="tools">'+
                                        '<a href="javascript:void(0)" class="edit-item" data-item="'+ val.id +'">'+
                                            ' <i class="fa fa-edit text-red fa-fw"></i> '+
                                        '</a>'+
                                        '<a href="javascript:void(0)" class=" delete-item" data-item="'+ val.id +'">'+
                                            ' <i class="fa fa-trash-o text-red fa-fw"></i> '+
                                        '</a>'+
                                    '</div>'+
                                '</li>';
                    });
                    $("#task-list").html(item);

                } else {
                    $("#task-list").html('');
                    return false;
                }
            },
            error: function(response){
                return false;
            }
        });
    }

    //action para executar o submit do form no modal
    $("#btn-submit-form").click(function() {
        $("#formTask").submit();
        return false;
    });

    // reseta o formulário assegurando caso item selecionado não seja editado
    $("#btn-novo-item").click(function() {
        ResetForm('PUT');
    });

    //action para executar o submit do form com requisição ajax
    $("#formTask").on('submit', (function(e) {
        e.preventDefault();
        var url_action = $(this).attr('action');
        var form_method = $(this).attr('method');
        var form_data = $(this).serialize();

        $.ajax({
            url: url_action,
            data: form_data,
            dataType: 'json',
            method: form_method,
            beforeSend: function(){
                $("#btn-submit-form").prop('disabled', true);
            },
            success: function(response){
                $("#formTaskModal").modal('hide');
                MessageDialog('Info', response.message);

                $("#btn-submit-form").prop('disabled', false);
                ResetForm(form_method);

                return false;
            },
            error: function(response){
                MessageDialog('Warning', response.responseJSON.message);
                $("#btn-submit-form").prop('disabled', false);

                return false;
            }
        }).then(function() {
            //atualiza lista
            GetAll();
        });

    }));

    /* Função criada para poder exibir as mensagens de sucesso ou erro */
    function MessageDialog(title,message){
        var dialog = bootbox.dialog({
            title: title,
            message: message,
            backdrop: true
        });
        dialog.init(function(){
            setTimeout(function(){
                dialog.modal('hide');
            }, 5000);
        });
    }

    // Função criada para manipular o formulário, inserindo os dados para edição
    $(document).on('click', '.edit-item', (function(e) {

        e.preventDefault();

        var task_id = $(this).data('item');
        
        if(task_id === undefined) {
            MessageDialog('Atenção','O item não foi selecionado.');
            return false;
        }

        var api_url = location.protocol + "//" + location.host + "/projeto/api_restserver/api/tasks/"+task_id;
        $.ajax({
            url: api_url,
            dataType: 'json',
            method: "GET",
            success: function(response){
                console.log(response.data[0].id);
                $('#formTask').attr('method','PUT');
                $('#formTask').attr('action',api_url);
                $('#formTask #titulo').val(response.data[0].titulo);
                $('#formTask #descricao').val(response.data[0].descricao);

                // $('#formUsuario #email').attr('readonly', true);
                // $('#formUsuario #senha').attr('required', false);

                $('#formTaskModal #myModalLabel').text('Editar Item');

                //$('#btn-remover-usuario').removeClass('hidden');
                //$('#btn-remover-usuario').data("id_usuario",response.data[0].id);

                $('#formTaskModal').modal('show');
                return false;
            },
            error: function(response){
                MessageDialog('Atenção',response.responseJSON.message);
                return false;
            }
        });
    }));

    // Função criada para manipular o formulário, exclusão
    $(document).on('click', '.delete-item', (function(e) {

        e.preventDefault();

        var confirmacao = confirm('Deseja realmente excluir essa Task?');
        if (confirmacao) {

            var task_id = $(this).data('item');
        
            if (task_id === undefined) {
                MessageDialog('Atenção','O item não foi selecionado.');
                return false;
            }

            var api_url = location.protocol + "//" + location.host + "/projeto/api_restserver/api/tasks/"+task_id;

            $.ajax({
                url: api_url,
                type: 'DELETE',
                dataType: 'json',
                success: function (response) {
                    MessageDialog('Informação',response.message);
                    return false;
                },
                error: function(response){
                    MessageDialog('Atenção',response.responseJSON.message);
                    return false;
                }
            }).then(function() {
                //atualiza lista
                GetAll();
            });
        }
        return false;
    }));

    // Função criada para manipular o formulário, checar task
    $(document).on('click', '.check-item', (function(e) {

        e.preventDefault();

        var confirmacao = confirm('Deseja realmente mudar o status essa Task?');
        if (confirmacao) {

            var task_id = $(this).data('item');
            var task_status = $(this).val();

            if (task_status == 0) {
                $(this).val('1');
            } else if (task_status == 1) {
                $(this).val('0');
            }
        
            if (task_id === undefined) {
                MessageDialog('Atenção','O item não foi selecionado.');
                return false;
            }

            var api_url = location.protocol + "//" + location.host + "/projeto/api_restserver/api/tasks/"+task_id;

            var form_data = $(this).serialize();
            var item_li = $(this).parents("li").first();

            $.ajax({
                url: api_url,
                data: form_data,
                dataType: 'json',
                method: 'PUT',
                success: function(response){
                    
                    item_li.toggleClass("done");

                    MessageDialog('Informação',response.message);
                    return false;
                },
                error: function(response){
                    MessageDialog('Atenção',response.responseJSON.message);
                    return false;
                }
            }).then(function() {
                //atualiza lista
                GetAll();
            });
        }
        return false;
    }));

    // Função que irá executar o reset do formulário, voltando os seus campos e configurações para o estado inicial
    function ResetForm(form_method){
        if (form_method == "PUT") {
            var api_url = location.protocol + "//" + location.host + "/projeto/api_restserver/api/tasks";
            $('#formTask').attr('method','POST');
            $('#formTask').attr('action',api_url);
            $('#formTask')[0].reset();
            $('#formTaskModal #myModalLabel').text('Novo Item');
            //$('#btn-remover-usuario').addClass('hidden');
        } else {
            $('#formTask')[0].reset();
        }
    }

});
