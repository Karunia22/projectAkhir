# <p align="center" style="margin-bottom: 0px;">SIPAGI</p>
## <p align="center" style="margin-top: 0;">SISTEM PENJADWALAN GUDANG GABAH TERINTEGRASI</p>

<p align="center">
  <img src="Logo Unsulbar.png" width="300" alt="Deskripsi gambar" />
</p>

### <p align="center">AHMAD KHANIF IZZAH ARIFIN</p>
### <p align="center">D0223511</p></br>
### <p align="center">Framework Web Based</p>
### <p align="center">2025</p>

---
## Role dan Fitur
### 1. Admin
**Fokus:** Kelola sistem & pengguna
| Fitur | Deskripsi |
| ----------- | ----------- |
| Kelola User | CRUD data pengguna |
| Kelola Role dan Hak Akses | Menentukan akses |
| Laporan Sistem | Export data jadwal, pengguna dsb |

### 2. Manager Gudang
**Fokus:** Operasional gudang
| Fitur | Deskripsi |
| ----------- | ----------- |
| Lihat Jadwal | Lihat jadwal pengiriman |
| Konfirmasi Jadwal | Setujui/tolak/proses jadwal petani |
| Update Jadwal | Tandai sebagai *selesai*, *proses*, dsb |
| Kelola stok | Tambah/edit jumlah stok |
| Laporan Gudang | Stok harian, riwayat masuk/keluar |

### 3. Petani/Pengguna
**Fokus:** Kirim gabah / pantau proses
| Fitur | Deskripsi |
| ----------- | ----------- |
| Buat Jadwal | Pilih tanggal, gudang tujuan, jumlah gabah, kadar air padi, dan berat gabah |
| Lihat Status Jadwal | Apakah diterima, di proses atau, selesai |
| Edit/Hapus Jadwal | Jika jadwal belum di proses |

---
## Tabel-tabel database beserta field dan tipe datanya

### 1. Tabel ```{users}```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INT(PK) | Primary Key |
| nama | VARCHAR(100) | Nama User |
| role_id | INT(FK) | Relasi ke ```{roles.id}``` |
| email | VARCHAR(100) | Email Unik |
| password | VARCHAR(255) | Password |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 2. Tabel ```{roles}```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INT(PK) | Primary Key |
| nama | VARCHAR(100) | Nama Role: admin, manager gudang, petani |
| created_at | TIMESTAMP | Waktu dibuat |

### 3. Tabel ```{gudang}```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INT(PK) | Primary Key |
| nama_gudang | VARCHAR(100) | Nama Gudang |
| kapasitas | INT | Maksimal kapasitas gudang |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 4. Tabel ```{penjadwalans}```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INT(PK) | Primary Key |
| user_id | INT(FK) | Relasi ke ```{users.id}``` |
| gudang_id | INT(FK) | Relasi ke ```{gudangs.id}``` |
| tanggal_kirim | DATE | Tanggal kirim gabah |
| berat_gabah | FLOAT | Berat gabah dalam kg |
| kadar_air | FLOAT | Persentase kadar air padi |
| status | ENUM | 'diajukan', 'diproses', 'selesai', 'ditolak' |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

### 5. Tabel ```{stok_gabahs}```
| Field | Tipe Data | Keterangan |
| ----------- | ----------- | ----------- |
| id | INT(PK) | Primary Key |
| gudang_id | INT(FK) | Relasi ke ```{gudangs.id}``` |
| tanggal_masuk | DATE | Tanggal kirim gabah |
| berat_gabah | FLOAT | Berat gabah dalam kg |
| kadar_air | FLOAT | Persentase kadar air padi |
| sumber | VARCHAR(100) | Nama petani atau sumber gabah |
| created_at | TIMESTAMP | Waktu dibuat |
| updated_at | TIMESTAMP | Waktu diupdate |

---
## Jenis relasi dan tabel yang berelasi
| Tabel Asal | Tabel Tujuan | Jenis Relasi | Keterangan |
| ----------- | ----------- | ----------- | ----------- |
| ```users.role_id``` | ```roles.id``` | Many to One | Banyak user bisa punya satu role |
| ```penjadwalans.user_id``` | ```users.id``` | Many to One | Setiap jadwal diajukan oleh satu user |
| ```penjadwalans.gudang_id``` | ```gudangs.id``` | Many to One | Setiap jadwal diajukan ke satu gudang |
| ```stok_gabahs.gudang_id``` | ```gudangs.id``` | Many to One | Banyak stok masuk ke satu gudang |
