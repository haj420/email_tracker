<!DOCTYPE html>
<html lang="en">
<?php include_once("include/head2.php"); 
      include_once("fx/functions.php");
      ?>

<!--Main layout-->
<main class="mt-5 pt-5">
    <div class="container">

        <!--Section: Cards-->
        <section id="homebodysec" class="text-center">

            <div class="row wow fadeIn">
                <div class="col">
                    
                    <h4 align="center">Email Status</h4>
                    <?  echo fetch_email_track_data($db); ?>

                </div>
                <!--Grid column-->

            </div>
            <!--Grid row-->

        </section>
        <!--Section: Cards-->

    </div>
</main>
<!--Main layout-->

<?php include_once("include/footer.php"); ?>

</body>

</html>
