<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct(); // Memanggil constructor bawaan CI_Controller
		$this->load->database(); // Memuat library database
		$this->load->library('session', 'database'); // Memuat library session (opsional, jika diperlukan)
		$this->load->helper('url'); // Memuat helper URL (opsional, jika diperlukan untuk redirect)
		$this->load->model('Users_model');
		$this->load->model('ProductModel');
		$this->load->model('TempatManggungModel');
		$this->load->model('JadwalModel');
	}







	public function index()
	{
		if ($this->session->userdata('id_user') || $this->session->userdata('username')) {
			$id_user = $this->session->userdata('id_user'); // Session

			// Data utama untuk dashboard
			$data['product_stock'] = $this->ProductModel->get_product_stock();
			$data['product_stock_in'] = $this->ProductModel->get_product_stock_in();
			$data['product_stock_out'] = $this->ProductModel->get_product_stock_out();


			// Ambil data jadwal untuk minggu ini

			// Load semua view dengan data
			$this->load->view('layouts/header', $id_user);
			$this->load->view('layouts/navheader');
			$this->load->view('layouts/sidebar');
			$this->load->view('layouts/content', $data);
			$this->load->view('layouts/footer');
		} else {
			echo "<script>
            alert('Anda harus Login untuk akses halaman ini!');
            window.location.href = '" . base_url() . "';
        </script>";
		}
	}



	public function satuan()
	{

		$data['satuan'] = $this->ProductModel->get_satuan();

		// var_dump($data);
		// die();
		$this->load->view('layouts/header');
		$this->load->view('layouts/navheader');
		$this->load->view('layouts/sidebar');
		$this->load->view('dashboard/satuan', $data);
		$this->load->view('layouts/footer');
	}


	public function simpan_data_satuan()
	{
		// Check if the form is submitted
		if ($this->input->post()) {
			$nama_satuan = $this->input->post('nama_satuan_data');
			$deskripsi_satuan = $this->input->post('deskripsi_satuan');

			// Prepare the data to be inserted
			$data = array(
				'nama_satuan' => $nama_satuan,
				'deskripsi' => $deskripsi_satuan
			);

			// Insert data using the model
			$insert = $this->ProductModel->simpan_data_satuan($data);

			// Check if the data was inserted successfully
			if ($insert) {
				// Redirect to a success page or show a success message
				$this->session->set_flashdata('success', 'Data saved successfully!');
				redirect('admin/dashboard/satuan');
			} else {
				// Show error message
				$this->session->set_flashdata('error', 'Failed to save data!');
				redirect('admin/dashboard/satuan');
			}
		}
	}


	public function update_data_satuan()
	{
		// Get data from the POST request
		$id_satuan = $this->input->post('id_satuan');
		$nama_satuan = $this->input->post('nama_satuan');
		$deskripsi = $this->input->post('deskripsi');

		// Data is valid, perform the update
		$data = [
			'nama_satuan' => $nama_satuan,
			'deskripsi' => $deskripsi,
		];

		// Update the record in the database
		$this->db->where('id_satuan', $id_satuan);
		$this->db->update('satuan', $data); // Assuming the table is 'satuan'

		// Redirect or show a success message
		$this->session->set_flashdata('success', 'Data Satuan updated successfully');
		redirect('admin/dashboard/satuan'); // Redirect to the desired page

	}



	public function delete_satuan($satuan_id)
	{



		if (empty($satuan_id)) {
			$this->session->set_flashdata('error', 'ID Product tidak valid.');
			redirect('admin/dashboard/satuan');
		}

		// Cek apakah ada transaksi yang terkait dengan supplier
		$is_satuan_related_to_transaction = $this->ProductModel->check_satuan_transaction($satuan_id);

		if ($is_satuan_related_to_transaction) {
			// Jika ada transaksi terkait, tampilkan pesan error
			$this->session->set_flashdata('error', 'Tidak dapat menghapus satuan karena terhubung ke produk.');
			redirect('admin/dashboard/satuan');
		}


		$result = $this->ProductModel->delete_satuan($satuan_id);

		// Periksa hasil penghapusan
		if ($result) {
			$this->session->set_flashdata('success', 'Data satuan berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus data satuan.');
		}

		redirect('admin/dashboard/satuan');
	}




	public function product_stock()
	{

		$data['product_all'] = $this->ProductModel->get_product_all_stock();
		$data['supplier_dropdown'] = $this->ProductModel->get_supplier_dropdown();
		$data['category_dropdown'] = $this->ProductModel->get_category_dropdown();
		$data['satuan_dropdown'] = $this->ProductModel->get_satuan_dropdown();
		// var_dump($data);
		// die();
		$this->load->view('layouts/header');
		$this->load->view('layouts/navheader');
		$this->load->view('layouts/sidebar');
		$this->load->view('dashboard/product_stock', $data);
		$this->load->view('layouts/footer');
	}


	// Function to save product data
	public function simpan_data_product()
	{
		// Form validation (optional but recommended)



		// Get the form data
		$data = array(
			'product_name' => $this->input->post('nama_produk'),
			'category_id' => $this->input->post('kategori'),
			'stock' => $this->input->post('stock'),
			'supplier_id' => $this->input->post('supplier'),
			'satuan_id' => $this->input->post('satuan'),
			'unit_price' => str_replace('.', '', $this->input->post('harga')), // Remove dots from price
			'created_at' => date('Y-m-d H:i:s'),
		);

		// Call the model to save the data
		$insert = $this->ProductModel->save_product($data);

		// Check if the insert was successful and redirect
		if ($insert) {
			$this->session->set_flashdata('product', 'Product saved successfully');
			redirect('admin/dashboard/product_stock'); // Adjust this to your desired redirect page
		} else {
			$this->session->set_flashdata('error', 'Failed to save product');
			redirect('admin/dashboard/product_stock'); // Adjust this to your desired redirect page
		}
	}



	public function update_data_product()
	{
		// Load form validation library
		// Get data from the form
		$product_id = $this->input->post('id_product');
		$product_name = $this->input->post('product_name_edit');
		$category_id = $this->input->post('kategori_edit');
		$supplier_id = $this->input->post('supplier_edit');
		$unit_id = $this->input->post('satuan_edit');
		$unit_price = str_replace('.', '', $this->input->post('harga_edit')); // Format Rupiah to save as integer

		// Prepare data for update
		$data = array(
			'product_name' => $product_name,
			'category_id' => $category_id,
			'supplier_id' => $supplier_id,
			'satuan_id' => $unit_id,
			'unit_price' => $unit_price
		);

		// Load the model

		// Update the product data
		$update = $this->ProductModel->update_product($product_id, $data);

		if ($update) {
			// Redirect with success message
			$this->session->set_flashdata('success', 'Product updated successfully');
			redirect('admin/dashboard');
		} else {
			// Redirect with error message
			$this->session->set_flashdata('error', 'Failed to update product');
			redirect('admin/dashboard');
		}
	}




	public function delete_product($product_id)
	{



		if (empty($product_id)) {
			$this->session->set_flashdata('error', 'ID Product tidak valid.');
			redirect('admin/dashboard/product_stock');
		}

		// Cek apakah ada transaksi yang terkait dengan supplier
		$is_supplier_related_to_transaction = $this->ProductModel->check_product_transaction($product_id);

		if ($is_supplier_related_to_transaction) {
			// Jika ada transaksi terkait, tampilkan pesan error
			$this->session->set_flashdata('error', 'Tidak dapat menghapus product karena terdapat transaksi terkait.');
			redirect('admin/dashboard/product_stock');
		}


		$result = $this->ProductModel->delete_product($product_id);

		// Periksa hasil penghapusan
		if ($result) {
			$this->session->set_flashdata('success', 'Data product berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus data supplier.');
		}

		redirect('admin/dashboard/product_stock');
	}





	private $api_key = 'fadfcca283fa5c1162a55401d306842f';
	private $api_url = 'https://api.rajaongkir.com/starter/';

	// Ambil data provinsi
	public function province()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "{$this->api_url}province",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: {$this->api_key}"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			// Kirimkan error sebagai JSON
			header('Content-Type: application/json');
			echo json_encode(['error' => $err]);
		} else {
			// Kirimkan response langsung dalam JSON
			header('Content-Type: application/json');
			echo $response;
		}
	}

	// Ambil data kota berdasarkan ID provinsi
	public function city($province_id)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "{$this->api_url}city?province=" . $province_id,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: {$this->api_key}"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			// Kirimkan error sebagai JSON
			header('Content-Type: application/json');
			echo json_encode(['error' => $err]);
		} else {
			// Kirimkan response langsung dalam JSON
			header('Content-Type: application/json');
			echo $response;
		}
	}

	// Fetch the cached or fresh data for provinsi or kota
	private function get_cached_data($type)
	{
		$cache_key = $type . '_data';
		// Check if data is cached
		$data = $this->session->userdata($cache_key);

		if (!$data) {
			// Make API call and cache the data
			$url = $this->api_url . $type;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, ["key: {$this->api_key}"]);
			$response = curl_exec($ch);
			curl_close($ch);

			$data = json_decode($response, true);

			// Store data in session cache
			$this->session->set_userdata($cache_key, $data);
		}

		return $data;
	}

	// Get the name of the province by ID
	private function get_provinsi_name($provinsi_id)
	{
		$data = $this->get_cached_data('province');

		foreach ($data['rajaongkir']['results'] as $province) {
			if ($province['province_id'] == $provinsi_id) {
				return $province['province'];
			}
		}
		return null;
	}

	// Get the name of the city by ID
	private function get_kota_name($kota_id)
	{
		$data = $this->get_cached_data('city');

		foreach ($data['rajaongkir']['results'] as $city) {
			if ($city['city_id'] == $kota_id) {
				return $city['city_name'];
			}
		}
		return null;
	}






	public function supplier()
	{

		$data['supplier'] = $this->ProductModel->get_all_supplier();

		// Fetch province and city names
		foreach ($data['supplier'] as &$tempat) {
			// Fetch Provinsi Name
			$tempat['province_name'] = $this->get_provinsi_name($tempat['province']);

			// Fetch Kota Name
			$tempat['city_name'] = $this->get_kota_name($tempat['city']);
		}
		// var_dump($data);
		// die();
		$this->load->view('layouts/header');
		$this->load->view('layouts/navheader');
		$this->load->view('layouts/sidebar');
		$this->load->view('dashboard/supplier', $data);
		$this->load->view('layouts/footer');
	}


	public function simpan_data_supplier()
	{
			// Load model jika belum diload
		;

		// Ambil data dari form
		$nama_supplier = $this->input->post('nama_supplier');
		$provinsi = $this->input->post('provinsi');
		$kota = $this->input->post('kota');
		$alamat = $this->input->post('alamat');
		$contact = $this->input->post('contact');

		// Validasi data
		if (empty($nama_supplier) || empty($provinsi) || empty($kota) || empty($alamat) || empty($contact)) {
			$this->session->set_flashdata('error', 'Semua kolom wajib diisi.');
			redirect('admin/dashboard/supplier');
		}

		// Siapkan data untuk disimpan
		$data = [
			'supplier_name' => $nama_supplier,
			'province' => $provinsi,
			'city' => $kota,
			'address' => $alamat,
			'contact_info' => $contact,
			'created_at' => date('Y-m-d H:i:s'),
		];

		// Simpan data ke database
		$result = $this->ProductModel->insert_supplier($data);

		// Periksa hasil penyimpanan
		if ($result) {
			$this->session->set_flashdata('success', 'Data supplier berhasil disimpan.');
		} else {
			$this->session->set_flashdata('error', 'Gagal menyimpan data supplier.');
		}

		// Redirect kembali ke halaman supplier
		redirect('admin/dashboard/supplier');
	}


	public function update_data_supplier()
	{
		// Get the posted data from the form
		$id_supplier = $this->input->post('id_supplier');
		$nama_supplier_edit = $this->input->post('nama_supplier_edit');
		$provinsi_edit = $this->input->post('provinsi_edit');
		$kota_edit = $this->input->post('kota_edit');
		$alamat_edit = $this->input->post('alamat_edit');
		$contact_edit = $this->input->post('contact_edit');

		// Prepare data array for updating
		$data = array(
			'supplier_name' => $nama_supplier_edit,
			'province' => $provinsi_edit,
			'city' => $kota_edit,
			'address' => $alamat_edit,
			'contact_info' => $contact_edit
		);

		// Call the model to update the data
		$update = $this->ProductModel->update_supplier($id_supplier, $data);

		// Check if the update was successful and redirect accordingly
		if ($update) {
			$this->session->set_flashdata('success', 'Data Supplier updated successfully');
			redirect('admin/dashboard/supplier'); // Redirect to the dashboard or appropriate page
		} else {
			$this->session->set_flashdata('error', 'Failed to update Supplier data');
			redirect('admin/dashboard/supplier');
		}
	}


	public function delete_supplier($supplier_id)
	{


		// Validasi ID supplier
		if (empty($supplier_id)) {
			$this->session->set_flashdata('error', 'ID Supplier tidak valid.');
			redirect('admin/dashboard/supplier');
		}

		// Cek apakah ada transaksi yang terkait dengan supplier
		$is_supplier_related_to_transaction = $this->ProductModel->check_supplier_transaction($supplier_id);

		if ($is_supplier_related_to_transaction) {
			// Jika ada transaksi terkait, tampilkan pesan error
			$this->session->set_flashdata('error', 'Tidak dapat menghapus supplier karena terdapat transaksi terkait.');
			redirect('admin/dashboard/supplier');
		}

		// Hapus data supplier
		$result = $this->ProductModel->delete_supplier($supplier_id);

		// Periksa hasil penghapusan
		if ($result) {
			$this->session->set_flashdata('success', 'Data supplier berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus data supplier.');
		}

		// Redirect kembali ke halaman supplier
		redirect('admin/dashboard/supplier');
	}










	public function product_in_out()
	{
		$data['product_all'] = $this->ProductModel->get_product_all_stock();
		$data['product_dropdown'] = $this->ProductModel->get_product_dropdown();
		$data['supplier_dropdown'] = $this->ProductModel->get_supplier_dropdown();
		$data['barang_masuk'] = $this->ProductModel->get_product_in_out();
		$this->load->view('layouts/header');
		$this->load->view('layouts/navheader');
		$this->load->view('layouts/sidebar');
		$this->load->view('dashboard/product_in_out', $data);
		$this->load->view('layouts/footer');
	}

	public function product_reject()
	{
		$data['product_all'] = $this->ProductModel->get_product_all_stock();
		$data['product_dropdown'] = $this->ProductModel->get_product_dropdown();
		$data['supplier_dropdown'] = $this->ProductModel->get_supplier_dropdown();
		$data['barang_masuk'] = $this->ProductModel->get_product_in_out();
		$this->load->view('layouts/header');
		$this->load->view('layouts/navheader');
		$this->load->view('layouts/sidebar');
		$this->load->view('dashboard/product_reject', $data);
		$this->load->view('layouts/footer');
	}

	// ONCHANGE STOCK
	public function get_stock($product_id)
	{

		// Dapatkan data stok berdasarkan ID produk
		$stock = $this->ProductModel->get_stock($product_id);

		if ($stock !== null) {
			echo json_encode(['success' => true, 'stock' => $stock]);
		} else {
			echo json_encode(['success' => false, 'message' => 'Produk tidak ditemukan']);
		}
	}


	public function simpan_barang_masuk()
	{
		// Load model untuk menangani database




		// Ambil data dari form
		$product_id = $this->input->post('id_product');
		$supplier_id = $this->input->post('id_supplier');
		$quantity = $this->input->post('qty');
		$transaction_date = date('Y-m-d H:i:s');

		// Data untuk disimpan di tabel transaction
		$transaction_data = [
			'product_id' => $product_id,
			'supplier_id' => $supplier_id,
			'quantity' => $quantity,
			'transaction_type' => 'in',
			'transaction_date' => date('Y-m-d H:i:s'),
			'status' => 'pending',
		];


		// Simpan data ke tabel transaction
		$transaction_id = $this->ProductModel->insert_transaction_in($transaction_data);

		// Generate transaction_code dengan format 'TRX' + id_transaction + tanggal (yyyy-mm-dd)
		$transaction_code = 'TRX' . $transaction_id . date('Ymd', strtotime($transaction_date));

		// Update transaction_code di tabel transaction
		$this->ProductModel->update_transaction_code($transaction_id, $transaction_code);

		// Update stok produk di tabel product
		// $this->ProductModel->update_stock($product_id, $quantity);

		// Redirect atau tampilkan pesan sukses
		$this->session->set_flashdata('stockIn', 'Data berhasil disimpan!');
		redirect('admin/dashboard/product_stock');
	}


	public function barang_keluar()
	{
		$data['barang_keluar'] = $this->ProductModel->get_barang_keluar();
		$this->load->view('layouts/header');
		$this->load->view('layouts/navheader');
		$this->load->view('layouts/sidebar');
		$this->load->view('dashboard/barang_keluar', $data);
		$this->load->view('layouts/footer');
	}

	public function barang_masuk()
	{
		$data['barang_masuk'] = $this->ProductModel->get_barang_in();

		$this->load->view('layouts/header');
		$this->load->view('layouts/navheader');
		$this->load->view('layouts/sidebar');
		$this->load->view('dashboard/barang_masuk', $data);
		$this->load->view('layouts/footer');
	}


	public function simpan_barang_keluar()
	{
		// Load model untuk menangani database

		// Validasi input dari form


		// Ambil data dari form
		$product_id = $this->input->post('id_product2');
		$supplier_id = $this->input->post('id_supplier2');
		$quantity = $this->input->post('qty2');
		$transaction_date = date('Y-m-d H:i:s');

		// Data untuk disimpan di tabel transaction
		$transaction_data = [
			'product_id' => $product_id,
			'supplier_id' => $supplier_id,
			'quantity' => $quantity,
			'transaction_type' => 'out',
			'transaction_date' => date('Y-m-d H:i:s'),
			'status' => 'pending',
		];


		// Simpan data ke tabel transaction
		$transaction_id = $this->ProductModel->insert_transaction_out($transaction_data);

		// Generate transaction_code dengan format 'TRX' + id_transaction + tanggal (yyyy-mm-dd)
		$transaction_code = 'TRX' . $transaction_id . date('Ymd', strtotime($transaction_date));

		// Update transaction_code di tabel transaction
		$this->ProductModel->update_transaction_code($transaction_id, $transaction_code);

		// Update stok produk di tabel product
		// $this->ProductModel->update_stock_out($product_id, $quantity);

		// Redirect atau tampilkan pesan sukses
		$this->session->set_flashdata('stockOut', 'Data berhasil disimpan!');
		redirect('admin/dashboard/product_stock');
	}


	public function stock_progress()
	{
		$data['progress'] = $this->ProductModel->get_product_in_out();
		$this->load->view('layouts/header');
		$this->load->view('layouts/navheader');
		$this->load->view('layouts/sidebar');
		$this->load->view('dashboard/stock_progress', $data);
		$this->load->view('layouts/footer');
	}



	public function update_status()
	{
		// Get the posted data
		$transactionId = $this->input->post('id');
		$status = $this->input->post('status');

		if (!$transactionId || !$status) {
			echo json_encode(['success' => false, 'message' => 'Invalid input data']);
			return;
		}

		// Fetch transaction data to get the type and quantity
		$transaction = $this->ProductModel->get_transaction_by_id($transactionId);

		if (!$transaction) {
			echo json_encode(['success' => false, 'message' => 'Transaction not found']);
			return;
		}

		$transactionType = $transaction['transaction_type']; // 'in' or 'out'
		$quantity = $transaction['quantity'];
		$productId = $transaction['product_id']; // Assuming each transaction is linked to a product

		// Update the transaction status
		$updateData = ['status' => $status];
		$result = $this->ProductModel->update_transaction_status($transactionId, $updateData);

		if ($result) {
			// Adjust stock based on the transaction type
			$adjustResult = false;

			if ($transactionType == 'out') {
				// Decrease stock for "out" transactions
				$adjustResult = $this->ProductModel->adjust_product_stock($productId, -$quantity);
			} elseif ($transactionType == 'in') {
				// Increase stock for "in" transactions
				$adjustResult = $this->ProductModel->adjust_product_stock($productId, $quantity);
			}

			// Check if stock adjustment was successful
			if ($adjustResult) {
				// Respond with success and provide the redirect URL
				echo json_encode([
					'success' => true,
					'redirect_url' => base_url('admin/dashboard/product_stock')  // Add the redirect URL here
				]);
			} else {
				// If stock adjustment fails, roll back the status update
				$this->ProductModel->update_transaction_status($transactionId, ['status' => 'pending']); // Rollback
				echo json_encode(['success' => false, 'message' => 'Stock adjustment failed']);
			}
		} else {
			echo json_encode(['success' => false, 'message' => 'Failed to update transaction status']);
		}
	}



	public function export_to_pdf_stock_out()
	{
		// Load the TCPDF library
		$this->load->library('tcpdf');

		// Fetch data from the model (adjust according to your model structure)
		$barang_keluar = $this->ProductModel->get_barang_keluar();

		// Initialize TCPDF
		$pdf = new TCPDF();
		$pdf->AddPage();

		// Set title
		$pdf->SetFont('helvetica', 'B', 12);
		$pdf->Cell(0, 10, 'List Of Product Stock Out Transactions - ' . date('Y'), 0, 1, 'C');


		// Set table headers
		$pdf->SetFont('helvetica', 'B', 10);
		$pdf->Cell(10, 7, 'No', 1);
		$pdf->Cell(30, 7, 'Kode Transaksi', 1);
		$pdf->Cell(40, 7, 'Nama Produk', 1);
		$pdf->Cell(20, 7, 'QTY', 1);
		$pdf->Cell(50, 7, 'Supplier', 1);

		$pdf->Cell(40, 7, 'Tanggal Transaksi', 1);
		$pdf->Ln();

		// Add table data
		$pdf->SetFont('helvetica', '', 8);
		$no = 1;
		foreach ($barang_keluar as $bm) {
			$pdf->Cell(10, 7, $no++, 1);
			$pdf->Cell(30, 7, htmlspecialchars($bm['transaction_code']), 1);
			$pdf->Cell(40, 7, htmlspecialchars($bm['product_name']), 1);
			$pdf->Cell(20, 7, htmlspecialchars($bm['quantity']), 1);
			$pdf->Cell(50, 7, htmlspecialchars($bm['supplier_name']), 1);

			$pdf->Cell(40, 7, htmlspecialchars($bm['created_at']), 1);
			$pdf->Ln();
		}

		// Add "Petugas" (Officer) and "Tempat Tanda Tangan" (Signature Place)
		$pdf->Ln(10);  // Add a little space before adding the text
		$pdf->SetFont('helvetica', '', 10);

		// Add "Tanggal" (Current Date)
		$pdf->Cell(0, 10, 'Tanggal: ' . date('d-m-Y'), 0, 1, 'L');  // Format as Day-Month-Year

		// Add "Petugas" (Officer) text with session username
		$pdf->Cell(0, 10, 'Petugas: ' . $this->session->userdata('username'), 0, 1, 'L');


		// Add "Tempat Tanda Tangan" (Signature Place) text
		$pdf->Cell(0, 10, 'Tempat Tanda Tangan: _________________________', 0, 1, 'L');

		// Optionally, you can adjust the position and add more lines or text as required
		$pdf->Ln(10);

		// Output the PDF (I = display in the browser, F = save to file)
		$pdf->Output('barang_keluar_transactions.pdf', 'I');
	}


	public function export_to_pdf_stock_in()
	{
		// Load the TCPDF library
		$this->load->library('tcpdf');

		// Fetch data from the model (adjust according to your model structure)
		$barang_keluar = $this->ProductModel->get_barang_keluar();

		// Initialize TCPDF
		$pdf = new TCPDF();
		$pdf->AddPage();

		// Set title
		$pdf->SetFont('helvetica', 'B', 12);
		$pdf->Cell(0, 10, 'List Of Product Stock In Transactions - ' . date('Y'), 0, 1, 'C');


		// Set table headers
		$pdf->SetFont('helvetica', 'B', 10);
		$pdf->Cell(10, 7, 'No', 1);
		$pdf->Cell(30, 7, 'Kode Transaksi', 1);
		$pdf->Cell(40, 7, 'Nama Produk', 1);
		$pdf->Cell(20, 7, 'QTY', 1);
		$pdf->Cell(50, 7, 'Supplier', 1);

		$pdf->Cell(40, 7, 'Tanggal Transaksi', 1);
		$pdf->Ln();

		// Add table data
		$pdf->SetFont('helvetica', '', 8);
		$no = 1;
		foreach ($barang_keluar as $bm) {
			$pdf->Cell(10, 7, $no++, 1);
			$pdf->Cell(30, 7, htmlspecialchars($bm['transaction_code']), 1);
			$pdf->Cell(40, 7, htmlspecialchars($bm['product_name']), 1);
			$pdf->Cell(20, 7, htmlspecialchars($bm['quantity']), 1);
			$pdf->Cell(50, 7, htmlspecialchars($bm['supplier_name']), 1);

			$pdf->Cell(40, 7, htmlspecialchars($bm['created_at']), 1);
			$pdf->Ln();
		}

		// Add "Petugas" (Officer) and "Tempat Tanda Tangan" (Signature Place)
		$pdf->Ln(10);  // Add a little space before adding the text
		$pdf->SetFont('helvetica', '', 10);

		// Add "Tanggal" (Current Date)
		$pdf->Cell(0, 10, 'Tanggal: ' . date('d-m-Y'), 0, 1, 'L');  // Format as Day-Month-Year

		// Add "Petugas" (Officer) text with session username
		$pdf->Cell(0, 10, 'Petugas: ' . $this->session->userdata('username'), 0, 1, 'L');


		// Add "Tempat Tanda Tangan" (Signature Place) text
		$pdf->Cell(0, 10, 'Tempat Tanda Tangan: _________________________', 0, 1, 'L');

		// Optionally, you can adjust the position and add more lines or text as required
		$pdf->Ln(10);

		// Output the PDF (I = display in the browser, F = save to file)
		$pdf->Output('barang_keluar_transactions.pdf', 'I');
	}
}
