<?php

// if(isset($_POST['part_searched'])):
// echo "<pre>";
// print_r($branch1);
// echo "</pre>";
// exit;
// endif;
 if(isset($_POST[''])):
    $search_string = $current_search;
 else:
    $search_string="";
 endif;
?>
<!--Page Container Start Here-->
    <section class="main-container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="widget-wrap material-table-widget">
                        <div class="widget-container margin-top-0">
                            <div class="widget-content">
                                <div class="data-action-bar">
                                    <div class="row ">
                                        <div class="col-md-4">
                                            <div class="widget-header">
                                                <h3>                                                    
                                                    Parts results table
                                                </h3>
                                                
                                                <form method = "post" class="j-forms" action="<?php echo base_url('sales_dashboard/part_search');?>">                                                        
                                                    <input type="text" placeholder="Part search" name="part_searched" value="<?php echo $search_string;?>" autofocus='autofocus'>
                                                    <input type="submit" id="part_search_button" class="btn btn-blue btn-primary"></input>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            
                                        </div>
                                        <div class="col-md-4">
                                            <?php 
                                                if(isset($_POST['part_searched']) || isset($_POST['add_to_cart_button'])):
                                            ?>
                                                    <label class="input select">
                                                        <select class="form-control" id="mySelectBox">
                                                            <?php
                                                                for($k=0;$k<count($branch1);$k++):
                                                                    $model = $branch1[$k]['brand']."/".$branch1[$k]['model_name'];
                                                                    if($branch1[$k]['engine_capacity']!=0.0):
                                                                        $model_a = $model."/".$branch1[$k]['engine_capacity'];
                                                                        $search_display = $model.$model_a;
                                                                    endif;
                                                                    if($branch1[$k]['engine_detail']!=""):
                                                                        $model_b = $model."/".$branch1[$k]['engine_detail'];                                                                        
                                                                    endif;
                                                                    
                                                            ?>
                                                                    <option value="<?php echo $model."/"; ?>"><?php echo $branch1[$k]['brand']." ".$branch1[$k]['model_name']." ".$branch1[$k]['engine_capacity']." ".$branch1[$k]['engine_detail'] ;?></option>
                                                            <?php
                                                                endfor;
                                                            ?>                                                            
                                                        </select>
                                                    </label>

                                            <?php 
                                                endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    if(isset($_POST['part_searched'])):
                                ?>

                                        <table id="responseTable" class="table table-striped data-tbl">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        <?php
                                                            echo 'Row';
                                                        ?>
                                                    </th>
                                                    <th>
                                                        <?php
                                                            echo "Part #";
                                                        ?>
                                                    </th>
                                                    <th>
                                                        <?php
                                                            echo "Part Name";
                                                        ?>
                                                    </th>
                                                    <th class="td-center">
                                                        <?php 
                                                            echo "Description";
                                                        ?>
                                                    </th>
                                                    <th>
                                                        <?php 
                                                            echo "Unit price";
                                                        ?>
                                                    </th>
                                                    <th class="td-center">
                                                        <?php
                                                            echo $user_branch;
                                                        ?>
                                                    </th>
                                                    <th class="td-center">
                                                        W/H
                                                    </th>
                                                    <th>

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $row=1;
                                                    for($k=0;$k<count($branch1);$k++):
                                                        $disable_cart_button=false;
                                                        $id=$branch1[$k]['part_id'];
                                                        $number=$branch1[$k]['part_number'];
                                                        $name=$branch1[$k]['part_name'];
                                                        $description1=$branch1[$k]['description']." ".$branch1[$k]['front_rear']." ".$branch1[$k]['left_right']." ".$branch1[$k]['transmission']." ".$branch1[$k]['part_abs']." ".$branch1[$k]['part_condition']." ".$branch1[$k]['packaging'];
                                                        $description2=$branch1[$k]['manufacturer_category']." ".$branch1[$k]['manufacturer_name'];
                                                        $price=$branch1[$k]['unit_price'];
                                                        $branch_quantity=$branch1[$k]['part_id'];
                                                        $model = $branch1[$k]['brand']."/".$branch1[$k]['model_name'];
                                                        if($branch1[$k]['engine_capacity']!=0.0):
                                                            $model = $model."/".$branch1[$k]['engine_capacity'];
                                                        endif;
                                                        if($branch1[$k]['engine_detail']!=" "):
                                                            $model = $model."/".$branch1[$k]['engine_detail'];
                                                        endif;
                                                ?>
                                                        <tr>
                                                            <td>
                                                                <?php
                                                                    echo $id;
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    echo $number."<br> <code><sub>".$model."</sub></code>";
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php
                                                                    echo $name;
                                                                ?>
                                                            </td>
                                                            <td data-value="78025368997">
                                                                <?php 
                                                                    echo $description1."<br>".$description2;
                                                                ?>
                                                            </td>
                                                            <td data-value="1">
                                                                    <?php 
                                                                        echo "R ". $price;
                                                                    ?>
                                                                </span>
                                                            </td>
                                                            <td data-value="1">

                                                                    <?php
                                                                        echo  $branch1[$k]['quantity'];
                                                                    ?>
                                                                </span>
                                                            </td>
                                                            <td data-value='1'>
                                                            <?php
                                                                echo $branch2[$k]['quantity'];
                                                            ?>
                                                            </td>
                                                            <td class="td-right">
                                                                <div id="contact_form">
                                                                    <?php
                                                                        echo form_open('sales_dashboard/add_to_cart');
                                                                        echo form_hidden('id',$id);
                                                                        echo form_hidden('number',$number);
                                                                        echo form_hidden('name',$name);
                                                                        echo form_hidden('price',$price);
                                                                        echo form_hidden('description',$description1."/".$description2);
                                                                        echo form_hidden('current_search',$_POST['part_searched']);
                                                                        echo form_hidden('model',$model);
                                                                        if($branch2[$k]['quantity']<=0):
                                                                    ?>
                                                                            <button class="row-edit" href="#" disabled>
                                                                            <span class="zmdi zmdi-shopping-cart"></span>
                                                                            <?php 
                                                                                echo '<code><sub>no stock</sub></code>';                                                                            
                                                                                else:
                                                                            ?>
                                                                            <button class="row-edit" href="#" name="add_to_cart_button"id="<?php echo 'add_cart'.$row;?>">
                                                                                <span class="zmdi zmdi-shopping-cart"></span>
                                                                                <?php echo '+';?>
                                                                            <?php
                                                                                endif;
                                                                            ?>
                                                                        </button>
                                                                    <?php 
                                                                        echo form_close();
                                                                    ?>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                <?php
                                                        $row++;
                                                    endfor;
                                                ?>
                                            </tbody>
                                        </table>
                                <?php
                                    endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget-wrap">
                        <div class="widget-header block-header margin-bottom-0 clearfix">
                            <div class="pull-left">
                                <h3>Sales C.O.D [Cart]</h3>
                                <p><code>*Tax Rate: 15%</code></p>
                                <p><code>*Discount Rate</code></p>
                            </div>
                            <div class="pull-right w-action">
                                <ul class="widget-action-bar">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="zmdi zmdi-more"></i></a>
                                        <ul class="dropdown-menu">
                                            <li class="widget-reload"><a href="#"><i class="zmdi zmdi-refresh-alt"></i></a></li>
                                            <li class="widget-toggle"><a href="#"><i class="zmdi zmdi-chevron-down"></i></a></li>
                                            <li class="widget-fullscreen"><a href="#"><i class="zmdi zmdi-fullscreen"></i></a></li>
                                            <li class="widget-exit"><a href="#"><i class="zmdi zmdi-power"></i></a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="widget-container margin-top-0">
                            <div class="widget-content">
                                <div class="recent-users">
                                    <div class="recent-users-list">
                                        <?php
                                            $display_counter=1;
                                            foreach($this->cart->contents() as $cart):
                                        ?>
                                            <?php
                                            //   if($display_counter==1):
                                            ?>
                                            <!-- <div class="individual-user info-expand">
                                                <div class="user-intro">
                                                    <div class="user-thumb"><a href="#"><img src="images/avatar/kurafire.jpg" alt="user"></a></div>
                                                    <div class="users-info">
                                                        <ul>
                                                            <li class="u-name"><a href="#">Part </a></li>
                                                            <li class="u-location">description</li>
                                                        </ul>
                                                    </div>
                                                    <span class="user-details-toggle"><i class="zmdi"></i></span>
                                                </div>
                                                <div class="users-details">
                                                    <ul>
                                                        <li><label>Detail 1:</label> - </li>
                                                        <li><label>Detail 2:</label> - </li>
                                                        <li><label>Detail 3:</label> <label class="label label-default">Silver</label> </li>
                                                    </ul>
                                                </div>
                                            </div> -->
                                            <?php
                                            // else:
                                            ?>
                                            <div class="individual-user">
                                                <div class="user-intro">
                                                    <div class="users-info">
                                                        <ul>
                                                            <li class="u-name">
                                                                <sup>
                                                                    <a href="#">
                                                                        <?php echo $cart['name'];?>
                                                                    </a>
                                                                </sup>
                                                                

                                                            </li>
                                                            <li>
                                                                <sup>
                                                                    <?php echo "[".$cart['number']."]";?>
                                                                </sup>
                                                                
                                                            </li>
                                                            <li class="u-location">

                                                                <code>                                                                    
                                                                        Unit Price: <b>R <?php echo $cart['price'];?></b>
                                                                </code>
                                                            
                                                                <code class="pull-right">
                                                                    <!-- <a href="#" class="pull-right"> -->
                                                                        <?php echo "qty: ". $cart['qty'];?>
                                                                    <!-- </a> -->
                                                                </code>
                                                            
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <span class="user-details-toggle"><i class="zmdi"></i></span>
                                                </div>
                                                <div class="users-details">
                                                    <ul>
                                                        <li><label>Detail 1:</label> - </li>
                                                        <li><label>Detail 2:</label> - </li>
                                                        <li><label>Detail 3:</label> <label class="label label-default">Silver</label> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <?php
                                                //endif;
                                            ?>
                                        <?php
                                            $display_counter++;
                                            endforeach;

                                            if($this->cart->contents()):
                                        ?>
                                            <div class="widget-header block-header margin-bottom-0 clearfix">
                                                    <div>
                                                            <h3><b>Sub total</b></h3>
                                                            <!-- <p> -->
                                                                <?php
                                                                    echo number_format($this->cart->total()-($this->cart->total()*0.15),2,'.',',');
                                                                ?>
                                                            <!-- </p>                                                         -->
                                                    </div>
                                                    <div>
                                                        <span>
                                                            <h3>Tax</h3>
                                                            <p>
                                                                <?php
                                                                    echo number_format(($this->cart->total()*0.15),2,'.',',');
                                                                ?>
                                                            </p>
                                                        </span>
                                                    </div>
                                                    <div>
                                                            <h3>Ticket Total</h3>
                                                            <p>
                                                                <?php
                                                                    echo number_format($this->cart->total(),2,',','.');
                                                                ?>
                                                            </p>
                                                    </div>
                                            </div>
                                        <?php
                                            endif;
                                            echo form_open('sales_dashboard/print_ticket');
                                        ?>
                                            <button class="btn btn-link btn-block btn-loadmore">Create Ticket</button>
                                        <?php
                                            echo form_close();
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!--Page Container End Here-->


<script>
    <?php for($i=1;$i<=count($data)+1;$i++):?>
        $("<?php echo '#add_cart'.$i;?>").click(function(){$("#content").load(" #content");});
    <?php endfor; ?>
</script>
<script>
    $(document).ready( function () 
    {
    var table = $('#responseTable').DataTable({
        
    });  
    $('#mySelectBox').on( 'change', function () 
    {
            table.search($('#mySelectBox').val()).draw();
    });
} );
</script>



