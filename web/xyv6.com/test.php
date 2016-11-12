<?php
require_once '_main.php';

?>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <section class="content">
            <div class="row">
            		<input id="pass">
                    <button id="send" type="submit" class="btn btn-primary">发送</button>

            </div>
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

<script>

    $(document).ready(function(){
        function feedback(){
		alert("pass");
        }
        $("#send").click(function(){
            feedback();
        });
    })
</script>

<?php
require_once '_footer.php'; ?>