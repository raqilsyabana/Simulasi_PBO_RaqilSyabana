<?php
// file: PendaftaranReguler.php
require_once 'Pendaftaran.php';

class PendaftaranReguler extends Pendaftaran {
    // Properti tambahan spesifik Reguler
    private $pilihanProdi;
    private $lokasiKampus;

    // Konstruktor
    public function __construct($id, $nama, $sekolah, $nilai, $biayaDasar, $pilihanProdi, $lokasiKampus) {
        // Memanggil konstruktor dari abstract class parent
        parent::__construct($id, $nama, $sekolah, $nilai, $biayaDasar);
        $this->pilihanProdi = $pilihanProdi;
        $this->lokasiKampus = $lokasiKampus;
    }

    // Getter untuk properti spesifik
    public function getPilihanProdi() { return $this->pilihanProdi; }
    public function getLokasiKampus() { return $this->lokasiKampus; }

    #[\Override]
    public function hitungTotalBiaya() {
        // Jalur reguler: Biaya tambahan matrikulasi Rp 500.000
        return $this->biayaPendaftaranDasar + 500000;
    }

    public function tampilkanInfoJalur() {
        return "Jalur: Reguler | Prodi: {$this->pilihanProdi} | Kampus: {$this->lokasiKampus}";
    }

    // Metode Query Spesifik (Menggunakan PDO)
    public static function getDaftarReguler($db) {
        $query = "SELECT id_pendaftaran, nama_calon, asal_sekolah, nilai_ujian, biaya_pendaftaran_dasar, pilihan_prodi, lokasi_kampus 
                  FROM tabel_pendaftaran 
                  WHERE jalur_pendaftaran = 'Reguler'";
        
        $stmt = $db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>