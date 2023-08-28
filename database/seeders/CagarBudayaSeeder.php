<?php

namespace Database\Seeders;

use App\Models\CagarBudaya;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CagarBudayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

   

    public function run()
    {
        CagarBudaya::create([
            'desa_id'               => 1,
            'nama_objek'            => "Makam Keramat Datu Mulia",
            'slug'                  => Str::slug("Makam Keramat Datu Mulia"),
            'nama_tempat'           => "Pulau Mandul",
            'alamat'                => "Jalan Usaha Tani RT. V",
            'koordinat_lat'         => "3.687378154086781",
            'koordinat_long'        => "117.5206006042704",
            'deskripsi'             => "Makam Keramat Datu Mulia berada di Pulau Mandul Tanah Merah Barat, yang berbentuk segi empat dan bertangga. Sekelilingnya dibentangkan kain panjang warna kuning.ini merupakan Makam anaknya Pangeran  Datu Bendahara",
            'riwayat_kepemilikan'   => "Pemilik Makam Keramat Datu Mulia adalah keturunan ke 6 setelah Datu Mulia meninggal, yaitu bapak Abdul Razak yang sampai pada saat ini yang mengelola makam Keramat Datu Mulia dan Pangeran Datu Bendahara",
            'latar_sejarah'         => "Datu Mulia ini merupakan Makam anaknya Pangeran  Datu Bendahara. orang keturunan bangsawan dan yang dihormati dan disegani oleh masyarakat suku Tidung pada zaman dahulu",
        ]);
        
        CagarBudaya::create([
            'desa_id'               => 1,
            'nama_objek'            => "Selapa ( Tempat Sirih )",
            'slug'                  => Str::slug("Selapa ( Tempat Sirih )"),
            'nama_tempat'           => "Desa seputuk",
            'alamat'                => "",
            'koordinat_lat'         => "3.5258333333333334",
            'koordinat_long'        => "116.73478333333334",
            'deskripsi'             => "Selapah adalah terbuat dari tembaga yang berwarna kuning, pada zaman dahulu di gunakan sebagai tempat sirih. Bentuknya segi empat memanjang",
            'riwayat_kepemilikan'   => "Selapa  ini adalah milik desa Seputuk",
            'latar_sejarah'         => "Selapa ini digunakan sebagai tempat sirih oleh orang zaman dahulu dan dipergunakan sebagai tempat persembahan orang yang sudah meninggal",
        ]);
        
        CagarBudaya::create([
            'desa_id'               => 1,
            'nama_objek'            => "Makam Keramat Tideng Pale",
            'slug'                  => Str::slug("Makam Keramat Tideng Pale"),
            'nama_tempat'           => "Tideng Pale",
            'alamat'                => "Jl. Jend. Sudirman",
            'koordinat_lat'         => "3.6069076848329633",
            'koordinat_long'        => "116.89880634723501",
            'deskripsi'             => "Abdul Rasyid meninggal sekitar tahun 1930",
            'riwayat_kepemilikan'   => "",
            'latar_sejarah'         => "Abdul Rasyid sangat dihormati dan sangat berpengaruh pada kehidupan suku Tidung di Sesayap, meninggal pada zaman mengayau dan mayatnya di potong-potong, bagian kepala dimakamkan di Tideng Pale dan bagian tubuh lainnya dimakamkan di Malinau, Melandan (Hulu Sengkong), Menjelutung dan Tarakan",
        ]);
        
        CagarBudaya::create([
            'desa_id'               => 1,
            'nama_objek'            => "Lungun Aki Korong",
            'slug'                  => Str::slug("Lungun Aki Korong"),
            'nama_tempat'           => "Rian Rayo",
            'alamat'                => "Desa Rian",
            'koordinat_lat'         => "3.5192525283551217",
            'koordinat_long'        => "116.79579347399996",
            'deskripsi'             => "Lungun Aki Korong berada di daerah perkampungan Desa Rian Rayo. Terbuat dari kayu ulin dengan dua tiang yang bercabang",
            'riwayat_kepemilikan'   => "",
            'latar_sejarah'         => "Aki Korong ada seorang kepala suku dari Suku Bulusu pada zaman dahulu dan memiliki peran yang sangat besar dalam keberadaan suku Bulusu yang ada di Desa Rian Rayo. Lungun Aki Korong  telah berusia -+ 200 tahun",
        ]);
        
        CagarBudaya::create([
            'desa_id'               => 1,
            'nama_objek'            => "Makam Kuno ( Lebangan Baloy Patoy )",
            'slug'                  => Str::slug("Makam Kuno ( Lebangan Baloy Patoy )"),
            'nama_tempat'           => "",
            'alamat'                => "",
            'koordinat_lat'         => "3.5258333333333334",
            'koordinat_long'        => "116.73478333333334",
            'deskripsi'             => "Lebangan Baloy Patoy adalah makam zaman dahulu yang cara pemakamannya tidak ditanam di dalam tanah melainkan diletakkan ditempat yang tinggi, peti dan atapnya terbuat dari kayu ulin",
            'riwayat_kepemilikan'   => "",
            'latar_sejarah'         => "Lebangan Baloy Patoy adalah tempat pemakaman suku Belusu  pada zaman dahulu kurang lebih berumur 100 tahun yang lalu, dimana orang yang meninggal tidak ditanam di dalam tanah melainkan diletakkan di tempat yang tinggi, peti  (lungun) dan atapnya terbuat dari kayu ulin yang diukir dan dalam satu tempat terdapat 10 peti mati (lungun)",
        ]);
        
        // CagarBudaya::create([
        //     'desa_id'               => 1,
        //     'nama_objek'            => "",
        //     'slug'                  => Str::slug(""),
        //     'nama_tempat'           => "",
        //     'alamat'                => "",
        //     'koordinat_lat'         => "",
        //     'koordinat_long'        => "",
        //     'deskripsi'             => "",
        //     'riwayat_kepemilikan'   => "",
        //     'latar_sejarah'         => "",
        // ]);

    }
}
