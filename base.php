<?php include("header.php"); ?>
<div class="wrapper">
    <?php include("sidebar.php"); ?>
    <div class="page-wrapper">
        <?php include("top-nav.php"); ?>
        <div class="content-wrapper">
            <div class="content">










            </div><!-- end /content -->
        </div><!-- end /content-wrapper -->
    </div> <!-- end /page-wrapper -->
</div><!-- end wrapper -->

<script>
jQuery(function() {
    $(".btn-cancel").on("click", function() {
        $(".form-container").slideToggle();
    });
});
</script>

<?php include("footer.php"); ?>