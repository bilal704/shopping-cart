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
        <div class="container col-xs-12 col-md-12">
            <h1>Already Registered, Please Login</h1>
            <form id="login-form" method="post" action="<?php echo base_url();?>user/checklogin">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="login-email" name="login-email" aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="login-password" name="login-password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <?php
        
        if(isset($msg) && $msg != ''){
            ?>
            <script>
                alert("<?php echo $msg; ?>");
            </script>
            <?php
            }
        ?>
    </body>
</html>