<div class="row" >
    <div class="widget-wrap ">
        <h4> Refund Processing Details</h4>
        <div class="container">
                <h1>Invoice Item list</h1>
            <div  class="panel panel-default">
                <?php
                    
                    foreach($invoice_details as $order):
                ?>
                <div class="panel-heading">
                <h3 class="panel-title">Part: <span id="orderNumber<?php echo $order['line_item_id'] ?>"><?php echo "[". $order['part_number']."]"." ".$order['part_name']; ?></span> </h3>

                </div>

                <div id="orderSection<?php echo $order['line_item_id'] ?>" class="panel-body">
                <div class="form-inline">
                    <div class="form-group">
                    <label for="nameInput<?php echo $order['line_item_id'] ?>"></label>
                    <input type="hidden" id="quoteId<?php echo $order['line_item_id']?>" value="<?php echo $order['quote_id']?>">
                    <input type="hidden" id="partId<?php echo $order['line_item_id']?>" value="<?php echo $order['item_id'];?>">
                    <!-- <input type="text" class="form-control" id="nameInput<?php echo $order['line_item_id'] ?>" value="<?php echo $order['quote_name'] ?> " > -->
                    </div>

                    <div class="form-group">
                    <label for="quantityInput<?php echo $order['line_item_id'] ?>">Quantity</label>
                    <input type="number" class="form-control" id="quantityInput<?php echo $order['line_item_id'] ?>" value="<?php echo $order['quantity'] ?>"min="0" max="<?php echo $order['quantity'] ?>">
                    </div>
                    <div class="form-group">
                    <label for="quantityInput<?php echo $order['line_item_id'] ?>">Unit Price</label>
                    <input class="form-control" id="orderPrice<?php echo $order['line_item_id'] ?>" value ="<?php echo $order['unit_price'] ?>">
                    </div>

                    <button class="btn btn-primary updateButton"  member_id="<?php echo $order['line_item_id'] ?>">Refund Item</button>
                </div>
                </div>
                <?php
                    endforeach;
                ?>
            </div>
        </div>
        <table id="editable_table" class="table table-striped">
            <tbody>
                <?php
                    if($invoice_details):
                    $sub_total=0;
                //    // print_r($invoice_details);
                    foreach($invoice_details as $line_item)
                    {


                    $sub_total = $sub_total+($line_item['quantity']*$line_item['unit_price']);
                    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <table class="table-striped">
                            <tr>
                                <td>
                                    Invoice total:
                                </td>
                                <td>
                                        <!-- Place Holder column -->
                                        &nbsp; &nbsp;
                                </td>
                                <td class="pull-right">
                                    <?php echo $currency. number_format($sub_total,2,'.',','); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Refund amount:
                                </td>
                                <td>
                                    <!-- Place holder column -->
                                </td>
                                <td class="pull-right">
                                    <?php echo $currency.number_format(($sub_total*0.15),'2','.',',');?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Remaining balance:
                                </td>
                                <td>
                                    <!-- Place holder column -->
                                </td>
                                <td class="pull-right">
                                    <?php echo $currency.number_format($sub_total*1.15,2,'.',',');?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Payment summary
                                </td>
                                <td>

                                </td>
                                <td class="pull-right" style="font-weight:bold;">
                                    amount
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
            </tfoot>
        </table>
        <?php
            $cashier_name = $this->session->userdata('user_name')."_"."refund_".explode('_',$invoice_details[0]['quote_name'])[1];
        ?>
        <table class="table-striped">
            <tr>
                <div class = "col-md-9">

                </div>
                <div class="col-md-3">
                    <td>       
                        <div class="form-group">
                        <input type="hidden" id="quotation_id" value="<?php echo $invoice_details[0]['quote_id']?>">
                        <button type="submit" class="btn btn-primary" id="refund_all">Refund All</button>
                        <button type="submit" class="btn btn-primary" id="finishForm" onclick="finishForm()">Finish</button>
                        </div>
                    </td>
                </div>
            </tr>
        </table>
        <?php
            else:
                echo "Error with invoice entry";
            endif;
        ?>
    </div>
</div>
<div class="row">
    <div class = "processRefund">
    </div>
    <div class="widget-wrap block-header margin-bottom-0 clearfix" id="processedInvoices">
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.updateButton').on('click', function() 
        {

            var line_item_id = $(this).attr('member_id');
            var item_id=$('#partId'+line_item_id).val();
            var name = $('#nameInput'+line_item_id).val();
            var qty = $('#quantityInput'+line_item_id).val();
            var quote_id=$('#quoteId'+line_item_id).val();
            var refund_price =$('#orderPrice'+line_item_id).val();
            
            ask = $.ajax({
                url : "<?php echo base_url('sales_dashboard/test');?>",
                type : 'POST',
                data : { user_name : name, quantity : qty, line_id : line_item_id, qid: quote_id,amount:refund_price,part_id:item_id },
                success: function(datareduzve){
                    $('#processedInvoices').html(datareduzve);
                }
            });

            ask.done(function(data) {

                $('#orderSection'+line_item_id).fadeOut(1000).fadeIn(1000);
                $('#orderNumber'+line_item_id).text(data.result);
                // $( "#thisone" ).load(window.location.href + " #thisone" );

            });


        });
    });
    $(".updateButton").on('click', function(event){
       
    event.stopPropagation();
    event.stopImmediatePropagation();
    alert("Insed");
        $("#refund_all").prop('disabled', true);

    //(... rest of your JS code)
})
    $("#refund_all").on("click", function(e) {
        e.preventDefault();
        $.ajax({type: "POST",
            url: "<?php echo base_url('sales_dashboard/refund_finito')?>",
            data: { quotation_id: $("#quotation_id").val()},
            success:function(datareduzve) {
                alert(datareduzve);
            },
            error:function(datareduzve) {
                alert('error');
            }
        });
    });
</script>
