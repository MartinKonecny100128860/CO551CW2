<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

?>
<?php
if (isset($_GET['return'])) {
    $msg = "";
    if ($_GET['return'] == "fail") {
        $msg = "Login Failed. Please try again.";
    }
    $data['message'] = "<h1>$msg</h1>";
}

if (isset($_SESSION['id'])) {
    $data['content'] = "<div class='centered-image'>
                            <img src='indexheader.png' alt='Hero Image'>
                        </div>
                        <div class='centered-box' style='width: 80%;'>
                            <div class='box-left'>
                                <img src='indexpic.jpg' alt='Left Image' style='width: 100%;'>
                            </div>
                            <div class='box-right'>
                                <h1>WELCOME TO ADMIN PAGE</h1>
                                <h2>Please select option from navigation bar</h2>
                                <p>Nullam vel dapibus lacus. Sed nec justo id leo rutrum eleifend. Curabitur nec metus a libero ullamcorper tincidunt. Sed a aliquam nisi. Nullam dignissim eros vel commodo dapibus. Sed ac posuere ligula. Vivamus euismod nisl in sollicitudin vulputate. Integer tristique, dui ut blandit tempor, arcu velit faucibus lacus, nec fermentum nisi orci eu risus. </p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ac tortor in velit tempor ullamcorper nec sed felis. Fusce eget nisi sed justo fringilla rhoncus. Mauris in sapien ut elit eleifend ultrices. Integer auctor odio eu neque facilisis, ut bibendum enim vehicula. </p>
                            </div>
                        </div>";
    echo template("templates/partials/nav.php");
    echo template("templates/default.php", $data);
} else {
    echo template("templates/login.php", $data);
}

echo template("templates/partials/footer.php");
?>

<style>
.centered-image {
    position: absolute;
    top: 10%;
    left: 44.78%;
    transform: translate(-50%, -50%);
}

.centered-box {
    position: absolute;
    top: 70%;
    left: 58%;
    transform: translate(-50%, -50%);
    display: flex;
    justify-content: center;
}

.box-left {
    flex: 1;
}

.box-right {
    flex: 1;
    padding-left: 20px;
}

.box-right h1 {
    font-size: 40px;
}

.box-right h2 {
    font-size: 30px;
}

.box-right p {
    font-size: 20px;
}
</style>

