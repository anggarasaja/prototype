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
        $cek_eksist=0;
          $qry = $DB->query("select nama_album,id_album from album where id_album='$id_album' " );
          while ($row = $DB->fetch_object($qry)) {
               $nama_album=$row->nama_album;
               $id_album=$row->id_album;
               $cek_eksist=1;
          }
            if($cek_eksist==0){
                          
                            $UTILITY->popup_message("Maaf data foto tidak memiliki album");
                            $UTILITY->location_goto("content/album");
                        }
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Foto  (Album <?=$nama_album?>)</h1>
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                          <div class="panel-info">
                             <ul class="breadcrumb">
                                  <li class="active" >Foto</li>
                                  
                             </ul>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                              <a class="btn btn-primary" href="<?=$url_rewrite ?>content/foto/<?=$id_album?>/tambah/" >Add Foto</a>
                              <br/>
                              <br/>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-today">
                                    <thead>
                                        <tr>
                                            <th width="25%">Gambar</th>
                                            <th width="10%">Keterangan</th>
                                            <th width="10%">Waktu</th>
                                       
                                             <th width="10%">Status</th>
                                             <th width=15%">Headline</th>
                                            <th width="30%">Event</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                                  <td colspan="6" class="dataTables_empty">Loading data from server</td>
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
        $('#dataTables-today').dataTable(
                {
                    "aoColumnDefs": [
                         { "aTargets": [2] }
                    ],
                    "aoColumns":[
                         {"bSortable": false},
                         {"bSortable": false},
                         {"bSortable": true},
                         
                             {"bSortable": true},
                               {"bSortable": true},
                         {"bSortable": false}],
   
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "<?=$url_rewrite?>api/api_foto.php?album=<?=$id_album?> "
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
