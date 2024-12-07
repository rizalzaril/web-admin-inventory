<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	public function login($username, $password)
	{
		// Memilih data pengguna berdasarkan username
		$this->db->where('username', $username);
		$query = $this->db->get('user');

		if ($query->num_rows() > 0) {
			$user = $query->row();

			// Memeriksa apakah password sesuai
			if (password_verify($password, $user->password)) {
				return $user; // Mengembalikan data user jika login berhasil
			} else {
				return 'wrong_password'; // Mengembalikan indikasi password salah
			}
		}
		return 'username_not_found'; // Mengembalikan indikasi username tidak ditemukan
	}



	// ***************** admin register **************** \\
	// Fungsi untuk mengecek apakah username sudah digunakan
	public function get_user_by_username($username)
	{
		$this->db->where('username', $username);
		$query = $this->db->get('user');
		return $query->row(); // Mengembalikan baris data jika ditemukan, atau NULL jika tidak ada
	}

	// Fungsi untuk memasukkan pengguna baru ke database
	public function insert_user($data)
	{
		$this->db->insert('user', $data); // Menyimpan data pengguna baru
	}
}
