<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['hitung'])) {
        // Ambil data dari form dengan validasi input
        $durasi = isset($_POST['durasi']) ? (int)$_POST['durasi'] : 0;
        $harga = isset($_POST['tipe_kamar']) ? (int)$_POST['tipe_kamar'] : 0;
        $nama = isset($_POST['nama']) ? htmlspecialchars($_POST['nama']) : "Tidak Diisi";
        $jenis_kelamin = isset($_POST['jenis_kelamin']) ? htmlspecialchars($_POST['jenis_kelamin']) : "Tidak Diisi";
        $identitas = isset($_POST['identitas']) ? htmlspecialchars($_POST['identitas']) : "Tidak Diisi";
        $tanggal_pesan = isset($_POST['tanggal_pesan']) ? htmlspecialchars($_POST['tanggal_pesan']) : "Tidak Diisi";
        $breakfast = isset($_POST['breakfast']) ? true : false;

        // Validasi input penting
        if ($durasi <= 0 || $harga <= 0) {
            echo "Error: Data tidak lengkap atau tidak valid.";
            exit;
        }

        // Perhitungan total harga
        $total = $harga * $durasi;

        // Hitung diskon
        $diskon = 0;
        if ($durasi > 3 && $durasi < 7) {
            $diskon = $total * 0.1; // Diskon 10%
        } elseif ($durasi >= 7) {
            $diskon = $total * 0.2; // Diskon 20%
        }

        // Kurangi total dengan diskon
        $total -= $diskon;

        // Tambahkan biaya sarapan (opsional, dihitung per hari)
        if ($breakfast) {
            $total += 80000 * $durasi;
        }

        // Format data untuk tampilan
        $total_formatted = number_format($total, 0, ',', '.');
        $diskon_formatted = number_format($diskon, 0, ',', '.');

        // Tampilkan hasil perhitungan
        echo "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;'>
            <h2 style='text-align: center;'>Rincian Pemesanan</h2>
            <p><strong>Nama Pemesan:</strong> $nama</p>
            <p><strong>Nomor Identitas:</strong> $identitas</p>
            <p><strong>Jenis Kelamin:</strong> $jenis_kelamin</p>
            <p><strong>Tanggal Pesan:</strong> $tanggal_pesan</p>
            <p><strong>Durasi Menginap:</strong> $durasi Hari</p>
            <p><strong>Diskon:</strong> Rp $diskon_formatted</p>
            <p><strong>Total Harga Akhir:</strong> Rp $total_formatted</p>
            <div style='text-align: center; margin-top: 20px;'>
                <a href='../index.html' style='padding: 10px 20px; background: #007bff; color: #fff; text-decoration: none; border-radius: 5px;'>Kembali</a>
            </div>
        </div>
        ";
    }
} else {
    echo "Metode tidak valid.";
}
?>
