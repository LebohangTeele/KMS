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
            foreach($results as $refunds):
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