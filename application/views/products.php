<!DOCTYPE html>
<html>
    <head>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">
        <style>
            .img-responsive{
                max-width: 50%;
            }
        </style>
        <title>Simple E-commerce</title>
    </head>
    <body>
        <?php $this->load->view('navigation'); ?>
        <div class="container">
        <?php

        foreach($products as $product){
            
            $hot_sale = ['hot', 'sale'];
            $tag = 2;

            $hot_sale_text = $hot_sale[rand(0,1)];
            $class = "tag".$tag." ".$hot_sale_text;
            ?>
            <div class="col-xs-12 col-md-6">
                <!-- First product box start here-->
                <div class="prod-info-main prod-wrap clearfix">
                    <div class="row">
                            <div class="col-md-5 col-sm-12 col-xs-12">
                                <div class="product-image"> 
                                    <img src="<?php echo $product['image']; ?>" class="img-responsive"> 
                                    <span class="<?php echo $class; ?>">
                                        <?php echo strtoupper($hot_sale_text); ?>
                                    </span> 
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12 col-xs-12">
                            <div class="product-deatil">
                                    <h5 class="name">
                                        <a href="#">
                                            <?php echo substr($product['title'], 0, 20)."..."; ?>
                                        </a>
                                        <a href="#">
                                            <span><?php echo $product['category']; ?></span>
                                        </a> 
                                    </h5>
                                    <p class="price-container">
                                        <span><?php echo "$".$product['price']; ?></span>
                                    </p>
                                    <span class="tag1"></span> 
                            </div>
                            <div class="description">
                                <p><?php echo substr($product['description'], 0, 100)."..."; ?></p>
                            </div>
                            <div class="product-info smart-form">
                                <div class="row">
                                    <div class="col-md-12"> 
                                        <a href="javascript:void(0);" onclick="javacsript:addToCart(<?php echo $product['id']; ?>, 1, <?php echo $product['price']; ?>, '<?php echo addslashes(substr($product['title'], 0, 30)); ?>...')" class="btn btn-danger">Add to cart</a>
                                        <a href="<?php echo base_url();?>products/getProduct/<?php echo $product['id'];?>" class="btn btn-info">More info</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end product -->
            </div>
            <?php
        }
        ?>
        </div>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/add-to-cart.js"></script>
        <script type="text/javascript">
            $('.nav.navbar-nav li').removeClass('active');
            $('#home').addClass('active');
        </script>
    </body>
</html>

