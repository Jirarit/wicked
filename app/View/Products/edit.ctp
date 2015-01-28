<h1><?php echo __('Products > Edit'); ?></h1>

<fieldset>
    <?php 
    echo $this->Form->create('Product');
    ?>
    <table class="TableView">
        <tr>
            <td><?php echo __('Product No'); ?></td>
            <td><?php echo $this->Form->input('product_no', array('label'=>FALSE, 'div'=>FALSE)); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Name'); ?></td>
            <td><?php echo $this->Form->input('product_name', array('label'=>FALSE, 'div'=>FALSE), 'required'); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Unit'); ?></td>
            <td><?php echo $this->Form->input('unit_id', array('label'=>FALSE, 'div'=>FALSE, 'options'=>$units, 'empty'=>__('Please select unit'), 'required')); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Category'); ?></td>
            <td><?php echo $this->Form->input('product_category_id', array('label'=>FALSE, 'div'=>FALSE, 'id' => 'cate', 'onchange' => 'filter_sub_cate(this.value);', 'options'=>$productCategories, 'empty'=>__('Please select category'), 'required')); ?></td>
        </tr>
        <tr>
            <td><?php echo __('Par Stock'); ?></td>
            <td><?php echo $this->Form->input('par_stock', array('label'=>FALSE, 'div'=>FALSE, 'default'=>0, 'style'=>'width:70px', 'required')); ?></td>
        </tr>
    </table>
<?php echo $this->Form->submit(__('Save'), array('class'=>'ButtonSave')); ?>
</fieldset>
<?php echo $this->Html->link(__('Back'), array('controller' => 'Products', 'action' => 'Index'), array('class'=>'ButtonLinkBack')); ?>

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
