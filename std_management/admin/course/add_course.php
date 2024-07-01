<?php

require_once dirname(__DIR__) . "/../layout/admin/top.php";

?>


<div class="border-default min-selles mb-20">
  <div class="analycic-title pb-15">
    <h4>ADD COURSE </h4>
  </div>
  <div class="veritical-form">
    <form action="#" id="add_course">
      <input type="hidden" name="inserts" value="INSERT">
      <div class="add-user-input add-user-input-2 mb-20">
        <div class="row  align-items-center">
          <div class="col-12 col-sm-2">
            <label for="course_name">Course Name</label>
          </div>
          <div class="col-12 col-sm-10">
            <input type="text" placeholder="Course Name" name="course_name" id="course_name">
          </div>
        </div>
      </div>

      <div class="add-user-message project-form-single mb-20">
        <div class="row">
          <div class="col-12 col-sm-2">
            <label for="message4">Syllabus Detail</label>
          </div>
          <div class="col-12 col-sm-10">
            <textarea placeholder="Write Your Syllabus Here....." name="syllabus" id="syllabus"></textarea>
          </div>
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