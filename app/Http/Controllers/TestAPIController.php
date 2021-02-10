<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestAPIController extends Controller
{
  public function getAll()
   {
     $cost = $_GET["cost"];
     echo cost;
      date_default_timezone_set('Asia/Tokyo');
      $NowDate=date("Y/m/d H:i:s");
      $DB_CONNECTION=$_ENV["DB_CONNECTION"];
      $HOST=$_ENV["DB_HOST"];
      $DB_DATABASE=$_ENV["DB_DATABASE"];
      $DB_PORT=$_ENV["DB_PORT"];
      $DB_USERNAME=$_ENV["DB_USERNAME"];
      $DB_PASSWORD=$_ENV['DB_PASSWORD'];
      if ($DB_CONNECTION == "mysql") {
        $link = mysqli_connect($HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
      }
      else if ($DB_CONNECTION == "pgsql") {
        $conn_string = "host=".$HOST." port=".$DB_PORT." dbname=".$DB_DATABASE." user=".$DB_USERNAME." password=".$DB_PASSWORD;
        $link = pg_connect($conn_string);
        echo "接続しました．";
        $flag=0;
        $sql_bef="SELECT * FROM recipes";
        $resultNew = pg_query($link, $sql_bef);
          while ($rowNew = pg_fetch_row($resultNew)) {
            $rowsNew["recipes"][]=$rowNew;
            $flag=1;
        }
        if ($flag == 0) {
            $rowsNew["message"]="Not found recipe";
          }
          echo json_encode($rowsNew,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      }
   }
   public function getID($ID)
    {
      date_default_timezone_set('Asia/Tokyo');
      $NowDate=date("Y/m/d H:i:s");
      $DB_CONNECTION=$_ENV["DB_CONNECTION"];
      $HOST=$_ENV["DB_HOST"];
      $DB_DATABASE=$_ENV["DB_DATABASE"];
      $DB_PORT=$_ENV["DB_PORT"];
      $DB_USERNAME=$_ENV["DB_USERNAME"];
      $DB_PASSWORD=$_ENV['DB_PASSWORD'];
      if ($DB_CONNECTION == "mysql") {
        $link = mysqli_connect($HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
      }
      else if ($DB_CONNECTION == "pgsql") {
        $conn_string = "host=".$HOST." port=".$DB_PORT." dbname=".$DB_DATABASE." user=".$DB_USERNAME." password=".$DB_PASSWORD;
        $link = pg_connect($conn_string);
        echo "接続しました．";
        $sql_bef="SELECT * FROM recipes";
        $resultNew = pg_query($link, $sql_bef);
        $flag=0;
          while ($rowNew = pg_fetch_row($resultNew)) {
            if ($rowNew[0] == $ID) {
              $rowsNew["message"]="Recipe detail by id";
              $rowsNew["recipes"][]=$rowNew;
              $flag=1;
              echo json_encode($rowsNew,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
          }
        }
        if ($flag == 0) {
            $rowsNew["message"]="Not found recipe";
            echo json_encode($rowsNew,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
          }
      }
    }
   public function post()
    {
      date_default_timezone_set('Asia/Tokyo');
      $NowDate=date("Y/m/d H:i:s");
      $DB_CONNECTION=$_ENV["DB_CONNECTION"];
      $HOST=$_ENV["DB_HOST"];
      $DB_DATABASE=$_ENV["DB_DATABASE"];
      $DB_PORT=$_ENV["DB_PORT"];
      $DB_USERNAME=$_ENV["DB_USERNAME"];
      $DB_PASSWORD=$_ENV['DB_PASSWORD'];
      if ($DB_CONNECTION == "mysql") {
        $link = mysqli_connect($HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
      }
      else if ($DB_CONNECTION == "pgsql") {
        $conn_string = "host=".$HOST." port=".$DB_PORT." dbname=".$DB_DATABASE." user=".$DB_USERNAME." password=".$DB_PASSWORD;
        $link = pg_connect($conn_string);
        echo "接続しました．";
        $sql_bef="SELECT * FROM recipes";
        $resultNew = pg_query($link, $sql_bef);
          while ($rowNew = pg_fetch_row($resultNew)) {
            $ID = $rowNew[0]+1;
        }
        echo $ID;
      }

    }
    public function patch($ID)
     {
        echo "PATCH";
  		   return 'patchでーす';
     }
     public function delete($ID)
      {
         echo "DELETE";
   		   return 'deleteでーす';
      }
      public function error($message)
       {    
    		   return 'Not found '.$message;
       }
}
