<?php

require_once dirname(__FILE__) . "/include/header.php";

if (!isset($_SESSION["email"]) || empty($_SESSION["email"])) {

    redirect_url(REGISTER);
}

// $sql= "SELECT * FROM `address_user`  WHERE user_id = '{$_SESSION['userId']}'" ;


// session_destroy();
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

        $address = "SELECT * FROM `address_user` WHERE `user_id` = '{$_SESSION["user_id"]}'";
        $exe_address = $conn->query($address);
        if ($exe_address->num_rows > 0) {
            $fetchAddress=$exe_address->fetch_assoc();  
        }
        else{
            $fetchAddress= [
                "address"=>"",
                "contact"=>"",
                "image"=>"./asset/images/modal4 .png"
            ];
        }
        ?>


        <div class="col py-3">

            <section class="shop login section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 offset-lg-3 col-12">
                            <div class="login-form">
                                <h2>PROFILE SETTING</h2>
                                <!-- <p>Please LOGIN  in order to checkout more quickly -->


                                </p>

                                <form enctype="multipart/form-data" class="form" method="post"
                                    action="<?php echo Profile_submit ?>">
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
                                                        <source srcset="<?php echo $fetchAddress["image"] ?>" type="image/svg+xml">
                                                        <img src="<?php echo $fetchAddress["image"] ?>"
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
                                                <label>Address<span>*</span></label>
                                                <input type="text" value="<?php echo  $fetchAddress["address"]; ?>" name="address" placeholder
                                                    required="required">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Contact<span>*</span></label>
                                                <input type="text" value="<?php echo  $fetchAddress["contact"]; ?>" name="contact" placeholder
                                                    required="required">
                                            </div>
                                        </div>





                                        <!-- <div class="col-12">
                                            <div class="form-group">
                                                <label>Your Email<span>*</span></label>
                                                <input type="email" value="<?php echo $row_fetch["email"] ?>"
                                                    name="email" placeholder required="required">
                                            </div>
                                        </div> -->

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

require_once dirname(__FILE__) . "/include/footer.php";
?>