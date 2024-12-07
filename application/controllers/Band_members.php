<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 */

class Band_members extends CI_Controller
{
	public function __construct()
	{
			parent::__construct(); // Memanggil constructor bawaan CI_Controller
		$this->load->database(); // Memuat library database
		$this->load->library('session'); // Memuat library session (opsional, jika diperlukan)
		$this->load->helper('url'); // Memuat helper URL (opsional, jika diperlukan untuk redirect)
	}

	public function login()
	{
		$query = $this->db->query("SELECT * FROM users"); // Jalankan query
		$data['users'] = $query->result(); // Ambil hasil sebagai array objek

		$this->load->view('/auth/login_view', $data); // Kirim data ke view
	}


	public function register()
	{
		$this->load->view('/auth/register_view');
	}
}
