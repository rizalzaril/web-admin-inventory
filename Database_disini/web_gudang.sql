-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 07 Des 2024 pada 13.43
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_gudang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `category`
--

INSERT INTO `category` (`id_category`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Elektronik', '2024-12-06 00:30:13', '2024-12-06 00:30:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id_product` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `satuan_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `stock` float NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id_product`, `product_name`, `category_id`, `satuan_id`, `supplier_id`, `stock`, `unit_price`, `created_at`, `updated_at`) VALUES
(10, 'VGA RTX 4090', 1, 1, 5, 3000, '25000000.00', '2024-12-07 00:36:51', '2024-12-07 10:27:23'),
(11, 'MONITOR LG CURVE 24 IN', 1, 1, 6, 21000, '2000000.00', '2024-12-07 00:38:55', '2024-12-07 11:52:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(50) NOT NULL,
  `deskripsi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`, `deskripsi`) VALUES
(1, 'Unit', 'unit deskripsi'),
(3, 'PCS', 'test');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `supplier_name` varchar(255) NOT NULL,
  `contact_info` varchar(255) DEFAULT NULL,
  `province` int(11) NOT NULL,
  `city` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `supplier_name`, `contact_info`, `province`, `city`, `address`, `created_at`, `updated_at`) VALUES
(5, 'ENTER KOMPUTER', '121312323', 6, 152, 'Mangga dua square LT3', '2024-12-06 21:13:07', '2024-12-07 03:13:07'),
(6, 'Jakarta Electronic Centre', '1231231', 6, 153, 'Jl. Letjen Suprapto', '2024-12-06 21:31:48', '2024-12-07 03:31:48'),
(7, 'Jaya Otomotif', '123123213', 5, 135, 'Jl jendral sudirman', '2024-12-07 03:39:38', '2024-12-07 09:39:38');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `id_transaction` int(11) NOT NULL,
  `transaction_code` varchar(100) NOT NULL,
  `transaction_type` enum('in','out') NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('pending','accepted','','') NOT NULL,
  `transaction_date` date NOT NULL DEFAULT current_timestamp(),
  `supplier_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`id_transaction`, `transaction_code`, `transaction_type`, `product_id`, `quantity`, `status`, `transaction_date`, `supplier_id`, `created_at`, `updated_at`) VALUES
(45, 'TRX4520241207', 'in', 11, 10000, 'accepted', '2024-12-07', 6, '2024-12-07 07:33:22', '2024-12-07 08:06:38'),
(47, 'TRX4720241207', 'out', 11, 100, 'accepted', '2024-12-07', 6, '2024-12-07 07:49:24', '2024-12-07 08:07:02'),
(48, 'TRX4820241207', 'out', 11, 900, 'accepted', '2024-12-07', 6, '2024-12-07 08:11:11', '2024-12-07 08:12:08'),
(49, 'TRX4920241207', 'out', 11, 1000, 'accepted', '2024-12-07', 6, '2024-12-07 08:13:47', '2024-12-07 08:13:55'),
(50, 'TRX5020241207', 'out', 11, 1000, 'accepted', '2024-12-07', 6, '2024-12-07 08:16:25', '2024-12-07 08:17:30'),
(51, 'TRX5120241207', 'out', 11, 1000, 'accepted', '2024-12-07', 6, '2024-12-07 08:18:32', '2024-12-07 08:18:39'),
(52, 'TRX5220241207', 'out', 11, 1000, 'accepted', '2024-12-07', 6, '2024-12-07 08:22:48', '2024-12-07 08:22:53'),
(53, 'TRX5320241207', 'out', 11, 1000, 'accepted', '2024-12-07', 6, '2024-12-07 08:25:06', '2024-12-07 08:25:11'),
(54, 'TRX5420241207', 'out', 11, 1000, 'accepted', '2024-12-07', 6, '2024-12-07 08:26:28', '2024-12-07 08:26:35'),
(55, 'TRX5520241207', 'out', 11, 1000, 'accepted', '2024-12-07', 6, '2024-12-07 08:27:24', '2024-12-07 08:27:30'),
(56, 'TRX5620241207', 'out', 11, 1000, 'accepted', '2024-12-07', 6, '2024-12-07 08:29:51', '2024-12-07 08:29:59'),
(57, 'TRX5720241207', 'in', 11, 1000, 'accepted', '2024-12-07', 6, '2024-12-07 08:32:38', '2024-12-07 08:33:16'),
(58, 'TRX5820241207', 'in', 11, 1000, 'accepted', '2024-12-07', 6, '2024-12-07 08:34:32', '2024-12-07 08:34:44'),
(59, 'TRX5920241207', 'in', 11, 2000, 'accepted', '2024-12-07', 6, '2024-12-07 08:39:09', '2024-12-07 08:39:18'),
(60, 'TRX6020241207', 'out', 11, 1000, 'accepted', '2024-12-07', 6, '2024-12-07 08:40:14', '2024-12-07 08:40:22'),
(61, 'TRX6120241207', 'in', 11, 1000, 'accepted', '2024-12-07', 6, '2024-12-07 08:42:53', '2024-12-07 08:43:00'),
(62, 'TRX6220241207', 'in', 11, 1000, 'accepted', '2024-12-07', 6, '2024-12-07 08:43:44', '2024-12-07 08:43:56'),
(63, 'TRX6320241207', 'in', 11, 1000, 'accepted', '2024-12-07', 6, '2024-12-07 08:45:01', '2024-12-07 08:45:09'),
(64, 'TRX6420241207', 'in', 11, 5000, 'accepted', '2024-12-07', 6, '2024-12-07 08:46:19', '2024-12-07 08:46:39'),
(65, 'TRX6520241207', 'out', 11, 1000, 'accepted', '2024-12-07', 6, '2024-12-07 08:48:37', '2024-12-07 08:48:55'),
(66, 'TRX6620241207', 'in', 11, 1000, 'accepted', '2024-12-07', 6, '2024-12-07 08:50:54', '2024-12-07 08:51:03'),
(67, 'TRX6720241207', 'in', 10, 1000, 'accepted', '2024-12-07', 5, '2024-12-07 08:52:37', '2024-12-07 08:53:10'),
(68, 'TRX6820241207', 'out', 10, 100, 'accepted', '2024-12-07', 5, '2024-12-07 09:10:02', '2024-12-07 09:10:08'),
(69, 'TRX6920241207', 'in', 10, 1000, 'accepted', '2024-12-07', 5, '2024-12-07 09:12:18', '2024-12-07 09:12:26'),
(70, 'TRX7020241207', 'out', 10, 100, 'accepted', '2024-12-07', 5, '2024-12-07 09:12:51', '2024-12-07 09:13:03'),
(71, 'TRX7120241207', 'out', 11, 100, 'pending', '2024-12-07', 6, '2024-12-07 09:23:51', '2024-12-07 09:23:51'),
(72, 'TRX7220241207', 'out', 11, 100, 'pending', '2024-12-07', 6, '2024-12-07 09:23:57', '2024-12-07 09:23:57'),
(73, 'TRX7320241207', 'out', 11, 100, 'pending', '2024-12-07', 6, '2024-12-07 09:24:03', '2024-12-07 09:24:03'),
(74, 'TRX7420241207', 'out', 11, 100, 'pending', '2024-12-07', 6, '2024-12-07 09:24:09', '2024-12-07 09:24:09'),
(75, 'TRX7520241207', 'in', 11, 100, 'pending', '2024-12-07', 6, '2024-12-07 09:24:42', '2024-12-07 09:24:42'),
(76, 'TRX7620241207', 'in', 10, 100, 'pending', '2024-12-07', 5, '2024-12-07 09:24:52', '2024-12-07 09:24:52'),
(77, 'TRX7720241207', 'in', 10, 1000, 'pending', '2024-12-07', 5, '2024-12-07 09:25:10', '2024-12-07 09:25:10'),
(78, 'TRX7820241207', 'in', 10, 1000, 'pending', '2024-12-07', 5, '2024-12-07 09:25:17', '2024-12-07 09:25:17'),
(79, 'TRX7920241207', 'in', 10, 1000, 'accepted', '2024-12-07', 5, '2024-12-07 09:25:23', '2024-12-07 10:27:23'),
(80, 'TRX8020241207', 'in', 11, 100, 'pending', '2024-12-07', 6, '2024-12-07 11:26:03', '2024-12-07 11:26:03'),
(81, 'TRX8120241207', 'out', 11, 1000, 'pending', '2024-12-07', 6, '2024-12-07 11:26:13', '2024-12-07 11:26:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `role`, `created_at`, `updated_at`) VALUES
(3, 'admin', '$2y$10$b84AVTocHk1byduqt6mm/.rJ8YdxtHQ.0Nl7thorEs3buv.NlxuWy', 'admin', '2024-12-06 00:16:05', '2024-12-06 00:18:27');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `product_ibfk_1` (`category_id`),
  ADD KEY `satuan_id` (`satuan_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transaction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id_satuan`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_supplier`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id_product`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_supplier`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
