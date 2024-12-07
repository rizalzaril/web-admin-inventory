<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JadwalModel extends CI_Model
{

	// Insert multiple rows into the database
	public function insertJadwal($data)
	{
		$this->db->insert_batch('jadwal_manggung', $data); // 'bands' is the table name
	}


	public function checkConflict($band_id, $tempat_id, $date, $time)
	{
		$this->db->where('id_band', $band_id);
		$this->db->where('id_tempat_manggung', $tempat_id);
		$this->db->where('date', $date);
		$this->db->where('time', $time);
		$query = $this->db->get('jadwal_manggung');

		return $query->num_rows() > 0; // Return true if conflict exists
	}

	public function checkConflictForOtherBands($band_id, $tempat_id, $date, $time)
	{
		$this->db->where('id_tempat_manggung', $tempat_id);
		$this->db->where('date', $date);
		$this->db->where('time', $time);
		$this->db->where('id_band !=', $band_id); // Ensure it's not the same band
		$query = $this->db->get('jadwal_manggung');

		// If another band is scheduled at the same time and place
		return $query->num_rows() > 0;
	}

	public function checkDuplicateSchedule($band_id, $tempat_id, $date, $time)
	{
		$this->db->where('id_band', $band_id);
		$this->db->where('id_tempat_manggung', $tempat_id);
		$this->db->where('date', $date);
		$this->db->where('time', $time);
		$query = $this->db->get('jadwal_manggung');

		// If a duplicate schedule exists with the same band, tempat, date, and time
		return $query->num_rows() > 0;
	}

	public function getTempatNameById($id_tempat)
	{
		$this->db->select('nama_tempat_manggung');
		$this->db->from('tempat_manggung');
		$this->db->where('id_tempat_manggung', $id_tempat);
		$query = $this->db->get();
		return $query->row() ? $query->row()->nama_tempat_manggung : 'Unknown Tempat';
	}


	public function get_all_jadwal()
	{
		// Mengambil semua data dari tabel 'jadwal_manggung' dengan join ke 'band', 'tempat_manggung', dan 'user_admin'
		$query = $this->db->select('*')
			->from('jadwal_manggung')
			->join('band', 'band.id_band = jadwal_manggung.id_band')
			->join('tempat_manggung', 'tempat_manggung.id_tempat_manggung = jadwal_manggung.id_tempat_manggung')
			->join('user_admin', 'user_admin.id_user_admin = jadwal_manggung.id_user_admin')
			->join('jenis_konser', 'jenis_konser.id_jenis_konser = jadwal_manggung.id_jenis_konser')
			->order_by('jadwal_manggung.id_jadwal', 'DESC')
			->get();

		if (!$query) {
			echo ("<script>alert('data kosong')</script>");
		} else {
			return $query->result_array(); // Mengembalikan hasil dalam bentuk array
		}
	}


	public function get_jadwal_hadir()
	{
		// Mengambil semua data dari tabel 'jadwal_manggung' dengan join
		$query = $this->db->select('*')
			->from('jadwal_manggung')
			->join('band', 'band.id_band = jadwal_manggung.id_band')
			->join('tempat_manggung', 'tempat_manggung.id_tempat_manggung = jadwal_manggung.id_tempat_manggung')
			->join('user_admin', 'user_admin.id_user_admin = jadwal_manggung.id_user_admin')
			->join('jenis_konser', 'jenis_konser.id_jenis_konser = jadwal_manggung.id_jenis_konser')
			->order_by('jadwal_manggung.id_jadwal', 'DESC')
			->get();

		// Menghitung jumlah jadwal dengan status 'Terkonfirmasi'
		$count_confirmed = $this->db->where('status', 'Terkonfirmasi')
			->from('jadwal_manggung')
			->count_all_results();

		if (!$query) {
			echo ("<script>alert('data kosong')</script>");
		} else {
			return [
				'jadwal' => $query->result_array(), // Mengembalikan hasil dalam bentuk array
				'total_terkonfirmasi' => $count_confirmed // Jumlah data dengan status 'Terkonfirmasi'
			];
		}
	}


	public function get_all_konser()
	{
		// Mengambil semua data dari tabel 'band' dan mengurutkan berdasarkan 'id_band' secara menurun (DESC)
		$this->db->order_by('id_jenis_konser', 'DESC');
		$query = $this->db->get('jenis_konser');

		if (!$query) {
			echo ("<script>alert('data kosong')</script>");
		} else {
			return $query->result_array(); // Mengembalikan hasil dalam bentuk array
		}
	}


	public function get_all_jadwal_weekly()
	{
		$start_of_week = date('Y-m-d', strtotime('monday this week')); // Awal minggu
		$end_of_week = date('Y-m-d', strtotime('sunday this week')); // Akhir minggu

		$query = $this->db->select('jadwal_manggung.*, band.nama_band, tempat_manggung.nama_tempat_manggung, 
                                tempat_manggung.alamat, user_admin.username, jenis_konser.nama_konser')
			->from('jadwal_manggung')
			->join('band', 'band.id_band = jadwal_manggung.id_band')
			->join('tempat_manggung', 'tempat_manggung.id_tempat_manggung = jadwal_manggung.id_tempat_manggung')
			->join('user_admin', 'user_admin.id_user_admin = jadwal_manggung.id_user_admin')
			->join('jenis_konser', 'jenis_konser.id_jenis_konser = jadwal_manggung.id_jenis_konser')
			->where('jadwal_manggung.date >=', $start_of_week) // Filter awal minggu
			->where('jadwal_manggung.date <=', $end_of_week) // Filter akhir minggu
			->order_by('jadwal_manggung.id_jadwal', 'DESC') // Urutkan secara descending
			->get();

		return $query->result_array(); // Kembalikan hasil dalam bentuk array
	}



	public function get_count_jadwal()
	{
		return $this->db->count_all('jadwal_manggung');
	}


	public function get_count_jadwal_pending()
	{
		$this->db->where('status', 'Pending'); // Kondisi untuk status Terkonfirmasi
		return $this->db->count_all_results('jadwal_manggung'); // Hitung hasil dengan kondisi
	}

	public function get_count_jadwal_hadir()
	{
		$this->db->where('status', 'Terkonfirmasi'); // Kondisi untuk status Terkonfirmasi
		return $this->db->count_all_results('jadwal_manggung'); // Hitung hasil dengan kondisi
	}

	public function get_count_jadwal_batal_hadir()
	{
		$this->db->where('status', 'Terkonfirmasi'); // Kondisi untuk status Terkonfirmasi
		return $this->db->count_all_results('jadwal_manggung'); // Hitung hasil dengan kondisi
	}



	public function getJadwalById($jadwal_id)
	{
		$this->db->where('id_jadwal', $jadwal_id);
		$query = $this->db->get('jadwal_manggung');
		if ($query->num_rows() > 0) {
			return $query->row_array(); // Fetch single row as an associative array
		} else {
			return null; // Return null if no record found
		}
	}


	public function updateJadwal($id_jadwal, $data)
	{
		// Update the data in the database where jadwal_id matches
		$this->db->where('id_jadwal', $id_jadwal);
		return $this->db->update('jadwal_manggung	', $data);
	}

	public function updateStatus($jadwal_status_id, $data)
	{
		// Update the data in the database where jadwal_id matches
		$this->db->where('id_jadwal', $jadwal_status_id);
		return $this->db->update('jadwal_manggung	', $data);
	}

	public function deleteJadwal($jadwal_id)
	{
		// Ensure $band_ids is an array
		if (is_array($jadwal_id)) {
			$this->db->where_in('id_jadwal', $jadwal_id);
			return $this->db->delete('jadwal_manggung');
		}
		return false;
	}



	// filter report \\

	// Fetch distinct months from jadwal_manggung table
	public function get_distinct_months()
	{
		$this->db->select('DISTINCT MONTH(date) AS month');
		$query = $this->db->get('jadwal_manggung');
		return $query->result();
	}

	// Fetch distinct years from jadwal_manggung table
	public function get_distinct_years()
	{
		$this->db->select('DISTINCT YEAR(date) AS year');
		$query = $this->db->get('jadwal_manggung');
		return $query->result();
	}

	// Fetch distinct dates from jadwal_manggung table
	public function get_distinct_dates()
	{
		$this->db->select('DISTINCT DATE(date) AS date');
		$query = $this->db->get('jadwal_manggung');
		return $query->result();
	}
}
