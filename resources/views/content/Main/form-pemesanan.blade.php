@extends('layouts.mainLayout')

@section("css")
<link rel="stylesheet" href="{{ asset("assets/css/servis.css") }}">
<link rel="stylesheet" href="{{asset("assets/css/form-pem.css")}}">
<style>
    .addons {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px 0;
}

.btn-detail-paket {
    background: linear-gradient(135deg, #2C4257 0%, #1b3549 100%);
    color: white;
    border: none;
    padding: 14px 30px;
    border-radius: 12px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(44, 66, 87, 0.3);
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.btn-detail-paket:hover {
    background: linear-gradient(135deg, #1b3549 0%, #0f1f2e 100%);
    box-shadow: 0 6px 20px rgba(44, 66, 87, 0.5);
    transform: translateY(-2px);
}

.btn-detail-paket i {
    font-size: 18px;
}

/* Modal Styles (reuse from servis.blade.php) */
.modal1 {
    display: none;
    position: fixed;
    z-index: 2000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.7);
    padding-top: 60px;
    transition: opacity 0.3s;
}

.modal-content1 {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    margin: 5% auto;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    width: 90%;
    height: fit-content;
    max-width: 600px;
    position: relative;
    border: 1px solid rgba(44, 66, 87, 0.2);
    transform: translateY(20px);
    opacity: 0;
    transition: all 0.4s ease;
}

.modal-content1.show {
    transform: translateY(0);
    opacity: 1;
}

.modal-header1 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 15px;
    border-bottom: 2px solid #2c4257;
    margin-bottom: 20px;
}

.modal-title1 {
    color: #2c4257;
    font-size: 24px;
    font-weight: 700;
    margin: 0;
}

.close-modal1 {
    color: #2c4257;
    font-size: 32px;
    font-weight: bold;
    cursor: pointer;
    transition: transform 0.2s;
    background: none;
    border: none;
    padding: 0 5px;
}

.close-modal1:hover {
    transform: rotate(90deg);
    color: #572c2c;
}

.modal-body1 {
    margin: 20px 0;
}

.paket-price {
    font-size: 28px;
    font-weight: 800;
    color: #2c4257;
    text-align: center;
    margin: 15px 0;
    background: linear-gradient(45deg, #2c4257, #572c2c);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 2px 4px rgba(44, 66, 87, 0.1);
}

.paket-items {
    list-style-type: none;
    padding: 0;
    margin: 20px 0;
}

.paket-items li {
    background: white;
    margin: 8px 0;
    padding: 12px 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    border-left: 3px solid #2c4257;
    transition: all 0.2s;
    font-weight: 500;
    color: #333;
}

.paket-items li:hover {
    transform: translateX(5px);
    box-shadow: 0 3px 8px rgba(0,0,0,0.1);
}

.modal-footer {
    display: flex;
    gap: 15px;
    justify-content: center;
    margin-top: 25px;
    padding-top: 20px;
    border-top: 1px solid rgba(44, 66, 87, 0.1);
}

.btn-modal {
    flex: 1;
    padding: 14px;
    border-radius: 10px;
    font-size: 18px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
}

.btn-kembali {
    background: linear-gradient(45deg, #572c2c, #3e1f1f);
    color: white;
}

.btn-kembali:hover {
    background: linear-gradient(45deg, #3e1f1f, #2a1515);
    box-shadow: 0 6px 15px rgba(87, 44, 44, 0.4);
    transform: translateY(-2px);
}

@media (max-width: 600px) {
    .modal-content {
        width: 95%;
        padding: 20px;
        margin: 10% auto;
    }
    
    .modal-title {
        font-size: 20px;
    }
    
    .paket-price {
        font-size: 24px;
    }
    
    .btn-modal {
        font-size: 16px;
        padding: 12px;
    }
    
    .btn-detail-paket {
        font-size: 14px;
        padding: 12px 24px;
    }
}
</style>
@endsection
@section("content")
@php
    $image = App\Models\DetailLayananFoto::where("id_layanan_foto", $datas['layanan_foto']->id_layanan_foto)->get();
 @endphp


<div id="section-makesure"  style="background-image:linear-gradient(rgba(0, 0, 0, 0.678), rgba(0, 0, 0, 0.704)),url('{{ asset("assets/img/hero-section.jpg") }}')" class="section-makesure">
    <div>
        <h2 style="color:white">{{ $datas['paket']->nama_paket }}</h2>
    </div>
    <div class="makesure">
        <div class="detail-makesure">
            <div class="durasi">
                <div>
                    <h3>Durasi</h3>
                </div>
                <div>
                    <h1 style="font-size: 60px">
                        {{ $datas['paket']->durasi_pemotretan }}
                    </h1>
                </div>
                <div>
                    <h3 >Menit</h3>
                </div>
            </div>
            <div class="background">
                <div>
                    <h3>Background</h3>
                </div>
                <div class="background-image-makesure">
                    @if(count($datas['background_paket']) > 1)
                    <img src="{{asset("storage/".$datas['background_paket'][0]['background_url'])}}" alt="">

                    @else
                    <img src="{{asset("storage/".$datas['background_paket'][0]['background_url'])}}" alt="">
                    @endif
                </div>
                <div>
                    @if(count($datas['background_paket']) > 1)
                    <h5>{{ $datas['background_paket'][0]['background_name'] }}</h5>

                    @else
                    <h5>{{ $datas['background_paket'][0]['background_name'] }}</h5>
                    @endif
                </div>
            </div>
            <div class="addons">
                <button type="button" class="btn-detail-paket" onclick="openAddonModal()">
                    <i class="fa fa-info-circle"></i> Lihat Detail Paket
                </button>
            </div>
            </div>

        </div>
        <div class="action-makesure">
            <a href="{{Route("servis-index",$datas["slug"])}}"><button type="button" class="btn-secondary">Lihat Paket Lain</button></a>
            <button type="button" class="btn-primary" id="btn-pesan">Pesan Sekarang</button>
        </div>
    </div>
</div>

<form autocomplete="off" method="post" id="section-form" style="position: relative">
    @method("POST")
    @csrf

    <div class="modal" id="day-modal">
    <div class="modal-content" style="width: fit-content">
        <button type="button" style="margin: 2px;border:none;background:none">
            <span onclick="closeModal('day-modal')"  class="close">&times;</span>
        </button>
        <div class="select-container">
            <input type="text" class="select-input" placeholder="Pilih Add On" disabled>
            <div class="select-options">
                @foreach(App\Models\ServisTambahan::where("key", "day")->get() as $as)
                    <label style="font-size: 12px" class="select-option">
                        <input
                        type="checkbox"  value="{{$as->id_servis}}" type="checkbox" name="servis_tambahan[]" class="select-checkbox">  {{$as->nama_servis}} ({{ 'Rp ' . number_format((int)$as->harga_servis, 0, ',', '.') }})
                  </label>

                @endforeach
            </div>
          </div>

    </div>
 </div>

 <div class="modal" id="cetak-modal">
    <div class="modal-content" style="width: fit-content">
        <button type="button" style="margin: 2px;border:none;background:none">
            <span onclick="closeModal('cetak-modal')" class="close">&times;</span>
        </button>
        <div class="select-container">
            <input type="text" class="select-input" placeholder="Pilih Ukuran Foto Dan Jumlah Lembar Di Kanan" style="font-size: 10px" disabled>
            <div class="select-options">
                @foreach(App\Models\ServisTambahan::where("key", "cetak")->get() as $as)
                    <label style="font-size: 12px;display:flex;justify-content:space-between" class="select-option">
                        <div>
                        <input
                        type="checkbox"  value="{{$as->id_servis}}" type="checkbox" name="servis_tambahan[]" class="select-checkbox">  {{$as->nama_servis}} ({{ 'Rp ' . number_format((int)$as->harga_servis, 0, ',', '.') }})
                        </div>
                        <input type="text" name="lembar_foto[]" style="width:30px">
                        <input type="hidden" name="id_servis_lembar[]"  value="{{$as->id_servis}}">
                  </label>


                @endforeach
            </div>
          </div>

    </div>
 </div>

 <div class="modal" id="file-modal">
    <div class="modal-content" style="width: fit-content">
        <button type="button" style="margin: 2px;border:none;background:none">
            <span onclick="closeModal('file-modal')" class="close">&times;</span>
        </button>
            <div class="select-container">
            <input type="text" class="select-input" placeholder="Pilih Add On" disabled>
            <div class="select-options">
                @foreach($datas['file_sent'] as $as)
                    <label style="font-size: 10px" class="select-option">
                        <input
                        type="checkbox"  value="{{$as->id_file_sent}}" type="checkbox" name="file_sent[]" class="select-checkbox">  {{$as->nama_file_sent}} ({{ 'Rp ' . number_format((int)$as->harga_file_sent, 0, ',', '.') }})
                  </label>

                @endforeach
            </div>
          </div>

    </div>
 </div>

 <div class="modal" id="makeup-modal">
    <div class="modal-content" style="width: fit-content">
        <button type="button" style="margin: 2px;border:none;background:none">
            <span onclick="closeModal('makeup-modal')" class="close">&times;</span>
        </button>
        <div class="select-container">
            <input type="text" class="select-input" placeholder="Pilih Add On" disabled>
            <div class="select-options">
                @foreach(App\Models\ServisTambahan::where("key", "makeup")->get() as $as)
                    <label style="font-size: 12px" class="select-option">
                        <input
                        type="checkbox"  value="{{$as->id_servis}}" type="checkbox" name="servis_tambahan[]" class="select-checkbox">  {{$as->nama_servis}} ({{ 'Rp ' . number_format((int)$as->harga_servis, 0, ',', '.') }})
                  </label>

                @endforeach
            </div>
          </div>

    </div>
 </div>

  <div id="section-form-pemesanan-2" class="hidden section-form-bio">
    <h1>Add On</h1>

    <div class="addon-servis">
        <div class="addon" onclick="openModal('day-modal')">
            <i id="logo-addon" class="fa fa-calendar-o" aria-hidden="true"></i>
        </div>
        <div class="addon" onclick="openModal('cetak-modal')">
            <i id="logo-addon" class="fa fa-print" aria-hidden="true"></i>
        </div>
        <div class="addon" onclick="openModal('file-modal')">
            <i id="logo-addon" class="fa fa-file" aria-hidden="true"></i>
        </div>
        <div class="addon" onclick="openModal('makeup-modal')">
            <i id='logo-addon' class="fa fa-tint" aria-hidden="true"></i>
        </div>
    </div>
    <div>
        <button type="button" class="btn-secondary" id="btn-back-4">Kembali</button>
        <button type="button" id="btn-selanjutnya-5" class="btn-primary">Selanjutnya</button>
    </div>
</div>
    <!-- Section 1 -->
    <input type="hidden" name="paket_foto" value="{{$datas['paket']->id_paket}}">
    <div id="section-form-bio-0" class="section-form-bio hidden">
        <div class="ipt-container ipt-nama" style="width:90%;font-size: 20px;">
            <label for="nama"><b>Masukkan Nama Lengkap Anda</b></label><br>
            <input class="ipt-form" type="text" name="nama_lengkap" id="nama">
        </div>
        <div class="ipt-container ipt-wa" style="width:90%;font-size: 20px;">
            <label for="wa"><b>Masukkan Nomor WA Anda</b>
                <br>
                <i style="font-size:14px">Pastikan Nomor whatsapp Benar Agar Invoice Bisa Dikirim</i>
            </label><br>
            <input class="ipt-form" 
        type="text" 
        name="no_wa" 
        id="wa"
        inputmode="numeric"
        pattern="[0-9]+"
        title="Hanya boleh memasukkan angka"
        placeholder="62858xxxxx"
        oninput="this.value = this.value.replace(/[^0-9]/g, '')"
        maxlength="15">
        </div>
        <div class="ipt-container ipt-ig" style="width:90%;font-size: 20px;">
            <label for="instagram"><b>Masukkan Akun IG Anda</b><br>                <i style="font-size:14px">Pastikan Akun Instagram Valid</i></label><br>
            <input class="ipt-form" type="text" name="instagram" id="instagram">
        </div>
        <input type="hidden" name="member_id">
        <input type="hidden" name="foto_kartu_member">
        <div>
            <button type="button" class="btn-secondary" id="btn-back-0">Kembali</button>
            <button type="button" class="btn-primary" id="btn-selanjutnya-1">Selanjutnya</button>
        </div>
    </div>

    <!-- Section 2 -->
    <div id="section-form-bio-1" class="section-form-bio hidden">
        <div class="ipt-container ipt-rek" style="width:90%;font-size: 20px;">
            <label for="norek"><b>Masukkan No Rekening Anda</b></label><br>
        <input 
                class="ipt-form" 
                type="text" 
                name="no_rekening" 
                id="norek"
                pattern="[0-9]+"
                title="Hanya boleh memasukkan angka"
                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
            >        
</div>
        <div class="ipt-container ipt-bank" style="width:90%;font-size: 20px;">
            <label for="bank"><b>Masukkan Nama Bank Anda</b>
            <br>
            <i style="font-size:14px">Gunakan Singkatan, contoh: BCA, BTPN</i>
            </label><br>
            <input class="ipt-form" type="text" name="nama_bank" id="bank">
        </div>
        <div>
            <button type="button" class="btn-secondary" id="btn-back-1">Kembali</button>
            <button type="button" class="btn-primary" id="btn-selanjutnya-2">Selanjutnya</button>
        </div>
    </div>

    <!-- Section 3 -->
    <div id="section-form-pemesanan-0" class="section-form-bio hidden">
        <div class="ipt-container ipt-rek" style="width:90%;font-size: 20px;">
            <label for="tanggal_booking"><b>Tanggal Pemotretan</b></label><br>
            <input class="ipt-form" type="date" name="tanggal_booking" id="tanggal_booking">
        </div>
        <div class="ipt-container ipt-rek" style="width:90%;font-size: 20px;">
            <label for="tanggal_booking"><b>Jam Pemotretan</b></label><br>
            <div style="display: flex;gap:15px" id="jadwal-container">
                <input disabled class="ipt-form" type="time"  min="08:00" max="17:00"  name="jam_booking" id="jam_booking" required>
                <i style="color:rgb(110, 176, 110);font-size:20px;display:none;" id="check-jadwal" class="fa fa-check" aria-hidden="true"></i>
                <i style="color:rgb(176, 110, 110);font-size:20px;display:none;" id="wrong-jadwal" class="fa fa-times" aria-hidden="true"></i>

            </div>
            <input type="hidden">
            <br>
            <div>
                <span style="text-decoration:underline;font-size:15px;cursor: pointer;"><a target="_blank" href="{{Route("kalender-index-main")}}" style="color:black"><i>Cek Kalender Pemotretan Untuk Melihat Jadwal Kosong</i></a></span>
            </div>
            </div>
        <div class="ipt-container ipt-rek" style="width:90%;font-size: 20px;">
            <label for="total_orang"><b>Total Orang</b></label><br>
            <input
            class="ipt-form"
            type="number"
            name="total_orang_foto"
            id="total_orang"
            pattern="\d+"
            title="Please enter a valid number."
            max="{{ $datas['paket']->tipe_paket == 0 ? 8 : ($datas['paket']->tipe_paket == 1 ? 12 : 15) }}"
        >
        </div>
        <div>
            <button type="button" class="btn-secondary" id="btn-back-2">Kembali</button>
            <button type="button" id="btn-selanjutnya-3" disabled class="btn-primary">Selanjutnya</button>
        </div>
    </div>
    <div id="section-form-pemesanan-1" class="section-form-bio hidden">
        <div class="ipt-background" style="font-size: 20px;">
            <label for="background"><b>Background Pemotretan</b></label><br>
            <br>
            <div class="background-form-list">
                @php
                    $background_paket_arr;
                    foreach($datas['background_paket'] as $bgp){
                        $background_paket_arr[] = $bgp['background_id'];
                    }
                @endphp
                @foreach($datas['background'] as $bg)
                        <figure>
                            <center>
                                <img src="{{ asset('storage/' . $bg->gambar_bg) }}" width="300" height="200">
                            </center>
                            <figcaption>
                                <input
                                    @if(in_array($bg->id_background, $background_paket_arr))
                                    checked
                                    @endif
                                    value="{{$bg->id_background}}"
                                    type="checkbox"
                                    name="background[]"
                                    id="background_check"> <!-- Ensure unique IDs -->
                                <span style="font-size:13px;text-align:center;">{{ $bg->nama_background }}</span>
                            </figcaption>
                        </figure>

                @endforeach

            </div>
        </div>
        <div>
            <button type="button" class="btn-secondary" id="btn-back-3">Kembali</button>
            <button type="button" id="btn-selanjutnya-4" class="btn-primary">Selanjutnya</button>
        </div>
    </div>

    <div id="section-form-pemesanan-3" class="section-form-bio hidden">
        <div class="ipt-container ipt-bank" style="width:90%;font-size: 20px;">
            <label for="bank"><b>Masukkan Catatan Anda Untuk Kami</b></label><br>
            <textarea  class="ipt-form" name="catatan" id="catatan_ta" cols="30" rows="10"></textarea>
        </div>
        <div class="ipt-container ipt-bank" style="width:90%;font-size: 20px;">
            <label for="bank"><b>Masukkan Refrensi Sebagai Pembantu</b></label><br>
            <textarea  class="ipt-form" name="referensi" id="referensi_ta" cols="30" rows="10"></textarea>
        </div>
        <div>
            <button type="button" class="btn-secondary" id="btn-back-5">Kembali</button>
            <button onclick="postPemesanan()" type="button" class="btn-primary">Submit</button>
        </div>
    </div>
</form>
<div id="addonModal" class="modal1">
    <div class="modal-content1">
        <div class="modal-header1">
            <h2 class="modal-title1">Detail Paket {{ $datas['paket']->nama_paket }}</h2>
            <button class="close-modal1" onclick="closeAddonModal()">&times;</button>
        </div>
        <div class="modal-body1">
            <div class="paket-price">{{ 'Rp ' . number_format((int)$datas['paket']->harga, 0, ',', '.') }}</div>
            <h3 style="color:#2c4257; text-align:center; margin:15px 0 10px">Benefit Paket:</h3>
            <ul class="paket-items">
                @foreach(explode(",", $datas['paket']->deskripsi) as $datasItem)
                    <li>{{ trim($datasItem) }}</li>
                @endforeach
            </ul>
        </div>
        <div class="modal-footer1">
            <button class="btn-modal btn-kembali" onclick="closeAddonModal()">
                <i class="fa fa-times"></i> Tutup
            </button>
        </div>
    </div>
</div>
@endsection

@section("js")
<script>
    headerStatus = false;
    hiddenFooter();

    document.addEventListener("DOMContentLoaded", function () {
        const totalOrangInput = document.getElementById("total_orang");

        totalOrangInput.addEventListener("input", function () {
            const tipePaket = {{ $datas['paket']->tipe_paket }};
            const maxAllowed = tipePaket === 0 ? 8 : tipePaket === 1 ? 12 : 15;
            const numberPattern = /^\d+$/;

            if (!numberPattern.test(totalOrangInput.value) || totalOrangInput.value > maxAllowed) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Jumlah Orang Melebihi Batas',
                    text: `Paket ini maksimal ${maxAllowed} orang.`,
                    confirmButtonText: 'OK'
                });
                totalOrangInput.value = '';
            }
        });

        window.addEventListener("load", () => {
            @if($datas['paket']->tipe_paket == 0)
                document.querySelectorAll("#background_check").forEach(element => {
                    if (!element.checked) {
                        element.disabled = true;
                    }
                });
            @endif
        });
    });

    document.getElementById('jam_booking').onchange = function() {
        cekJadwal();
    }

    document.getElementById('tanggal_booking').onchange = function() {
        document.getElementById('jam_booking').disabled = false;
    }

    function cekJadwal() {
        const jam_booking = document.getElementById('jam_booking');
        const tanggal_booking = document.getElementById('tanggal_booking');
        const loadingLayer = document.getElementById("loading-layer");
        const check = document.getElementById("check-jadwal");
        const wrong = document.getElementById("wrong-jadwal");

        loadingLayer.style.display = "flex";

        fetch(`{{ route('cek-jadwal') }}?tanggal_booking=${tanggal_booking.value}&jam_booking=${jam_booking.value}`, {
            method: 'GET',
            headers: { 'Content-Type': 'application/json' }
        })
        .then(response => {
            if (response.ok) {
                return response.json().then(data => ({ status: true, data }));
            } else {
                return response.json().then(data => ({ status: false, data }));
            }
        })
        .then(result => {
            loadingLayer.style.display = "none";
            if (result.status) {
                check.style.display = "block";
                wrong.style.display = "none";
                document.getElementById("btn-selanjutnya-3").disabled = false;
            } else {
                wrong.style.display = "block";
                check.style.display = "none";
                document.getElementById("btn-selanjutnya-3").disabled = true;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            loadingLayer.style.display = "none";
            Swal.fire({
                icon: 'error',
                title: 'Gagal Memeriksa Jadwal',
                text: 'Terjadi kesalahan saat memeriksa ketersediaan jadwal. Silakan coba lagi nanti.',
                confirmButtonText: 'OK'
            });
        });
    }

   function postPemesanan() {
    const formData = new FormData(document.getElementById("section-form"));
    const loadingLayer = document.getElementById("loading-layer");
    loadingLayer.style.display = "flex";

    fetch('{{ route("form-pemesanan-post") }}', {
        method: 'POST',
        body: formData,
        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
    })
    .then(async (response) => {
        const responseData = await response.json();
        
        if (!response.ok) {
            loadingLayer.style.display = "none";
            
            // Cek apakah error karena nomor WA tidak valid
            if (responseData.error_type === 'invalid_wa') {
                Swal.fire({
                    icon: 'error',
                    title: 'Nomor WhatsApp Tidak Valid',
                    text: responseData.message || 'Nomor WhatsApp yang Anda masukkan tidak valid. Silakan periksa kembali dan coba lagi.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#2c4257'
                });
            } else {
                // Error lainnya
                Swal.fire({
                    icon: 'error',
                    title: 'Pemesanan Gagal',
                    text: responseData.message || 'Gagal menyimpan pemesanan. Silakan coba lagi.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#2c4257'
                });
            }
            return;
        }
        
        // Berhasil
        loadingLayer.style.display = "none";
        window.location.href = "{{ route('success-index') }}";
    })
    .catch(error => {
        loadingLayer.style.display = "none";
        console.error("Fetch Error:", error);
        Swal.fire({
            icon: 'error',
            title: 'Koneksi Gagal',
            text: 'Tidak dapat menghubungi server. Periksa koneksi internet Anda.',
            confirmButtonText: 'OK',
            confirmButtonColor: '#2c4257'
        });
    });
}
</script>
<script src="{{asset("assets/js/form-pemesanan.js")}}"></script>
<script defer src="{{asset("assets/js/multiselect-dropdown.js")}}"></script>
<script>
function openAddonModal() {
    const modal = document.getElementById('addonModal');
    modal.style.display = 'block';
    
    // Trigger animation
    setTimeout(() => {
        document.querySelector('#addonModal .modal-content1').classList.add('show');
    }, 10);
    
    // Prevent scrolling when modal is open
    document.body.style.overflow = 'hidden';
}

function closeAddonModal() {
    const modal = document.getElementById('addonModal');
    const modalContent = document.querySelector('#addonModal .modal-content1');
    
    // Remove animation class first
    modalContent.classList.remove('show');
    
    // Close modal after animation
    setTimeout(() => {
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }, 300);
}

// Close modal when clicking outside content
window.addEventListener('click', function(event) {
    const modal = document.getElementById('addonModal');
    if (event.target === modal) {
        closeAddonModal();
    }
});

// Handle ESC key to close modal
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const modal = document.getElementById('addonModal');
        if (modal.style.display === 'block') {
            closeAddonModal();
        }
    }
});
</script>
@endsection
