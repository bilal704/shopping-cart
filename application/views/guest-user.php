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
        <div class="modal fade" id="myModal" role="dialog">
        </div>
        <div class="container col-xs-12 col-md-12">
            <h1>Guest Checkout</h1>
            <form id="gues-user-form" onsubmit="javascript:guestUser(this);return false;" method="post" action="<?php echo base_url();?>cart/saveOrder">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" name="guest-user-email" id="guest-user-email" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="guest-user-email-help" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Name</label>
                    <input type="text" class="form-control" name="guest-user-name" id="guest-user-name" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Address</label>
                    <textarea class="form-control" name="guest-user-address" id="guest-user-address" placeholder="Address"></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">City</label>
                    <input type="text" class="form-control" name="guest-user-city" id="guest-user-city" placeholder="City">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Pin Code</label>
                    <input type="text" class="form-control" name="guest-user-pin-code" id="guest-user-pin-code" placeholder="Pin Code">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mobile</label>
                    <input type="phone" class="form-control" name="guest-user-phone" id="guest-user-phone" placeholder="Mobile">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
            <script type="text/javascript">

                function guestUser(formObj){

                    formid = formObj.id;
                    console.log($("#"+formid).serialize());
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
        </div>
    </body>
</html>
