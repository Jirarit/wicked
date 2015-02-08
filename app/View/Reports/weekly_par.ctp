<h1><?php echo __('Weekly Par'); ?></h1>
<fieldset>
    <?php 
    echo $this->Form->create('Report',array('url'=>"/Reports/weekly_par"));
    echo __('Request Date');
    echo "&nbsp; &nbsp;";
    echo $this->Form->input('from_date' , array('id'=>'from', 'div'=>FALSE, 'label'=>FALSE, 'type'=>'text', 'class'=>'datepicker', 'onchange'=>'change_from();'));
    echo "&nbsp;To&nbsp;";
    echo $this->Form->input('to_date' , array('id'=>'to', 'div'=>FALSE, 'label'=>FALSE, 'type'=>'text', 'class'=>'datepicker'));
    echo "&nbsp;";
    echo $this->Form->submit('Search', array('div'=>FALSE, 'class'=>'ButtonSearch'));
    ?>
</fieldset>

<?php if(isset($dates)){ $types = array("I"=>"เข้า", "O"=>"ออก", "D"=>"ทิ้ง/เสีย"); ?>

<table class="TableReport">
    <tr>
        <th rowspan="2"><?php echo __("No"); ?></th>
        <th rowspan="2" style="width: 110px;"><?php echo __("Code"); ?></th>
        <th rowspan="2"><?php echo __("Description"); ?></th>
        <th rowspan="2"><?php echo __("Unit"); ?></th>
        <th rowspan="2" style="width: 25px;"><?php echo __("Par Stock"); ?></th>
        <th rowspan="2" style="width: 20px;"><?php echo __("เหลือ"); ?></th>
        <?php foreach($dates as $date){ ?>
        <th colspan="3" style="width: 60px;"><?php echo displayDate($date); ?></th>
        <th rowspan="2" style="width: 20px;"><?php echo __("เหลือ"); ?></th>
        <?php } ?>
    </tr>
    <tr>
        <?php foreach($dates as $date){ ?>
        <?php foreach($types as $type){ ?>
        <th style="width: 20px;"><?php echo __($type); ?></th>
        <?php }} ?>
    </tr>

    <?php
    $cur_cate = "";
    $line = 1;
    foreach($products as $product){
        $product_id = $product['Product']['id'];
        $product_no = $product['Product']['product_no'];
        $product_name = $product['Product']['product_name'];
        $unit = $product['Unit']['name'];
        $par = number_format($product['Product']['par_stock'], 0);
        $cate = $product['ProductCategory']['name'];
        $bal = isset($balance[$product_id]) ? displayQty($balance[$product_id]) : "0";
        if($cur_cate != $cate){
            $line = 1;
            $cur_cate = $cate;
            echo '<tr><td colspan="100%">' . $cate . '</td></tr>';
        }
    ?>
    <tr>
        <td><?php echo $line++; ?></td>
        <td><?php echo $product_no ?></td>
        <td><?php echo $product_name ?></td>
        <td><?php echo $unit; ?></td>
        <td style="text-align: center;"><?php echo $par; ?></td>
        <td style="text-align: center;"><?php echo $bal; ?></td>
        <?php foreach($dates as $date){ ?>
        <?php foreach($types as $type => $v){if(isset($movements[$product_id][$date][$type]))$bal += $movements[$product_id][$date][$type]; ?>
        <td style="text-align: center;"><?php echo displayQty(@$movements[$product_id][$date][$type]); ?></td>
        <?php } ?>
        <td style="text-align: center;"><?php echo displayQty($bal) ?></td>
        <?php } ?>
    </tr>
    <?php } ?>
</table>
<?php } ?>

<?php 
function displayDate($iso_date){
    $result = date("D d/m", strtotime($iso_date));
    return $result;
}

function displayQty($qty){
    if($qty == number_format($qty, 0)){
        $qty = abs(number_format($qty, 0));
    }else{
        $qty = abs($qty);
    }
    return $qty == "0" ? "" : $qty;
}
?>


<script>
    function change_from(){
        var from = document.getElementById("from").value;
        var date = new Date(from);
        date.setDate(date.getDate() + 6);
        document.getElementById("to").value = date.toISOString().substr(0, 10);
    }
</script>

<style>
    table.TableReport{
        width: 100%;
        border-spacing: 0px;
        border-collapse: separate;
        border: black thin solid;
        font-size: 14px;
    }
    table.TableReport td, th{
        border: black thin solid;
    }
</style>