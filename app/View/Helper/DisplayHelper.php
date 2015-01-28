<?php
/**
 * Description of DisplayHelper
 *
 * @author Win
 */
App::uses('HtmlHelper', 'View/Helper');
class DisplayHelper extends AppHelper{
    
    
    public function empty_table_data() {
        return "<tr><td colspan='100%' style='text-align:center;'>No data</td></tr>";
    }
}
