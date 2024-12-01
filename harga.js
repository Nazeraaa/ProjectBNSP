function calculateTotal() {
    const tipeKamar = parseInt(document.getElementById("tipe_kamar").value) || 0; // Harga kamar per malam
    const durasi = parseInt(document.getElementById("durasi").value) || 0; // Lama menginap dalam hari
    const breakfastChecked = document.getElementById("breakfast").checked; // Cek apakah breakfast dipilih

    // Tambahan biaya untuk breakfast
    const biayaBreakfast = breakfastChecked ? 80000 * durasi : 0;

    // Hitung total sebelum diskon
    let total = tipeKamar * durasi + biayaBreakfast;

    // Logika diskon
    let diskon = 0;
    if (durasi > 3) {
        diskon = total * 0.1; // Diskon 10% jika menginap lebih dari 3 hari
    }

    // Total akhir setelah diskon
    const hargaAkhir = total - diskon;

    // Format hasil ke format IDR dan tampilkan di input
    document.getElementById("total_bayar").value = total.toLocaleString("id-ID", { style: "currency", currency: "IDR" });
    document.getElementById("diskon").value = diskon.toLocaleString("id-ID", { style: "currency", currency: "IDR" });
    document.getElementById("harga_akhir").value = hargaAkhir.toLocaleString("id-ID", { style: "currency", currency: "IDR" });
}

// Tambahkan event listener untuk perubahan input
    document.addEventListener("DOMContentLoaded", () => {
        const elements = ["tipe_kamar", "durasi", "breakfast"];
        elements.forEach(id => {
            document.getElementById(id).addEventListener("change", calculateTotal);
        });
        calculateTotal(); // Hitung langsung saat halaman pertama kali dimuat
    });
