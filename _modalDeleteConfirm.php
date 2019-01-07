<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 11/1/2018
 * Time: 3:19 PM
 */


/*
html:::::
    onclick="deleteConfirm('id delete','name delete');"
Script:::::
    function deleteConfirm(id,text) {
    var fn_name = 'deleteProject';
    var fn_text = text;
    var fn_id = id;
    setModalDelete(fn_name,fn_text,fn_id);
    }
PHP::::
    name    : fn
    delete  : delete_id
 */
?>
<div class="modal fade" id="_modalDeleteConfirm" tabindex="-1" role="dialog" aria-labelledby="modalDeleteConfirm" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form class="modal-content" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteConfirm">Modal Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                คุณต้องการลบข้อมูล
                <p id="modalDeleteConfirm_message"></p>

                <hr>
                <input id="modalDeleteConfirm_checkbox" type="checkbox" value="Y" onchange="checkboxConfirmDelete();" > ยืนยันการลบข้อมูล
            </div>
            <div class="modal-footer">
                <input id="modalDeleteConfirm_id" name="delete_id" value="" hidden>
                <input id="modalDeleteConfirm_fn" name="fn" value="" hidden>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="modalDeleteConfirm_btn" type="submit" class="btn btn-primary" disabled>Delete Data ...</button>
            </div>
        </form>
    </div>
</div>
<script>

    function checkboxConfirmDelete() {
        var check = $('#modalDeleteConfirm_checkbox').prop('checked');
        if(check){
            $('#modalDeleteConfirm_btn').removeAttr('disabled');
        }else {
            $('#modalDeleteConfirm_btn').attr('disabled',true);
        }
    }

    function setModalDelete(fn,text,id) {
        $('#modalDeleteConfirm_message').html(text);
        $('#modalDeleteConfirm_fn').attr('value',fn);
        $('#modalDeleteConfirm_id').attr('value',id);

        $("#_modalDeleteConfirm").modal();
        $('#modalDeleteConfirm_checkbox').prop('checked',false);
        $('#modalDeleteConfirm_btn').attr('disabled',true);
    }

</script>

