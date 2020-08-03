<div class="widget-content">
    <div class="recent-users">
        <div class="recent-users-list">
            <?php
                $display_counter=1;
                foreach($this->cart->contents() as $cart):
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
<script src="<?php echo base_url();?>assets/js/lib/jquery.dataTables.js"></script>