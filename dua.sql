CREATE DATABASE db_0618;

CREATE TABLE `table_calon_mhs` (
    `id` int(11) NOT NULL,
    `kode_calon_mhs` varchar(10) NOT NULL,
    `nama_calon_mhs` varchar(50) NOT NULL,
    `alamat` varchar(200) NOT NULL,
    `telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `table_seleksi` (
    `id` int(11) NOT NULL,
    `kode_seleksi` varchar(11) NOT NULL,
    `kode_calon_mhs` varchar(10) NOT NULL,
    `nilai_tkda` int(3) NOT NULL,
    `nilai_matematika` int(3) NOT NULL,
    `nilai_wawancara` int(3) NOT NULL,
    `rata_rata` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;