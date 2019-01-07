<?php if(isset($_SESSION['E_STATUS']) && isset($_SESSION['E_MESSAGE'])): ?>
    <?php
    $alertClass = 'alert-warning';
    $alertStrong = 'Warning.';
    $alertMessage = $_SESSION['E_MESSAGE'];
    if($_SESSION['E_STATUS']=='success'){
        $alertClass = 'alert-success';
        $alertStrong = 'Success.';
    } elseif ($_SESSION['E_STATUS']=='error'){
        $alertClass = 'alert-danger';
        $alertStrong = 'Fail.';
    }
    ?>
<div class="alert <?php echo $alertClass ?> alert-dismissible" role="alert">
    <strong> <?php echo $alertStrong;?> </strong> <?php echo $alertMessage; ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>


<?php
    unset($_SESSION['E_STATUS']);
    unset($_SESSION['E_MESSAGE']);
endif;
?>
