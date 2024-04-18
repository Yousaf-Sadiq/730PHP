<?php

require_once dirname(__FILE__) . "/layout/header.php";

if (!isset($_SESSION["email"]) || empty($_SESSION["email"])) {

    redirect_url(REGISTER);
}

;
?>

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


<div class="container-fluid">
    <div class="row flex-nowrap">

        <?php

        require_once dirname(__FILE__) . '/include/dashboard_sidenav.php';

        ?>


        <div class="col py-3">

            <section class="shop login section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3 col-12">
                            <div class="login-form">
                                <h2>PROFILE SETTING</h2>
                               


                                </p>

                                <form enctype="multipart/form-data" class="form" method="post" action="<?php echo Profile_submit ?>">
                                    <div class="row">

                                        <div class=" col-12">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-group">
                                                        <label>Your Profile<span>*</span></label>
                                                        <input type="file" class="form-control" name="profile" id=""
                                                            placeholder="" aria-describedby="fileHelpId" />
                                                    </div>

                                                </div>
                                                <div class="col-6">
                                                    <picture>
                                                        <source srcset="./asset/images/cart3.jpg" type="image/svg+xml">
                                                        <img src="./asset/images/cart3.jpg"
                                                            class="img-fluid img-thumbnail" alt="...">
                                                    </picture>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Your NAME<span>*</span></label>
                                                <input type="text" value="<?php echo $row_fetch["user_name"] ?>"
                                                    name="user_name" placeholder required="required">
                                            </div>
                                        </div>



                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Your Email<span>*</span></label>
                                                <input type="email" value="<?php echo $row_fetch["email"] ?>"
                                                    name="email" placeholder required="required">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Your Password<span>*</span></label>
                                                <input type="password" id="pswd"
                                                    value="<?php echo base64_decode($row_fetch["ptoken"]) ?>"
                                                    name="password" placeholder required="required">
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="form-group login-btn">
                                                <input class="btn  w-25 " name="update_profile" id="submit"
                                                    type="submit" value="UPDATE">

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


        </div>





    </div>
</div>


<?php

require_once dirname(__FILE__) . "/layout/footer.php";
?>