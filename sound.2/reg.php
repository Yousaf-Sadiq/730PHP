<?php

require_once dirname(__FILE__) . "/layout/header.php";


?>
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="blog-single.html">Register</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<section class="shop login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <div class="login-form">
                    <h2>Register</h2>
                    <p>Please register in order to checkout more quickly


                    </p>


                    <form class="form" method="post" action="<?php echo Register_submit ?>" >
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Your Name<span>*</span></label>
                                    <input type="text" name="name" placeholder required="required">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Your Email<span>*</span></label>
                                    <input type="text" name="email" placeholder>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Your Password<span>*</span></label>
                                    <input type="password" id="pswd" name="password" placeholder required="required">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Confirm Password<span>*</span></label>
                                    <input type="password" id="confirm_pswd" name="Confirm_password" placeholder
                                        required="required">
                                    <span class="small-content" id="msg"></span>
                                </div>
                            </div>
                            
                            <div class="col-12">
                                <div class="form-group login-btn">
                                    <input class="btn  w-25 disabled" name="register" id="submit" type="btn"
                                        value="Register">
                                    
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-inline" for="2"><input name="news" id="2"
                                            type="checkbox">Sign Up for Newsletter</label>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>






<?php

require_once dirname(__FILE__) . "/layout/footer.php";

?>

<script>
    let password = document.querySelector("#pswd");
    let confirm_pswd = document.querySelector("#confirm_pswd");
    let msg = document.querySelector("#msg");
    let submit = document.querySelector("#btn");

    cfm_pswd.addEventListener("keyup", function () {
        if (password.value == confir4m_pswd.value) {
            msg.innerHTML = "PASSWORD MATCHED";
            msg.style.color = "green";
            btn.type = 'register';
            btn.classList.remove("disabled")
        }
        else {
            msg.innerHTML = "PASSWORD NOT MATCHED";
            msg.style.color = "red"
            btn.type = 'button';
            btn.classList.add("disabled")
        }
    })
</script>