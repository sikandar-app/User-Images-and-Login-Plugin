<?php

/**
 * Template Name: custom page
 *
 */
?>
<?php get_header(); ?>
<link rel='stylesheet' href='<?php echo  plugins_url('/assets/css/bootstrap.min.css', __FILE__); ?>'>
<link rel=' stylesheet' href="<?php echo  plugins_url('/assets/css/style.css', __FILE__); ?>">

<?php
$errors = null;

do_action('user_redirect_if_logged_in');
if (isset($_REQUEST['signin'])) {
    ini_set('display_errors', 'Off');
    $email = $_POST['email'];
    $password = $_POST['password'];
    $creds = array();
    $creds['user_login'] = $_POST['email'];
    $creds['user_password'] = $_POST['password'];
    $creds['remember'] = false;
    $user = wp_signon($creds, false);

    if (isset($user->errors)) {
        $errors = $user->get_error_message();
    } else {
        $errors = '';
        session_start();
        $user_login_details = $email . '_pass_' . $password;
        if (!empty($_POST["remember"])) {
            setcookie("user_login_details", $user_login_details, time() + (10 * 365 * 24 * 60 * 60)); //set cookie time as per you need
        } else {  //remove login details from cookie
            if (isset($_COOKIE["user_login_details"])) {
                setcookie("user_login_details", "");
            }
        }
        $upload_dir     = wp_upload_dir();

        $userId = $user->ID;

        $dir_crown      = ($upload_dir['basedir'] . '/photobooth/' . $userId . '/crown/');
        $pathCrown      = str_replace("\\", "/", $dir_crown);
        $imageCrown     = glob($pathCrown . "*.*");
        // Hairline
        $dir_hairline  = ($upload_dir['basedir'] . '/photobooth/' . $userId . '/hairline/');
        $pathHairline       = str_replace("\\", "/", $dir_hairline);
        $imageHairline      = glob($pathHairline . "*.*");
        // imageLeft
        $dir_left      = ($upload_dir['basedir'] . '/photobooth/' . $userId . '/left/');
        $pathLeft           = str_replace("\\", "/", $dir_left);
        $imageLeft          = glob($pathLeft . "*.*");
        // imageRight
        $dir_right     = ($upload_dir['basedir'] . '/photobooth/' . $userId . '/right/');
        $pathRight          = str_replace("\\", "/", $dir_right);
        $imageRight         = glob($pathRight . "*.*");
        // imageTop
        $dir_top       = ($upload_dir['basedir'] . '/photobooth/' . $userId . '/top/');
        $pathTop            = str_replace("\\", "/", $dir_top);
        $imageTop           = glob($pathTop . "*.*");

?>
        <div class="container">
            <?php if ($imageCrown) { ?>
                <div class="row">
                    <div class="col-12">
                        <h4><b>Crown</b></h4>
                    </div>
                </div>
                <div class="row">
                    <?php
                    foreach ($imageCrown as $image) {
                        $img = explode("uploads", $image);
                    ?>
                        <div class="col-2">
                            <img class="img-fluid" width="100%" src="<?php echo $upload_dir['baseurl'] . $img[1]; ?>">
                        </div>
                    <?php
                    }
                    ?>
                </div>
            <?php } ?>
            <?php if ($imageHairline) { ?>
                <div class="row">
                    <div class="col-12">
                        <h4><b>Hairline</b></h4>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if (isset($imageHairline)) {
                        foreach ($imageHairline as $image) {
                            $img = explode("uploads", $image);
                    ?>
                            <div class="col-2">
                                <img class="img-fluid" width="100%" src="<?php echo $upload_dir['baseurl'] . $img[1]; ?>">
                            </div>
                    <?php
                        }
                    }

                    ?>
                </div>
            <?php } ?>
            <!-- left -->
            <?php if ($imageLeft) { ?>
                <div class="row">
                    <div class="col-12">
                        <h4><b>Left</b></h4>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if (isset($imageLeft)) {
                        foreach ($imageLeft as $image) {
                            $img = explode("uploads", $image);
                    ?>
                            <div class="col-2">
                                <img class="img-fluid" width="100%" src="<?php echo $upload_dir['baseurl'] . $img[1]; ?>">
                            </div>
                    <?php
                        }
                    }

                    ?>
                </div>
            <?php } ?>
            <!-- right -->
            <?php if ($imageRight) { ?>
                <div class="row">
                    <div class="col-12">
                        <h4><b>Right</b></h4>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if (isset($imageRight)) {
                        foreach ($imageRight as $image) {
                            $img = explode("uploads", $image);
                    ?>
                            <div class="col-2">
                                <img class="img-fluid" width="100%" src="<?php echo $upload_dir['baseurl'] . $img[1]; ?>">
                            </div>
                    <?php
                        }
                    }

                    ?>
                </div>
            <?php } ?>
            <!-- top -->
            <?php if ($imageTop) { ?>
                <div class="row">
                    <div class="col-12">
                        <h4><b>Top</b></h4>
                    </div>
                </div>
                <div class="row">
                    <?php
                    if (isset($imageTop)) {
                        foreach ($imageTop as $image) {
                            $img = explode("uploads", $image);
                    ?>
                            <div class="col-2">
                                <img class="img-fluid" width="100%" src="<?php echo $upload_dir['baseurl'] . $img[1]; ?>">
                            </div>
                    <?php
                        }
                    }

                    ?>
                </div>
            <?php } ?>

            <?php if (!$imageTop && !$imageRight && !$imageLeft && !$imageHairline && !$imageCrown) { ?>
                <div class="row">
                    <div class="col-12">
                        <h4><b>Currently you don't have any data to display</b></h4>
                    </div>
                </div>
            <?php } ?>
        </div>
<?php
        get_footer();
        exit;
    }
}

?>

<?php if (!is_user_logged_in()) { ?>
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-title text-center">
                        <h4>Login</h4>
                    </div>
                    <div class="d-flex flex-column text-center">
                        <?php if ($errors) { ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $errors; ?>
                            </div>
                        <?php } ?>
                        <form method="POST" action="">
                            <div class="form-group">
                                <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
                                <input class="form-control" required type="email" name="email" id="email" placeholder="email">
                            </div>
                            <div class="form-group">
                                <input class="form-control" required type="password" name="password" id="password" placeholder="Password" />
                            </div>
                            <button type="submit" id="signin" name="signin" class="btn btn-info btn-block btn-round">Login</button>
                            <label class="error-msg"></label>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    get_template_part('ajax', 'auth'); ?>
<?php } ?>
<!-- jQuery -->
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
<!-- Popper JS -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
<!-- Bootstrap JS -->
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script>
    $(document).ready(function() {
        $('#loginModal').modal('show');
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    });
</script>
<script type="text/javascript">
    $(document).ready(function($) {
        // Signin form
        $("#myFormID").submit(function(e) {

            var form_data = $("form#signinForm").serialize();

            $.ajax({
                type: "POST",
                url: '<?php bloginfo("template_url") ?>/ajax-login.php',
                data: form_data,
                success: function(responseData) {
                    if (responseData == 1) {
                        redirecturl = "<?php echo site_url() ?>";
                        $(location).attr("href", redirecturl);
                    } else {
                        $(".error-msg").html(responseData);
                    }
                }
            });
            return false;

        });
    });
</script>
<?php get_footer(); ?>