<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('login') != TRUE) {
   			echo "<script type='text/javascript'>alert('Harap Login Terlebih dahulu');window.location.href='".site_url('utama/login')."'</script>";
		}
		$this->load->model('Siswa_model');
		$this->load->model('Kelas_siswa_model');
		$this->load->model('Mapel_kelas_model');
		$this->load->model('Kelas_model');
		$this->load->model('File_model');
		$this->load->helper('download');
	}

    public function index()
	{
		$data['header'] = 'E-elearning - Siswa';
        $data['jadwal'] = $this->Siswa_model->jadwal_siswa($_SESSION['is_siswa'])->result();
        $data['jumlah_tugas'] = $this->Siswa_model->hitung_tugas($_SESSION['is_siswa'])->result();
		$this->load->view('template/header',$data);
		$this->load->view('siswa/index',$data);
		$this->load->view('template/footer');
    }
	
	public function file_materi()
    {
    	$data['header'] = 'E-elearning - File Materi';
        $data['kelas'] = $this->Kelas_model->kelas_siswa($_SESSION['is_siswa'])->result();
		$this->load->view('template/header',$data);
		$this->load->view('siswa/file_materi',$data);
		$this->load->view('template/footer');
    }

    public function file_materi_kelas($id)
    {
    	$data['header'] = 'E-elearning - File Materi Kelas';
        $data['file'] = $this->File_model->file_materi_siswa($_SESSION['is_siswa'],$id)->result();
        $data['kelas'] = $this->Kelas_model->kelas_siswa($_SESSION['is_siswa'])->row();
		$this->load->view('template/header',$data);
		$this->load->view('siswa/file_materi_kelas',$data);
		$this->load->view('template/footer');
    }

    public function download_file_materi_kelas($id)
    {
    	$cek_file = $this->db->get_where('file_materi',['id' => $id])->row();
    	if ($cek_file) {
			force_download($cek_file->file, NULL);
    	}
    }

    public function tugas()
    {
        $data['header'] = 'E-elearning - Siswa Tugas';
        $data['ujian'] = $this->Siswa_model->ujian_siswa($_SESSION['is_siswa'])->result();
		$this->load->view('template/header',$data);
		$this->load->view('siswa/ujian',$data);
		$this->load->view('template/footer');
    }

    public function kerjakan($id)
    {
    	$data['header'] = 'E-elearning - Kerjakan Tugas';
        $data['kerjakan'] = $this->Siswa_model->kerjakan_ujian($id)->row(1);
		$this->load->view('template/header',$data);
		$this->load->view('siswa/kerjakan',$data);
		$this->load->view('template/footer');
    }

    public function kerjakan_soal()
    {
		$this->load->view('siswa/soal');
    }

    public function nilai()
    {
		$user = $_SESSION['is_siswa'];
    	if (empty($_SESSION['email']) AND empty($_SESSION['level']) AND $_SESSION['login']==TRUE){
   			 echo "<script type='text/javascript'>alert('Harap Login Terlebih dahulu');window.location.href='".site_url('utama/login')."'</script>";
		 
		}else{
		
		$soal = $this->db->query("SELECT * FROM quiz_pilganda where topik_tugas_id='$_POST[id_topik]'");
		$pilganda = $soal->num_rows();
		$soal_esay = $this->db->query("SELECT * FROM quiz_essay WHERE topik_tugas_id='$_POST[id_topik]'");
		$esay = $soal_esay->num_rows();
		//jika ada pilihan ganda dan ada esay
		if (!empty($pilganda) AND !empty($esay)){

		//jika ada inputan soal pilganda
		if(!empty($_POST['soal_pilganda'])){
		    $benar = 0;
		    $salah = 0;
		    foreach($_POST['soal_pilganda'] as $key => $value){
		    $cek = $this->db->query("SELECT * FROM quiz_pilganda WHERE id=$key");
		    // while($c = mysqli_fetch_array($cek)){
		 	foreach ($cek->result_array() as $c) {
		        $jawaban = $c['kunci'];
		    }
		    if($value==$jawaban){
		        $benar++;
		    }else{
		        $salah++;
		    }
		}

		$jumlah = $_POST['jumlahsoalpilganda'];
		$tidakjawab = $jumlah - $benar - $salah;
		$persen = $benar / $jumlah;
		$hasil = $persen * 100;

		$this->db->query("INSERT INTO nilai (topik_tugas_id, siswa_id, benar, salah, tidak_dikerjakan,persentase)
		                           VALUES ('$_POST[id_topik]','$user','$benar','$salah','$tidakjawab','$hasil')");
		}
		elseif (empty($_POST['soal_pilganda'])){
		    $jumlah = $_POST['jumlahsoalpilganda'];
		    $this->db->query("INSERT INTO nilai (topik_tugas_id, siswa_id, benar, salah, tidak_dikerjakan,persentase)
		                           VALUES ('$_POST[id_topik]','$user','0','0','$jumlah','0')");
		}

		//jika ada inputan soal esay
		if(!empty($_POST['soal_esay'])){
		    foreach($_POST['soal_esay'] as $key2 => $value){
		    $jawaban = $value;
		    $cek = $this->db->query("SELECT * FROM quiz_essay WHERE id=$key2");
		    foreach ($cek->result_array() as $data) {
		    // while($data = mysqli_fetch_array($cek)){
		        $this->db->query("INSERT INTO jawaban_essay(topik_tugas_id,id_quiz_essay,siswa_id,jawaban)
		                                 VALUES('$_POST[id_topik]','$data[id]','$user','$jawaban')");

		    }
		    
		    }

		}
		elseif (empty($_POST['soal_esay'])){
		    $this->db->query("INSERT INTO jawaban_essay(topik_tugas_id,id_quiz_essay,siswa_id,jawaban)
		                                 VALUES('$_POST[id_topik]','$data[id]','$user','')");
		}
			$this->session->set_flashdata('success','Ujian Telah Selesai');
			redirect(site_url('siswa/tugas'));
		}

		//jika soal hanya esay
		if (empty($pilganda) AND !empty($esay)){
		    //jika ada inputan soal esay
		if(!empty($_POST['soal_esay'])){
		    foreach($_POST['soal_esay'] as $key2 => $value){
		    $jawaban = $value;
		    $cek = $this->db->query("SELECT * FROM quiz_essay WHERE id=$key2");
		    foreach ($cek->result_array() as $data) {
		    
		        $this->db->query("INSERT INTO jawaban_essay(topik_tugas_id,id_quiz_essay,siswa_id,jawaban)
		                                 VALUES('$_POST[id_topik]','$data[id]','$user','$jawaban')");

		    }

		    }

		}
		elseif (empty($_POST['soal_esay'])){
		    $this->db->query("INSERT INTO jawaban_essay(topik_tugas_id,id_quiz_essay,siswa_id,jawaban)
		                                 VALUES('$_POST[id_topik]','$data[id]','$user','')");
		}
			$this->session->set_flashdata('success','Ujian Telah Selesai');
			redirect(site_url('siswa/tugas'));
		}

		//jika soal hanya pilihan ganda
		if (!empty($pilganda) AND empty($esay)){
		    //jika ada inputan soal pilganda
		if(!empty($_POST['soal_pilganda'])){
		    $benar = 0;
		    $salah = 0;
		    foreach($_POST['soal_pilganda'] as $key => $value){
		    $cek = $this->db->query("SELECT * FROM quiz_pilganda WHERE id=$key");
		    // while($c = mysqli_fetch_array($cek)){
		    foreach ($cek->result_array() as $c) {
		        $jawaban = $c['kunci'];
		    }
		    if($value==$jawaban){
		        $benar++;
		    }else{
		        $salah++;
		    }
		}

		$jumlah = $_POST['jumlahsoalpilganda'];
		$tidakjawab = $jumlah - $benar - $salah;
		$persen = $benar / $jumlah;
		$hasil = $persen * 100;

		$this->db->query("INSERT INTO nilai (topik_tugas_id, siswa_id, benar, salah, tidak_dikerjakan,persentase)
		                           VALUES ('$_POST[id_topik]','$user','$benar','$salah','$tidakjawab','$hasil')");

		}elseif (empty($_POST['soal_pilganda'])){
		    $jumlah = $_POST['jumlahsoalpilganda'];
		    $this->db->query("INSERT INTO nilai (topik_tugas_id, siswa_id, benar, salah, tidak_dikerjakan,persentase)
		                           VALUES ('$_POST[id_topik]','$user','0','0','$jumlah','0')");
		}
				$this->session->set_flashdata('success','Ujian Telah Selesai');
				redirect(site_url('siswa/tugas'));
		}

		}
    }

    public function nilai_tugas()
    {
    	$data['header'] = 'E-elearning - Nilai Tugas';
        $data['nilai'] = $this->Siswa_model->nilai_tugas($_SESSION['is_siswa'])->result();
		$this->load->view('template/header',$data);
		$this->load->view('siswa/nilai_tugas',$data);
		$this->load->view('template/footer');
    }

    public function cek_nilai($id)
    {
    	$data['header'] = 'E-elearning - Cek Nilai Tugas';
        $data['cek_nilai'] = $this->Siswa_model->cek_nilai_pilganda_tugas($_SESSION['is_siswa'],$id)->result();
        $data['cek_nilai_essay'] = $this->Siswa_model->cek_nilai_essay_tugas($_SESSION['is_siswa'],$id)->result();
        $data['mapel'] = $this->Siswa_model->kerjakan_ujian($id)->row(1);
		$this->load->view('template/header',$data);
		$this->load->view('siswa/cek_nilai_tugas',$data);
		$this->load->view('template/footer');	
    }

    public function ubah_profil()
	{
		$data['header'] = 'E-elearning - Ubah Profil Siswa';
		$data['admin'] = $this->db->get_where('user',['is_siswa' => $this->session->userdata('is_siswa')])->row();
		$data['siswa'] = $this->db->get_where('siswa',['id' => $_SESSION['is_siswa'] ])->row();
		$this->load->view('template/header',$data);
		$this->load->view('siswa/ubah_profil',$data);
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
			$this->Siswa_model->update_siswa($id,$data,$data_user);
			$this->session->set_flashdata('success','Berhasil Update Ubah Profil');
			redirect(site_url('siswa/ubah_profil'));
		}elseif (!$this->upload->do_upload('foto')) {
			$data = [
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
			$this->Siswa_model->update_siswa($id,$data,$data_user);
			$this->session->set_flashdata('success','Berhasil Update Ubah Profil');
			redirect(site_url('siswa/ubah_profil'));
		}else{
			$data['header'] = 'E-elearning - Edit Ubah Profil';
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('template/header',$data);
			$this->load->view('siswa/ubah_profil',$error);
			$this->load->view('template/footer');
		}
	}

	public function export_jadwal()
	{
        $this->load->library('Pdf'); // MEMANGGIL LIBRARY YANG KITA BUAT TADI
		$siswa = $this->db->get_where('siswa',['id' => $this->session->userdata('id_siswa')])->row();
		$kelas_siswa = $this->Kelas_siswa_model->kelas_siswa_persiswa($this->session->userdata('id_siswa'))->row(1);
		error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
 
        $pdf = new FPDF('L', 'mm','A4');
 
        $pdf->AddPage();
        // $pdf->Image('./assets/images/kabupaten_hulu.png',20,6,30);
        $pdf->SetFont('Arial','B',16);
		// $pdf->Cell(10);
        $pdf->Cell(0,7,'Nama Siswa :'.$siswa->nama.'',0,1,'L');
        $pdf->Cell(0,7,'Kelas      :'.$kelas_siswa->kelas_nama.'',0,1,'L');
		$pdf->Cell(0,7,'',0,1,'C');

        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(10,6,'No',1,0,'C');
        $pdf->Cell(100,6,'Mata Pelajaran',1,0,'C');
        $pdf->Cell(40,6,'Hari',1,0,'C');
        $pdf->Cell(120,6,'Pengajar',1,1,'C');

        $pdf->SetFont('Arial','',16);
      	
        $resultse = $this->Siswa_model->jadwal_siswa($this->session->userdata('id_siswa'));
        // $hitung = $this->Admin_model->join_responden_jawaban_user_hitung($id)->row();
        $no=0;
        foreach ($resultse->result() as $data){
            
            $no++;
            $pdf->Cell(10,6,$no,1,0, 'C');
            $pdf->Cell(100,6,$data->mapel_nama,1,0, 'C');
            $pdf->Cell(40,6,$data->hari,1,0, 'C');
            $pdf->Cell(120,6,$data->nama_pengajar,1,1, 'C');
        }
            
        $pdf->Output('D','jadwal-'.$siswa->nama.'.pdf');
	}
}