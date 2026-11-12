<?php
/*
|--------------------------------------------------------------------------
| Program hitung diskon belanja
|--------------------------------------------------------------------------
| Aturan diskon:
|   - Total belanja >= Rp 100.000          -> diskon 10%
|   - Total belanja >= Rp 50.000 (< 100rb) -> diskon 5%
|   - Total belanja <  Rp 50.000           -> tidak ada diskon
*/

// 1. Fungsi bantu: menentukan persentase diskon dari total belanja.
//    Cek dari angka terbesar dulu supaya tidak "nyangkut" di syarat yang lebih kecil.
function tentukanPersen($totalBelanja)
{
    if ($totalBelanja >= 100000) {
        return 10;
    }
    if ($totalBelanja >= 50000) {
        return 5;
    }
    return 0;
}

// 2. Fungsi utama sesuai soal: menerima total belanja, mengembalikan NILAI diskon (rupiah).
function hitungDiskon($totalBelanja)
{
    $persen = tentukanPersen($totalBelanja);
    return $totalBelanja * $persen / 100;
}

// 3. Fungsi bantu: merapikan angka jadi format rupiah, contoh 120000 -> "Rp 120.000"
function formatRupiah($angka)
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

// 4. Data contoh: beberapa pelanggan dengan total belanja berbeda.
//    Dewi dan Rafi sengaja dibuat tepat di angka batas untuk menguji tanda >=.
$transaksi = [
    ['nama' => 'Andi', 'total' => 120000],
    ['nama' => 'Sari', 'total' => 75000],
    ['nama' => 'Budi', 'total' => 30000],
    ['nama' => 'Dewi', 'total' => 100000],
    ['nama' => 'Rafi', 'total' => 50000],
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hitung diskon belanja</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Courier+Prime:wght@400;700&family=Work+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --meja: #dde4e8;
            --kertas: #fffef8;
            --tinta: #22303a;
            --tinta-pudar: #6a7882;
            --hemat: #1d6b58;
            --garis: #b9c2c8;
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 2.5rem 1.25rem 4rem;
            background: var(--meja);
            color: var(--tinta);
            font-family: "Work Sans", system-ui, sans-serif;
            line-height: 1.5;
        }

        header {
            max-width: 62rem;
            margin: 0 auto 2rem;
        }

        h1 {
            margin: 0 0 0.5rem;
            font-size: 1.75rem;
            font-weight: 600;
        }

        .aturan {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem 1.5rem;
            margin: 0;
            padding: 0;
            list-style: none;
            color: var(--tinta-pudar);
            font-size: 0.95rem;
        }

        .daftar-struk {
            max-width: 62rem;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(16rem, 1fr));
            gap: 1.75rem;
            align-items: start;
        }

        /* Struk: satu-satunya elemen yang dibuat "menonjol" */
        .struk {
            position: relative;
            padding: 1.5rem 1.25rem 2.25rem;
            background: var(--kertas);
            font-family: "Courier Prime", "Courier New", monospace;
            box-shadow: 0 1px 2px rgba(34, 48, 58, 0.18);
        }

        /* Tepi bawah bergerigi seperti kertas struk */
        .struk::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            bottom: -10px;
            height: 10px;
            background:
                linear-gradient(-135deg, var(--kertas) 5px, transparent 0) 0 0 / 14px 10px,
                linear-gradient(135deg, var(--kertas) 5px, transparent 0) 0 0 / 14px 10px;
        }

        .struk h2 {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 700;
        }

        .struk .pelanggan {
            margin: 0.1rem 0 1rem;
            color: var(--tinta-pudar);
            font-size: 0.9rem;
        }

        .baris {
            display: flex;
            justify-content: space-between;
            gap: 1rem;
            margin: 0.35rem 0;
        }

        .baris.hemat { color: var(--hemat); }

        .baris.bayar {
            margin-top: 0.9rem;
            padding-top: 0.9rem;
            border-top: 2px dashed var(--garis);
            font-size: 1.15rem;
            font-weight: 700;
        }

        .catatan {
            margin: 1rem 0 0;
            color: var(--tinta-pudar);
            font-size: 0.85rem;
        }

        @media (prefers-reduced-motion: reduce) {
            * { transition: none !important; animation: none !important; }
        }
    </style>
</head>
<body>
    <header>
        <h1>Hitung diskon belanja</h1>
        <ul class="aturan">
            <li>Mulai Rp 100.000: diskon 10%</li>
            <li>Mulai Rp 50.000: diskon 5%</li>
            <li>Di bawah Rp 50.000: tanpa diskon</li>
        </ul>
    </header>

    <main class="daftar-struk">
        <?php foreach ($transaksi as $nomor => $data): ?>
            <?php
            // Untuk setiap pelanggan: panggil fungsi, lalu hitung total bayar.
            $total      = $data['total'];
            $persen     = tentukanPersen($total);
            $diskon     = hitungDiskon($total);
            $totalBayar = $total - $diskon;
            ?>
            <article class="struk">
                <h2>Struk #<?= $nomor + 1 ?></h2>
                <p class="pelanggan">Pelanggan: <?= htmlspecialchars($data['nama']) ?></p>

                <div class="baris">
                    <span>Total belanja</span>
                    <span><?= formatRupiah($total) ?></span>
                </div>

                <?php if ($persen > 0): ?>
                    <div class="baris hemat">
                        <span>Diskon <?= $persen ?>%</span>
                        <span>- <?= formatRupiah($diskon) ?></span>
                    </div>
                <?php else: ?>
                    <p class="catatan">Belum mendapat diskon.</p>
                <?php endif; ?>

                <div class="baris bayar">
                    <span>Total bayar</span>
                    <span><?= formatRupiah($totalBayar) ?></span>
                </div>
            </article>
        <?php endforeach; ?>
    </main>
</body>
</html>