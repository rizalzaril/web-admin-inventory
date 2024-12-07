<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct(); // Memanggil constructor bawaan CI_Controller
		$this->load->database(); // Memuat library database
		$this->load->library('session', 'database'); // Memuat library session (opsional, jika diperlukan)
		$this->load->helper('url'); // Memuat helper URL (opsional, jika diperlukan untuk redirect)
		$this->load->model('Users_model');
	}

	public function index()
	{

		$this->load->view('/auth/login_view'); // Kirim data ke view


	}


	// Proses login
	public function authenticate()
	{
		// Mendapatkan username dan password dari input
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		// Memeriksa apakah username dan password tidak kosong
		if (empty($username) || empty($password)) {
			$this->session->set_flashdata('error', 'Username dan password tidak boleh kosong');
			redirect('/'); // Jika kosong, kembali ke halaman login
			return;
		}

		// Memeriksa apakah login berhasil
		$user = $this->Users_model->login($username, $password);

		if ($user === 'username_not_found') {
			$this->session->set_flashdata('error', 'Username tidak tersedia');
			redirect('/'); // Jika username tidak ditemukan, kembali ke halaman login
		} elseif ($user === 'wrong_password') {
			$this->session->set_flashdata('error', 'Password salah');
			redirect('/'); // Jika password salah, kembali ke halaman login
		} elseif ($user) {
			// Menyimpan data user ke session
			$this->session->set_userdata('id_user', $user->id_user);
			$this->session->set_userdata('username', $user->username);
			$this->session->set_userdata('role', $user->role); // Menyimpan role pengguna

			// Mengarahkan ke halaman berdasarkan role pengguna
			if ($user->role == 'admin') {
				$this->session->set_flashdata('success', 'Berhasil login! Selamat datang, ' . $user->username);
				redirect('admin/dashboard'); // Redirect ke dashboard admin
			} elseif ($user->role == 'staff') {
				$this->session->set_flashdata('success', 'Berhasil login! Selamat datang, ' . $user->username);
				redirect('user/dashboard'); // Redirect ke dashboard user
			} else {
				$this->session->set_flashdata('error', 'Role pengguna tidak dikenali');
				redirect('/'); // Jika role tidak dikenali, kembali ke halaman login
			}
		} else {
			$this->session->set_flashdata('error', 'Username atau password salah');
			redirect('/'); // Jika login gagal, kembali ke halaman login
		}
	}



	// ********************** REGISTER ADMIN ***************** \\

	public function registerUser()
	{
		$this->load->view('/auth/register_user');
	}

	public function registerUserFunction()
	{
		// Mendapatkan data dari form
		$username = $this->input->post('username'); // Mengambil username
		$password = $this->input->post('password');
		$confirm_password = $this->input->post('confirm_password');
		$role = 'staff'; // Menetapkan role sebagai staff

		// Validasi form
		if ($password !== $confirm_password) {
			// Jika password dan konfirmasi password tidak cocok
			$this->session->set_flashdata('error', 'Password dan Confirm Password tidak cocok');
			redirect('auth/register');
			return;
		}

		// Memeriksa apakah username sudah terdaftar
		$this->load->model('Users_model');
		$existing_user = $this->Users_model->get_user_by_username($username); // Cek username
		if ($existing_user) {
			// Jika username sudah digunakan
			$this->session->set_flashdata('error', 'Username sudah terdaftar');
			redirect('auth/register');
			return;
		}

		// Enkripsi password sebelum disimpan
		$hashed_password = password_hash($password, PASSWORD_BCRYPT);

		// Menyimpan data pengguna baru dengan role staff
		$data = [
			'username' => $username, // Menyimpan username
			'password' => $hashed_password,
			'role' => $role, // Menyimpan role sebagai staff
		];

		// Insert user data into the database
		$user_id = $this->Users_model->insert_user($data);

		// Menyimpan data ke session setelah berhasil mendaftar
		$this->session->set_userdata('id_user', $user_id);  // Simpan id user ke session
		$this->session->set_userdata('username', $username);  // Simpan username ke session
		$this->session->set_userdata('role', $role);  // Simpan role ke session

		// Menyimpan data ke session dan mengarahkan ke dashboard atau halaman lain
		$this->session->set_flashdata('success', 'Akun berhasil dibuat. Selamat datang, ' . $username);
		redirect('/');  // Redirect ke halaman dashboard atau halaman utama setelah registrasi
	}





	// Logout
	public function logout()
	{
		// Menghancurkan sesi pengguna
		$this->session->sess_destroy();

		// Mengatur pesan flash untuk notifikasi logout berhasil
		$this->session->set_flashdata('message', 'Anda berhasil logout!');

		// Mengarahkan pengguna ke halaman login
		redirect('/');
	}
}
