<!DOCTYPE html>
<html>
<head>
    <title>{{ $proje->proje_adi }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif; /* Türkçe karakter desteği için uygun yazı tipi */
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            margin-bottom: 20px; /* Header altındaki boşluk azaltıldı */
        }

        .header img {
            max-height: 80px; /* Logoyu küçülterek alan açıyoruz */
            margin-bottom: 5px;
        }

        h1, h2, h3, h4 {
            color: #555;
            margin-bottom: 10px; /* Başlıkların altındaki boşluklar azaltıldı */
        }

        .content {
            padding: 10px 20px; /* İçeriğe biraz daha boşluk bırakarak sayfa genişliğini artırıyoruz */
        }

        .section-title {
            font-size: 18px; /* Başlık fontu küçültüldü */
            color: #0066cc;
            border-bottom: 2px solid #0066cc;
            padding-bottom: 5px;
            margin-bottom: 15px; /* Başlık altındaki boşluk azaltıldı */
            text-transform: uppercase;
        }

        .info-table, .product-table, .notes-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px; /* Tabloların altındaki boşluk azaltıldı */
        }

        .info-table th, .product-table th, .notes-table th {
            background-color: #f2f2f2;
            padding: 8px; /* Hücre içi boşluklar azaltıldı */
            text-align: left;
            font-size: 12px; /* Font boyutları küçültüldü */
            border-bottom: 1px solid #ddd;
            width: %25;
        }

        .info-table th {
            flex: row;
            width: 150px;
        }

        .info-table td, .product-table td, .notes-table td {
            padding: 8px; /* Hücre içi boşluklar azaltıldı */
            font-size: 12px; /* Font boyutları küçültüldü */
            border-bottom: 1px solid #ddd;
        }

        .product-table th, .product-table td, .notes-table th, .notes-table td {
            text-align: center;
            font-size: 8px;
        }


        .footer {
            text-align: center;
            font-size: 10px; /* Altbilgi fontu küçültüldü */
            color: #999;
            margin-top: 40px; /* Altbilgi üstündeki boşluk azaltıldı */
            position: fixed;
            bottom: 0px;
            width: 100%;
        }

        .notes-table ul {
            list-style-type: none;
            padding-left: 0;
            margin: 0;
        }

        .notes-table li {
            font-size: 12px; /* Sipariş notları font boyutu */
            margin-bottom: 5px;
        }
    </style>
</head>
<body>

    <!-- Header (Logo) -->
    <div class="header">
        <img src="{{ public_path('admin/dist/img/PDF_LOGO.png   ') }}" alt="Logo">
    </div>

    <!-- Content -->
    <div class="content">

        <!-- Proje Bilgileri -->
        <div class="section">
            <h2 class="section-title">Proje Bilgileri</h2>
            <table class="info-table">
                <tr>
                    <th>Proje Kodu:</th>
                    <td>{{ $proje->proje_kodu }}</td>
                </tr>
                <tr>
                    <th>Proje Adı:</th>
                    <td>{{ $proje->proje_adi }}</td>
                </tr>
                <tr>
                    <th>Müşteri:</th>   
                    <td>{{ $proje->musteri }}</td>
                </tr>
                <tr>
                    <th>Proje Süreci:</th>
                    <td>{{ $proje->surec }}</td>
                </tr>
            </table>
        </div>

        <!-- Ürün Bilgileri -->
        <div class="section">
            <h2 class="section-title">Ürün Bilgileri</h2>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Ürün Adı</th>
                        <th>Ral Kodu</th>
                        <th>Kumaş Cinsi</th>
                        <th>Kumaş Profil Ral</th>
                        <th>Led Model</th>
                        <th>Motor Model</th>
                        <th>Kumanda</th>
                        <th>Flanş</th>
                        <th>Arka Çelik</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proje->urunler as $urun)
                    <tr>
                        <td>{{ $urun->urun_name }}</td>
                        <td>{{ $urun->ral_kodu }}</td>
                        <td>{{ $urun->kumas_cinsi }}</td>
                        <td>{{ $urun->kumas_profil_ral }}</td>
                        <td>{{ $urun->led_model }}</td>
                        <td>{{ $urun->motor_model }}</td>
                        <td>{{ $urun->kumanda }}</td>
                        <td>{{ $urun->flans }}</td>
                        <td>{{ $urun->arka_celik }}</td>
                        

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Sipariş Notları -->
        <div class="section">
            <h2 class="section-title">Sipariş Notları</h2>
            <table class="notes-table">
                <ul>
                    @foreach ($siparisNotlari as $note)
                        <li>{{ $note->not }}</li>
                    @endforeach
                </ul>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
