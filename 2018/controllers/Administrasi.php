<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Administrasi extends Admin_Controller {

    public function user()
    {
        $this->load->helper('xcrud');
        $tahun = $this->session->userdata('tahun');           
        $xcrud = xcrud_get_instance();
        $xcrud->table('auth_users');
        $xcrud->table_name('Data Master User');

        $xcrud->columns('username,email,unit,level');
        $xcrud->relation('unit','vv_subunit','id','nama');
        $xcrud->relation('level','auth_level','name','name');
        $xcrud->fields('username,email,unit,level,active', false, 'Informasi User');
        $xcrud->readonly('username,email', 'edit');
        $xcrud->label('username', 'Username');
        $xcrud->label('email', 'e-mail');
        $xcrud->label('unit', 'OPD');
        $xcrud->label('level', 'Akses Level');
        $xcrud->before_insert('hash_password');
        $xcrud->create_action('reset', 'reset_action');
        $xcrud->create_action('ban', 'ban_action'); // action callback, function ban_action() in functions.php
        $xcrud->create_action('unban', 'unban_action');
        $xcrud->button('#', 'Reset Password', 'fa fa-refresh', 'xcrud-action', 
            array(  // set action vars to the button
                'data-task' => 'action',
                'data-action' => 'reset',
                'data-username' => '{username}',
                'data-primary' => '{id}')
        );

        $xcrud->button('#', 'unban', 'fa fa-unlock', 'xcrud-action btn-success', 
                array(  // set action vars to the button
                    'data-task' => 'action',
                    'data-action' => 'unban',
                    'data-primary' => '{id}'), 
                array(  // set condition ( when button must be shown)
                    'active',
                    '!=',
                    '1')
        );
        $xcrud->button('#', 'ban', 'fa fa-lock', 'xcrud-action btn-warning', array(
            'data-task' => 'action',
            'data-action' => 'ban',
            'data-primary' => '{id}'), array(
            'active',
            '=',
            '1'));
        $xcrud->highlight_row('active', '<', 1, '#ff7700');

        
        $this->data['content'] = $xcrud->render();

        $this->data['judul'] = 'Update Profil';
        $this->render('administrasi/user');
    }

    public function grup()
    {
        $this->load->helper('xcrud');
                
        $xcrud = xcrud_get_instance();
        $xcrud->table('auth_level');
        $xcrud->table_name('Data Master Group');

        $xcrud->columns('name,description');
        $xcrud->fields('name,description', false, 'Data Master Group');

        
        $this->data['content'] = $xcrud->render();

        $this->data['judul'] = 'Update Profil';
        $this->render('administrasi/grup');
    }

    public function setup()
    {
        $this->load->helper('xcrud');
                
        $xcrud = xcrud_get_instance();
        $xcrud->table('app_config');
        $xcrud->table_name('SETUP APLIKASI');
        $xcrud->unset_add();
        $xcrud->unset_remove();
        $xcrud->unset_view();
        $this->data['kembali'] = base_url('administrasi/setup');
        $this->data['content'] = $xcrud->render('edit',1);

        $this->data['judul'] = 'SETUP APLIKASI';
        $this->render('administrasi/setup');
    }

    public function transfer()
    {
        $db2 = $this->load->database('d2017', TRUE);

        $users = $db2->get('v_ta_users')->result();

        foreach ($users as $u) {
            if ($u->grup == 'Operator') {
                $this->ion_auth->register($u->username, '12345678', $u->email, 
                ['level'=>strtolower($u->grup),'unit'=>($u->kode_opd)]);
            }
        }
    }


}

/* End of file Administrasi.php */
/* Location: ./application/controllers/Administrasi.php */
