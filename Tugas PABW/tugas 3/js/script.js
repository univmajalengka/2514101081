// Mengambil elemen form dari HTML menggunakan ID yang sudah dibuat
const form = document.getElementById('formPemesanan');

// Memberikan perintah saat tombol submit ditekan
form.addEventListener('submit', function(event) {
    
    // Mencegah halaman web melakukan reload/refresh otomatis
    event.preventDefault();

    // Mengambil data yang diketik oleh pengguna
    const nama = document.getElementById('inputNama').value;
    const paket = document.getElementById('inputPaket').value;

    // Logika Validasi: Mengecek apakah ada kolom yang kosong
    if (nama.trim() === '' || paket === '') {
        // Jika kosong, munculkan peringatan
        alert('Mohon lengkapi Nama dan Pilihan Paket Anda terlebih dahulu!');
    } else {
        // Jika lengkap, munculkan pesan berhasil
        alert('Halo ' + nama + ', terima kasih! Pesanan untuk paket ' + paket + ' berhasil dicatat.');
        
        // Mengosongkan form kembali setelah berhasil dipesan
        form.reset();
    }
});