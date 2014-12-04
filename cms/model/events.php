  <?php
  include "../../config/config.php";
  open_connection();
        $query="select * from attraction where status_display=1 and kategori=2 order by waktu desc limit 2";
        $result=  mysql_query($query) or die(mysql_error());
        $no=0;
        $full="";
        while ($row=  mysql_fetch_object($result)){
             $judul=$row->judul;
             $waktu_2=$row->waktu_2;
             $waktu=$row->waktu;
             if($waktu_2!="0000-00-00 00:00:00")
                  $data="{\"title\": \"$judul\",
                              \"start\": \"$waktu\" ,
                                   \"end\": \"$waktu_2\"
                            }";
             else
                      $data="{\"title\": \"$judul\",
                              \"start\": \"$waktu\"
                            }";
             if($no==0)
                  $full=$data;
             else {
                       $full.=",".$data;
             }
             $no++;
        }
        echo "[$full]";
        
        ?>