<h1><?php echo __('Products'); ?></h1>

<fieldset>
    <?php echo $this->Form->create('Product',array('url'=>"/Products/index/page:1")); ?>
    <table>
        <tr>
            <td><?php echo __('Product No/Name'); ?></td>
            <td><?php echo $this->Form->input('search' , array('div'=>FALSE, 'label'=>FALSE)); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Category'); ?></td>
            <td><?php echo $this->Form->input('product_category_id', array('label'=>FALSE, 'div'=>FALSE, 'id' => 'cate', 'onchange' => 'filter_sub_cate(this.value);', 'options'=>$productCategories, 'empty'=>__('Please select category'))); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Sub Category'); ?></td>
            <td><?php echo $this->Form->input('product_sub_category_id', array('label'=>FALSE, 'div'=>FALSE, 'id' => 'sub_cate', 'options'=>@$productSubCategories[$this->request->data['Product']['product_category_id']], 'empty'=>__('Please select sub category'))); ?></td>
        </tr>
    </table>
    <?php
    echo $this->Form->submit('Search', array('div'=>FALSE, 'class'=>'ButtonSearch'));
    ?>
</fieldset>
<?php echo $this->Html->link(__('Create New Product'), array('controller' => 'Products', 'action' => 'add'), array('class'=>'ButtonLinkAdd')); ?>
<br><br>

<?php 
    $current_page = $this->Paginator->counter(array('format' => __('{:pages}'))); 
    $start_rec = $this->Paginator->counter(array('format' => __('{:start}')));
?>
<table class="TableIndex">
    <tr>
        <th class="index">#</th>
        <th><?php echo $this->Paginator->sort('product_no'); ?></th>
        <th><?php echo $this->Paginator->sort('product_name'); ?></th>
        <th><?php echo $this->Paginator->sort('product_category_id', 'Category'); ?></th>
        <th><?php echo $this->Paginator->sort('product_sub_category_id', 'Sub Category'); ?></th>
        <th class="datetime"><?php echo $this->Paginator->sort('modified'); ?></th>
        <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php 
    if(!empty($products)){
    foreach ($products as $k => $product): 
        $cate_id = $product['Product']['product_category_id'];
        $sub_cate_id = $product['Product']['product_sub_category_id'];
    ?>
	<tr>
            <td class="index"><?php echo $start_rec++; ?></td>
            <td><?php echo h($product['Product']['product_no']); ?>&nbsp;</td>
            <td><?php echo h($product['Product']['product_name']); ?>&nbsp;</td>
            <td><?php echo h(@$productCategories[$cate_id]); ?>&nbsp;</td>
            <td><?php echo h(@$productSubCategories[$cate_id][$sub_cate_id]); ?>&nbsp;</td>
            <td class="datetime"><?php echo h($product['Product']['modified']); ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->link(__('View'), array('action' => 'view', $product['Product']['id']), array('class'=>'ButtonLinkDetail')); ?>
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $product['Product']['id']), array('class'=>'ButtonLinkEdit')); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $product['Product']['id']), array('class'=>'ButtonLinkDelete'), __('Are you sure you want to delete %s?', $product['Product']['product_name'])); ?>
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
</script>
