<section class="main-container">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class = "widget-wrap">
                    <form action="#" class="j-forms" >     
                        <div class="form-content">
                                <div class="j-row">
                                    <div class="span6 unit">
                                        <div class="input">
                                            <label class="icon-right" for="date-icon">
                                                <i class="fa fa-calendar"></i>
                                            </label>
                                            <input  class="form-control" type="text" id="date-icon" placeholder="datepicker with an icon" readonly="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-2">
                                            <div class="input-group date addon-datepicker">
                                                <input type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </form>
                </div>
                <div class="widget-wrap block-header margin-bottom-0 clearfix">
                    <table class="table table-striped data-tbl">
                        <thead>
                            <tr>
                                <td>
                                    <!-- index column -->
                                </td>
                                <td>
                                    Date
                                </td>
                                <td>
                                    Purchased Items
                                </td>
                                <td>
                                    Total Cost
                                </td>
                                <td>
                                    State
                                </td>
                                <th>
                                    View
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $row = 1;

                                foreach($invoices as $inv):
                            ?>
                                    <tr>
                                        <td>
                                            <?php
                                                echo $row;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $inv['modified'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $inv['invoice_name'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                echo $inv['invoice_value'];
                                            ?>
                                        </td>
                                        <td>
                                            <sub>
                                                <code>
                                                    <?php
                                                        echo $inv['state'];
                                                    ?>
                                                </code>    
                                            </sub>    
                                        </td>
                                        <td>
                                            <form action = "">
                                                <input type="hidden" id="<?php echo $inv['invoice_name'];?>" value ="<?php echo $inv['quote_id'];?>">
                                                <input type="submit" value="details" onclick ="return <?php echo $inv['invoice_name'].'chk()'; ?> ">
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                    $row++;
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="widget-wrap " id="quotationDetails">
                        <!-- view quotation details -->
                    </div>
                </div>
                <div class="row">
                    <div class = "processRefund">

                    </div>
                    <div class="widget-wrap block-header margin-bottom-0 clearfix" id="processedInvoices">
                        <h4>
                            Refunds Processed Today
                        </h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        Ticket Date
                                    </th>
                                    <th>
                                        Invoice Name
                                    </th>
                                    <th>
                                        Total Cost
                                    </th>
                                    <th>
                                        State
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($refunds_today as $refunds):
                                ?>
                                <tr>
                                    <td>
                                        <?php 
                                            echo $refunds['created'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $refunds['quote_name'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $refunds['quote_value'];
                                        ?>
                                    </td>
                                    <td>
                                        <sub>
                                            <code>
                                                <?php
                                                    echo $refunds['state'];
                                                ?>
                                            </code>    
                                        </sub>
                                        <a id = "printLink" href="javascript: window.open('?sale_id=1843538&invoice_id=AK1492&finalSubtotal=45.22&finalTotal=52', '', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=320,height=500,left = 312,top = 284'); return false;">view</a>
                                    </td>
                                </tr>
                                <?php 
                                    endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Asynchronous JS and XML -->

<script>  
      $(document).ready(function(){
      $('#editable_table').Tabledit(
            {
                  url:'<?php echo base_url("test_tables/edit");?>',
                  columns:{
                  identifier:[0, "line_item_id"],
                  editable:[[2, 'quantity']]
                  },
                  restoreButton:true,
                  onSuccess:function(data, textStatus, jqXHR)
                  {
                  if(data.action == 'delete')
                        {
                        $('#'+data.id).delete();
                        }
                  }

            });

      });

    $("#test").click(function()
    {
        $("").load("<?php echo base_url('process_invoices/quote_details');?>");
    });
</script>
<script>
<?php
    foreach($invoices as $inv):
?>
    function <?php echo $inv['invoice_name'].'chk()'; ?>
    {
        var name = document.getElementById('<?php echo $inv['invoice_name'];?>').value;
        var dataString = '<?php echo $inv['invoice_name']."=";?>'+name;
        $.ajax({
            type:"post",
            url: "<?php echo base_url('process_refunds/refund_details');?>",
            data:dataString,
            cache:false,
            success:function (html){
                $('#quotationDetails').html(html);
            }
    });

    return false;
    }
<?php 
    endforeach;
?>
</script>

<script>
    function invoices_processed()
    {
        var name = document.getElementById('<?php echo $inv['invoice_name'];?>').value;
        var dataString = '<?php echo $inv['invoice_name']."=";?>'+name;
        $.ajax({
            type:"post",
            url: "<?php echo base_url('process_refunds/refund_details');?>",
            data:dataString,
            cache:false,
            success:function (html){
                $('#quotationDetails').html(html);
            }
        });
        return false;
    }
</script>
<script>
    document.getElementById("printLink").onclick = function() {myFunction()};
    function myFunction() {
        window.open('<?php echo base_url('process_invoices/print_invoice');?>?sale_id=1843538&invoice_id=AK1492&finalSubtotal=45.22&finalTotal=52');
    }
</script>

