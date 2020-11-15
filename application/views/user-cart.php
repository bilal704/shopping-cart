<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <title>Simple E-commerce</title>
        <style>
            .addMargin{

                margin-top: 20px
            }
            table, td, th {
                border: 1px solid black;
                text-align:center;
                width: 300px;
            }
            form h2 {

                margin-left: 350px
            }
        </style>
        <?php

        if(isset($msg)){

            ?>
            <script type="text/javascript">
                alert("<?php echo $msg; ?>");
            </script>
            <?php
        }
        ?>
    </head>
    <body>
        <?php $this->load->view('navigation'); ?>
        <?php if(!empty(($this->cart->contents()))){ ?>
            <?php echo form_open(base_url().'cart/updateCart', array('style' => 'margin-left: 350px;margin-top: 75px;')); ?>
            <h2>My Cart</h2>
            <table class="table" cellpadding="6" cellspacing="1" style="width:75%;margin-top:35px;">

                <tr>
                    <th>QTY</th>
                    <th>Item Name</th>
                    <th>Item Price</th>
                    <th>Sub-Total</th>
                </tr>

                <?php $i = 1; ?>

                <?php foreach ($this->cart->contents() as $items): ?>

                        <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

                        <tr>
                            <td><?php echo form_input(array('name' => $i.'[qty]', 'value' => $items['qty'], 'maxlength' => '3', 'size' => '5')); ?></td>
                            <td>
                                <a href="<?php echo base_url();?>products/getProduct/<?php echo $items['id'];?>"><?php echo $items['name']; ?></a>

                                <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>

                                    <p>
                                    <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>

                                        <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />

                                    <?php endforeach; ?>
                                    </p>

                                <?php endif; ?>

                            </td>
                            <td>$<?php echo $this->cart->format_number($items['price']); ?></td>
                            <td>$<?php echo $this->cart->format_number($items['subtotal']); ?></td>
                        </tr>

                <?php $i++; ?>

                <?php endforeach; ?>

                <tr>
                    <td colspan="2"> </td>
                    <td class="right"><strong>Total</strong></td>
                    <td class="right">$<?php echo $this->cart->format_number($this->cart->total()); ?></td>
                </tr>

            </table>

            <p><?php echo form_submit('', 'Update your Cart', "class='addMargin btn btn-success'"); ?>  <?php echo form_button('', 'Checkout', "class='addMargin checkout btn btn-primary'"); ?></p>

        <?php } else{

            ?>
            <center><h2 style="margin-top: 75px;">Your Cart Is Empty</h2></center>
            <?php
        } ?>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $('.nav.navbar-nav li').removeClass('active');
            $('#cart').addClass('active');
            <?php

                if(!isset($_SESSION['user'])){

                    $url = base_url().'cart/checkout';
                }
                else{

                    $url = base_url().'cart/finalCheckout';
                }
            ?>
            $('.checkout').on('click', function(){

                window.location.href = "<?php echo $url; ?>";
            });
        </script>
    </body>
</html>


