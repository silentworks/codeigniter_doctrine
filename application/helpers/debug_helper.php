<?php
if(!function_exists('print_pre'))
{
    function print_pre($data, $exit = FALSE)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";

        if($exit) die;
    }
}
/* End of file debug_helper.php */
/* Location: ./application/helpers/debug_helper.php */