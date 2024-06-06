<?php
require_once dirname(__FILE__) . "/layout/user/header.php";

use app\database\Mysqli as DB;
use app\database\helper as help;


$obj = new DB;
$help = new help;
//  keys table columns   ]=> values database values
// $abc=[
//     "email"=>"XYZ@gmail.com",
//     "password"=>1234,
//     "ptoken"=>1234
// ];

// echo $obj->insert("user",$abc);
// echo form_action;

$obj->select("users");
$abc = $obj->Getresult();
// $help->pre($abc);

?>





<form class="text-bg-dark p-5 m-5" id="Myform" action="#" method="POST">

    <input type="hidden" name="insert" value="insert">

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="email" name="Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" name="pswd" class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1">
        <label class="form-check-label" for="exampleCheck1">Check me out</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>




<div class="table-responsive">
    <table class="table table-dark table-hover">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">USERNAME</th>
                <th scope="col">EMAIL</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($abc as $key => $value) {
                ?>
                <tr>
                    <td ><?php echo $value["user_id"] ?></td>
                    <td><?php echo $value["user_name"] ?></td>
                    <td><?php echo $value["email"] ?></td>
                </tr>

                <?php
            }
            ?>
        </tbody>
    </table>
</div>


<?php
require_once dirname(__FILE__) . "/layout/user/footer.php";

?>

<script>

    let form = document.querySelector("#Myform");

    form.addEventListener("submit", async function (event) {

        event.preventDefault();

        let Form_data = new FormData(form);



        let url = "<?php echo form_action; ?>";

        const option = {
            method: "POST",
            body: Form_data
        }

        let data = await fetch(url, option);

        let response = await data.json();

        console.log(response);
        if (response.error > 0) {

            response.message.forEach(msg => {
                SHOW_MESSEGE("error", msg, "danger")
            });
        }
        else {
            SHOW_MESSEGE("error", response.message, "success")
        }



    });
</script>