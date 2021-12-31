<?php 
$page_title = "display";
$body_class = "display";
session_start();
require("includes/mysql-connect.php");

extract($_GET);

include("includes/header.php");
 ?>

<section class="sidebar-section">
    <?php include("includes/search.php") ?>
    <?php include("includes/filter.php"); ?>
</section>
<section class="display-section">
    <?php if (isset($search) || isset($displayby)): ?>
    <?php if (isset($search)): ?>
        <h1><?php echo "Results for \"$search\""; ?></h1>
        <?php $sql = "SELECT * FROM phones WHERE deleted_yn = 'N' $search_part"; ?>
    <?php else: ?>
        <?php if (isset($displayby)): ?>
            <?php if (isset($displayvalue)): ?>
                <h1><?php echo "$displayvalue phones"; ?></h1>
                <?php $sql = "SELECT * FROM phones WHERE deleted_yn = 'N' AND $displayby LIKE '$displayvalue'"; ?>
            <?php else: ?>
                <?php if (isset($minrangevalue) && isset($maxrangevalue)): ?>
                    <h1><?php echo "$displayby $minrangevalue - $maxrangevalue"; ?></h1>
                    <?php $sql = "SELECT * FROM phones WHERE deleted_yn = 'N' AND $displayby BETWEEN '$minrangevalue' AND '$maxrangevalue'"; ?>
                <?php else: ?>

                <?php endif ?>
            <?php endif ?>
        <?php endif ?>
    <?php endif ?>
    <?php else: ?>
        <h1>All Phones</h1>
        <?php $sql = "SELECT * FROM phones WHERE deleted_yn = 'N'"; ?>
    <?php endif ?>

    <?php $sql_result = $conn->query($sql); ?>
    <?php if ($sql_result->num_rows > 0): ?>
        <?php include("includes/display-phones.php") ?>
    <?php endif ?>
</section>
<?php include("includes/footer.php"); ?>