<?php
declare(strict_types=1);
function filter_data(string $data)
{

  global $conn;
  $data = trim($data);
  $data = $conn->real_escape_string(htmlspecialchars($data));
  $data = stripslashes($data);


  return $data;

}



function ERROR_MSG(string $msg)
{
  echo "<div class='alert alert-danger d-flex flex-wrap align-items-center ' role='alert'>
    <svg style='width:10%' class='bi flex-shrink-0 ' role='img' aria-label='Danger:'><use xlink:href='#exclamation-triangle-fill'/></svg>
    <div style='font-size:1.5rem;'>
     $msg
    </div>
  </div>";
}


function Sucuss_msg(string $msg)
{
  echo "<div class='alert alert-success  d-flex flex-wrap align-items-center ' role='alert'>
    <svg style='width:10%' class='bi flex-shrink-0 me-2' role='img' aria-label='Success:'><use xlink:href='#check-circle-fill'/></svg>
    <div style='font-size:1.5rem;'>
     $msg
    </div>
  </div>";
}

function refresh_url(int $second, string $url)
{


  header("Refresh:{$second},url={$url}");
}



function File_upload(string $input, array $ext, string $to)
{
  $file = $_FILES[$input];

  $file_name = ceil(rand(1,99))."_".$file["name"];
  $tmp_name = $file["tmp_name"];


  $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION)); // png,jpg 

  if (!in_array($file_ext, $ext)) {
    $string = implode(",", $ext);
    ERROR_MSG("{$string} ONLY REQUIRED EXTENTION");

    return false;
  }

  $destination = $to . "/" . $file_name;
  $url = [];
  if (move_uploaded_file($tmp_name, $destination)) {
    $url["absolute_url"] = absolute_upload . "/" . $file_name;
    $url["relative_url"] = relative_upload . "/" . $file_name;

    return $url;

  } else {
    ERROR_MSG("FILE UPLOADING ERROR");
    return false;
  }

}





function redirect_url(string $url)
{
  header("Location:{$url}");
}

function pre(array $a)
{
  echo "<pre>";
  print_r($a);
  echo "</pre>";
}
?>