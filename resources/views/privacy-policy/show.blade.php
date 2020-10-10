@extends('frontend.layouts.app')

@section('title',"Syarat & Ketentuan |")

@section('content')
<div class="container">
  <div class="row">
      <div class="head-text-syarat-ketentuan">
          <span class="syarat__">SYARAT DAN KETENTUAN UNICELLE</span>
          <div >
              <img class="img__ img-fluid" src="{{my_asset("images/img/banner-syarat&ketentuan.jpg")}}" alt="">
          </div>
      </div>
      @php
          $policy = \App\Policy::where('name', "privacy_policy")->first();
        //   dd($policy);
      @endphp
      <div class="text-syarat-ketentuan">
          {{-- <p>
              Kebijakan Privasi Unicelle adalah penjelasan terkait data dan informasi pribadi Pengguna
              Unicelle, meliputi:

              1. Hukum dan Peraturan yang berlaku;
              2. Perolehan dan Perlindungan Data;
              3. Penggunaan, Penyimpanan, Pemanfaatan, dan Pengolahan Data;
              4. Penghapusan Data;
              5. Pembatasan Tanggung Jawab Unicelle;
              6. Perubahan atas Kebijakan Privasi;
              6. Cookies; dan
              7. Kontak Unicelle.

              Referensi Unicelle dalam Kebijakan Privasi ini dapat berarti PT Unicelle.com, afiliasi PT
              Unicelle.com, perusahaan grup, pihak ketiga yang bekerja sama dengan PT Unicelle.com, yakni
              partner, vendor, dan subkontraktor.
              Kebijakan Privasi ini merupakan bagian tidak terpisahkan dan merupakan satu kesatuan dengan
              Aturan Penggunaan Unicelle

              HUKUM DAN PERATURAN YANG BERLAKU

              Unicelle tunduk terhadap segala peraturan perundang-undangan dan kebijakan pemerintah Republik
              Indonesia yang berlaku, termasuk yang mengatur tentang informasi dan transaksi elektronik,
              penyelenggaraan sistem elektronik, dan perlindungan data pribadi Pengguna, termasuk segala
              peraturan pelaksana dan peraturan perubahan dari peraturan-peraturan tersebut yang mengatur dan
              melindungi penggunaan data dan informasi penting para Pengguna.

              PENGGUNAAN, PENYIMPANAN, PEMANFAATAN, DAN PENGOLAHAN DATA

              1. Unicelle berhak menggunakan data dan informasi pribadi Pengguna demi meningkatkan mutu dan
              pelayanan di Unicelle sesuai dengan ketentuan perundang-undangan yang berlaku dan berdasarkan
              Persetujuan Pengguna.

              2. Unicelle berhak menggunakan informasi umum dan penggunaan layanan yang telah dikumpulkan
              untuk verifikasi data Pengguna

              3. Unicelle berhak menggunakan informasi transaksi untuk melakukan monitoring dan mengetahui
              pola transaksi Pengguna, serta untuk keperluan administrasi dan kepentingan penyelidikan atau
              kepentingan lainnya sebagaimana yang diwajibkan oleh aturan perundang-undangan

              4. Unicelle berhak menggunakan dan menyimpan informasi nama bank yang didalamnya termasuk nama
              dan nomor rekening, nama dan/atau nomor kartu kredit untuk memastikan pembayaran/penerimaan oleh
              Pengguna Unicelle.

              KONTAK BUKALAPAK

              Pengguna dapat menghubungi Bukalapak terkait Kebijakan Privasi ini melalui BukaBantuan
          </p> --}}
        {!!$policy->content!!}
      </div>
  </div>
</div>
@endsection