@extends('Layout.master')
@section('content')  
<div class="popup">
    <img src="{{asset('loading.gif')}}" width="50" alt=""></div>  
<div class="section">
    <div class="content">
        <div class="content1">
            <div class="left1">
                <div class="col-title">
                    <div class="text-ajakan1">AYO PILIH </div>
                    <ul class="text-ajakan2">
                        <li><span>KEBUTUHAN ATK MU</span></li>
                        <li><span>PRODUK BERKUALITAS</span></li>
                    </ul>
                    <div class="text-ajakan3">
                        Temukan produk ATK berkualitas dengan merk terpercaya hanya di sini! Waktunya upgrade kebutuhan ATK Anda
                        dengan pilihan terbaik. </div>
                </div>

                <div class="col-informasi">
                    <div class="informasi">
                        <div> <span class="angka1">12</span> <span class="plus">+</span></div>
                        <div>Merk Terpercaya</div>
                    </div>
                    <div class="informasi">
                        <div> <span class="angka2">2</span> <span class="plus">+</span></div>

                        <div>Metode Pembayaran</div>
                    </div>
                    <div class="informasi">
                        <div> <span class="angka3">839 </span> <span class="plus">+</span></div>

                        <div>Produk terjual perbulan</div>
                    </div>
                </div>
                <div class="col-btn-page1">
                    <a href="#content4"> <button class="btn-cari-kelas">Kunjungi Sekarang</button></a>
                    <a href="#content4">
                        <div class="icon-arrow-down">
                            <i class='bx bx-up-arrow-alt' style='color:#ffffff'></i>
                        </div>
                    </a>
                </div>
            </div>
            <div class="right1">
                <div class="box-right1">
                    <div class="kategori-text">JENIS</div>
                    <div class="judul-text">KERTAS</div>
                   <a href="#content4"> <div class="btn-kunjungi-right">Kunjungi</div></a>
                    <img src="{{ asset('kertas.png') }}" width="400" alt="">
                </div>
                <div class="col-box-right">
                    <div class="box-right2">
                        <div class="kategori-text2">JENIS</div>
                        <div class="judul-text2">ORDENER</div>
                      <a href="#content4"> <div class="btn-kunjungi-right2">Kunjungi</div></a> 
                        <img src="{{ asset('odner.png') }}" width="190" height="200" alt="">

                    </div>
                    <div class="box-right3">
                        <div class="kategori-text2">JENIS</div>
                        <div class="judul-text2">CALCULATOR</div>
                       <a href="#content4"> <div class="btn-kunjungi-right3">Kunjungi</div></a>
                        <img src="{{ asset('cal.png') }}" width="170" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="content2">
            <div class="box-content2">
                <div class="left-bc2"><img src="{{ asset('truck.png') }}" width="70" alt=""></div>
                <div class="right-bc2">
                    <div>Gratis pengiriman</div>
                    <div>Setelah 3 kali pemesanan</div>
                </div>
            </div>
            <div class="box-content2">
                <div class="left-bc2"><img src="{{ asset('time.png') }}" width="70" style="margin-top: -10px"
                        alt=""></div>
                <div class="right-bc2">
                    <div>Pengiriman</div>
                    <div>Cepat dan Aman</div>
                </div>
            </div>
            <div class="box-content2">
                <div class="left-bc2"><img src="{{ asset('cs.png') }}" width="50" alt=""></div>
                <div class="right-bc2">
                    <div>Response cepat</div>
                    <div>Response cepat 24/7 via WhatsApp</div>
                </div>
            </div>
            <div class="box-content2">
                <div class="left-bc2"><img src="{{ asset('payment.png') }}" width="50" alt=""></div>
                <div class="right-bc2">
                    <div>Pembayaran aman</div>
                    <div>Cash dan Transfer</div>
                </div>
            </div>
        </div>
        <div class="content3"  id="content4">
            <img src="{{ asset('teks.png') }}" width="1000" class="kaos-gab" alt="">
            <img src="{{ asset('logo.png') }}" width="270" class="logo-white" alt="">
            <div class="col-btn-page2">
                <a href="#content4"> <button class="btn-cari-kelas2">Lihat Produk Sekarang</button></a>
                <a href="#content4">
                    <div class="icon-arrow-down">
                        <i class='bx bx-up-arrow-alt' style='color: #FF3131'></i>
                    </div>
                </a>
            </div>
        </div>
       <div class="content4">
    <div class="title4">Produk Kami</div>
    <div class="sub-title4"></div>
    
   <!-- Search Bar -->
<div class="mt-3">
    <input type="text" id="searchInput" class="form-control rounded-3 w-100 custom-search" placeholder="Cari produk..." onkeyup="searchProducts()" />
</div>

<style>
    /* Menambahkan efek rounded pada input */
    .custom-search {
        border-radius: 1.5rem; /* Sudut yang lebih bulat */
        border: 1px solid #ccc; /* Warna border normal */
    }

    /* Menonaktifkan efek focus (border biru) */
    .custom-search:focus {
        border-color: #ccc; /* Tetap warna border saat fokus */
        box-shadow: none; /* Menghapus shadow focus */
    }

    /* Menambahkan gaya untuk pesan "Tidak ada produk" */
    .no-products {
        display: none; /* Secara default, sembunyikan pesan */
        font-size: 16px;
        color: #888;
        text-align: center;
        margin-top: 20px;
    }
</style>

<div class="col-card" id="productList">
    @foreach ($data as $item)      
    <div class="card" style="border: none" data-title="{{ strtolower($item->title) }}" data-motif="{{ strtolower($item->motif) }}">
        <div class="card-thumb">
            <img src="{{ asset($item->foto_produk) }}" width="120" alt="">
        </div>
        <div class="judul-card">{{$item->motif}}</div>
        <div class="desc-card">{{$item->title}}</div>
        <div class="col-btn-card">
            <a href="{{url('detail-produk/'.$item->id)}}" class="btn-cari-kelas3">Lihat Detail</a>
            <div class="harga">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
        </div>
    </div>
    @endforeach
</div>

<!-- Pesan "Tidak ada produk" -->
<div id="noProducts" class="no-products">Tidak ada produk yang ditemukan</div>

<script>
    function searchProducts() {
        var input, filter, productList, cards, title, motif, i, txtValue;
        input = document.getElementById('searchInput');
        filter = input.value.toLowerCase();
        productList = document.getElementById('productList');
        cards = productList.getElementsByClassName('card');
        var noProductsMessage = document.getElementById('noProducts');
        var visibleCount = 0; // Menyimpan jumlah produk yang terlihat

        for (i = 0; i < cards.length; i++) {
            title = cards[i].getAttribute('data-title');
            motif = cards[i].getAttribute('data-motif');
            if (title.includes(filter) || motif.includes(filter)) {
                cards[i].style.display = "";
                visibleCount++;
            } else {
                cards[i].style.display = "none";
            }
        }

        // Menampilkan atau menyembunyikan pesan "Tidak ada produk"
        if (visibleCount === 0) {
            noProductsMessage.style.display = "block"; // Tampilkan pesan jika tidak ada produk yang cocok
        } else {
            noProductsMessage.style.display = "none"; // Sembunyikan pesan jika ada produk yang cocok
        }
    }
</script>



    </div>

</div>
@endsection
