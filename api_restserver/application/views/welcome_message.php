<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="utf-8">
    <title>Task list | RestServer com CodeIgniter</title>
    <link rel="stylesheet" href="<?=base_url('assets/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?=base_url('assets/bower_components/AdminLTE/dist/css/AdminLTE.min.css')?>">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <br>
                <a href="javascript:void(0)" id="btn-novo-item" data-toggle="modal" data-target="#formTaskModal" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add item</a>
            </div>
            <div class="col-xs-12 col-md-8 col-md-offset-2">
                <hr>
                <ul class="todo-list" id="task-list" data-url="<?= base_url('api/tasks') ?>"></ul>
                <br>
            </div>
        </div>
    </div>

    <div class="modal fade" id="formTaskModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Nova Task</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="<?=base_url('api/tasks')?>" id="formTask"val>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="titulo">Título</label>
                            <div class="col-md-10">
                                <input id="titulo" name="titulo" placeholder="Título da Task" class="form-control input-md" type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="descricao">Descrição</label>
                            <div class="col-md-10">
                                <textarea class="form-control" id="descricao" name="descricao" placeholder="Descreva sobre a Task"></textarea>
                            </div>
                        </div>
                    </form>

                    <div class="edicao"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btn-submit-form">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="<?=base_url('assets/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
    <script src="<?=base_url('assets/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('assets/bower_components/AdminLTE/plugins/jQueryUI/jquery-ui.min.js')?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    <script src="<?=base_url('assets/js/actions.js')?>"></script>
</body>
</html>