<!DOCTYPE html>
<html>

<head>

   <?php
   include "view/head.php";
   ?>

</head>

<body>

    <div id="wrapper">

        <?php
        include "view/default/right_menu.php";
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Setting    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                          <div class="panel-info">
                             <ul class="breadcrumb">
                                  <li class="active" >Setting</li>
                                  
                             </ul>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                              <a class="btn btn-primary" href="<?=$url_rewrite ?>content/setting/tambah" >Add Pengguna</a>
                              <br/>
                              <br/>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-setting">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Level</th>
                                            <th>Event</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                                  <td colspan="3" class="dataTables_empty">Loading data from server</td>
                                             </tr>
                                     </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
     <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-setting').dataTable(
                {
                    "aoColumnDefs": [
                         { "aTargets": [2] }
                    ],
                    "aoColumns":[
                         {"bSortable": true},
                         {"bSortable": true},
                         {"bSortable": false}],
   
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>api/api_pengguna.php"
               }
                  
                  );
    });
    </script>
    
    
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    

    

</body>

</html>
