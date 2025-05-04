## <p align="center" style="margin-top: 0;">Tokoh Alat Motor</p>

<p align="center">
  <img src="LOGO-UNSULBAR.png" width="300" alt="Deskripsi gambar" />
</p>

### <p align="center">Karunia Juli Sariri</p>
### <p align="center">D0223513</p></br>
### <p align="center">Framework Web Based</p>
### <p align="center">2025</p>

---
## Role dan Fitur
### 1. Admin
| Fitur | Deskripsi |
| ----------- | ----------- |
| Kelola User | Menambah, mengedit, dan menghapus pengguna (penjual/pelanggan). |
| Manajemen Produk | Mengelola semua produk dan kategori.|
| Manajemen Pesanan | Melihat semua pesanan dari seluruh pelanggan.|
| Manajemen Layanan Servis | Menambah dan mengelola jenis layanan servis.|
| Penjadwalan Teknisi | Mengatur penugasan teknisi ke permintaan servis.|
| Monitoring Sistem | Melihat statistik, laporan, dan aktivitas sistem. |

### 2. Penjual
| Fitur | Deskripsi |
| ----------- | ----------- |
| Manajemen Produk | Menambah, mengedit, menghapus stok produk.|
| Melihat Pesanan Masuk | Melihat dan memproses pesanan yang dibuat pelanggan. |
| Update Status Pesanan | Mengubah status pesanan (pending, paid, shipped). |
| Laporan Penjualan | Melihat riwayat penjualan produk. |

### 3. Pelanggan
| Fitur | Deskripsi |
| ----------- | ----------- |
| Registrasi & Login | Mendaftar akun, masuk ke sistem.|
| Belanja Produk | Menelusuri dan membeli produk. |
| Manajemen Keranjang | Menambah dan menghapus produk dari keranjang. |
| Melakukan Pesanan | Checkout produk dan memilih metode pembayaran. |
| Melihat Status Pesanan | Melacak status pengiriman pesanan. |
| Memesan Layanan Servis | Mengajukan servis motor ke rumah. | 
| Melihat Jadwal Servis | Mengetahui teknisi dan jadwal yang ditentukan. |

---
## Tabel-tabel database beserta field dan tipe datanya

### 1. Tabel ```{pengguna}```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INT(PK) | Primary Key |
| nama | VARCHAR(100) | Nama Pengguna |
| role_id | INT(FK) | Relasi ke ```{roles.id}``` |
| email | VARCHAR(100) | Email Unik |
| password | VARCHAR(255) | Password |
| no_telepon | VARCHAR(20) | Nomor telepon pengguna |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 2. Tabel ```{roles}```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INT(PK) | Primary Key |
| nama | VARCHAR(100) | Nama Role: admin, Penjual, pelanggan |
| created_at | TIMESTAMP | Waktu dibuat |

### 3. Tabel ```{kategori}```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INT(PK) | Primary Key |
| nama_produk | VARCHAR(100) | Nama produk |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 4. Tabel ```{produk}```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INT(PK) | Primary Key |
| nama_produk | VARCHAR | Nama produk |
| deskripsi | TEXT | Deskripsi produk |
| harga | INTEGER | Harga produk |
| stok | INTEGER | Jumlah stok |
| kategori_id | INT (FK) | Foreign key ke kategori |
| img_url | VARCHAR | URL gambar |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 5. Tabel ```{pesanan}```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INT(PK) | Primary Key |
| pengguna_id | INTEGER(FK) | Relasi ke pengguna |
| total_harga | INTEGER | Total harga pesanan |
| status | ENUM | pending / paid / shipped |
| alamat_pengiriman | TEXT | Alamat tujuan |
| kota | VARCHAR(100) | Kota tujuan |
| kode_pos | VARCHAR | Kode pos |
| no_telepon | VARCHAR | Nomor telepon |
| metode_pebayaran | Misalnya: COD, transfer |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 6. Tabel ```{Detail_pesanan}```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INTEGER (PK) | Primary key |
| pesanan_id | INTEGER (FK) | Foreign key ke pesanan |
| produk_id | INTEGER | Jumlah produk |
| jumlah | INTEGER | Total harga |

### 7. Tabel ```{Keranjang}```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INTEGER(PK) | Primary key |
| user_id | INTEGER(FK) | Foreign key ke pengguna |
| produk_id | INTEGER(FK) | Foreign key ke produk |
| jumlah | INTEGER | Jumlah item dalam keranjang |

### 8. Tabel ```{Layanan Servis}```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INTEGER(PK) | Primary key |
| nama | VARCHAR | Nama layanan servis | 
| deskripsi | TEXT | Detail layanan |
| harga | INTEGER | Biaya layanan |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |


### 9. Tabel ```{Permintaaan_servis}```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id |  INTEGER | Primary key |
| user_id | INTEGER(FK) | Foreign key ke pengguna |
| layanan_id | INTEGER | Foreign key ke layanan_servis |
| alamat | TEXT | Lokasi servis |
| jadwal | DATE | Tanggal permintaan servis |
| status | ENUM | tertunda / dijadwalkan / selesai / dibatalkan |
| no_telepon | VARCHAR | Nomor pelanggan |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 10. Tabel ```{Teknisi}```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
|id | INTEGER | Primary key |
| nama  | VARCHAR | Nama teknisi |
| telepon | VARCHAR | No HP teknisi |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 11. Tabel ```{Penugasan Teknisi}```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
|id | INTEGER | Primary key |
| teknisi_id | INTEGER (FK) | Foreign key ke teknisi |
| permintaan_id | INTEGER (FK) | Foreign key ke permintaan_servis | 


---
## Jenis relasi dan tabel yang berelasi
| Tabel Asal | Tabel Tujuan | Jenis Relasi | Keterangan |
| ----------- | ----------- | ----------- | ----------- |
| ```pengguna.role_id``` | ```roles.id``` | Many to One | Banyak user bisa punya satu role |
| ```produk.kategori_id``` | ```kategori.id``` | Many to One | Banyak produk termasuk dalam satu kategori |
| ```pesanan.user_id``` | ```pengguna.id``` | Many to One | Banyak pesanan dibuat oleh satu pengguna |
| ```keranjang.user_id``` | ```pengguna.id``` | Many to One | Banyak item di keranjang milik satu pengguna |
| ```keranjang.produk_id``` | ```produk.id``` | Many to One | Satu produk bisa muncul di banyak keranjang |
| ```detail_pesanan.pesanan_id``` | ```pesanan.id``` | Many to One | Banyak detail item milik satu pesanan |
| ```detail_pesanan.produk_id``` | ```produk.id``` | Many to One | Banyak detail pesanan bisa menunjuk ke satu produk |
| ```permintaan_servis.user_id``` | ```pengguna.id``` | Many to One | Banyak permintaan servis dibuat oleh satu pengguna |
| ```permintaan_servis.layanan_id``` | ```layanan_servis.id``` | Many to One | Banyak permintaan servis menunjuk ke satu layanan |
| ```penugasan_teknisi.teknisi_id``` | ```teknisi.id``` | Many to One | Satu teknisi bisa memiliki banyak penugasan |
| ```penugasan_teknisi.permintaan_id``` | ```permintaan_servis.id``` | Many to One | Satu permintaan servis bisa memiliki satu atau beberapa penugasan teknisi (tergantung implementasi) |

