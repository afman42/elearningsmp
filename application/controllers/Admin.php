<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		if ($this->session->userdata('login') != TRUE) {
   			echo "<script type='text/javascript'>alert('Harap Login Terlebih dahulu');window.location.href='".site_url('utama/login')."'</script>";
		}
		$this->load->model('Admin_model');
		$this->load->model('Mapel_model');
		$this->load->model('Kelas_model');
		$this->load->model('Mapel_kelas_model');
		$this->load->model('Kelas_siswa_model');
	}

    public function index()
	{
		$data['pengajar'] = $this->Admin_model->hitung_pengajar()->result();
		$data['siswa'] = $this->Admin_model->hitung_siswa()->result();
		$data['kelas'] = $this->Admin_model->hitung_kelas()->result();
		$data['header'] = 'E-elearning - Admin';
		$this->load->view('template/header',$data);
		$this->load->view('admin/beranda',$data);
		$this->load->view('template/footer');
	}

	//Pengajar
	public function pengajar()
	{
		$data['header'] = 'E-elearning - Pengajar';
		$data['pengajar'] = $this->Admin_model->pengajar_not_in()->result();
		$this->load->view('template/header',$data);
		$this->load->view('admin/pengajar');
		$this->load->view('template/footer');
	}

	public function tambah_pengajar()
	{
		$this->form_validation->set_rules('nip', 'Nip', 'is_unique[pengajar.nip]', [
			'is_unique' => "Nip nya sudah ada Silakan Cari Lain"
		]);
		$this->form_validation->set_rules('email', 'Email', 'is_unique[user.email]', [
			'is_unique' => "Email nya sudah ada Silakan Cari Lain",
			// 'email' => "Email Valid"
		]);
		if ($this->form_validation->run() == false) {
			$data['header'] = 'E-elearning - Tambah Pengajar';
			$this->load->view('template/header',$data);
			$this->load->view('admin/tambah_pengajar');
			$this->load->view('template/footer');
		} else {
			$this->insert_pengajar();
		}
	}

	public function edit_pengajar($id)
	{
		$data['header'] = 'E-elearning - Edit Pengajar';
		$data['pengajar'] = $this->db->get_where('pengajar',['id' => $id])->row();
		$data['user'] = $this->db->get_where('user',['is_pengajar' => $id])->row();
		$this->load->view('template/header',$data);
		$this->load->view('admin/edit_pengajar');
		$this->load->view('template/footer');
	}

	public function insert_pengajar()
	{
		$post = $this->input->post();
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 1024;
		
		$this->upload->initialize($config);
			if ($this->upload->do_upload('foto')){
				$upload_data = $this->upload->data();
				$featured_image = $upload_data['file_name'];
				$data = [
					'nip' => $post['nip'],
					'nama' => $post['nama'],
					'tempat_lahir' => $post['tempat_lahir'],
					'tgl_lahir' => $post['tgl_lahir'],
					'foto' => 'uploads/'.$featured_image,
					'jk' => $post['jk'],
					'alamat' => $post['alamat'],
				];
			$this->Admin_model->tambah_pengajar($data);
				$data_user = [
					'email' => $post['email'],
					'password' => md5('pengajar123'),
					'is_pengajar' => $this->db->insert_id(),
					'level' => 2
				];
			$this->Admin_model->tambah_user($data_user);
			$this->session->set_flashdata('success','Berhasil Tambah Akun Pengajar');
			redirect(site_url('admin/pengajar'));
		}else{
			$data['header'] = 'E-elearning - Tambah Pengajar';
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('template/header',$data);
			$this->load->view('admin/tambah_pengajar',$error);
			$this->load->view('template/footer');
		}
	}

	public function update_pengajar($id)
	{
		$post = $this->input->post();
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 1024;
		
		$this->upload->initialize($config);
			if ($this->upload->do_upload('foto')){
				$upload_data = $this->upload->data();
				$featured_image = $upload_data['file_name'];
				$data = [
					'nip' => $post['nip'],
					'nama' => $post['nama'],
					'tempat_lahir' => $post['tempat_lahir'],
					'tgl_lahir' => $post['tgl_lahir'],
					'foto' => 'uploads/'.$featured_image,
					'jk' => $post['jk'],
					'alamat' => $post['alamat'],
				];
				$data_user = [
					'email' => $post['email'],
				];
			$this->Admin_model->update_pengajar($id,$data,$data_user);
			$this->session->set_flashdata('success','Berhasil Update Akun Pengajar');
			redirect(site_url('admin/pengajar'));
		}elseif (!$this->upload->do_upload('foto')) {
			$data = [
				'nip' => $post['nip'],
				'nama' => $post['nama'],
				'tempat_lahir' => $post['tempat_lahir'],
				'tgl_lahir' => $post['tgl_lahir'],
				'jk' => $post['jk'],
				'alamat' => $post['alamat'],
			];
			$data_user = [
					'email' => $post['email'],
				];
			$this->Admin_model->update_pengajar($id,$data,$data_user);
			$this->session->set_flashdata('success','Berhasil Update Akun Pengajar');
			redirect(site_url('admin/pengajar'));
		}else{
			$data['header'] = 'E-elearning - Edit Pengajar';
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('template/header',$data);
			$this->load->view('admin/tambah_pengajar',$error);
			$this->load->view('template/footer');
		}
	}

	public function hapus_pengajar($id)
	{
		$model = $this->db->get_where('pengajar',['id' => $id])->row();
		if ($model != null) {
			unlink($model->foto);
			$this->Admin_model->hapus_pengajar($model->id);
			$this->session->set_flashdata('success','Berhasil Hapus Akun Pengajar');
			redirect(site_url('admin/pengajar'));
		}else{
			$this->session->set_flashdata('success','Gagal Hapus Akun Pengajar');
			redirect(site_url('admin/pengajar'));
		}
	}

	//Siswa
	public function siswa()
	{
		$data['header'] = 'E-elearning - Siswa';
		$data['siswa'] = $this->Admin_model->siswa()->result();
		$this->load->view('template/header',$data);
		$this->load->view('admin/siswa');
		$this->load->view('template/footer');
	}

	public function tambah_siswa()
	{
		$this->form_validation->set_rules('nip', 'Nip', 'is_unique[siswa.nis]', [
			'is_unique' => "Nis nya sudah ada Silakan Cari Lain"
		]);
		$this->form_validation->set_rules('email', 'Email', 'is_unique[user.email]', [
			'is_unique' => "Email nya sudah ada Silakan Cari Lain",
			// 'email' => "Email Valid"
		]);
		if ($this->form_validation->run() == false) {
			$data['header'] = 'E-elearning - Tambah Siswa';
			$this->load->view('template/header',$data);
			$this->load->view('admin/tambah_siswa');
			$this->load->view('template/footer');
		} else {
			$this->insert_siswa();
		}
	}

	public function edit_siswa($id)
	{
		$data['header'] = 'E-elearning - Edit user';
		$data['siswa'] = $this->db->get_where('siswa',['id' => $id])->row();
		$data['user'] = $this->db->get_where('user',['is_siswa' => $id])->row();
		$this->load->view('template/header',$data);
		$this->load->view('admin/edit_siswa',$data);
		$this->load->view('template/footer');
	}

	public function insert_siswa()
	{
		$post = $this->input->post();
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 1024;
		
		$this->upload->initialize($config);
			if ($this->upload->do_upload('foto')){
				$upload_data = $this->upload->data();
				$featured_image = $upload_data['file_name'];
				$data = [
					'nis' => $post['nis'],
					'nama' => $post['nama'],
					'tempat_lahir' => $post['tempat_lahir'],
					'tgl_lahir' => $post['tgl_lahir'],
					'foto' => 'uploads/'.$featured_image,
					'agama' => $post['agama'],
					'jk' => $post['jk'],
					'alamat' => $post['alamat'],
					'tahun_masuk' => $post['tahun_masuk'],
				];
			$this->Admin_model->tambah_siswa($data);
				$data_user = [
					'email' => $post['email'],
					'password' => md5('siswa123'),
					'is_siswa' => $this->db->insert_id(),
					'level' => 3
				];
			$this->Admin_model->tambah_user($data_user);
			$this->session->set_flashdata('success','Berhasil Tambah Akun User');
			redirect(site_url('admin/siswa'));
		}else{
			$data['header'] = 'E-elearning - Tambah Siswa';
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('template/header',$data);
			$this->load->view('admin/tambah_siswa',$error);
			$this->load->view('template/footer');
		}
	}

	public function update_siswa($id)
	{
		$post = $this->input->post();
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 1024;
		
		$this->upload->initialize($config);
			if ($this->upload->do_upload('foto')){
				$upload_data = $this->upload->data();
				$featured_image = $upload_data['file_name'];
				$data = [
					'nis' => $post['nis'],
					'nama' => $post['nama'],
					'tempat_lahir' => $post['tempat_lahir'],
					'tgl_lahir' => $post['tgl_lahir'],
					'foto' => 'uploads/'.$featured_image,
					'agama' => $post['agama'],
					'jk' => $post['jk'],
					'alamat' => $post['alamat'],
					'tahun_masuk' => $post['tahun_masuk'],
				];
				$data_user = [
					'email' => $post['email'],
				];
			$this->Admin_model->update_siswa($id,$data,$data_user);
			$this->session->set_flashdata('success','Berhasil Update Akun User');
			redirect(site_url('admin/siswa'));
		}elseif (!$this->upload->do_upload('foto')) {
			$data = [
				'nis' => $post['nis'],
				'nama' => $post['nama'],
				'tempat_lahir' => $post['tempat_lahir'],
				'tgl_lahir' => $post['tgl_lahir'],
				'agama' => $post['agama'],
				'jk' => $post['jk'],
				'alamat' => $post['alamat'],
				'tahun_masuk' => $post['tahun_masuk'],
			];
			$data_user = [
					'email' => $post['email'],
				];
			$this->Admin_model->update_siswa($id,$data,$data_user);
			$this->session->set_flashdata('success','Berhasil Update Akun User');
			redirect(site_url('admin/siswa'));
		}else{
			$data['header'] = 'E-elearning - Edit User';
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('template/header',$data);
			$this->load->view('admin/edit_siswa',$error);
			$this->load->view('template/footer');
		}
	}

	public function hapus_siswa($id)
	{
		$model = $this->db->get_where('siswa',['id' => $id])->row();
		if ($model != null) {
			unlink($model->foto);
			$this->Admin_model->hapus_siswa($model->id);
			$this->session->set_flashdata('success','Berhasil Hapus Akun Siswa');
			redirect(site_url('admin/siswa'));
		}else{
			$this->session->set_flashdata('success','Gagal Hapus Akun Siswa');
			redirect(site_url('admin/siswa'));
		}
	}

	//Mapel
	public function mapel()
	{
		$data['header'] = 'E-elearning - Siswa';
		$data['mapel'] = $this->Mapel_model->mapel()->result();
		$this->load->view('template/header',$data);
		$this->load->view('admin/mapel',$data);
		$this->load->view('template/footer');
	}

	public function tambah_mapel()
	{
		$data['header'] = 'E-elearning - Tambah Mapel';
		$this->load->view('template/header',$data);
		$this->load->view('admin/tambah_mapel');
		$this->load->view('template/footer');
	}

	public function edit_mapel($id)
	{
		$data['header'] = 'E-elearning - Edit Mapel';
		$data['mapel'] = $this->db->get_where('mapel',['id' => $id])->row();
		$this->load->view('template/header',$data);
		$this->load->view('admin/edit_mapel',$data);
		$this->load->view('template/footer');
	}

	public function insert_mapel()
	{
		$post = $this->input->post();
		
		$data = [
				'nama' => $post['nama'],	
			];
		$this->Mapel_model->tambah_mapel($data);
		
		$this->session->set_flashdata('success','Berhasil Tambah Mapel');
		redirect(site_url('admin/mapel'));
	}

	public function update_mapel($id)
	{
		$post = $this->input->post();
		$data = [
			'nama' => $post['nama'],			
		];
		
		$this->Mapel_model->update_mapel($id,$data);
		
		$this->session->set_flashdata('success','Gagal Update Mapel');
		redirect(site_url('admin/mapel'));
	}

	public function hapus_mapel($id)
	{
		$model = $this->db->get_where('mapel',['id' => $id])->row();
		if ($model != null) {
			$this->Mapel_model->hapus_mapel($model->id);
			$this->session->set_flashdata('success','Berhasil Hapus Mapel');
			redirect(site_url('admin/mapel'));
		}else{
			$this->session->set_flashdata('success','Gagal Hapus Mapel');
			redirect(site_url('admin/mapel'));
		}
	}

	//Mapel Ajar
	public function mapel_ajar()
	{
		$data['header'] = 'E-elearning - Mapel Ajar';
		$data['mapel_ajar'] = $this->Mapel_kelas_model->mapel_ajar()->result();
		$this->load->view('template/header',$data);
		$this->load->view('admin/mapel_ajar',$data);
		$this->load->view('template/footer');
	}

	public function tambah_mapel_ajar()
	{
		$data['header'] = 'E-elearning - Tambah Mapel Ajar';
		$data['mapel'] = $this->Mapel_model->mapel()->result();
		$data['kelas'] = $this->Kelas_model->kelas()->result();
		$data['pengajar'] = $this->Kelas_model->pengajar()->result();
		$this->load->view('template/header',$data);
		$this->load->view('admin/tambah_mapel_ajar',$data);
		$this->load->view('template/footer');
	}

	public function edit_mapel_ajar($id)
	{
		$data['header'] = 'E-elearning - Edit Mapel Ajar';
		$data['mapel_ajar'] = $this->db->get_where('mapel_kelas',['id' => $id])->row();
		$data['mapel'] = $this->Mapel_model->mapel()->result();
		$data['kelas'] = $this->Kelas_model->kelas()->result();
		$data['pengajar'] = $this->Kelas_model->pengajar()->result();
		$this->load->view('template/header',$data);
		$this->load->view('admin/edit_mapel_ajar',$data);
		$this->load->view('template/footer');
	}

	public function insert_mapel_ajar()
	{
		$post = $this->input->post();
		
		$data = [
				'kelas_id' => $post['kelas_id'],	
				'mapel_id' => $post['mapel_id'],
				'pengajar_id' => $post['pengajar_id'],
				'hari' => $post['hari'],	
			];
		$this->Mapel_kelas_model->tambah_mapel_ajar($data);
		
		$this->session->set_flashdata('success','Berhasil Tambah Mapel Ajar');
		redirect(site_url('admin/mapel_ajar'));
	}

	public function update_mapel_ajar($id)
	{
		$post = $this->input->post();
		$data = [
			'kelas_id' => $post['kelas_id'],	
			'mapel_id' => $post['mapel_id'],
			'pengajar_id' => $post['pengajar_id'],
			'hari' => $post['hari'],
		];
		
		$this->Mapel_kelas_model->update_mapel_ajar($id,$data);
		
		$this->session->set_flashdata('success','Berhasil Update Mapel Ajar');
		redirect(site_url('admin/mapel_ajar'));
	}

	public function hapus_mapel_ajar($id)
	{
		$model = $this->db->get_where('mapel_kelas',['id' => $id])->row();
		if ($model != null) {
			$this->Mapel_kelas_model->hapus_mapel_ajar($model->id);
			$this->session->set_flashdata('success','Berhasil Hapus Mapel Ajar');
			redirect(site_url('admin/mapel_ajar'));
		}else{
			$this->session->set_flashdata('success','Gagal Hapus Mapel Ajar');
			redirect(site_url('admin/mapel_ajar'));
		}
	}

	//Kelas
	public function kelas()
	{
		$data['header'] = 'E-elearning - Kelas';
		$data['kelas'] = $this->Kelas_model->kelas()->result();
		$this->load->view('template/header',$data);
		$this->load->view('admin/kelas',$data);
		$this->load->view('template/footer');
	}

	public function tambah_kelas()
	{
		$data['header'] = 'E-elearning - Tambah Kelas';
		$this->load->view('template/header',$data);
		$this->load->view('admin/tambah_kelas');
		$this->load->view('template/footer');
	}

	public function edit_kelas($id)
	{
		$data['header'] = 'E-elearning - Edit Kelas';
		$data['kelas'] = $this->db->get_where('kelas',['id' => $id])->row();
		$this->load->view('template/header',$data);
		$this->load->view('admin/edit_kelas',$data);
		$this->load->view('template/footer');
	}

	public function insert_kelas()
	{
		$post = $this->input->post();
		
		$data = [
				'nama' => $post['nama'],	
			];
		$this->Kelas_model->tambah_kelas($data);
		
		$this->session->set_flashdata('success','Berhasil Tambah Kelas');
		redirect(site_url('admin/kelas'));
	}

	public function update_kelas($id)
	{
		$post = $this->input->post();
		$data = [
			'nama' => $post['nama'],			
		];
		
		$this->Kelas_model->update_kelas($id,$data);
		
		$this->session->set_flashdata('success','Berhasil Update Kelas');
		redirect(site_url('admin/kelas'));
	}

	public function hapus_kelas($id)
	{
		$model = $this->db->get_where('kelas',['id' => $id])->row();
		if ($model != null) {
			$this->Kelas_model->hapus_kelas($model->id);
			$this->session->set_flashdata('success','Berhasil Hapus Kelas');
			redirect(site_url('admin/kelas'));
		}else{
			$this->session->set_flashdata('success','Gagal Hapus Kelas');
			redirect(site_url('admin/kelas'));
		}
	}

	//Kelas - Siswa
	public function kelas_siswa()
	{
		$data['header'] = 'E-elearning - Kelas Siswa';
		$data['kelas_siswa'] = $this->Kelas_siswa_model->kelas_siswa()->result();
		$this->load->view('template/header',$data);
		$this->load->view('admin/kelas_siswa',$data);
		$this->load->view('template/footer');
	}

	public function tambah_kelas_siswa()
	{
		$data['header'] = 'E-elearning - Tambah Kelas Siswa';
		$data['kelas'] = $this->Kelas_model->kelas()->result();
		$data['siswa'] = $this->Admin_model->siswa()->result();
		$this->load->view('template/header',$data);
		$this->load->view('admin/tambah_kelas_siswa',$data);
		$this->load->view('template/footer');
	}

	public function edit_kelas_siswa($id)
	{
		$data['header'] = 'E-elearning - Edit Kelas Siswa';
		$data['kelas_siswa'] = $this->db->get_where('kelas_siswa',['id' => $id])->row();
		$data['kelas'] = $this->Kelas_model->kelas()->result();
		$data['siswa'] = $this->Admin_model->siswa()->result();
		$this->load->view('template/header',$data);
		$this->load->view('admin/edit_kelas_siswa',$data);
		$this->load->view('template/footer');
	}

	public function insert_kelas_siswa()
	{
		$post = $this->input->post();
		
		$data = [
				'siswa_id' => $post['siswa_id'],	
				'kelas_id' => $post['kelas_id'],	
			];
		$this->Kelas_siswa_model->tambah_kelas_siswa($data);
		
		$this->session->set_flashdata('success','Berhasil Tambah Kelas Siswa');
		redirect(site_url('admin/kelas_siswa'));
	}

	public function update_kelas_siswa($id)
	{
		$post = $this->input->post();
		$data = [
			'siswa_id' => $post['siswa_id'],	
			'kelas_id' => $post['kelas_id'],
		];
		
		$this->Kelas_siswa_model->update_kelas_siswa($id,$data);
		
		$this->session->set_flashdata('success','Berhasil Update Kelas Siswa');
		redirect(site_url('admin/kelas_siswa'));
	}

	public function hapus_kelas_siswa($id)
	{
		$model = $this->db->get_where('kelas_siswa',['id' => $id])->row();
		if ($model != null) {
			$this->Kelas_siswa_model->hapus_kelas_siswa($model->id);
			$this->session->set_flashdata('success','Berhasil Hapus Kelas Siswa');
			redirect(site_url('admin/kelas_siswa'));
		}else{
			$this->session->set_flashdata('success','Gagal Hapus Kelas Siswa');
			redirect(site_url('admin/kelas_siswa'));
		}
	}

	//Ubah Profil
	public function ubah_profil()
	{
		$data['header'] = 'E-elearning - Ubah Profil Admin';
		$data['admin'] = $this->db->get_where('user',['is_pengajar' => $this->session->id_pengajar])->row();
		$data['pengajar'] = $this->db->get_where('pengajar',['id' => $this->session->id_pengajar ])->row();
		$this->load->view('template/header',$data);
		$this->load->view('admin/ubah_profil',$data);
		$this->load->view('template/footer');
	}

	public function update_ubah_profil($id)
	{
		$post = $this->input->post();
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 1024;
		
		$this->upload->initialize($config);
			if ($this->upload->do_upload('foto')){
				$upload_data = $this->upload->data();
				$featured_image = $upload_data['file_name'];
				$data = [
					'nip' => $post['nip'],
					'nama' => $post['nama'],
					'tempat_lahir' => $post['tempat_lahir'],
					'tgl_lahir' => $post['tgl_lahir'],
					'foto' => 'uploads/'.$featured_image,
					'jk' => $post['jk'],
					'alamat' => $post['alamat'],
				];
				$data_user = [
					'email' => $post['email'],
					'password' => md5($post['password']),
				];
			$this->Admin_model->update_pengajar($id,$data,$data_user);
			$this->session->set_flashdata('success','Berhasil Update Ubah Profil');
			redirect(site_url('admin/ubah_profil'));
		}elseif (!$this->upload->do_upload('foto')) {
			$data = [
				'nip' => $post['nip'],
				'nama' => $post['nama'],
				'tempat_lahir' => $post['tempat_lahir'],
				'tgl_lahir' => $post['tgl_lahir'],
				'jk' => $post['jk'],
				'alamat' => $post['alamat'],
			];
			$data_user = [
					'email' => $post['email'],
					'password' => md5($post['password']),
				];
			$this->Admin_model->update_pengajar($id,$data,$data_user);
			$this->session->set_flashdata('success','Berhasil Update Ubah Profil');
			redirect(site_url('admin/ubah_profil'));
		}else{
			$data['header'] = 'E-elearning - Edit Ubah Profil';
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('template/header',$data);
			$this->load->view('admin/ubah_profil',$error);
			$this->load->view('template/footer');
		}
	}
}