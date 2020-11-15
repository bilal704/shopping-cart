<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
        <style>
            .container {

                width: 100%;
            }
        </style>
        <title>Simple E-commerce</title>
    </head>
    <body>
        <?php $this->load->view('navigation'); ?>
        <?php 
        if(!isset($_SESSION['user'])){
        ?>
        <div class="container col-xs-12 col-md-12">
            <a href="<?php echo base_url();?>user/login">Already Registered, Please Login</a>
        </div>
        <?php
        }
        ?>
        <div class="container col-xs-12 col-md-12">
            <?php 
            if(!isset($_SESSION['user'])){

                $onclick = 'registerUser';
                $action = base_url().'user/register';
            ?>
            <h1>New User, Please Register Or <a href="<?php echo base_url().'user/guest'; ?>">Checkout As Guest</a></h1>
            <?php
            }
            else{

                $onclick = 'checkout';
                $action = base_url().'cart/saveOrder';
                ?>
                <h1>Please Confrm The Below Details</h1>
                <div class="modal fade" id="myModal" role="dialog">
                </div>
                <?php
            }
            ?>
            <form onsubmit="javascript:<?php echo $onclick;?>(this);return false;" id="new-user-form" method="post" action="<?php echo $action; ?>">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" value="<?php echo (isset($email)) ? $email : ''; ?>" class="form-control" name="new-user-email" id="new-user-email" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="new-user-email-help" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <?php 
                if(!isset($_SESSION['user'])){
                ?>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="new-user-password" id="new-user-password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input type="password" class="form-control" name="new-user-confirm-password" id="new-user-confirm-password" placeholder="Confirm Password">
                </div>
                <?php
                }
                ?>
                <div class="form-group">
                    <label for="exampleInputPassword1">Name</label>
                    <input type="text" value="<?php echo (isset($name)) ? $name : ''; ?>" class="form-control" name="new-user-name" id="new-user-name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Address</label>
                    <textarea class="form-control" name="new-user-address" id="new-user-address" placeholder="Address"><?php echo (isset($address)) ? trim($address) : ''; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">City</label>
                    <input type="text" value="<?php echo (isset($city)) ? $city : ''; ?>" class="form-control" name="new-user-city" id="new-user-city" placeholder="City">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Pin Code</label>
                    <input type="number" value="<?php echo (isset($pin_code)) ? $pin_code : ''; ?>" class="form-control" name="new-user-pin-code" id="new-user-pin-code" placeholder="Pin Code">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mobile</label>
                    <input type="number" value="<?php echo (isset($phone)) ? $phone : ''; ?>" maxlength="10" class="form-control" name="new-user-phone" id="new-user-phone" placeholder="Mobile">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script type="text/javascript">

            function registerUser(formObj){

                formid = formObj.id;
                
                $.ajax({

                    url: formObj.action,
                    method: 'post',
                    data: $("#"+formid).serialize(),
                    dataType: 'JSON',
                    beforeSend: function(){

                        $('.loader').addClass('loading');
                    },
                    success: function(response){
                        
                        $('.loader').removeClass('loading');
                        alert(response.msg);
                    }
                });
            }

            function checkout(formObj){

                formid = formObj.id;
                
                $.ajax({

                    url: formObj.action,
                    method: 'post',
                    data: $("#"+formid).serialize(),
                    dataType: 'html',
                    beforeSend: function(){

                        $('.loader').addClass('loading');
                    },
                    success: function(response){
                        
                        $('.loader').removeClass('loading');
                        $('#myModal').html(response);
                        $('#myModal').modal('show');
                        $("#"+formid).trigger('reset');
                    }
                });
            }
        </script>
    </body>
</html> 