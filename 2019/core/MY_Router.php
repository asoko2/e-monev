<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
    Extended the core Router class to allow for sub-sub-folders in the controllers directory.
*/
class MY_Router extends CI_Router {

    function __construct()
    {
        parent::__construct();
    }

}

/* End of file MY_Router.php */
/* Location: ./application/core/MY_Router.php */