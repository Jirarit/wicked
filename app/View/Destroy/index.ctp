<h1><?php echo __('Spoil & Waste'); ?></h1>

<fieldset>
    <?php echo $this->Form->create('Product',array('url'=>"/Destroy/index/page:1")); ?>
    <table>
        <tr>
            <td><?php echo __('Product No/Name'); ?></td>
            <td><?php echo $this->Form->input('search' , array('div'=>FALSE, 'label'=>FALSE)); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Category'); ?></td>
            <td><?php echo $this->Form->input('product_category_id', array('label'=>FALSE, 'div'=>FALSE, 'id' => 'cate', 'onchange' => 'filter_sub_cate(this.value);', 'options'=>$productCategories, 'empty'=>__('Please select category'))); ?></td>
        </tr>
    </table>
    <?php
    echo $this->Form->submit('Search', array('div'=>FALSE, 'class'=>'ButtonSearch'));
    ?>
</fieldset>

<?php 
    $current_page = $this->Paginator->counter(array('format' => __('{:pages}'))); 
    $start_rec = $this->Paginator->counter(array('format' => __('{:start}')));
?>
<table class="TableIndex">
    <tr>
        <th class="index">#</th>
        <th><?php echo $this->Paginator->sort('product_no'); ?></th>
        <th><?php echo $this->Paginator->sort('product_name'); ?></th>
        <th><?php echo $this->Paginator->sort('unit'); ?></th>
        <th><?php echo $this->Paginator->sort('product_category_id', 'Category'); ?></th>
        <th><?php echo __('Today'); ?></th>
        <th class="actions"><?php echo __('Spoil&Waste'); ?></th>
    </tr>
    <?php 
    if(!empty($products)){
    foreach ($products as $k => $product): 
        $product_id = $product['Product']['id'];
        $cate_id = $product['Product']['product_category_id'];
        $product_name = $product['Product']['product_name'];
        $unit = @$productUnits[$product_id];
    ?>
	<tr>
            <td class="index"><?php echo $start_rec++; ?></td>
            <td><?php echo h($product['Product']['product_no']); ?>&nbsp;</td>
            <td><?php echo h($product_name); ?>&nbsp;</td>
            <td><?php echo h($unit); ?>&nbsp;</td>
            <td><?php echo h(@$productCategories[$cate_id]); ?>&nbsp;</td>
            <td style="width: 120px"><?php echo h(empty($picked[$product_id]) ? 0 : abs($picked[$product_id])); ?>&nbsp;</td>
            <td class="actions">
                <?php 
                $destroy_info = json_encode(array('product_id'=>$product_id, 'product_name'=>$product_name, 'unit'=>$unit), 256);
                echo $this->Form->input('destroy', array('div'=>FALSE, 'label'=>FALSE, 'type'=>'number', 'id'=>$product_id, 'default'=>0, 'style'=>'width:100px', 'onKeydown'=>"if(event.keyCode==13)return destroy({$destroy_info});"));
                echo $this->Html->link(__('Destroy'), array('#'), array('class'=>'ButtonLink', 'onclick'=>"return destroy({$destroy_info});"));
                ?>
            </td>
	</tr>
    <?php 
    endforeach; 
    }else{
        echo $this->Display->empty_table_data();
    }
    ?>
</table>

<p>
<?php
$this->Paginator->options(array('url' => $this->passedArgs));

echo $this->Paginator->counter(array(
'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
));
?>	
</p>
<?php if($current_page > '1'){ ?>
<div class="paging">
<?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
?>
</div>
<?php } ?>

<script>
    function filter_sub_cate(cate_id){
        var options = <?php echo json_encode($productSubCategories); ?>;
        var inner_html = '<option value="">Please select sub category</option>';
        
        if(cate_id in options){
            options = options[cate_id];
            for (var k in options){
                inner_html += '<option value="' + k + '">' + options[k] + '</option>';
            };
        }
        
        document.getElementById('sub_cate').innerHTML = inner_html;
    }
    
    function destroy(product_info){
        var destroy_qty = document.getElementById(product_info.product_id).value;
        
        if(destroy_qty == 0 || destroy_qty == ''){
            alert('Please input destroy qty');
            return false;
        }
        
        var r = confirm('Confirm destroy ' + product_info.product_name + ' : ' + destroy_qty + ' ' + product_info.unit);
        if (r == true) {
            window.location.href = '/Destroy/destroy/' + product_info.product_id + '/' + destroy_qty;
        }else{
            return false;
        }
    }
</script>


