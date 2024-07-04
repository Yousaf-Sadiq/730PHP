<?php

require_once dirname(__DIR__) . "/../layout/admin/top.php";

use app\database\Mysqli as DB;

$db = new DB();
?>


<div class="border-default min-selles mb-20">
    <div class="analycic-title pb-15">
        <h4>ADD STUDENT </h4>
    </div>
    <div class="veritical-form">
        <form action="#" id="add_std">

            <input type="hidden" name="inserts" value="INSERT">

            <div class="add-user-input mb-20">
                <label for="f-name2">User Name</label>
                <div class="veritical-form-icon">
                    <input type="text" placeholder="User Name" name="user_name" id="f-name2">
                    <span><i class="fa-regular fa-user"></i></span>
                </div>
            </div>

            <div class="add-user-input mb-20">
                <label for="email2">Email Address</label>
                <div class="veritical-form-icon">
                    <input type="text" placeholder="Enter Email" name="email" id="email2">
                    <span><i class="fa-regular fa-envelope"></i></span>
                </div>
            </div>

            <div class="add-user-input mb-20">
                <label for="password2">password</label>
                <div class="veritical-form-icon">
                    <input type="password" placeholder="Enter password" name="pswd" id="password2">
                    <span><i class="fa-solid fa-lock"></i></span>
                </div>
            </div>


            <div class="add-user-input mb-20">
                <label for="course">COURSE NAME</label>
                <div class="veritical-form">

                    <select class="form-select mb-3" id="course" name="course_name" aria-label="Default select example">
                        <option selected="">Open this select menu</option>

                        <?php
                        $course = $db->select(COURSE, "*");
                        $row = $db->Getresult();

                        foreach ($row as $value) {
                            # code...
                        
                            ?>

                            <option value="<?php echo $value["course_id"] ?>"><?php echo $value["course_name"] ?></option>



                        <?php } ?>

                    </select>

                </div>
            </div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-10">
                    <div class="update-btn">
                        <button type="submit" class="btn-1">Save</button>
                        <button type="reset" class="btn-2">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


<?php

require_once dirname(__DIR__) . "/../layout/admin/footer.php";

?>
<script>
    let add_course = document.querySelector("#add_course");
    add_course.addEventListener("submit", async function (e) {
        e.preventDefault();

        let formData = new FormData(add_course);

        let url = "<?php echo admin_Course_action ?>";

        const option = {
            method: "POST",
            body: formData
        }


        let data = await fetch(url, option);

        let res = await data.json();
        console.log(res);
        let msg = res.message;
        if (res.error > 0) {



            msg.forEach(msage => {
                showMessage("error", msage, "danger")
            });
        }
        else {
            showMessage("error", msg, "success")
        }
    })

</script>