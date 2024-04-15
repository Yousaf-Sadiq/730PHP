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


function redirect_url(string $url)
{
  header("Location:{$url}");
}
?>