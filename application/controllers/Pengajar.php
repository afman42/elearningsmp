<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengajar extends CI_Controller {

	function __construct(){
		parent::__construct();
		if ($this->session->userdata('login') != TRUE) {
   			echo "<script type='text/javascript'>alert('Harap Login Terlebih dahulu');window.location.href='".site_url('utama/login')."'</script>";
		}
		$this->load->model('Ujian_model');
		$this->load->model('Kelas_model');
		$this->load->model('Soal_model');
		$this->load->model('Admin_model');
		$this->load->model('Mapel_model');
		$this->load->model('Jawaban_siswa_model');
		$this->load->model('Siswa_model');
		$this->load->model('Mapel_kelas_model');
		$this->load->model('File_model');
		$this->load->model('Pengumuman_model');
	}

    public function index()
	{
		$data['header'] = 'E-elearning - Pengajar';
		// $data['ujian'] = $this->Ujian_model->ujian_hitung($this->session->id_pengajar,$this->session->mapel_id'])result();
		// $data['kuis'] = $this->Ujian_model->ujian_kuis_hitung($this->session->id_pengajar,$this->session->mapel_id'])result();
		$data['pengajar'] = $this->db->get_where('pengajar',['id' => $this->session->id_pengajar])->row();
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/index',$data);
		$this->load->view('template/footer');
	}

	//Tugas
	public function tugas()
	{
		$data['header'] = 'E-elearning - Tugas';
		$data['kelas'] = $this->Ujian_model->kelas($this->session->id_pengajar)->result();
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/kelas',$data);
		$this->load->view('template/footer');
	}

	public function tugas_kelas($id)
	{
		$data['header'] = 'E-elearning - Tugas / Kelas';
		$data['kelas'] = $this->Ujian_model->kelas_mapel($this->session->id_pengajar,$id)->row(1);
		$data['ujian'] = $this->Ujian_model->ujian($this->session->id_pengajar,$id)->result();
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/kelas_siswa',$data);
		$this->load->view('template/footer');
		// var_dump($data['ujian']);
	}

	public function tambah_tugas_kelas($id)
	{
		$data['header'] = 'E-elearning - Tugas / Kelas';
		$data['kelas'] = $this->Ujian_model->kelas_mapel($this->session->id_pengajar,$id)->row(1);
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/tambah_ujian_kelas',$data);
		$this->load->view('template/footer');
	}

	public function insert_tugas_siswa()
	{
		$post = $this->input->post();
		$data = [
			'judul' => $post['judul'],
			'waktu_pengerjaan' => $post['waktu_pengerjaan'],
			'mapel_kelas_id' => $post['mapel_kelas_id'],
			'pengajar_id' => $this->session->id_pengajar,
			'tgl_dibuat' => date('Y-m-d'),
			'terbit' => $post['terbit'],
		];
		$save = $this->Ujian_model->tambah_tugas($data);
		$mapel_kelas = $this->db->get_where('mapel_kelas',['id' => $post['mapel_kelas_id']])->row(1);
		// var_dump($mapel_kelas);
		if ($save) {
			$this->session->set_flashdata('success','Berhasil Tambah Tugas Siswa');
			redirect(site_url('pengajar/tugas_kelas/'.$mapel_kelas->mapel_id));
		} else {
			$this->session->set_flashdata('success','Gagal Tambah Tugas Siswa');
			redirect(site_url('pengajar/tugas_kelas/'.$mapel_kelas->mapel_id));
		}
	}

	public function edit_tugas_kelas($id)
	{
		$data['header'] = 'E-elearning - Tugas / Kelas';
		$data['ujian'] = $this->Ujian_model->cek_tugas($id)->row(1);
		$mapel_kelas = $this->db->get_where('mapel_kelas',['id' => $data['ujian']->mapel_kelas_id])->row();
		$data['kelas'] = $this->Ujian_model->kelas_mapel($this->session->id_pengajar,$mapel_kelas->mapel_id)->row(1);
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/edit_ujian_kelas',$data);
		$this->load->view('template/footer');
	}

	public function update_tugas_siswa($id)
	{
		$post = $this->input->post();
		$data = [
			'judul' => $post['judul'],
			'waktu_pengerjaan' => $post['waktu_pengerjaan'],
			'pengajar_id' => $this->session->id_pengajar,
			'tgl_dibuat' => date('Y-m-d'),
			'terbit' => $post['terbit'],
		];
		// var_dump($data);
		$this->Ujian_model->update_tugas($id,$data);
		$ujian = $this->Ujian_model->cek_tugas($id)->row(1);
		$mapel_kelas = $this->db->get_where('mapel_kelas',['id' => $ujian->mapel_kelas_id])->row();
		// var_dump($ujian);		
		$this->session->set_flashdata('success','Berhasil Update Tugas Siswa');
		redirect(site_url('pengajar/tugas_kelas/'.$mapel_kelas->mapel_id));
	}

	public function hapus_tugas_kelas($id)
	{
		$model = $this->Ujian_model->cek_tugas($id)->row();
		$kelas = $this->Ujian_model->kelas_mapel($model->pengajar_id,$id)->row(1);
		if ($model != null) {
			$this->Ujian_model->hapus_tugas($model->id);
			$this->session->set_flashdata('success','Berhasil Hapus Tugas Siswa');
			redirect(site_url('pengajar/tugas_kelas/'.$kelas->mapel_idd));
		}else{
			$this->session->set_flashdata('success','Gagal Hapus Tugas Siswa');
			redirect(site_url('pengajar/tugas_kelas/'.$kelas->mapel_idd));
		}
	}

	//Jawaban Siswa
	public function jawaban_siswa($id)
	{
		$data['header'] = 'E-elearning - Jawaban Siswa / Kelas';
		$topik_tugas = $this->db->get_where('topik_tugas',['id' => $id])->row();
		$mapel_kelas = $this->db->get_where('mapel_kelas',['id' => $topik_tugas->mapel_kelas_id])->row();
		$data['kelas'] = $this->Ujian_model->kelas_mapel($this->session->id_pengajar,$mapel_kelas->mapel_id)->row(1);
		$data['siswa'] = $this->Jawaban_siswa_model->tampil_siswa_jawaban_perkelas($data['kelas']->kelas_id,$data['kelas']->mapel_idd,$this->session->id_pengajar)->result();
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/jawaban_siswa',$data);
		$this->load->view('template/footer');
	}

	public function cek_jawaban_siswa()
	{
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		$data['header'] = 'E-elearning - Jawaban Siswa / Kelas';
		$data['siswa'] = $this->Siswa_model->cek_siswa($uri4)->row(1);
		$data['nilai_pilganda'] = $this->Jawaban_siswa_model->cek_jawaban_siswa_pilganda($uri4,$uri3)->result();
		$data['nilai_essay'] = $this->Jawaban_siswa_model->cek_jawaban_siswa_essay($uri4,$uri3)->result();
		$data['hitung_essay'] = $this->Jawaban_siswa_model->tampil_nilai_essay_persiswa($uri4,$uri3)->row(1);
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/cek_jawaban_siswa',$data);
		$this->load->view('template/footer');
		// var_dump($data['nilai_pilganda']);
		// var_dump($data['nilai_essay']);
	}

	public function nambah_nilai_essay()
	{
		$siswa_id = $_POST['siswa_id'];
		$mapel_kelas_id = $_POST['mapel_kelas_id'];
		$topik_tugas = $this->db->get_where('topik_tugas',['mapel_kelas_id' => $mapel_kelas_id])->row();
		$hitung_nilai_essay = $this->db->get_where('nilai_essay',['topik_tugas_id' => $topik_tugas->id ]);
		$tampil_id = $hitung_nilai_essay->row_array(1);
		if ($hitung_nilai_essay->num_rows() == 1) {
			$data = [
				'nilai' => $_POST['nilai'],
			];
			$this->Jawaban_siswa_model->update_siswa_essay($tampil_id['id'],$data);
			echo "<script>alert('Nilai Essay telah diupdate');window.location.href='".site_url('pengajar/cek_jawaban_siswa/'.$mapel_kelas_id.'/'.$siswa_id)."';</script>";			
		} else {
				$data = [
				'siswa_id' => $siswa_id,
				'nilai' => $_POST['nilai'],
				'topik_tugas_id' => $topik_tugas->id
			];

			$this->Jawaban_siswa_model->nambah_siswa_essay($data);
			echo "<script>alert('Nilai Essay telah disimpan');window.location.href='".site_url('pengajar/cek_jawaban_siswa/'.$mapel_kelas_id.'/'.$siswa_id)."';</script>";
		}
	}

	//File Materi
	public function file_materi()
	{
		$data['header'] = 'E-elearning - File Materi';
		$data['kelas'] = $this->Ujian_model->kelas($this->session->id_pengajar)->result();
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/file_materi',$data);
		$this->load->view('template/footer');
	}

	public function file_materi_kelas($id)
	{
		$data['header'] = 'E-elearning - File Materi Kelas';
		$data['kelas'] = $this->Ujian_model->kelas_mapel($this->session->id_pengajar,$id)->row(1);
		$data['file'] = $this->File_model->file_materi($this->session->id_pengajar,$id)->result();
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/file_materi_kelas',$data);
		$this->load->view('template/footer');
	}

	public function tambah_file_materi_kelas($id,$id_kelas)
	{
		$data['header'] = 'E-elearning - File Materi Kelas';
		$data['kelas'] = $this->Ujian_model->kelas_mapel($this->session->id_pengajar,$id)->row(1);
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/tambah_file_materi_kelas',$data);
		$this->load->view('template/footer');
	}

	public function insert_file_materi()
	{
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		$mapel_kelas = $this->db->get_where('mapel_kelas',['kelas_id' => $uri4, 'mapel_id' => $uri3])->row();
		$config['upload_path'] = './uploads/file/';
		$config['allowed_types'] = 'docx|doc|pptx|ppt|pdf';
		$config['max_size'] = 10240;
		
		$this->upload->initialize($config);
			if ($this->upload->do_upload('file')){
				$upload_data = $this->upload->data();
				$featured_image = $upload_data['file_name'];

				$data = [
					'mapel_kelas_id' => $mapel_kelas->id,
					'file' => 'uploads/file/'.$featured_image,
				];
			$save = $this->File_model->tambah_file($data);
			if ($save) {
				$this->session->set_flashdata('success','Berhasil Tambah File Materi');
				redirect(site_url('pengajar/file_materi_kelas/'.$uri3));
			} else {
				$this->session->set_flashdata('success','Gagal Tambah File Materi');
				redirect(site_url('pengajar/file_materi_kelas/'.$uri3));
			}
		}else{
			$data['error'] = $this->upload->display_errors();
			$data['header'] = 'E-elearning - File Materi Kelas';
			$data['kelas'] = $this->Ujian_model->kelas_mapel($this->session->id_pengajar,$uri3)->row(1);
			$this->load->view('template/header',$data);
			$this->load->view('pengajar/tambah_file_materi_kelas',$data);
			$this->load->view('template/footer');
		}
	}

	public function download_file_materi_kelas($id)
	{
		$this->load->helper('download');
		$cek_file = $this->db->get_where('file_materi',['id' => $id])->row();
		if ($cek_file) {
			force_download($cek_file->file, NULL);
		}
	}

	public function hapus_file_materi_kelas($id)
	{
		$cek_file = $this->db->get_where('file_materi',['id' => $id])->row();
		if ($cek_file) {
			unlink($cek_file->file);
			$this->File_model->hapus_file($id);
			$this->session->set_flashdata('success','Sukses Hapus File Materi');
			redirect(site_url('pengajar/file_materi_kelas/'.$id));
		}
	}

	//Pengumuman
	public function pengumuman()
	{
		$data['header'] = 'E-elearning - Pengumuman';
		$data['kelas'] = $this->Ujian_model->kelas($this->session->id_pengajar)->result();
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/pengumuman',$data);
		$this->load->view('template/footer');
	}

	public function pengumuman_kelas($id)
	{
		$data['header'] = 'E-elearning - Pengumuman Kelas';
		$mapel_kelas = $this->db->get_where('mapel_kelas',['id' => $id])->row();
		$_SESSION['mapel_ids'] = $id;
		$data['kelas'] = $this->Ujian_model->kelas_mapel($this->session->id_pengajar,$mapel_kelas->mapel_id)->row();
		$data['pengumuman'] = $this->Pengumuman_model->tampil_pengumuman()->result();
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/pengumuman_kelas',$data);
		$this->load->view('template/footer');
	}

	public function tambah_pengumuman_kelas($id)
	{
		$data['header'] = 'E-elearning - Tambah Pengumuman Kelas';
		$mapel_kelas = $this->db->get_where('mapel_kelas',['id' => $id])->row();
		$data['kelas'] = $this->Ujian_model->kelas_mapel($this->session->id_pengajar,$mapel_kelas->mapel_id)->row();
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/tambah_pengumuman_kelas',$data);
		$this->load->view('template/footer');
	}

	public function insert_pengumuman_kelas()
	{
		$uri3 = $this->uri->segment(3);
		$post = $this->input->post();
		$data = [
			'deskripsi' => $post['deskripsi'],
			'pengajar_id' => $this->session->id_pengajar,
			'mapel_kelas' => $uri3,
			'tgl_dibuat' => date("Y-m-d"),
			'tgl_berakhir' => $post['tgl_berakhir']
		];

		$save = $this->Pengumuman_model->tambah_pengumuman($data);
		if ($save) {
			$this->session->set_flashdata('success','Berhasil Tambah Pengumuman Materi');
			redirect(site_url('pengajar/pengumuman_kelas/'.$uri3));
		} else {
			$this->session->set_flashdata('success','Gagal Tambah Pengumuman Materi');
			redirect(site_url('pengajar/pengumuman_kelas/'.$uri3));
		}
	}

	public function edit_pengumuman_kelas($id)
	{
		$data['header'] = 'E-elearning - Edit Pengumuman Kelas';
		$mapel_kelas = $this->db->get_where('mapel_kelas',['id' => $id])->row();
		$data['kelas'] = $this->Ujian_model->kelas_mapel($this->session->id_pengajar,$mapel_kelas->mapel_id)->row();
		$data['pengumuman'] = $this->db->get_where('pengumuman',['id' => $id])->row();
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/edit_pengumuman_kelas',$data);
		$this->load->view('template/footer');
	}

	public function update_pengumuman_kelas()
	{
		$uri3 = $this->uri->segment(3);
		$post = $this->input->post();
		$data = [
			'deskripsi' => $post['deskripsi'],
			'tgl_berakhir' => $post['tgl_berakhir']
		];

		$this->Pengumuman_model->update_pengumuman($uri3,$data);
		$this->session->set_flashdata('success','Berhasil Update Pengumuman Materi');
		redirect(site_url('pengajar/pengumuman_kelas/'.$uri3));
	}

	public function hapus_pengumuman_kelas($id)
	{
		$model = $this->db->get_where('pengumuman',['id' => $id])->row();
		if ($model != null) {
			$this->Pengumuman_model->hapus_pengumuman($model->id);
			$this->session->set_flashdata('success','Berhasil Hapus Pengumuman Siswa');
			redirect(site_url('pengajar/pengumuman_kelas/'.$_SESSION['mapel_ids']));
		}else{
			$this->session->set_flashdata('success','Gagal Hapus Pengumuman Siswa');
			redirect(site_url('pengajar/pengumuman_kelas/'.$_SESSION['mapel_ids']));
		}
	}

	//Soal Pilganda
	public function soal_pilganda($id)
	{
		$data['header'] = 'E-elearning - Soal Pilganda / Kelas';
		$data['ujian'] = $this->Ujian_model->cek_tugas($id)->row(1);
		$mapel_kelas = $this->db->get_where('mapel_kelas',['id' => $data['ujian']->mapel_kelas_id])->row();
		$data['kelas'] = $this->Ujian_model->kelas_mapel($this->session->id_pengajar,$mapel_kelas->mapel_id)->row(1);
		$data['soal'] = $this->Soal_model->soal($id)->result();
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/soal_pilganda',$data);
		$this->load->view('template/footer');
	}

	public function tambah_soal_pilganda($id)
	{
		$data['header'] = 'E-elearning - Soal Pilganda / Siswa';
		$data['ujian'] = $this->Ujian_model->cek_tugas($id)->row(1);
		$mapel_kelas = $this->db->get_where('mapel_kelas',['id' => $data['ujian']->mapel_kelas_id])->row();
		$data['kelas'] = $this->Ujian_model->kelas_mapel($data['ujian']->pengajar_id,$mapel_kelas->mapel_id)->row(1);
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/tambah_soal_pilganda',$data);
		$this->load->view('template/footer');
	}

	public function insert_soal_pilganda($id)
	{
		$post = $this->input->post();
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 1024;
		
		$this->upload->initialize($config);
			if ($this->upload->do_upload('gambar')){
				$upload_data = $this->upload->data();
				$featured_image = $upload_data['file_name'];

				$data = [
					'pertanyaan' => $post['pertanyaan'],
					'pil_a' => $post['pil_a'],
					'pil_b' => $post['pil_b'],
					'pil_c' => $post['pil_c'],
					'pil_d' => $post['pil_d'],
					'kunci' => $post['kunci'],
					'topik_tugas_id' => $id,
					'gambar' => 'uploads/'.$featured_image,
				];
			$save = $this->Soal_model->tambah_soal_pilganda($data);
			if ($save) {
				$this->session->set_flashdata('success','Berhasil Tambah Soal Pilganda Siswa');
				redirect(site_url('pengajar/soal_pilganda/'.$id));
			} else {
				$this->session->set_flashdata('success','Gagal Tambah Soal Pilganda Siswa');
				redirect(site_url('pengajar/soal_pilganda/'.$id));
			}
		}elseif (!$this->upload->do_upload('foto')) {
			$data = [
				'pertanyaan' => $post['pertanyaan'],
				'pil_a' => $post['pil_a'],
				'pil_b' => $post['pil_b'],
				'pil_c' => $post['pil_c'],
				'pil_d' => $post['pil_d'],
				'kunci' => $post['kunci'],
				'topik_tugas_id' => $id,
			];
			
			$save = $this->Soal_model->tambah_soal_pilganda($data);
			if ($save) {
				$this->session->set_flashdata('success','Berhasil Tambah Soal Pilganda Siswa');
				redirect(site_url('pengajar/soal_pilganda/'.$id));
			} else {
				$this->session->set_flashdata('success','Gagal Tambah Soal Pilganda Siswa');
				redirect(site_url('pengajar/soal_pilganda/'.$id));
			}
		}else{
			$data['header'] = 'E-elearning - Tambah Soal Pilganda';
			$data['error'] = $this->upload->display_errors();
			$data['ujian'] = $this->Ujian_model->cek_tugas($id)->row(1);
			$data['kelas'] = $this->Ujian_model->kelas($data['ujian']->pengajar_id)->row(1);
			$this->load->view('template/header',$data);
			$this->load->view('pengajar/tambah_soal_pilganda',$data);
			$this->load->view('template/footer');
		}
	}

	public function edit_soal_pilganda($id)
	{
		$data['header'] = 'E-elearning - Tugas / Soal';
		$data['soal'] = $this->Soal_model->cek_soal_pilganda($id)->row(1);
		$data['ujian'] = $this->Ujian_model->cek_tugas($data['soal']->topik_tugas_id)->row(1);
		$mapel_kelas = $this->db->get_where('mapel_kelas',['id' => $data['ujian']->mapel_kelas_id])->row();
		$data['kelas'] = $this->Ujian_model->kelas_mapel($data['ujian']->pengajar_id,$mapel_kelas->mapel_id)->row(1);
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/edit_soal_pilganda',$data);
		$this->load->view('template/footer');
	}

	public function update_soal_pilganda($id)
	{
		$post = $this->input->post();
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 1024;
		
		$this->upload->initialize($config);
			if ($this->upload->do_upload('gambar')){
				$upload_data = $this->upload->data();
				$featured_image = $upload_data['file_name'];

				$data = [
					'pertanyaan' => $post['pertanyaan'],
					'pil_a' => $post['pil_a'],
					'pil_b' => $post['pil_b'],
					'pil_c' => $post['pil_c'],
					'pil_d' => $post['pil_d'],
					'kunci' => $post['kunci'],
					'gambar' => 'uploads/'.$featured_image,
				];
			$this->Soal_model->update_soal_pilganda($id,$data);
			$soal = $this->Soal_model->cek_soal_pilganda($id)->row(1);		
			$this->session->set_flashdata('success','Berhasil Update Soal Pilganda Siswa');
			redirect(site_url('pengajar/soal_pilganda/'.$soal->topik_tugas_id));
		}elseif (!$this->upload->do_upload('gambar')) {
			$data = [
				'pertanyaan' => $post['pertanyaan'],
				'pil_a' => $post['pil_a'],
				'pil_b' => $post['pil_b'],
				'pil_c' => $post['pil_c'],
				'pil_d' => $post['pil_d'],
				'kunci' => $post['kunci'],
			];
			
			$this->Soal_model->update_soal_pilganda($id,$data);
			$soal = $this->Soal_model->cek_soal_pilganda($id)->row(1);		
			$this->session->set_flashdata('success','Berhasil Update Soal Pilganda Siswa');
			redirect(site_url('pengajar/soal_pilganda/'.$soal->topik_tugas_id));
		}else{
			$data['header'] = 'E-elearning - Edit Soal Pilganda';
			$data['error'] = $this->upload->display_errors();
			$data['ujian'] = $this->Ujian_model->cek_tugas($id)->row(1);
			$data['kelas'] = $this->Ujian_model->kelas($data['ujian']->pengajar_id)->row(1);
			$this->load->view('template/header',$data);
			$this->load->view('pengajar/edit_soal_pilganda',$data);
			$this->load->view('template/footer');
		}
	}

	public function hapus_soal_pilganda($id)
	{
		$model = $this->Soal_model->cek_soal_pilganda($id)->row(1);
		$ujian = $this->Ujian_model->cek_tugas($model->topik_tugas_id)->row(1);
		if ($model != null) {
			$this->Soal_model->hapus_soal_pilganda($model->id);
			$this->session->set_flashdata('success','Berhasil Hapus Soal Pilganda Siswa');
			redirect(site_url('pengajar/soal_pilganda/'.$ujian->id));
		}else{
			$this->session->set_flashdata('success','Gagal Hapus Soal PilgandaSiswa');
			redirect(site_url('pengajar/soal_pilganda/'.$ujian->id));
		}
	}

	//soal essay
	public function soal_essay($id)
	{
		$data['header'] = 'E-elearning - Soal Essay / Kelas';
		$data['ujian'] = $this->Ujian_model->cek_tugas($id)->row(1);
		$mapel_kelas = $this->db->get_where('mapel_kelas',['id' => $data['ujian']->mapel_kelas_id])->row();
		$data['kelas'] = $this->Ujian_model->kelas_mapel($data['ujian']->pengajar_id,$mapel_kelas->mapel_id)->row(1);
		$data['soal'] = $this->Soal_model->soal_essay($id)->result();
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/soal_essay',$data);
		$this->load->view('template/footer');
	}

	public function tambah_soal_essay($id)
	{
		$data['header'] = 'E-elearning - Soal Essay / Siswa';
		$data['ujian'] = $this->Ujian_model->cek_tugas($id)->row(1);
		$mapel_kelas = $this->db->get_where('mapel_kelas',['id' => $data['ujian']->mapel_kelas_id])->row();
		$data['kelas'] = $this->Ujian_model->kelas_mapel($data['ujian']->pengajar_id, $mapel_kelas->mapel_id)->row(1);
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/tambah_soal_essay',$data);
		$this->load->view('template/footer');
	}

	public function insert_soal_essay($id)
	{
		$post = $this->input->post();
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 1024;
		
		$this->upload->initialize($config);
			if ($this->upload->do_upload('gambar')){
				$upload_data = $this->upload->data();
				$featured_image = $upload_data['file_name'];

				$data = [
					'pertanyaan' => $post['pertanyaan'],
					'tgl_dibuat' => date('Y-m-d'),
					'topik_tugas_id' => $id,
					'gambar' => 'uploads/'.$featured_image,
				];
			$save = $this->Soal_model->tambah_soal_essay($data);
			if ($save) {
				$this->session->set_flashdata('success','Berhasil Tambah Soal Essay Siswa');
				redirect(site_url('pengajar/soal_essay/'.$id));
			} else {
				$this->session->set_flashdata('success','Gagal Tambah Soal Essay Siswa');
				redirect(site_url('pengajar/soal_essay/'.$id));
			}
		}elseif (!$this->upload->do_upload('foto')) {
			$data = [
				'pertanyaan' => $post['pertanyaan'],
				'tgl_dibuat' => date('Y-m-d'),
				'topik_tugas_id' => $id,
			];
			
			$save = $this->Soal_model->tambah_soal_essay($data);
			if ($save) {
				$this->session->set_flashdata('success','Berhasil Tambah Soal Essay Siswa');
				redirect(site_url('pengajar/soal_essay/'.$id));
			} else {
				$this->session->set_flashdata('success','Gagal Tambah Soal Essay Siswa');
				redirect(site_url('pengajar/soal_essay/'.$id));
			}
		}else{
			$data['header'] = 'E-elearning - Tambah Soal Pilganda';
			$data['error'] = $this->upload->display_errors();
			$data['ujian'] = $this->Ujian_model->cek_tugas($id)->row(1);
			$data['kelas'] = $this->Ujian_model->kelas($data['ujian']->pengajar_id)->row(1);
			$this->load->view('template/header',$data);
			$this->load->view('pengajar/tambah_soal_essay',$data);
			$this->load->view('template/footer');
		}
	}

	public function edit_soal_essay($id)
	{
		$data['header'] = 'E-elearning - Tugas / Soal';
		$data['soal'] = $this->Soal_model->cek_soal_essay($id)->row(1);
		$data['ujian'] = $this->Ujian_model->cek_tugas($data['soal']->topik_tugas_id)->row(1);
		$mapel_kelas = $this->db->get_where('mapel_kelas',['id' => $data['ujian']->mapel_kelas_id])->row();
		$data['kelas'] = $this->Ujian_model->kelas($data['ujian']->pengajar_id,$mapel_kelas->mapel_id)->row(1);
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/edit_soal_essay',$data);
		$this->load->view('template/footer');
	}

	public function update_soal_essay($id)
	{
		$post = $this->input->post();
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 1024;
		
		$this->upload->initialize($config);
			if ($this->upload->do_upload('gambar')){
				$upload_data = $this->upload->data();
				$featured_image = $upload_data['file_name'];

				$data = [
					'pertanyaan' => $post['pertanyaan'],
					'gambar' => 'uploads/'.$featured_image,
				];
			$this->Soal_model->update_soal_essay($id,$data);
			$soal = $this->Soal_model->cek_soal_essay($id)->row(1);		
			$this->session->set_flashdata('success','Berhasil Update Soal Essay Siswa');
			redirect(site_url('pengajar/soal_essay/'.$soal->topik_tugas_id));
		}elseif (!$this->upload->do_upload('gambar')) {
			$data = [
				'pertanyaan' => $post['pertanyaan'],
			];
			
			$this->Soal_model->update_soal_essay($id,$data);
			$soal = $this->Soal_model->cek_soal_pilganda($id)->row(1);		
			$this->session->set_flashdata('success','Berhasil Update Soal Essay Siswa');
			redirect(site_url('pengajar/soal_essay/'.$soal->topik_tugas_id));
		}else{
			$data['header'] = 'E-elearning - Edit Soal Essay';
			$data['error'] = $this->upload->display_errors();
			$data['ujian'] = $this->Ujian_model->cek_tugas($id)->row(1);
			$data['kelas'] = $this->Ujian_model->kelas($data['ujian']->pengajar_id)->row(1);
			$this->load->view('template/header',$data);
			$this->load->view('pengajar/edit_soal_essay',$data);
			$this->load->view('template/footer');
		}
	}

	public function hapus_soal_essay($id)
	{
		$model = $this->Soal_model->cek_soal_essay($id)->row(1);
		$ujian = $this->Ujian_model->cek_tugas($model->topik_tugas_id)->row(1);
		if ($model != null) {
			$this->Soal_model->hapus_soal_essay($model->id);
			$this->session->set_flashdata('success','Berhasil Hapus Soal Essay Siswa');
			redirect(site_url('pengajar/soal_essay/'.$ujian->id));
		}else{
			$this->session->set_flashdata('success','Gagal Hapus Soal Essay Siswa');
			redirect(site_url('pengajar/soal_essay/'.$ujian->id));
		}
	}

	//laporan perkelas
	public function laporan_nilai()
	{
		$data['header'] = 'E-elearning - Laporan Nilai';
		$data['kelas'] = $this->Ujian_model->kelas($this->session->id_pengajar)->result();
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/laporan_nilai',$data);
		$this->load->view('template/footer');	
	}

	public function laporan_perkelas($id)
	{
		$data['header'] = 'E-elearning - Laporan Nilai Perkelas';
		$data['kelas'] = $this->Ujian_model->kelas_mapel($this->session->id_pengajar,$id)->row(1);
		$data['ujian'] = $this->Ujian_model->ujian($this->session->id_pengajar,$id)->result();
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/laporan_nilai_perkelas',$data);
		$this->load->view('template/footer');
	}

	public function cek_kelas()
	{
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		$data['header'] = 'E-elearning - Laporan Nilai Perkelas Siswa';
		$data['kelas'] = $this->Ujian_model->kelas_mapel($this->session->id_pengajar,$uri3)->row(1);
		$data['siswa'] = $this->Siswa_model->nilai_perkelas($uri3,$uri4,$this->session->id_pengajar)->result();
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/laporan_nilai_siswa',$data);
		$this->load->view('template/footer');
	}

	public function export_nilai_perkelas()
	{
        $this->load->library('Pdf'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
		
		$uri3 = $this->uri->segment(3);
		$uri4 = $this->uri->segment(4);
		$pengajar = $this->db->get_where('pengajar',['id' => $this->session->userdata('id_pengajar')])->row();
		$mapel_kelas = $this->Mapel_kelas_model->cek_pengajar_mata_pelajaran($uri3,$uri4,$this->session->userdata('id_pengajar'));
		$row_mapel_kelas = $mapel_kelas->row(1);
		error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
 
        $pdf = new FPDF('L', 'mm','A4');
 
        $pdf->AddPage();
        // $pdf->Image('./assets/images/kabupaten_hulu.png',20,6,30);
        $pdf->SetFont('Arial','B',16);
		// $pdf->Cell(10);
        $pdf->Cell(0,7,'Nama Pengajar :'.$pengajar->nama.'',0,1,'L');
        $pdf->Cell(0,7,'Kelas - Mata Pelajaran     :'.$row_mapel_kelas->kelas_nama.' - '.$row_mapel_kelas->mapel_nama,0,1,'L');
		$pdf->Cell(0,7,'',0,1,'C');

        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(120,6,'Nama Siswa',1,0,'C');
        $pdf->Cell(40,6,'Nilai Pilganda',1,0,'C');
        $pdf->Cell(40,6,'Nilai Essay',1,1,'C');

        $pdf->SetFont('Arial','',16);

        $resultse = $this->Siswa_model->nilai_perkelas($uri3,$uri4,$this->session->userdata('id_pengajar'));
        // $hitung = $this->Admin_model->join_responden_jawaban_user_hitung($id)->row();
        $no=0;
        foreach ($resultse->result() as $data){
  
        	if($data->persentase == null) {
                 $persen = "Kosong";
               }else{
                 $persen = $data->persentase;
             }
             if($data->nilai == null) {
                $n =  "Kosong";
             } else{
               $n = $data->nilai;
             }            
            $no++;
            $pdf->Cell(10,6,$no,1,0, 'C');
            $pdf->Cell(120,6,$data->nama,1,0, 'C');
            $pdf->Cell(40,6,$persen,1,0, 'C');
            $pdf->Cell(40,6,$n,1,1, 'C');
        }
            
        $pdf->Output('D','laporan '.$row_mapel_kelas->kelas_nama .' - '. $row_mapel_kelas->mapel_nama .'.pdf');
	}

	//Ubah Profil
	public function ubah_profil()
	{
		$data['header'] = 'E-elearning - Ubah Profil Pengajar';
		$data['admin'] = $this->db->get_where('user',['is_pengajar' => $this->session->id_pengajar])->row();
		$data['pengajar'] = $this->db->get_where('pengajar',['id' => $this->session->id_pengajar ])->row();
		$data['mapel'] = $this->Mapel_model->mapel()->result();
		$this->load->view('template/header',$data);
		$this->load->view('pengajar/ubah_profil',$data);
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