<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Profiler extends CI_Profiler
{

    public function __construct($config = array())
    {
        parent::__construct($config);
    }

    
    public function run()
    {
        $output = '<div id="codeigniter_profiler" style="clear:both;background-color:#fff;padding:10px;margin-left: 70px;">';
        $fields_displayed = 0;

        foreach ($this->_available_sections as $section)
        {
            if ($this->_compile_{$section} !== FALSE)
            {
                $func = '_compile_'.$section;
                $output .= $this->{$func}();
                $fields_displayed++;
            }
        }

        if ($fields_displayed === 0)
        {
            $output .= '<p style="border:1px solid #5a0099;padding:10px;margin:20px 0;background-color:#eee;">'
                .$this->CI->lang->line('profiler_no_profiles').'</p>';
        }

        return $output.'</div>';
    }
}

/* End of file MY_Profiler.php */
/* Location: ./application/core/MY_Profiler.php */
