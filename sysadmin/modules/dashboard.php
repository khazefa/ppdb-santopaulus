        <?php
            /**
            $pagetitle = "Dashboard";
            $query_o = "SELECT order_id FROM orders WHERE DATE(order_date) = CURDATE() AND order_status = 'invoiced'";
            $num_o = (int)$database->num_rows( $query_o );
            
            $query_m = "SELECT customer_id FROM customers";
            $num_m = (int)$database->num_rows( $query_m );
            
            $query_p = "SELECT product_id FROM products WHERE product_stock <> 0";
            $num_p = (int)$database->num_rows( $query_p );
            **/
        ?>
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active"><?php echo $pagetitle;?></li>
            </ol>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><?php echo $pagetitle;?></h1>
            </div>
        </div><!--/.row-->

        <div class="panel panel-container">
			<div class="row">
				<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
							<!--<div class="large"><?php echo $num_m;?></div>-->
							<div class="large">0</div>
							<div class="text-muted">Total Registrant</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-user-circle color-blue"></em>
							<!--<div class="large"><?php echo $num_o;?></div>-->
							<div class="large">0</div>
							<div class="text-muted">Total Passed</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-4 col-lg-4 no-padding">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding"><em class="fa fa-xl fa-user-circle-o color-red"></em>
							<!--<div class="large"><?php echo $num_p;?></div>-->
							<div class="large">0</div>
							<div class="text-muted">Total Not Passed</div>
						</div>
					</div>
				</div>
			</div><!--/.row-->
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">New Registrant</div>
                    <div class="panel-body">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Actions</th>
                                <th>Order</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                            <?php
                            /**
                                $query = "SELECT o.order_id, o.order_uniqid, o.order_date, o.order_subtotal, o.order_status, c.customer_name "
                                        . "FROM orders AS o INNER JOIN customers AS c ON o.customer_uniqid = c.customer_uniqid "
                                        . "WHERE DATE(order_date) = CURDATE() AND order_status = 'invoiced' ORDER BY order_id DESC";
                                $results = $database->get_results( $query );
                                $no = 1;
                                foreach( $results as $row )
                                {
                                    echo "<tr>";
                                        echo "<td>
                                                <a href='?page=customer-orders&act=info&key=$row[order_uniqid]'><i class='fa fa-eye'></i> View</a>
                                            </td>";
                                        echo "<td>#$row[order_id]</td>";
                                        echo "<td>$row[customer_name]</td>";
                                        echo "<td>". tgl_indo($row[order_date]) ."</td>";
                                        echo "<td>RP. ". format_IDR($row[order_subtotal]) ."</td>";
                                        echo "<td>". strtoupper($row[order_status]) ."</td>";
                                    echo "</tr>";
                                    $no++;
                                }
                            **/
                            ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!--/.row-->