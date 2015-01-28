<h1><?php echo __('Request Orders > Create new request'); ?></h1>
<fieldset>
    <?php 
    //echo $this->Html->link(__('Add item'), array('action' => 'add_temp_item'), array('class'=>'ButtonLinkAdd'));
    //echo "&nbsp;";
    echo $this->Html->link(__('Full fill par stock'), array('action' => 'full_fill_stock'), array('class'=>'ButtonLinkAdd'));
    echo "<hr>";
    echo $this->Form->create('Request',array('url'=>"/Requests/add"));
    $line = 1;
    ?>
    <table class="TableIndex">
        <tr>
            <th class="index">#</th>
            <th><?php echo __('Product No'); ?></th>
            <th><?php echo __('Product Name'); ?></th>
            <th style="width: 120px"><?php echo __('Par Stock'); ?></th>
            <th style="width: 120px"><?php echo __('Remain Stock'); ?></th>
            <th style="width: 120px"><?php echo __('Order Qty'); ?></th>
            <th class="actions"><?php echo __('Remove'); ?></th>
        </tr>
        <?php 
        if(!empty($_SESSION['TEMP_REQUEST'])){
            $line = 1;
            foreach ($_SESSION['TEMP_REQUEST'] as $product_id => $order_qty){
        ?>
        <tr>
            <td class="index"><?php echo $line++; ?></td>
            <td><?php echo $products[$product_id]['product_no']; ?></td>
            <td><?php echo $products[$product_id]['product_name']; ?></td>
            <td><?php echo $products[$product_id]['par_stock']; ?></td>
            <td><?php echo $products[$product_id]['onhand_qty']; ?></td>
            <td><?php echo $this->Form->input("Request.{$product_id}", array('div'=>FALSE, 'label'=>FALSE,'default'=>$order_qty, 'type'=>'number', 'style'=>'width:100px', 'required')); ?></td>
            <td><?php echo $this->Html->link(__('Remove'), array('action' => 'remove_temp_item', $product_id), array('class'=>'ButtonLinkDelete')); ?></td>
        </tr>
        <?php 
            }
        }else{
            echo $this->Display->empty_table_data();
        }
        ?>
    </table>
    <?php
    echo "<br>";
    if(!empty($_SESSION['TEMP_REQUEST'])){
        echo $this->Form->submit(__('Submit'), array('div'=>FALSE, 'class'=>'ButtonSave'));
        echo "&nbsp;";
        echo $this->Html->link(__('Cancel'), array('action' => 'clear_temp'), array('class'=>'ButtonLink'));
    }else{
        echo $this->Html->link(__('Back'), array('action' => 'clear_temp'), array('class'=>'ButtonLinkBack'));
    }
    ?>
</fieldset>