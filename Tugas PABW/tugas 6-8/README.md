# Tugas Pertemuan 6 - 8: Program Hitung Diskon Belanja (PHP)

**Nama:** Khalil Albar  
**NPM:** 2514101081  
**Mata Kuliah:** Pengembangan Aplikasi Berbasis Web (PABW)  
**Program Studi:** Informatika – Universitas Majalengka  

---

## Deskripsi Tugas
Aplikasi web berbasis PHP untuk menghitung besaran diskon dan total pembayaran belanja pelanggan. Program memisahkan logika perhitungan ke dalam fungsi-fungsi modular dan menampilkan hasil transaksi dalam antarmuka bergaya kartu struk belanja (*receipt card*).

## Struktur Fungsi PHP
Kode program dibangun menggunakan tiga fungsi utama:

1. **`tentukanPersen($totalBelanja)`**  
   Menentukan persentase potongan harga berdasarkan nominal total belanja (pengecekan dilakukan dari batas nominal terbesar ke terkecil):
   * `>= Rp 100.000` → **10%**
   * `>= Rp 50.000` (dan `< Rp 100.000`) → **5%**
   * `< Rp 50.000` → **0%** (Tidak ada diskon)
2. **`hitungDiskon($totalBelanja)`**  
   Fungsi utama yang menerima parameter `$totalBelanja`, memanggil `tentukanPersen()`, dan mengembalikan nominal potongan harga dalam satuan Rupiah (`$totalBelanja * $persen / 100`).
3. **`formatRupiah($angka)`**  
   Fungsi bantu untuk memformat angka numerik menjadi format mata uang Rupiah yang rapi menggunakan `number_format()` (contoh: `120000` menjadi `Rp 120.000`).

## Data Pengujian & Hasil Perhitungan
Program menguji 5 skenario transaksi pelanggan (termasuk pengujian nilai batas tepat di `Rp 100.000` dan `Rp 50.000`):

| Struk | Pelanggan | Total Belanja | Persentase Diskon | Nominal Diskon | Total Bayar |
| :---: | :--- | :---: | :---: | :---: | :---: |
| **#1** | Andi | Rp 120.000 | 10% | - Rp 12.000 | **Rp 108.000** |
| **#2** | Sari | Rp 75.000 | 5% | - Rp 3.750 | **Rp 71.250** |
| **#3** | Budi | Rp 30.000 | 0% (Tanpa diskon) | Rp 0 | **Rp 30.000** |
| **#4** | Dewi *(uji batas)* | Rp 100.000 | 10% | - Rp 10.000 | **Rp 90.000** |
| **#5** | Rafi *(uji batas)* | Rp 50.000 | 5% | - Rp 2.500 | **Rp 47.500** |

## Fitur Antarmuka (UI)
* **Grid Responsif:** Menampilkan daftar struk transaksi secara otomatis menyesuaikan lebar layar (`CSS Grid`).
* **Desain Kertas Struk:** Menggunakan tipografi monospace (`Courier Prime` & `Work Sans`), tepi bawah bergerigi dengan efek *CSS linear-gradient*, serta penanda warna hijau khusus untuk nominal penghematan diskon.

## Cara Menjalankan
1. Jalankan web server lokal (**Laragon** / **XAMPP**).
2. Letakkan folder `tugas 6-8` ke dalam direktori server (`www` atau `htdocs`).
3. Buka browser dan akses alamat `http://localhost/tugas%206-8/` (atau sesuai nama file `.php` di dalam folder).