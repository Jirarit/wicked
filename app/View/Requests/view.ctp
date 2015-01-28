<h1><?php echo __('Request Orders > information'); ?></h1>
<fieldset>
    <table class="TableView">
        <tr>
            <td><?php echo __("Request Date"); ?></td><td><?php echo $request['Request']['request_date']; ?></td>
        </tr>
        <tr>
            <td><?php echo __("Status"); ?></td><td><?php echo $request['Request']['status'] == 'N' ? 'New' : 'Received' ; ?></td>
        </tr>
        <tr>
            <td><?php echo __("Created"); ?></td><td><?php echo $request['Request']['created']; ?></td>
            <td><?php echo __("By"); ?></td><td><?php echo @$create_by; ?></td>
        </tr>
        <tr>
            <td><?php echo __("Updated"); ?></td><td><?php echo $request['Request']['modified']; ?></td>
            <td><?php echo __("By"); ?></td><td><?php echo @$update_by; ?></td>
        </tr>
        <tr>
            <td><?php echo __("Receive Date"); ?></td><td><?php echo $request['Request']['receive_date']; ?></td>
            <td><?php echo __("By"); ?></td><td><?php echo @$receive_by; ?></td>
        </tr>
    </table>
</fieldset>
<fieldset>
    <table class="TableIndex">
        <tr>
            <th class="index">#</th>
            <th><?php echo __('Product No'); ?></th>
            <th><?php echo __('Product Name'); ?></th>
            <th><?php echo __('Order Qty'); ?></th>
            <th><?php echo __('Receive Qty'); ?></th>
        </tr>
        <?php
        $line = 1;
        foreach ($request_details as $request_detail){
            $request_detail = $request_detail['RequestDetail'];
            $product_id = $request_detail['product_id'];
        ?>
        <tr>
            <td class="index"><?php echo $line++; ?></td>
            <td><?php echo $product_info[$product_id]['product_no']; ?></td>
            <td><?php echo $product_info[$product_id]['product_name']; ?></td>
            <td><?php echo $request_detail['request_qty']; ?></td>
            <td><?php echo $request_detail['receive_qty']; ?></td>
        </tr>
        <?php } ?>
    </table>
    
<?php 
if($request['Request']['status'] == 'N'){
    echo "<br>";
    echo $this->Html->link(__('Receive All'), array('action' => 'receive_all', $request['Request']['id']), array('class'=>'ButtonLinkAdd')); 
}
?>
</fieldset>
<?php echo $this->Html->link(__('Back'), array('action' => 'index'), array('class'=>'ButtonLinkBack')); ?>