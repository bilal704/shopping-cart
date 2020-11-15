<style>
    table, th, td{

        border:1px solid black;
    }
</style>
<div class="modal-body">
    <h2>InVoice</h2>
</div>
<div class="modal-dialog">
    
    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Thank You, Your Order Has Been Placed</h4>
        </div>
        <div class="modal-body">
            <h4 class="modal-title">Invoice</h4>
            <table cellpadding="6" cellspacing="1" style="width:75%;margin-top:35px;">
                <tr>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ADDRESS</th>
                    <th>CITY</th>
                    <th>PIN CODE</th>
                    <th>PHONE</th>
                </tr>
                <tr>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $address; ?></td>
                    <td><?php echo $city; ?></td>
                    <td><?php echo $pin_code; ?></td>
                    <td><?php echo $phone; ?></td>
                </tr>
            </table>
            <table cellpadding="6" cellspacing="1" style="width:75%;margin-top:35px;">

                <tr>
                    <th>QTY</th>
                    <th>Item Name</th>
                    <th>Item Price</th>
                    <th>Sub-Total</th>
                </tr>

                <?php $i = 1; ?>

                <?php foreach ($this->cart->contents() as $items): ?>
                        <tr>
                            <td><?php echo $items['qty']; ?></td>
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
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
    
</div>
<script>
    $('#cart-count').text("<?php echo $this->cart->total_items(); ?>");
</script>