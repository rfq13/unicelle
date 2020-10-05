@extends('frontend.layouts.app')
@section('content')
    <div class="container">
    <nav aria-label="breadcrumb">
            <ul class="breadcrumb mb-5 mt-5">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Artikel</a></li>
                <li class="breadcrumb-item active" style="color:#3BB6B1" aria-current="page">8 Orang Tidak Disarankan Lakukan Donor Darah</li>
            </ul>
        </nav>
        <div class="container">
            <div class="container">
                <div class="card mb-5">
                    <div class="ml-5" >
                        <p class="judul-artikel">8 Orang Tidak Disarankan Lakukan Donor Darah</p>
                    </div>
                    <div class="container" >
                        <img class="gambar-artikel" src="{{my_asset('/images/img/artikel1.png')}}" alt="">
                    </div>
                    <div class="container">
                        <p class="text-artikel ml-5 mr-5 mb-5">Donor darah adalah perbuatan mulia yang dapat menyelamatkan nyawa orang lain. Selain itu, pendonornya pun juga dapat merasakan sejumlah manfaat kesehatan, seperti mendapatkan pemeriksaan kesehatan gratis, mengurangi risiko terkena penyakit jantung, stroke, bahkan kanker. 

                            Meskipun punya segudang manfaat baik, sayangnya, tidak semua orang bisa melakukan donor darah. Ada sejumlah persyaratan yang perlu kamu penuhi untuk menjadi peserta donor darah. Dilansir dari Organisasi Kesehatan Dunia (WHO), pendonor harus berusia 18-65 tahun, memiliki berat badan minimal 50 kilogram, serta memiliki kondisi kesehatan yang baik.
                            
                            Walaupun sudah memenuhi persyaratan dasar untuk menjadi pendonor darah tersebut pun, riwayat kesehatan dan beberapa kebiasaan lainnya juga dipertimbangkan untuk menentukan apakah kamu memenuhi syarat untuk menjadi pendonor atau tidak.
                            
                            Berikut ini kelompok orang yang tidak dianjurkan untuk melakukan donor darah:
                            
                            1.Sedang Sakit
                            
                            Pada hari donor darah, kamu harus dalam keadaan sehat. Bila kamu sedang pilek, flu, sakit tenggorokan, sakit perut, herpes atau infeksi lainnya, sebaiknya tunda dulu untuk sementara rencana kamu untuk melakukan donor darah.  
                            
                            2.Baru Melakukan Tindikan
                            
                            Bila kamu baru saja mendapatkan tato atau melakukan tindik badan, kamu juga sangat tidak disarankan untuk melakukan donor darah selama 6 bulan sejak prosedur dilakukan. Namun, bila tindik badan dilakukan oleh ahli kesehatan berlisensi dan peradangan sudah sembuh sepenuhnya, kamu bisa mendonorkan darah setelah 12 jam.
                            
                            3.Sedang hamil
                            
                            Kamu tidak disarankan untuk melakukan donor darah dalam kondisi hamil karena dikhawatirkan dapat membahayakan kesehatan kamu dan janin. Kamu baru diperbolehkan untuk mendonorkan darah kembali 6 bulan setelah melahirkan. Wanita menyusui juga tidak disarankan untuk mendonorkan darah.
                            
                            4.Mengidap Penyakit Menular Seksual
                            
                            Beberapa penyakit menular seksual yang berbahaya, seperti gonore dan sifilis, dapat menular lewat darah. Bila kamu terinfeksi penyakit tersebut dan sedang dalam masa pengobatan, kamu baru bisa mendonorkan darah setelah 12 bulan sejak pengobatan kamu dinyatakan selesai.
                            
                            WHO juga melarang orang-orang yang melakukan aktivitas seksual ‘berisiko’ dalam 12 bulan terakhir untuk mendonorkan darah.
                            
                            5.Memiliki Riwayat Penyakit Hepatitis dan HIV
                            
                            Orang-orang yang pernah mendapatkan hasil tes positif HIV tidak diperbolehkan untuk mendonorkan darah secara permanen. Begitu juga dengan orang yang memiliki riwayat penyakit hepatitis. Sayangnya, tidak ada solusi yang bisa dilakukan bila kamu memiliki riwayat penyakit tersebut.
                            
                            6.Pernah Menggunakan Narkoba
                            
                            Orang-orang yang pernah menggunakan narkoba dalam bentuk suntik juga dilarang secara permanen untuk melakukan donor darah. Meskipun kamu sudah melakukan rehabilitasi dan tidak pernah kembali menggunakannya, kamu tidak akan pernah diperbolehkan untuk donor darah.
                            
                            7.Minum Obat-obatan Tertentu
                            
                            Bila kamu sedang mengonsumsi obat-obatan tertentu, seperti obat pengencer darah, antibiotik, obat untuk kanker atau kondisi kesehatan lainnya, kamu tidak disarankan untuk melakukan donor darah mulai dari seminggu hingga beberapa bulan.
                            
                            8.Bepergian Ke Luar Negeri
                            
                            Bila kamu baru saja bepergian ke negara lain, kamu mungkin tidak disarankan untuk melakukan donor darah, karena adanya kemungkinan kamu dapat terpapar penyakit menular. Misalnya, bepergian ke daerah endemik infeksi nyamuk, seperti demam berdarah, atau chikungunya dapat membuat kamu ditangguhkan sebagai pendonor sampai gejala hilang. Sedangkan orang yang pernah melakukan perjalanan atau tinggal di negara dengan kasus penularan malaria yang tinggi
                            juga akan ditangguhkan menjadi pendonor selama 1-3 tahun.
                        </p>
                    </div>                   
                </div>
                <div class="col-12 mb-5 mt-5">
                    <h5 class="mb-4">Artikel Serupa</h5>
                    <div class="row">
                        <div class="col-3">
                            <div class="card card-artikel">
                                <img src="{{my_asset('/images/img/artikel1.png')}}" style="width: 100%; border-radius: 15px 15px 0 0" alt="">
                                <p class="judul-card-artikel">
                                    Ini Prosedur Pengolahan Darah Sebelum Didonorkan
                                </p>
                                <p class="text-card-artikel">
                                    5 Causes of Fatigue when Wake Up 5 Causes of Fatigue when Wake Up
                                    5 Causes of Fatigue when Wake Up 5 Causes of Fatigue when Wake Up
                                </p>
                            </div>
                        </div>
                        
                        
                       
                    </div>
                </div>
        </div>
    </div>
@endsection