<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="utf-8">
    <title>RestServer com CodeIgniter</title>
    <link rel="stylesheet" href="<?=base_url('assets/bower_components/AdminLTE/bootstrap/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?=base_url('assets/bower_components/AdminLTE/dist/css/AdminLTE.min.css')?>">



    <!-- <link rel="stylesheet" href="<?=base_url('assets/bower_components/AdminLTE/bootstrap/dist/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets/bower_components/AdminLTE/datatables.net-bs/css/dataTables.bootstrap.css')?>"> -->
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                

                <!-- TO DO List -->
                <div class="box box-primary">
                    <div class="box-header">
                        <i class="ion ion-clipboard"></i>

                        <h3 class="box-title">To Do List</h3>

                        <div class="box-tools pull-right">
                            <ul class="pagination pagination-sm inline">
                                <li><a href="#">&laquo;</a></li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">&raquo;</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <ul class="todo-list">
                            <li>
                                <!-- drag handle -->
                                <span class="handle">
                                    <i class="fa fa-ellipsis-v"></i>
                                    <i class="fa fa-ellipsis-v"></i>
                                </span>
                                <!-- checkbox -->
                                <input type="checkbox" value="">
                                <!-- todo text -->
                                <span class="text">Design a nice theme</span>
                                <!-- Emphasis label -->
                                <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
                                <!-- General tools such as edit or delete-->
                                <div class="tools">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </li>
                            <li>
                                <span class="handle">
                                    <i class="fa fa-ellipsis-v"></i>
                                    <i class="fa fa-ellipsis-v"></i>
                                </span>
                                <input type="checkbox" value="">
                                <span class="text">Make the theme responsive</span>
                                <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
                                <div class="tools">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </li>
                            <li>
                                <span class="handle">
                                    <i class="fa fa-ellipsis-v"></i>
                                    <i class="fa fa-ellipsis-v"></i>
                                </span>
                                <input type="checkbox" value="">
                                <span class="text">Let theme shine like a star</span>
                                <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
                                <div class="tools">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </li>
                            <li>
                                <span class="handle">
                                    <i class="fa fa-ellipsis-v"></i>
                                    <i class="fa fa-ellipsis-v"></i>
                                </span>
                                <input type="checkbox" value="">
                                <span class="text">Let theme shine like a star</span>
                                <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
                                <div class="tools">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </li>
                            <li>
                                <span class="handle">
                                    <i class="fa fa-ellipsis-v"></i>
                                    <i class="fa fa-ellipsis-v"></i>
                                </span>
                                <input type="checkbox" value="">
                                <span class="text">Check your messages and notifications</span>
                                <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
                                <div class="tools">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </li>
                            <li>
                                <span class="handle">
                                    <i class="fa fa-ellipsis-v"></i>
                                    <i class="fa fa-ellipsis-v"></i>
                                </span>
                                <input type="checkbox" value="">
                                <span class="text">Let theme shine like a star</span>
                                <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
                                <div class="tools">
                                    <i class="fa fa-edit"></i>
                                    <i class="fa fa-trash-o"></i>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer clearfix no-border">
                        <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
                    </div>
                </div>
                <!-- /.box -->

            </div>
        </div>
    </div>

    <script src="<?=base_url('assets/bower_components/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
    <script src="<?=base_url('assets/bower_components/AdminLTE/bootstrap/js/bootstrap.min.js')?>"></script>

    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="<?=base_url('assets/bower_components/AdminLTE/dist/js/app.min.js')?>"></script>
    <script src="<?=base_url('assets/bower_components/AdminLTE/dist/js/pages/dashboard.js')?>"></script>
    <!-- <script src="<?=base_url('assets/bower_components/AdminLTE/dist/js/demo.js')?>"></script> -->


<!-- 
    <script src="<?=base_url('assets/bower_components/AdminLTE/jquery/dist/jquery.min.js')?>"></script>
    <script src="<?=base_url('assets/bower_components/AdminLTE/bootstrap/dist/js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('assets/bower_components/AdminLTE/datatables.net/js/jquery.dataTables.min.js')?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script> -->

    <!-- <script src="<?=base_url('assets/js/actions.js')?>"></script> -->
</body>
</html>