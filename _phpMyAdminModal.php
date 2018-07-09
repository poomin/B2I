<?php

/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 7/9/2018
 * Time: 11:43 AM
 */
?>

<div class="modal fade" tabindex="-1" role="dialog" id="phpMyAdminModal">
    <div class="modal-dialog" role="document">
        <form class="modal-content" method="post" action="_phpMyAdminLogin.php">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Login By Pro Admin </h4>
            </div>
            <div class="modal-body">

                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="inputProAdmin" class="col-sm-4 control-label">Pro Admin</label>
                        <div class="col-sm-8">
                            <input name="u" type="text" class="form-control" id="inputProAdmin" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputConfirmProAdmin" class="col-sm-4 control-label">Confirm Pro Admin</label>
                        <div class="col-sm-8">
                            <input name="p" type="password" class="form-control" id="inputConfirmProAdmin" value="">
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <input name="fn" value="myAdmin" hidden>
                <button type="submit" class="btn btn-danger">Pro Admin</button>
            </div>
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>
    function phpMyAdminModal() {

      $('#phpMyAdminModal').modal();
    }
</script>
