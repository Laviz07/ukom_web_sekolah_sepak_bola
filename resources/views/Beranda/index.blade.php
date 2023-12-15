@extends('layouts.layout')
@section('title', 'Beranda')
@section('content')   

<div class="container mt-1 mb-4">
    <div id="#">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center" >
                <div class="row" >
                    <span class="text-uppercase judul2">Website Managemen</span>
                    <span class="text-uppercase  judul1">sekolah sepak bola</span>

                    <span class="mt-4 ">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </span>

                    <div class="mt-4">
                        <a href="#tentangKami" class="btn btn-primary ">Tentang Kami</a>
                        <a href="#hubungiKami" class="btn btn-outline-primary ms-3">Hubungi Kami</a>
                    </div>
                </div>
            </div>

             <div class="col-md-6">
                <img src="{{ asset('images/landing_img.jpg') }}" alt="Sepak Bola" width="600">
            </div>

        </div>

    <div id="tentangKami">
        <div class="row mt-5">
            <span class=" judul1 text-uppercase judul2" style="text-align: center; padding: 20px">Tentang Kami</span>

            <div class="col-md-6  mt-4">
                <img 
                    src="{{ asset('images/main_bola.jpeg') }}"
                    alt="sekolah sepak bola" width="450" class="rounded">
            </div>

            <div class="col-md-6 d-flex align-items-center">
                <span style="font-size: 16px;">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
                    when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, 
                    and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </span>
            </div>
        </div>

        <div class="row mt-5 align-items-center" >
            <div class="card col-md-12 p-3" style="border: 2px solid #003459; text-align: center;" >
                <span class=" text-uppercase judul2">VISI</span>
                <span class="mt-4" style="font-size: 16px;">“MENJADI SMK YANG MENGHASILKAN SDM KOMPETEN, BERKARAKTER, DAN IHSAN”</span>
            </div>

            <div class="card p-3 mt-5" style="border: 2px solid #003459" >
                <span class=" text-uppercase judul2" style="text-align: center">misi</span>
                <span class="mt-4 ps-4 ">
                    <ol class="" style="width:900px; padding-left: 10%; font-size: 16px;" >
                        <li>Melaksanakan Sistem Manajemen Mutu ISO 9001 : 2015</li>
                        <li>Membudayakan pengamalan nilai-nilai agama dalam setiap aspek kehidupan seluruh warga sekolah.</li>
                        <li>Menyelenggarakan pendidikan formal kejuruan untuk menghasilkan lulusan yang berkarakter, cerdas, inovatif , kreatif, sesuai dengan tuntutan dunia industri dan mampu berwirausaha.</li>
                        <li>Meningkatkan kualitas tenaga pendidik dan kependidikan sesuai kualifikasi dan kompetensi standar.</li>
                        <li>Menyelenggarakan Lembaga Sertifikasi Profesi dan Tempat Uji Kompetensi sesuai dengan bidang kompetensi</li>
                        <li>Menyelenggarakan sekolah Berbudaya lingkungan</li>
                    </ol>
                </span>
            </div>
        </div>
    </div>

    <di id="hubungiKami">
        <div class="row mt-5">
            <span class=" judul1 text-uppercase judul2" style="text-align: center">Hubungi Kami</span>

            <div class="col-md-6 card mt-4 align-items-center" style="width: 500px;">
                
                <img 
                src="{{ asset('images/stadion.jpg') }}"
                    alt="Stadion" width="450" class="rounded p-2 pt-4">
                
                <div class="row p-3">
                    <span class="h4" style="font-weight: 700; font-size: 26px">
                        <i class="bi bi-geo-alt"></i>
                        Stadion Lorem Ipsum
                    </span>
                    <span class="mt-2">
                        Jalan Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                        sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </span>
                </div>
            </div>

            <div class="col-md-6 mt-5 ms-5 offset-md-6" style="font-size: 20px; vertical-align: middle;">
                <div class="row p-5">
                    
                    <div class="col-md-12 mt-3">
                        <i class="bi bi-whatsapp" style="font-size: 40px;  vertical-align: middle;"></i>
                        <span class="ms-3"> +62 1234567890 </span>
                    </div>

                    <div class="col-md-12 mt-3">
                        <i class="bi bi-envelope" style="font-size: 40px;  vertical-align: middle;"></i>
                        <span class="ms-3"> sekolahbola@gmail.com </span>
                    </div>

                    <div class="col-md-12 mt-3">
                        <i class="bi bi-instagram" style="font-size: 40px;  vertical-align: middle;"></i>
                        <span class="ms-3"> @sekolahbolakita </span>
                    </div>

                    <div class="col-md-12 mt-3">
                        <i class="bi bi-facebook" style="font-size: 40px;  vertical-align: middle;"></i>
                        <span class="ms-3"> Sekolah Bola </span>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>
<div class="col d-flex justify-content-end mb-2 mt-3">
    <a href="{{ url('#', []) }}" class="position-fixed z-10 bottom-0 end-0">
        <i class="bi bi-arrow-up-circle bi-3x" style="font-size: 35px; margin: 30px; color:black;"></i>
    </a>
</div>
@endsection