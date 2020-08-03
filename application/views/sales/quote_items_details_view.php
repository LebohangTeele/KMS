<h4> Ticket Processing Details</h4>
<table class="table table-striped">
    <thead >
        <tr >
                <th>
                    <h4>
                        Item Name
                    </h4>
                </th>
                <th>
                    <h4>
                        Quantity
                    </h4>
                </th>
                <th>
                    <h4>
                        Unit Price
                    </h4>
                </th>
                <th>
                    <h4>
                        +Tax
                    </h4>
                </th>

        </tr>
    </thead>
    <tbody>
        <?php
            if($quote_details):
            $sub_total=0;
            foreach($quote_details as $line_item):
        ?>
            <tr>
                <td>
                    <?php echo $line_item['part_name'];?>
                </td>
                <td>
                    <?php 
                        echo $line_item['quantity'];
                    ?>
                </td>
                <td>
                    <?php echo $currency.number_format($line_item['unit_price'],2,'.',',');?>
                </td>
                <td>
                    <?php echo $currency.number_format($line_item['unit_price']*1.15,2,'.',',');?>
                </td>
            </tr>
        <?php
            $sub_total = $sub_total+($line_item['quantity']*$line_item['unit_price']);
            endforeach;
        ?>
    </tbody>
    <tfoot>
        <tr>
            <td>
                <table class="table-striped">
                    <tr>
                        <td>
                            
                                Sale Sub Total:
                            
                        </td>
                        <td>
                                <!-- Place Holder column -->
                                &nbsp; &nbsp;
                        </td>
                        <td class = "pull-right">
                            <?php echo $currency. number_format($sub_total,2,'.',','); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        
                                Tax Total:
                        
                        </td>
                        <td>
                            <!-- Place holder column -->

                        </td>
                        <td class = "pull-right">
                            <?php echo $currency.number_format(($sub_total*0.15),'2','.',',');?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            
                                Sale Total Cost:
                            
                        </td>
                        <td>
                            <!-- Place holder column -->
                        </td>
                        <td class  ="pull-right">
                            <?php echo $currency.number_format($sub_total*1.15,2,'.',',');?>
                        </td>
                    </tr>
                </table>
            </td>

        </tr>
    </tfoot>
</table>
<?php
    echo form_open('sales_dashboard/create_invoice');
    echo form_hidden('quote_total',number_format($sub_total*1.15,2,'.',''));
    $cashier_name = $this->session->userdata('user_name')."_"."cashier_".explode('_',$quote_details[0]['quote_name'])[1];
    echo form_hidden('invoice_name',$cashier_name);
    echo form_hidden('quote_id',$quote_details[0]['quote_id']);
?>
<table class="table-striped">

    <tr>
        <div class="col-md-3">
            <td>
                <label class="input select">
                    Method 1
                </label>
                <select class="form-control " name="paymentMode1">
                    <?php
                        foreach($payment_modes as $mode):
                    ?>
                            <option value = "<?php echo $mode['mode_id'];?>">
                                <?php echo $mode['payment_mode'] ?>
                            </option>
                    <?php
                        endforeach;
                    ?>
                </select>
            </td>
        </div>
        <div class = "col-md-3">
            <td>
                <label class="input select">
                        Amount
                </label>
                <input id = "paymentValue1" name = "paymentValue1" class = "form-control" type="text" value="<?php echo number_format($sub_total*1.15,2,'.',',');?>" >
            </td>
        </div>
        <div class = "col-md-3">
            <td>
                <label class="input select">
                    Method 2
                </label>
                <select class="form-control " name="paymentMode2">
                    <?php
                        foreach($payment_modes as $mode):
                    ?>
                            <option value = "<?php echo $mode['mode_id'];?>">
                                <?php echo $mode['payment_mode'] ?>
                            </option>
                    <?php
                        endforeach;
                    ?>
                </select>
            </td>
        </div>
        <div class = "col-md-3">
            <td>
                <label class="input select">
                    Amount
                </label>
                <input id="paymentValue2" name ="paymentValue2" class = "form-control" type="text" readonly="readonly" value="">
            </td>
        </div>
    </tr>
    <tr>
        <div class = "col-md-3"><td>&nbsp;</td></div>
        <div class = "col-md-3"><td>&nbsp;</td></div>
        <div class = "col-md-3">
            <td> 
                <button type="submit" class="btn btn-default">
                    + Sales Note
                </button>
            </td>
        </div>
        <div class="col-md-3">
            <td>                <!-- input to add a sales comment goes here, a not accompanying the invoice -->
                <button type="submit" class="btn btn-primary">Process Payment</button>
            </td>
        </div>
    </tr>
</table>
<?php
    echo form_close();
else:
    echo "Error with quote entry";
endif;
?>


