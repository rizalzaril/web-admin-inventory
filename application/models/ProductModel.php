<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductModel extends CI_Model
{


	public function get_product_all_stock()
	{
		// Mengambil semua data dari tabel 'jadwal_manggung' dengan join ke 'band', 'tempat_manggung', dan 'user_admin'
		$query = $this->db->select('*')
			->from('product')
			->join('category', 'category.id_category = product.category_id')
			->join('satuan', 'satuan.id_satuan = product.satuan_id')
			->join('supplier', 'supplier.id_supplier = product.supplier_id')
			->order_by('product.id_product', 'DESC')
			->get();

		if (!$query) {
			echo ("<script>alert('data kosong')</script>");
		} else {
			return $query->result_array(); // Mengembalikan hasil dalam bentuk array
		}
	}

	public function get_satuan()
	{
		// Mengambil semua data dari tabel 'jadwal_manggung' dengan join ke 'band', 'tempat_manggung', dan 'user_admin'
		$query = $this->db->select('*')
			->from('satuan')

			->order_by('satuan.id_satuan', 'DESC')
			->get();

		if (!$query) {
			echo ("<script>alert('data kosong')</script>");
		} else {
			return $query->result_array(); // Mengembalikan hasil dalam bentuk array
		}
	}

	// Function to save product data
	public function save_product($data)
	{
		// Insert data into the 'products' table (adjust table name if necessary)
		return $this->db->insert('product', $data);
	}


	public function get_product_dropdown()
	{
		$query = $this->db->select('*')
			->from('product')
			->get();

		return $query->result_array(); // Ensure this returns data
	}

	public function get_supplier_dropdown()
	{
		$query = $this->db->select('*')
			->from('supplier')
			->get();

		return $query->result_array(); // Ensure this returns data
	}

	public function get_satuan_dropdown()
	{
		$query = $this->db->select('*')
			->from('satuan')
			->get();

		return $query->result_array(); // Ensure this returns data
	}

	public function get_category_dropdown()
	{
		$query = $this->db->select('*')
			->from('category')
			->get();

		return $query->result_array(); // Ensure this returns data
	}


	public function get_all_supplier()
	{
		// Mengambil semua data dari tabel 'jadwal_manggung' dengan join ke 'band', 'tempat_manggung', dan 'user_admin'
		$query = $this->db->select('*')
			->from('supplier')
			->order_by('supplier.id_supplier', 'DESC')
			->get();

		if (!$query) {
			echo ("<script>alert('data kosong')</script>");
		} else {
			return $query->result_array(); // Mengembalikan hasil dalam bentuk array
		}
	}

	public function insert_supplier($data)
	{
		// Insert data ke tabel 'supplier'
		return $this->db->insert('supplier', $data);
	}


	// Function to update supplier data
	public function update_supplier($id_supplier, $data)
	{
		$this->db->where('id_supplier', $id_supplier);
		return $this->db->update('supplier', $data); // 'supplier' is the table name
	}


	public function delete_supplier($supplier_id)
	{
		// Mulai transaksi database
		$this->db->trans_start();

		// Hapus supplier berdasarkan ID
		$this->db->where('id_supplier', $supplier_id);
		$this->db->delete('supplier'); // Ganti dengan nama tabel supplier yang sesuai

		// Cek apakah penghapusan berhasil
		if ($this->db->affected_rows() > 0) {
			// Jika berhasil menghapus supplier, lakukan commit
			$this->db->trans_complete();
			return true;
		} else {
			// Jika gagal menghapus supplier, lakukan rollback
			$this->db->trans_rollback();
			return false;
		}
	}


	public function check_supplier_transaction($supplier_id)
	{
		// Query untuk memeriksa apakah ada transaksi yang terkait dengan supplier
		$this->db->where('supplier_id', $supplier_id);
		$query = $this->db->get('transaction'); // Asumsi tabel transaksi bernama 'transactions'

		// Jika ada transaksi, return true
		if ($query->num_rows() > 0) {
			return true;
		}

		// Jika tidak ada transaksi, return false
		return false;
	}

	public function delete_product($product_id)
	{
		// Mulai transaksi database
		$this->db->trans_start();

		// Hapus supplier berdasarkan ID
		$this->db->where('id_product', $product_id);
		$this->db->delete('product'); // Ganti dengan nama tabel supplier yang sesuai

		// Cek apakah penghapusan berhasil
		if ($this->db->affected_rows() > 0) {
			// Jika berhasil menghapus supplier, lakukan commit
			$this->db->trans_complete();
			return true;
		} else {
			// Jika gagal menghapus supplier, lakukan rollback
			$this->db->trans_rollback();
			return false;
		}
	}


	public function check_product_transaction($product_id)
	{
		// Query untuk memeriksa apakah ada transaksi yang terkait dengan supplier
		$this->db->where('product_id', $product_id);
		$query = $this->db->get('transaction'); // Asumsi tabel transaksi bernama 'transactions'

		// Jika ada transaksi, return true
		if ($query->num_rows() > 0) {
			return true;
		}

		// Jika tidak ada transaksi, return false
		return false;
	}


	public function simpan_data_satuan($data)
	{
		return $this->db->insert('satuan', $data);
	}


	public function delete_satuan($satuan_id)
	{
		// Mulai transaksi database
		$this->db->trans_start();

		// Hapus supplier berdasarkan ID
		$this->db->where('id_satuan', $satuan_id);
		$this->db->delete('satuan'); // Ganti dengan nama tabel supplier yang sesuai

		// Cek apakah penghapusan berhasil
		if ($this->db->affected_rows() > 0) {
			// Jika berhasil menghapus supplier, lakukan commit
			$this->db->trans_complete();
			return true;
		} else {
			// Jika gagal menghapus supplier, lakukan rollback
			$this->db->trans_rollback();
			return false;
		}
	}


	public function check_satuan_transaction($satuan_id)
	{
		// Query to check if there's a related product with the given satuan_id
		$this->db->where('satuan_id', $satuan_id);
		$query = $this->db->get('product'); // Assume the related table is 'products'

		// If there's at least one product with the specified satuan_id, return true
		if ($query->num_rows() > 0) {
			return true;
		}

		// If no product is found with that satuan_id, return false
		return false;
	}






	public function get_product_stock()
	{
		$this->db->select_sum('stock');  // Select the sum of the 'qty' field
		$query = $this->db->get('product');  // Get the data from the 'product' table
		return $query->row()->stock;  // Return the total sum of qty
	}

	public function get_product_stock_in()
	{
		// Add the WHERE condition to filter by the 'in' value
		$this->db->select_sum('quantity');  // Select the sum of the 'quantity' field
		$this->db->where('transaction_type', 'in');  // Filter by the 'in' value (replace 'transaction_type' with your actual field)
		$query = $this->db->get('transaction');  // Get the data from the 'transaction' table
		return $query->row()->quantity;  // Return the total sum of quantity
	}


	public function update_product($product_id, $data)
	{
		$this->db->where('id_product', $product_id);
		return $this->db->update('product', $data); // 'products' is the name of the table
	}



	public function insert_transaction_in($data)
	{
		// Insert data ke tabel transaction
		$this->db->insert('transaction', $data);

		// Mengembalikan ID transaksi yang baru disimpan
		return $this->db->insert_id();
	}

	public function insert_transaction_out($data)
	{
		// Insert data ke tabel transaction
		$this->db->insert('transaction', $data);

		// Mengembalikan ID transaksi yang baru disimpan
		return $this->db->insert_id();
	}

	public function update_stock($product_id, $quantity)
	{
		// Update stok produk berdasarkan ID
		$this->db->set('stock', 'stock + ' . (int) $quantity, FALSE);
		$this->db->where('id_product', $product_id);
		$this->db->update('product');
	}

	public function update_stock_out($product_id, $quantity)
	{
		// Update stok produk berdasarkan ID
		$this->db->set('stock', 'stock - ' . (int) $quantity, FALSE);
		$this->db->where('id_product', $product_id);
		$this->db->update('product');
	}

	public function update_transaction_code($transaction_id, $transaction_code)
	{
		// Update transaction_code berdasarkan id_transaction
		$this->db->set('transaction_code', $transaction_code);
		$this->db->where('id_transaction', $transaction_id);
		$this->db->update('transaction');
	}


	public function get_product_stock_out()
	{
		// Add the WHERE condition to filter by the 'in' value
		$this->db->select_sum('quantity');  // Select the sum of the 'quantity' field
		$this->db->where('transaction_type', 'out');  // Filter by the 'in' value (replace 'transaction_type' with your actual field)
		$query = $this->db->get('transaction');  // Get the data from the 'transaction' table
		return $query->row()->quantity;  // Return the total sum of quantity
	}


	// get stcok product for ochange
	public function get_stock($product_id)
	{
		$this->db->select('stock');
		$this->db->from('product');
		$this->db->where('id_product', $product_id);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->stock; // Mengembalikan nilai stok
		}

		return null; // Jika produk tidak ditemukan
	}

	public function get_product_in_out()
	{
		// Retrieve data from the 'transaction' table with LEFT JOINs to 'product' and 'supplier'
		$query = $this->db->select('*')
			->from('transaction')
			->join('product', 'product.id_product = transaction.product_id', 'left') // LEFT JOIN with 'product' table
			->join('supplier', 'supplier.id_supplier = transaction.supplier_id', 'left') // LEFT JOIN with 'supplier' table
			->where('status', 'pending')
			->order_by('transaction.id_transaction', 'DESC') // Order by product ID in descending order
			->get();

		// Check if the query returned results
		if ($query->num_rows() == 0) {
			echo "<script>alert('Data kosong')</script>";
			return [];
		} else {
			return $query->result_array(); // Return the result as an array
		}
	}


	public function get_barang_keluar()
	{
		// Retrieve data from the 'transaction' table with joins to 'product' and 'supplier'
		$query = $this->db->select('*')
			->from('transaction')
			->join('product', 'product.id_product = transaction.product_id') // Join with 'product' table
			->join('supplier', 'supplier.id_supplier = transaction.supplier_id') // Join with 'supplier' table
			->where('transaction.transaction_type', 'out') // Filter for transaction type 'out'
			->where('transaction.status', 'accepted') // Filter for status 'accepted'
			->order_by('transaction.id_transaction', 'DESC') // Order by transaction ID in descending order
			->get();

		// Check if the query returned results
		if ($query->num_rows() == 0) {
			echo "<script>alert('Data kosong')</script>";
			return [];
		} else {
			return $query->result_array(); // Return the result as an array
		}
	}


	public function get_barang_in()
	{
		// Retrieve data from the 'transaction' table with joins to 'product' and 'supplier'
		$query = $this->db->select('transaction.*, product.product_name, supplier.supplier_name') // Specify only required fields
			->from('transaction')
			->join('product', 'product.id_product = transaction.product_id') // Join with 'product' table
			->join('supplier', 'supplier.id_supplier = transaction.supplier_id') // Join with 'supplier' table
			->where('transaction.transaction_type', 'in') // Filter transactions of type 'in'
			->where('transaction.status', 'accepted') // Filter only 'accepted' transactions
			->order_by('transaction.id_transaction', 'DESC') // Order by transaction ID in descending order
			->get();

		// Return results or an empty array if no data is found
		return $query->num_rows() > 0 ? $query->result_array() : [];
	}





	public function update_transaction_status($transactionId, $updateData)
	{
		$this->db->where('id_transaction', $transactionId);
		return $this->db->update('transaction', $updateData); // Assuming 'transactions' is the table name
	}


	public function get_transaction_by_id($transactionId)
	{
		$this->db->where('id_transaction', $transactionId);
		$query = $this->db->get('transaction'); // Assuming 'transactions' is the table name
		return $query->row_array();
	}

	public function adjust_product_stock($productId, $quantity)
	{
		// Assuming you have a 'products' table where stock is stored
		$this->db->set('stock', 'stock + ' . (int)$quantity, FALSE);
		$this->db->where('id_product', $productId);
		return $this->db->update('product');
	}
}
