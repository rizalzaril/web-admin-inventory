<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TempatManggungModel extends CI_Model
{

	// Insert multiple rows into the database
	public function insertTempatManggung($data)
	{
		$this->db->insert_batch('tempat_manggung', $data); // 'bands' is the table name
	}

	public function get_all_tempat_manggung()
	{
		// Mengambil semua data dari tabel 'band' dan mengurutkan berdasarkan 'id_band' secara menurun (DESC)
		$this->db->order_by('id_tempat_manggung', 'DESC');
		$query = $this->db->get('tempat_manggung');

		if (!$query) {
			echo ("<script>alert('data kosong')</script>");
		} else {
			return $query->result_array(); // Mengembalikan hasil dalam bentuk array
		}
	}

	public function get_count_tempat_manggung()
	{
		return $this->db->count_all('tempat_manggung');
	}


	public function getTempatManggungById($tempat_id)
	{
		$tempat = $this->db->get_where('tempat_manggung', ['id_tempat_manggung' => $tempat_id])->row_array();

		if ($tempat) {
			$tempat['provinsi'] = $this->get_provinsi_name($tempat['provinsi']);
			$tempat['kota'] = $this->get_kota_name($tempat['kota']);
		}

		return $tempat;
	}


	// Ambil data provinsi berdasarkan ID
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

	// Ambil data kota berdasarkan ID
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

	// Contoh fungsi cache data dari API
	private function get_cached_data($type)
	{
		// Misal data diambil dari file cache atau API RajaOngkir
		$cache_file = APPPATH . "cache/{$type}_data.json";
		if (file_exists($cache_file)) {
			return json_decode(file_get_contents($cache_file), true);
		}
		return $this->fetch_data_from_api($type); // Ganti sesuai implementasi API fetch Anda
	}

	private function fetch_data_from_api($type)
	{
		// Contoh fetch dari API RajaOngkir
		$url = $type == 'province'
			? 'https://api.rajaongkir.com/starter/province'
			: 'https://api.rajaongkir.com/starter/city';
		$api_key = 'fadfcca283fa5c1162a55401d306842f';

		$response = file_get_contents($url, false, stream_context_create([
			'http' => [
				'header' => "Key: {$api_key}"
			]
		]));
		$data = json_decode($response, true);

		// Cache data ke file
		$cache_file = APPPATH . "cache/{$type}_data.json";
		file_put_contents($cache_file, json_encode($data));

		return $data;
	}


	public function updateTempatManggung($tempat_id, $data)
	{
		// Update the data in the database where band_id matches
		$this->db->where('id_tempat_manggung', $tempat_id);
		return $this->db->update('tempat_manggung	', $data); // Assuming 'bands' is your table name
	}

	public function deleteTempatmanggung($tempat_id)
	{
		// Ensure $band_ids is an array
		if (is_array($tempat_id)) {
			$this->db->where_in('id_tempat_manggung', $tempat_id); // Assuming 'id_band' is the primary key
			return $this->db->delete('tempat_manggung'); // 'bands' is the name of the table
		}
		return false;
	}
}
