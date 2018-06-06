<?php
/**
 * Created by PhpStorm.
 * User: EPOP
 * Date: 6/5/2018
 * Time: 3:40 PM
 */
?>
<style>

    .myImgModal {
        border-radius: 5px;
        cursor: pointer;
        transition: 0.3s;
    }
    .myImgModal:hover {opacity: 0.7;}

    /* The Modal (background) */
    .modalImg {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 3; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
    }

    /* Modal Content (image) */
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image */
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation */
    .modal-content, #caption {
        -webkit-animation-name: zoom;
        -webkit-animation-duration: 0.6s;
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @-webkit-keyframes zoom {
        from {-webkit-transform:scale(0)}
        to {-webkit-transform:scale(1)}
    }

    @keyframes zoom {
        from {transform:scale(0)}
        to {transform:scale(1)}
    }

    /* The Close Button */
    #myModalClose {
        position: absolute;
        top: 50px;
        right: 35px;
        color: #FFFFF0;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    #myModalClose:hover,
    #myModalClose:focus {
        color: #FFFFFF;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */
    @media only screen and (max-width: 700px){
        .modal-content {
            width: 100%;
        }
    }


</style>

<!-- The Modal -->
<div id="myModal" class="modalImg">
    <span class="close" id="myModalClose">&times;</span>
    <img class="modal-content" id="myModalShow">
</div>

<script>
    $('.myImgModal').on('click',function () {
        var src = $(this).attr('src');
        $('#myModal').css('display','block');
        $('#myModalShow').attr('src',src);
    });
    $('#myModalClose').on('click',function () {
        $('#myModal').css('display','none');
    })
</script>