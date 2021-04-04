<?php

require_once("config.php"); 
 if(isset($_GET["type"])){
    $type = $_GET["type"];
     $type();

}


function viewBackup(){

    $table =<<<EOT
	( SELECT * FROM tbl_backup back JOIN tbl_users em ON em.emp_id= back.user_id WHERE backup_status='1' ORDER BY backup_date
		) temp
EOT;

    $primaryKey ='backup_id';

    $columns = array(
        array( 'db' => 'backup_id', 'dt'=> 0),
        array( 'db' => 'backup_date', 'dt'=> 1),
        array( 'db' => 'backup_time', 'dt'=> 2),
        array( 'db' => 'file_name', 'dt'=> 3),
        array( 'db' => 'emp_fname', 'dt'=> 4),

    );
    require_once('config.php');
    $host = Config::$host ; 
    $user = Config::$db_uname ;
    $pass = Config::$db_upass ;
    $db = Config::$db_name ;

    $sql_details = array(
        'user' => $user,
        'pass' => $pass,
        'db'   => $db,
        'host' => $host
    );

    require('ssp.class.php');

    echo json_encode(
    SSP::complex($_POST, $sql_details, $table, $primaryKey, $columns,null )
    );
 

}

function createBackup(){
    $userid = $_POST['userid'];

    $host ="localhost";
    $user ="root";
    $pass ="";
    $name = "nesmo_db";
    $tables = '*';
    $link = mysqli_connect($host,$user,$pass,$name);
    $tables = array(); //get tables to array
    $result = mysqli_query($link,'SHOW TABLES');

    while($row= mysqli_fetch_row($result)){
        $tables[] = $row[0]; // tables add to array
    }
    $return ="";
    foreach ($tables as $table) {
       $result = mysqli_query($link,'SELECT * FROM '.$table);
       $num_fields = mysqli_num_fields($result); //count rows
       $row2 = mysqli_fetch_row(mysqli_query($link,'SHOW CREATE TABLE '.$table));
       $return .= "\n\n".$row2[1].";\n\n";

       for($i = 0; $i < $num_fields; $i++){
            while($row= mysqli_fetch_row($result)){
                $return .= 'INSERT INTO '.$table.'VALUES(';
                    for($j=0; $j<$num_fields; $j++){
                         $row[$j] = addslashes($row[$j]);
                         if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                         if ($j<($num_fields-1)) { $return.= ','; }
                    }

                 $return.= ");\n";
            }
       }
       $return.="\n\n\n";
    }
  
  $name = "db_".time().'.sql';
  $path ="../backup/";
  $handle = fopen($path.$name,'w+');
  fwrite($handle,$return);
  fclose($handle);

  $cdate=date('Y-m-d'); 
  $ctime=date("H:i:s");
    $dbobj =DB::connect();
  $sql="INSERT INTO tbl_backup VALUES('','$cdate','$ctime','$name','$userid','1')"; //inserting backup details into backup table
   $res = $dbobj->prepare($sql);
   if(!$res->execute()){
        echo "0,Not Success";
   }else{
        echo "1,Successs";
   }
   $dbobj->close();
}

function restoreBackup(){
    $filename = $_FILES['customFile']['tmp_name'];

   // $filename ="../backup/".$filename;

    $dbobj = mysqli_connect('localhost','root','','final');

    $handle = fopen($filename,"r+");

    $contents = fread($handle, filesize($filename)); //fread to read file (file name and size)

    $sql = explode(';',$contents); //break line to array
    $output ="";
    foreach($sql as $query){
      $result = $dbobj->query($query);
      if($result->errno){
            $output .= '<hr>'.$query.' <b>SUCCESS</b><hr>';
      }
    }
fclose($handle);
echo $output;

}

?>