<?php
namespace WebDesign;

class Database
{

    //database login information
    protected $username = "iqover9000";
    protected $password = "iOniz4tion";
    protected $database = "track";
    protected $server = "localhost";

    protected $db_handle;

    public $tb_handle;
    public $values;
    public $recordsNumber;
    public $rowNumber;
    public $tb;
    public $records;
    public $order;

    //Connects to database, table, and assigns values
    function __construct($tb,$order) {
        $this->db_handle = mysqli_connect($this->server,$this->username,$this->password,$this->database);
        $tb = mysqli_escape_string($this->db_handle,$tb);
       
        $this->tb = $tb;
        $this->order = $order;

        //$SQL = "SHOW columns FROM " . $this->tb;
        //$this->records = mysqli_query($this->db_handle,$SQL);        
       

        

        $this->assign();
    }

    public function assign() {
        $SQL = "SELECT * FROM " . $this->tb . " ORDER BY " . $this->order;
        $this->tb_handle = mysqli_query($this->db_handle,$SQL);

        while ($finfo = mysqli_fetch_field($this->tb_handle)) {
            $this->records[] = $finfo->name;
        }

        $this->rowNumber = mysqli_num_rows($this->tb_handle);
        $this->recordsNumber = count($this->records);
        //this creates arrays from records given even if the table is empty
        //this is to prevent errors
        if ($this->rowNumber === 0) {
            foreach ($this->records as $record) {
                $this->{$record} = array();
            } 
        } else {
            $i = 0;        
            while ( $db_field = mysqli_fetch_assoc($this->tb_handle) ) {
                foreach ($this->records as $record) {
                    $this->{$record}[$i] = $db_field[$record];

                    $encoding = mb_detect_encoding($this->{$record}[$i]);
                    $this->{$record}[$i] = mb_convert_encoding($this->{$record}[$i],"UTF-8");
                    $this->{$record}[$i] = htmlspecialchars($this->{$record}[$i], ENT_QUOTES, "ISO-8859-1");
                }            
                $i++;
            }
        }
    }

    //saves all records passed in through the array
    public function save($records) {
        //loops through all of the record-column names
        foreach ($records as $record) {
            //loops through all of the records for the column       
            for ($i = 1; $i < $this->rowNumber + 1; $i++) {             
                $this->{$record}[$i] = mysqli_real_escape_string($this->db_handle,$_POST[$this->tb . $record . $i]);
                $SQL = "UPDATE " . $this->tb . " SET " . $record . " = '" . $this->{$record}[$i] . "' WHERE ID = '" . $i . "'";
                mysqli_query($this->db_handle,$SQL);           
            }
        }
        $this->assign();
    }

    //this function saves file based records if they are not blank based on the 'choose file' input
    public function saveFile($records,$path) {
        //loops through all of the record-column names
        foreach ($records as $record) {
            //loops through all of the records for the column       
            for ($i = 1; $i < $this->rowNumber + 1; $i++) {             
                $this->{$record}[$i] = mysqli_real_escape_string($this->db_handle,$_FILES[$this->tb . $record . $i]["name"]);
                if (!$this->{$record}[$i] == "") {
                    $SQL = "UPDATE " . $this->tb . " SET " . $record . " = '" . $this->{$record}[$i] . "' WHERE ID = '" . $i . "'";
                    mysqli_query($this->db_handle,$SQL);                  
                    $this->upload($this->tb . $record . $i,$path);
                }                        
            }
        }
        $this->assign();
    }

    public function savePattern($records,$post,$pattern) {
         //loops through all of the record-column names
        foreach ($records as $record) {
            //loops through all of the records for the column       
            for ($i = 1; $i < $this->rowNumber + 1; $i++) {             
                $this->{$record}[$i] = mysqli_real_escape_string($this->db_handle,$_POST[$this->tb . $post[0] . $i]);
                preg_match($pattern, $this->{$record}[$i],$matches);

                if (!isset($matches[0])) {
                    $matches[0] = "0000-00-00";
                } else {
                    $matches[0] = "2015-" . $matches[0];                   
                }
                
                $SQL = "UPDATE " . $this->tb . " SET " . $record . " = CAST('" . $matches[0] . "' AS DATE) WHERE ID = '" . $i . "'";
                mysqli_query($this->db_handle,$SQL);           
            }
        }
       $this->assign();
    }

    //adds a row to the table
    public function add() {
        $SQL = "INSERT INTO " . $this->tb . " (ID) VALUES (" . ($this->rowNumber + 1) . ")";
        mysqli_query($this->db_handle,$SQL);
        $this->rowNumber = mysqli_num_rows($this->tb_handle);
        $this->assign();
    }

    //adds specific data
    public function addSpecific($columns,$values) {
        $names = "";
        foreach ($columns as $column) {
            if ($column === end($columns)) {
                $names .= $column . ")";
            } else {
                $names .= $column . ",";
            }
        }       

        $data = "";
        foreach ($values as $value) {
            if ($value === end($values)) {
                $data .= "'" . mysqli_real_escape_string($this->db_handle,$value) . "'" . ")";
            } else {
                $data .= "'" . mysqli_real_escape_string($this->db_handle,$value) . "'" . ",";
            }
        }

        $SQL = "INSERT INTO " . $this->tb . "(ID," . $names . " VALUES (" . ($this->rowNumber + 1) . "," . $data;        
        mysqli_query($this->db_handle,$SQL);
        $this->rowNumber = mysqli_num_rows($this->tb_handle);
        $this->assign();
    }

    //deletes the specified id, and closes the id gap
    public function delete($number) {
        $SQL = "DELETE FROM " . $this->tb . "  WHERE Id= " . $number;
        mysqli_query($this->db_handle,$SQL);
        for ($i=$number; $i < $this->rowNumber + 1; $i++) { 
            $SQL = "UPDATE " . $this->tb . " SET ID = '" . ($i - 1) . "' WHERE ID = '" . $i . "'";    
            mysqli_query($this->db_handle,$SQL);
        }

        $this->assign();
    }

    //deletes all of the data
    public function deleteAll() {
        $SQL = "DELETE FROM " . $this->tb;
        mysqli_query($this->db_handle,$SQL);
        
        $this->assign();
    }

    public function upload($name,$path,$max = true) {
        $allowedExts = array("gif", "jpeg", "jpg", "JPG", "x-png", "png", "pjpeg","JPEG");
        $temp = explode(".", $_FILES[$name]["name"]);
        $extension = end($temp);
        require_once "WebDesign/simpleimage.class.php";

        if ((($_FILES[$name]["type"] == "image/gif")
        || ($_FILES[$name]["type"] == "image/jpeg")
        || ($_FILES[$name]["type"] == "image/jpg")
        || ($_FILES[$name]["type"] == "image/pjpeg")
        || ($_FILES[$name]["type"] == "image/x-png")
        || ($_FILES[$name]["type"] == "image/png")
        || ($_FILES[$name]["type"] == "image/JPEG")
        || ($_FILES[$name]["type"] == "image/JPG"))
        
        && in_array($extension, $allowedExts)) {
        
          if ($_FILES[$name]["error"] > 0)
            {
           //echo "Return Code: " . $_FILES[$name]["error"] . "<br>";
            }
          else
            {
            //echo "Upload: " . $_FILES[$name]["name"] . "<br>";
            //echo "Type: " . $_FILES[$name]["type"] . "<br>";
            //echo "Size: " . ($_FILES[$name]["size"] / 1024) . " kB<br>";
            //echo "Temp file: " . $_FILES[$name]["tmp_name"] . "<br>";

            if (file_exists("upload/" . $_FILES[$name]["name"]))
              {
              //echo $_FILES[$name]["name"] . " already exists. ";
              }
            else
              {
              move_uploaded_file($_FILES[$name]["tmp_name"],
              $path . $_FILES[$name]["name"]);
              if ($max) {
                $image = new SimpleImage();
                $image->load($path . $_FILES[$name]["name"]);             
                $image->resizeToWidth(900);
                $image->save($path . $_FILES[$name]["name"]);
                unset($image);
              }
              //echo "Stored in: " . "upload/" . $_FILES[$name]["name"];
              }
            }
        }      
    }
}
