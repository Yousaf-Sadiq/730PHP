<?php
require_once dirname(__FILE__) . "/layout/user/header.php";

use app\database\Mysqli as DB;
use app\database\helper as help;


$obj = new DB;
$help = new help;
//  keys table columns   ]=> values database values
// $abc = [
//     "email" => "XYZ@gmail.com",
//     "password" => 1234,
//     "ptoken" => 1234
// ];

// $obj->update("users", $abc, "`user_id` =2");
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
                <th scope="col">ACTION</th>
            </tr>
        </thead>
        <tbody>

            <?php
            foreach ($abc as $key => $value) {
                ?>
                <tr>
                    <td><?php echo $value["user_id"] ?></td>
                    <td><?php echo $value["user_name"] ?></td>
                    <td><?php echo $value["email"] ?></td>
                    <td>
                        <?php
                        $email = $value["email"];
                        $user_name = $value["user_name"];
                        $user_id = $value["user_id"];
                        ?>
                        <a href="javascript:void(0)"
                            onclick="onEdit('<?php echo $email; ?>','<?php echo $user_name; ?>','<?php echo $user_id; ?>')"
                            class="btn btn-md bg-info">EDIT</a>
                        |
                        <a href="javascript:void(0)" onclick="onDelete('<?php echo $user_id; ?>')"
                            class="btn btn-md bg-danger">DELETE</a>
                    </td>
                </tr>

                <?php
            }
            ?>
        </tbody>
    </table>
</div>


<div class="modal fade" id="delete_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="delete_madal_lable" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="delete_madal_lable">DELETE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <h3>ARE YOUR SURE <span class="text-danger">!</span></h3>

            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->

                <form id="delete_form" action="#" method="POST">

                    <input type="hidden" name="DELETES" value="DELETES">

                    <input type="hidden" name="_token" id="delete_token">

                    <button type="submit" class="btn btn-primary">DELETE</button>
                </form>

                <!-- <button type="button" class="btn btn-primary">Understood</button> -->
            </div>
        </div>
    </div>
</div>


<!--  update Modal -->
<div class="modal fade" id="edit_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="edit_madoal_lable" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="edit_madoal_lable">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form class="text-bg-dark p-5" id="edit_form" action="#" method="POST">

                    <input type="hidden" name="update" value="update">

                    <input type="hidden" name="_token" id="_token">

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">USER NAME</label>
                        <input type="text" name="user_name" class="form-control" id="user_name"
                            aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="Email" class="form-control" id="email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="pswd" class="form-control" id="pswd">
                    </div> -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div>
        </div>
    </div>
</div>

<?php
require_once dirname(__FILE__) . "/layout/user/footer.php";

?>

<script>

    function onDelete(token) {
        // =============================================================
        let myModal = document.querySelector("#delete_modal");

        let bootstrap_modal_edit = new bootstrap.Modal(myModal);

        bootstrap_modal_edit.show(myModal);
        // =================================================================
        let delete_token = document.querySelector("#delete_token");
        delete_token.value = token;

    }

    let delete_form = document.querySelector("#delete_form");

    delete_form.addEventListener("submit", async function (e) {
        e.preventDefault();

        let Form_data = new FormData(delete_form);



        let url = "<?php echo form_action; ?>";

        const option = {
            method: "POST",
            body: Form_data
        }

        let data = await fetch(url, option);

        let response = await data.json();


        if (response.error > 0) {


            response.msg.forEach(msg => {
                SHOW_MESSEGE("error", msg, "danger")
            });
        }
        else {

            SHOW_MESSEGE("error", response.msg, "success");

            let Mymodal = document.querySelector("#delete_modal");
            const modal = bootstrap.Modal.getInstance(Mymodal);
            modal.hide();

            setTimeout(function () {
                location.reload();
            }, 700)
        }



    })


    // =========================UPDATE WORK=============================
    function onEdit(Email, UserName, token) {
        // =============================================================
        let myModal = document.querySelector("#edit_modal");

        let bootstrap_modal_edit = new bootstrap.Modal(myModal);

        bootstrap_modal_edit.show(myModal);
        // =================================================================
        let email = document.querySelector("#email")
        let userName = document.querySelector("#user_name")
        let _token = document.querySelector("#_token")

        email.value = Email
        userName.value = UserName
        _token.value = token



    }
    // ===============================


    let edit_form = document.querySelector("#edit_form");

    edit_form.addEventListener("submit", async function (event) {

        event.preventDefault();

        let Form_data = new FormData(edit_form);



        let url = "<?php echo form_action; ?>";

        const option = {
            method: "POST",
            body: Form_data
        }

        let data = await fetch(url, option);

        let response = await data.json();


        console.log(response);

        if (response.error > 0) {

            // if (response.error == 1) {
            //     SHOW_MESSEGE("error", response.msg, "danger")
            // }
            // else {

            // }


            response.msg.forEach(msg => {
                SHOW_MESSEGE("error", msg, "danger")
            });
        }
        else {

            SHOW_MESSEGE("error", response.msg, "success");

            let Mymodal = document.querySelector("#edit_modal");
            const modal = bootstrap.Modal.getInstance(Mymodal);
            modal.hide();

            setTimeout(function () {
                location.reload();
            }, 500)
        }



    });
    // ===============================
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

            setTimeout(function () {
                location.reload();
            }, 700)
        }



    });
</script>