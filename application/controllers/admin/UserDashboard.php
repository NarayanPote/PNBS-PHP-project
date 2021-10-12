<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserDashboard extends CI_Controller {

	public function __construct(){
        parent::__construct();
       // check_login_user();
        $this->load->model('common_model');
    }

    
    public function index(){
        $data = array();
        $data['page_title'] = 'UserDashboard';
        $data['count'] = $this->common_model->get_user_total();
        $data['main_content'] = $this->load->view('admin/userhome', $data, TRUE);
        $this->load->view('admin/index', $data);
    }
      
    public function backup($fileName='db_backup.zip'){
        $this->load->dbutil();
        $backup =& $this->dbutil->backup();
        $this->load->helper('file');
        write_file(FCPATH.'/downloads/'.$fileName, $backup);
        $this->load->helper('download');
        force_download($fileName, $backup);
    }

}