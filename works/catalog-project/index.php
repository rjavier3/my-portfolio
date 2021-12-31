<?php 
$page_title = "home";
$body_class = "home";
session_start();
require("includes/mysql-connect.php");

include("includes/header.php");
 ?>
<section class="sidebar-section">
    <?php include("includes/search.php") ?>
    <?php include("includes/filter.php"); ?>
</section>
<section class="f-basis-100">
    <div>
        <p>This website features a catalogue of smartphones, I created this website with PHP, and SQL to demonstrate my skills and knowledge in reading and writing SQL data, and creating different PHP functionalities like creating filters, form handling, and using different PHP functions. Each phone is associated with its own specs saved on the SQL database: name, release price, brand, release year, operating system or OS, battery size, screen size, and an image of the phone. The website is styled using SCSS and made to be clear, straightforward, but also nice to look at.</p>

        <p>Click on phones to see specs, and use filter to filter. Thanks for visiting. </p>
    </div>
    <div class="display-section">
        <?php 
        $current_year = date("Y");
        $sql = "SELECT * FROM phones WHERE deleted_yn = 'N' AND phone_year = '$current_year'";
        $sql_result = $conn->query($sql);
         ?>
         <?php if ($sql_result->num_rows > 0): ?>
            <h1><?php echo "Featured $current_year's Phones" ?></h1>
            <?php include("includes/display-phones.php") ?>
         <?php endif ?>        
    </div>
</section>
<?php include("includes/footer.php"); ?>