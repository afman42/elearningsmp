<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utama extends CI_Controller {

	public function index()
	{
		redirect(site_url('utama/login'));
	}

	public function login()
	{
        $this->form_validation->set_rules('email', 'Email', 'required|trim|htmlspecialchars');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|htmlspecialchars');
		if ($this->form_validation->run() == FALSE)
	    {
			$this->load->view('home/login');
	    }else{   
        
            if($this->cek_login() == TRUE){
                
                $this->home();
            }
            else{
              $this->session->set_flashdata('error','Harap diisi Email dan password dengan benar');
              redirect(site_url('utama/login'));
            }
        }
	}

	protected function cek_login()
	{
		$this->load->model('Login_model','model');
		$email    = $this->input->post('email');
        $password = $this->input->post('password');
		$password_encrypt = md5($password);
        
        $query = $this->model->login($email,$password_encrypt);

        if( $query->num_rows() > 0 )
        {
            $row = $query->row(1);
            if($row->level == 1){
                $data = array(
                    'email'   => $row->email,
                    'level'   => $row->level,
                    'login'   => TRUE,
                    'id_pengajar' => $row->is_pengajar
                );
            }
            else if($row->level == 2){
                $pengajar = $this->model->cek_pengajar($row->is_pengajar)->row();
                $data = array(
                    'email'  => $row->email,
                    'level'  => $row->level,
                    'login'   => TRUE,
                    'id_pengajar' => $pengajar->id,
                );
            }
            else{
                $siswa = $this->model->cek_siswa($row->is_siswa)->row();
                $data = array(
                    'email'  => $row->email,
                    'login'   => TRUE,
                    'level'  => $row->level,
                    'id_siswa' => $siswa->id,
                    'is_siswa' => $row->is_siswa,
                );
            }
            
            $this->session->set_userdata($data);
            return TRUE;
        }
        else{
            return FALSE;
        }
	}

	public function home()
    {
        $data['level'] = $this->session->userdata('level');
        $data['email'] = $this->session->userdata('email');
        if($data['level'] == 1){
            redirect(site_url('admin'));
        }
        else if($data['level'] == 2){
            redirect(site_url('pengajar'));
        }
        else{
            redirect(site_url('siswa'));
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url('utama/login'));
    }

    public function login_kedua()
    {
        $this->load->view('home/login_kedua');
    }
}