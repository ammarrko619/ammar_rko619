<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	public function __construct(){
		
		parent ::__construct();

		//load model
		$this->load->model('Model_data'); 

	}

	public function index()
	{
		$data = array(

			'title' 	=> 'Data',
			'data'	=> $this->Model_data->get_all(),

		);

		$this->load->view('data', $data);
	}

	public function tambah()
	{
		$data = array(

			'title' 	=> 'Tambah_Data'

		);

		$this->load->view('tambah_data', $data);
	}

	public function simpan()
	{
		$data = array(

			'nim' 			=> $this->input->post("nim"),
			'nama' 		=> $this->input->post("nama"),
			'jenis_kelamin' 	=> $this->input->post("jenis_kelamin"),
			'alamat' 		=> $this->input->post("alamat"),
			
		);

		$this->Model_data->simpan($data);

		$this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil disimpan didatabase.
			                                    </div>');

		//redirect
		redirect('mahasiswa/');

	}

	public function edit($nim)
	{
		$nim = $this->uri->segment(3);

		$data = array(

			'title' 	=> 'Edit Data',
			'data' => $this->Model_data->edit($nim)

		);

		$this->load->view('edit_data', $data);
	}

	public function update()
	{
		$id['nim'] = $this->input->post("nim");
		$data = array(

			'nim' 			=> $this->input->post("nim"),
			'nama' 		=> $this->input->post("nama"),
			'jenis_kelamin' 	=> $this->input->post("jenis_kelamin"),
			'alamat' 		=> $this->input->post("alamat"),
			
		);

		$this->Model_data->update($data, $id);

		$this->session->set_flashdata('notif', '<div class="alert alert-success alert-dismissible"> Success! data berhasil diupdate didatabase.
			                                    </div>');

		//redirect
		redirect('mahasiswa/');

	}

	public function hapus($nim)
	{
		$id['nim'] = $this->uri->segment(3);
		
		$this->Model_data->hapus($id);

		//redirect
		redirect('mahasiswa/');

	}

}
