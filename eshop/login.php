<?php

require_once dirname(__FILE__) . "/include/header.php";

if(isset($_SESSION["email"]) || !empty($_SESSION["email"])){

    redirect_url(Dashboard);
}

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
                    <h2>LOGIN</h2>
                    <p>Please LOGIN  in order to checkout more quickly


                    </p>

                    <form class="form" method="post" action="<?php echo login_submit ?>">
                        <div class="row">
                           
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Your Email<span>*</span></label>
                                    <input type="email" name="email" placeholder required="required">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Your Password<span>*</span></label>
                                    <input type="password" id="pswd" name="password" placeholder required="required">
                                </div>
                            </div>
                           
                            <style>
                                #submit {
                                    position: relative;
                                    font-weight: 500;
                                    font-size: 14px;
                                    color: #fff !important;
                                    background: #333 !important;

                                    -webkit-transition: all 0.4s ease;
                                    -moz-transition: all 0.4s ease;
                                    transition: all 0.4s ease;
                                    z-index: 5;

                                    text-transform: uppercase;
                                }

                                #submit:hover {
                                    color: #fff !important;
                                    background: #F7941D !important;
                                }
                            </style>
                            <div class="col-12">
                                <div class="form-group login-btn">
                                    <input class="btn  w-25 " name="login" id="submit" type="submit"
                                        value="LOGIN">
                                    <a href="<?php echo REGISTER; ?>" class="btn">REGISTER</a>
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

require_once dirname(__FILE__) . "/include/footer.php";
?>

<script>
    let password = document.querySelector("#pswd");
    let cfm_pswd = document.querySelector("#cfm_pswd");
    let msg = document.querySelector("#msg");
    let submit = document.querySelector("#submit");

    cfm_pswd.addEventListener("keyup", function () {
        if (password.value == cfm_pswd.value) {
            msg.innerHTML = "PASSWORD MATCHED";
            msg.style.color = "green";
            submit.type = 'submit';
            submit.classList.remove("disabled")
        }
        else {
            msg.innerHTML = "PASSWORD NOT MATCHED";
            msg.style.color = "red"
            submit.type = 'button';
            submit.classList.add("disabled")
        }
    })
</script>