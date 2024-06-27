<!-- footer start -->
<div class="footer mt-20">
  <p>
    Copyright© All Rights Reserved By
    <a href="#" class="t-name">Syndrox</a>
  </p>
</div>
<!-- footer end -->
</div>
</div>
<!-- main-content-end -->
</main>

<!-- JS here -->
<script src="<?php echo DOMAIN1; ?>/assets/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="<?php echo DOMAIN1; ?>/assets/js/vendor/jquery-3.7.1.min.js"></script>
<script src="<?php echo DOMAIN1; ?>/assets/js/popper.min.js"></script>
<script src="<?php echo DOMAIN1; ?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo DOMAIN1; ?>/assets/js/apex-charts.js"></script>
<script src="<?php echo DOMAIN1; ?>/assets/js/jquery.counterup.min.js"></script>
<script src="<?php echo DOMAIN1; ?>/assets/js/jquery.waypoints.min.js"></script>
<script src="<?php echo DOMAIN1; ?>/assets/js/wow.min.js"></script>
<script src="<?php echo DOMAIN1; ?>/assets/js/deshbord.js"></script>
<script src="<?php echo DOMAIN1; ?>/assets/js/main.js"></script>

<script>
  function showMessage(id, msg, classes) {
    const alertPlaceholder = document.getElementById(id)


    const appendAlert = (message, type) => {
      const wrapper = document.createElement('div')
      wrapper.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible" role="alert">`,
        `   <div>${message}</div>`,
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
      ].join('')

      alertPlaceholder.append(wrapper)

      wrapper.style.transition = "opacity 0.75s ease-in-out"
      setTimeout(function () {
        wrapper.style.opacity = "0"

        setTimeout(function () {
          wrapper.remove();
        }, 1000)
      }, 1000)
    }

    appendAlert(msg, classes)



  }
</script>
</body>

<!-- Mirrored from preetheme.com/rana/syndrox-prev/syndrox/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 26 Jun 2024 14:45:20 GMT -->

</html>