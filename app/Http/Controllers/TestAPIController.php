<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestAPIController extends Controller
{
  public function getAll()
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
        //echo "接続しました．";
        $flag=0;
        $ID=0;
        $sql_bef="SELECT * FROM recipes";
        $resultNew = pg_query($link, $sql_bef);
          while ($rowNew = pg_fetch_row($resultNew)) {
            $rowsNew["recipes"][$ID]=$rowNew;
            $flag=1;
            $ID=$ID+1;
        }
        if ($flag == 0) {
            $rowsNew["message"]="Not found recipe";
          }
          return json_encode($rowsNew,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
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
        //echo "接続しました．";
        $sql_bef="SELECT * FROM recipes";
        $resultNew = pg_query($link, $sql_bef);
        $flag=0;
          while ($rowNew = pg_fetch_row($resultNew)) {
            if ($rowNew[0] == $ID) {
              $rowsNew["message"]="Recipe detail by id";
              $rowsNew["recipes"][]=$rowNew;
              $flag=1;
              return json_encode($rowsNew,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
          }
        }
        if ($flag == 0) {
            $rowsNew["message"]="Not found recipe";
            return json_encode($rowsNew,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
          }
      }
    }
   public function post(Request $request)
    {
      date_default_timezone_set('Asia/Tokyo');
      $NowDate=date("Y/m/d H:i:s");
      $DB_CONNECTION=$_ENV["DB_CONNECTION"];
      $HOST=$_ENV["DB_HOST"];
      $DB_DATABASE=$_ENV["DB_DATABASE"];
      $DB_PORT=$_ENV["DB_PORT"];
      $DB_USERNAME=$_ENV["DB_USERNAME"];
      $DB_PASSWORD=$_ENV['DB_PASSWORD'];
      $contentAll = $request->getContent();
      $content[0] = $request->input('title');
      $content[1] = $request->input('making_time');
      $content[2] = $request->input('serves');
      $content[3] = $request->input('ingredients');
      $content[4] = $request->input('cost');

      $POSTFlag=0;
      for ($i=0;$i<5;$i++) {
        if ($content[0] == NULL) {
          $POSTFlag=1;
        }
      }
      if ($POSTFlag == 1) {
        $rowsNew["message"]="Recipe creation failed!";
        $rowsNew["required"]="title, making_time, serves, ingredients, cost";
        return json_encode($rowsNew,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      }
      else {

        if ($DB_CONNECTION == "mysql") {
          $link = mysqli_connect($HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
        }
        else if ($DB_CONNECTION == "pgsql") {
          $conn_string = "host=".$HOST." port=".$DB_PORT." dbname=".$DB_DATABASE." user=".$DB_USERNAME." password=".$DB_PASSWORD;
          $link = pg_connect($conn_string);
          //echo "接続しました．";
          $sql_bef="SELECT * FROM recipes";
          $resultNew2 = pg_query($link, $sql_bef);
            while ($rowNew2 = pg_fetch_row($resultNew2)) {
              $ID = $rowNew2[0]+1;
          }
          $sql="insert into recipes (id, title, making_time, serves, ingredients, cost, created_at, updated_at) values (".$ID.", '".$content[0]."','".$content[1]."','".$content[2]."','".$content[3]."','".$content[4]."','".$NowDate."','".$NowDate."')";
          $resultPOST = pg_query($link, $sql);
          $resultNew = pg_query($link, $sql_bef);
          while ($rowNew = pg_fetch_row($resultNew)) {
          if ($rowNew[0] == $ID) {
            $rowsNew["message"]="Recipe detail by id";
            $rowsNew["recipes"][]=$rowNew;
            return json_encode($rowsNew,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
      }
          //echo $ID;
        }
    }
    }
    public function patch(Request $request, $ID)
     {
       date_default_timezone_set('Asia/Tokyo');
       $NowDate=date("Y/m/d H:i:s");
       $DB_CONNECTION=$_ENV["DB_CONNECTION"];
       $HOST=$_ENV["DB_HOST"];
       $DB_DATABASE=$_ENV["DB_DATABASE"];
       $DB_PORT=$_ENV["DB_PORT"];
       $DB_USERNAME=$_ENV["DB_USERNAME"];
       $DB_PASSWORD=$_ENV['DB_PASSWORD'];
       $contentAll = $request->getContent();
       $content[0] = $request->input('title');
       $content[1] = $request->input('making_time');
       $content[2] = $request->input('serves');
       $content[3] = $request->input('ingredients');
       $content[4] = $request->input('cost');
       $PATCHFlag=0;
       for ($i=0;$i<5;$i++) {
         if ($content[0] == NULL) {
           $PATCHFlag=1;
         }
       }
       if ($PATCHFlag == 1) {
         $rowsNew["message"]="Recipe update failed!";
         $rowsNew["required"]="title, making_time, serves, ingredients, cost";
         return json_encode($rowsNew,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
       }
       else {
         if ($DB_CONNECTION == "mysql") {
           $link = mysqli_connect($HOST, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE);
         }
         else if ($DB_CONNECTION == "pgsql") {
           $conn_string = "host=".$HOST." port=".$DB_PORT." dbname=".$DB_DATABASE." user=".$DB_USERNAME." password=".$DB_PASSWORD;
           $link = pg_connect($conn_string);
           //echo "接続しました．";
           $sql_bef="SELECT * FROM recipes";

           $sql="update recipes set id=".$ID.", title='".$content[0]."', making_time='".$content[1]."', serves='".$content[2]."',ingredients='".$content[3]."',cost='".$content[4]."', updated_at='".$NowDate."' where id=".$ID;
           $resultPATCH = pg_query($link, $sql);
           $resultNew = pg_query($link, $sql_bef);
           $FALG=0;
           while ($rowNew = pg_fetch_row($resultNew)) {
           if ($rowNew[0] == $ID) {
             $rowsNew["message"]="Recipe detail by id";
             $rowsNew["recipes"][]=$rowNew;
             return json_encode($rowsNew,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
             $FALG=1;
         }
       }
       if ($FALG == 0) {
        $rowsNew["message"]="No Recipe found!";
        return json_encode($rowsNew,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      }
           //echo $ID;
         }
     }

     }
     public function delete($ID)
      {
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
          //echo "接続しました．";
          $sql_bef="SELECT * FROM recipes";

          $resultNew = pg_query($link, $sql_bef);
          $FLAG=0;
          while ($rowNew = pg_fetch_row($resultNew)) {
          if ($rowNew[0] == $ID) {
            $sql="delete from recipes where id=".$ID;
            $resultDELETE = pg_query($link, $sql);
            $rowsNew["message"]="Recipe successfully removed!";
            $FLAG=1;
            return json_encode($rowsNew,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        }
      }
      if ($FLAG == 0) {
            $rowsNew["message"]="No Recipe found!";
            return json_encode($rowsNew,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
      }
        }
      }
      public function error($message)
       {
    		//   return 'Not found '.$message;
       }
}
