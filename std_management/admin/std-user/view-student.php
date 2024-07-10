<?php

require_once dirname(__DIR__) . "/../layout/admin/top.php";
use app\database\Mysqli as DB;
use app\database\helper as help;

$db = new DB;
$help = new help();

$db->select(STD, "*");
$row = $db->Getresult();
?>



<table class="table table-bordered">
    <thead>
        <tr class="table-title">
            <th scope="col">#</th>
            <th scope="col">USER NAME</th>
            <th scope="col">EMAIL</th>
            <th scope="col">COURSE</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 1;
        foreach ($row as $std_data) {
            # code...

            $course = $db->select(STD_COURSE,"*",null,"`std_id`='{$std_data["std_id"]}'");
            
            $rows = $db->Getresult();
            // one to one 
            // ======================================================================
            $course = $db->select(COURSE,"*",null,"`course_id`='{$rows[0]["course_id"]}'");
            $row_c = $db->Getresult();
            // $help->pre($rows);
            ?>
            <tr>
                <th scope="row"><?php echo $count; ?></th>
                <td><?php echo $std_data["user_name"] ?></td>
                <td><?php echo $std_data["email"] ?></td>
                <td><?php echo $row_c[0]["course_name"];  ?></td>

                <td>
                    <?php
                    $std_id = $std_data["std_id"];
                    $user_name = $std_data["user_name"];
                    $email = $std_data["email"];
                    ?>
                    <a href="javascript:void(0)"
                        onclick="OnEDit('<?php echo $std_id ?>','<?php echo $user_name ?>','<?php echo $email ?>')">
                        UPDATE
                    </a>
                </td>
            </tr>
            <?php
            $count++;
        } ?>

    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="edit_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="edit_lable" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="edit_lable">EDIT COURSE</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding:0px;">
                <div class="border-default min-selles " style="margin: 0px;">
                    <!-- <div class="analycic-title pb-15">
                        <h4>EDIT  COURSE </h4>
                    </div> -->
                    <div class="veritical-form">
                        <form action="#" id="edit_course">
                            <input type="hidden" name="UPDATES" value="UPDATE">
                            <input type="hidden" name="_token_edit" id="_token_edit">
                            <div class="add-user-input add-user-input-2 mb-20">
                                <div class="row  align-items-center">
                                    <div class="col-12 col-sm-2">
                                        <label for="course_name">Course Name</label>
                                    </div>
                                    <div class="col-12 col-sm-10">
                                        <input type="text" placeholder="Course Name" name="course_name"
                                            id="course_names">
                                    </div>
                                </div>
                            </div>

                            <div class="add-user-message project-form-single mb-20">
                                <div class="row">
                                    <div class="col-12 col-sm-2">
                                        <label for="message4">Syllabus Detail</label>
                                    </div>
                                    <div class="col-12 col-sm-10">
                                        <textarea placeholder="Write Your Syllabus Here....." name="syllabus"
                                            id="Syllabus"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-2"></div>
                                <div class="col-10">
                                    <div class="update-btn">
                                        <button type="submit" class="btn-1">Save</button>
                                        <!-- <button type="reset" class="btn-2">Cancel</button> -->
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div> -->
        </div>
    </div>
</div>

<?php

require_once dirname(__DIR__) . "/../layout/admin/footer.php";

?>
<script>

    function OnEDit(token, courseName, courseSyllabus) {
        let myModal = document.querySelector("#edit_modal");
        let BootstrapModal = new bootstrap.Modal(myModal);
        BootstrapModal.show(myModal);

        let _token_edit = document.querySelector("#_token_edit");
        let course_names = document.querySelector("#course_names");
        let Syllabus = document.querySelector("#Syllabus");

        _token_edit.value = token;
        course_names.value = courseName;
        Syllabus.value = courseSyllabus;
    }


    let edit_course = document.querySelector("#edit_course");
    edit_course.addEventListener("submit", async function (e) {
        e.preventDefault();

        let formData = new FormData(edit_course);

        let url = "<?php echo admin_Course_action ?>";

        const option = {
            method: "POST",
            body: formData
        }


        let data = await fetch(url, option);

        let res = await data.json();
        console.log(res);
        let msg = res.msg;
        if (res.error > 0) {



            msg.forEach(msage => {
                showMessage("error", msage, "danger")
            });
        }
        else {
            showMessage("error", msg, "success")

            setTimeout(function () {

                var genericModalEl = document.getElementById('edit_modal')
                var modal = bootstrap.Modal.getInstance(genericModalEl)
                modal.hide()


                setTimeout(function () {
                    location.reload();
                }, 700)

            }, 1000)
        }
    })

</script>