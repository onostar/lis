<?php   
        session_start();
        $store = $_SESSION['store_id'];
        $sales = htmlspecialchars(stripslashes($_POST['sales_id']));
        $qty = htmlspecialchars(stripslashes($_POST['pack_qty']));
        $pack_price = htmlspecialchars(stripslashes($_POST['pack_price']));
        $pack_size = htmlspecialchars(stripslashes($_POST['pack_size']));
        $total_qty = $qty * $pack_size;
        $new_amount = $qty * $pack_size * $pack_price;

        // instantiate classes
        include "../classes/dbh.php";
        include "../classes/select.php";
        include "../classes/update.php";
        $get_invoice = new selects();
        $rows = $get_invoice->fetch_details_cond('sales', 'sales_id', $sales);
        foreach($rows as $row){
            $invoice = $row->invoice;
            $item_id = $row->item;
        }
        // /get itemd commission
        $get_commission = new selects();
        $coms = $get_commission->fetch_details_group('items', 'commission', 'item_id', $item_id);
        //get item quantity from inventory
        //first get the item from sales order
        $get_item = new selects();
        $item = $get_item->fetch_details_group('sales', 'item', 'sales_id', $sales);
        $item_id = $item->item;
        $get_qty = new selects();
        $item_qtys = $get_qty->fetch_sum_double('inventory', 'quantity', 'store', $store, 'item', $item_id);
        foreach($item_qtys as $item_qty){
            $inv_qty = $item_qty->total;
        }
        if($total_qty > $inv_qty){
            echo "<script>alert('Available Quantity is less than required! Can not proceed!')</script>";
        }else{
        //get cost price
        $get_cost = new selects();
        $costs = $get_cost->fetch_details_group('items', 'cost_price', 'item_id', $item_id);
        $cost_price = $costs->cost_price;
        $total_cost = $total_qty * $cost_price;
        $commission = ($pack_price * ($commission_percent/100));
        $new_com = $total_qty * $commission;
        //update quantity and price
        $update = new Update_table();
        $update->update_multiple('sales', 'quantity', $total_qty, 'price', $pack_price, 'total_amount', $new_amount, 'cost', $total_cost, 'commission', $new_com, 'sales_id', $sales);
        
        // if($update){
        }
?>
<!-- display items with same invoice number -->

<?php
    include "sales_order_details.php";
            // }            
        // }
    // }
?>