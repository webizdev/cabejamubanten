-- =====================================================
-- PT Cabe Jamu Banten - Database Export
-- Generated: 2026-04-17
-- MySQL 5.7 | Database: alilogis_cabejamubanten
-- =====================================================

CREATE DATABASE IF NOT EXISTS `alilogis_cabejamubanten`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE `alilogis_cabejamubanten`;

-- =====================================================
-- Table: site_settings
-- =====================================================

DROP TABLE IF EXISTS `site_settings`;

CREATE TABLE `site_settings` (
  `id`       INT(11)      NOT NULL AUTO_INCREMENT,
  `key_name` VARCHAR(50)  NOT NULL,
  `value`    LONGTEXT     NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key_name` (`key_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- Data: site_settings
-- =====================================================

INSERT INTO `site_settings` (`key_name`, `value`) VALUES (
'site_data',
'{
  "hero": {
    "tag": "Eksportir & Produsen Terpercaya 2026",
    "title": "Melestarikan Warisan Jamu Banten Melalui Cabe Jamu",
    "sub": "Dedikasi kami dalam mengolah rempah tradisional Indonesia menjadi produk berkualitas tinggi untuk kesehatan dunia.",
    "bg": "assets/img-2.png"
  },
  "cultivation": [
    {"title": "Lahan Perkebunan Cabe Jamu",       "img": "assets/img-3.jpeg"},
    {"title": "Persiapan Bibit Unggul",            "img": "assets/img-4.jpeg"},
    {"title": "Penanaman Organik",                 "img": "assets/img-5.jpeg"},
    {"title": "Sistem Pengairan Modern",           "img": "assets/img-6.jpeg"},
    {"title": "Pertumbuhan Vegetatif",             "img": "assets/img-7.jpeg"},
    {"title": "Pemantauan Kesehatan Tanaman",      "img": "assets/img-8.jpeg"},
    {"title": "Proses Pembungaan",                 "img": "assets/img-9.jpeg"},
    {"title": "Buah Cabe Jamu Muda",               "img": "assets/img-10.jpeg"},
    {"title": "Perawatan Intensif",                "img": "assets/img-11.jpeg"},
    {"title": "Teknik Pemangkasan",                "img": "assets/img-12.jpeg"},
    {"title": "Pemberian Nutrisi Alami",           "img": "assets/img-13.jpeg"},
    {"title": "Kematangan Buah Optimal",           "img": "assets/img-14.jpeg"},
    {"title": "Masa Panen Raya",                   "img": "assets/img-15.jpeg"},
    {"title": "Pemetikan Tradisional",             "img": "assets/img-16.jpeg"},
    {"title": "Hasil Panen Berkualitas",           "img": "assets/img-17.jpeg"},
    {"title": "Sortasi Grade A",                   "img": "assets/img-18.jpeg"},
    {"title": "Pembersihan Pasca Panen",           "img": "assets/img-19.jpeg"},
    {"title": "Persiapan Pengeringan",             "img": "assets/img-20.jpeg"},
    {"title": "Penjemuran Higienis",               "img": "assets/img-21.jpeg"},
    {"title": "Kontrol Kadar Air",                 "img": "assets/img-22.jpeg"},
    {"title": "Pengeringan Sinar Matahari",        "img": "assets/img-23.jpeg"},
    {"title": "Hasil Kering Sempurna",             "img": "assets/img-24.jpeg"},
    {"title": "Aroma Rempah Khas",                 "img": "assets/img-25.jpeg"},
    {"title": "Kualitas Rempah Banten",            "img": "assets/img-26.jpeg"},
    {"title": "Penyimpanan Gudang Steril",         "img": "assets/img-27.jpeg"},
    {"title": "Proses Penggilingan Bubuk",         "img": "assets/img-28.jpeg"},
    {"title": "Uji Laboratorium Mandiri",          "img": "assets/img-29.jpeg"},
    {"title": "Pelatihan Petani Mitra",            "img": "assets/img-30.jpeg"},
    {"title": "Edukasi Budidaya",                  "img": "assets/img-31.jpeg"},
    {"title": "Kunjungan Kebun",                   "img": "assets/img-32.jpeg"},
    {"title": "Kerjasama Kemitraan",               "img": "assets/img-33.jpeg"},
    {"title": "Distribusi Nasional",               "img": "assets/img-34.jpeg"},
    {"title": "Persiapan Ekspor Luar Negeri",      "img": "assets/img-35.jpeg"},
    {"title": "Keunggulan Cabe Jamu Banten",       "img": "assets/img-36.jpeg"},
    {"title": "Warisan Rempah Nusantara",          "img": "assets/img-37.jpeg"},
    {"title": "Pusat Pelatihan Cabe Jamu",         "img": "assets/img-38.jpeg"}
  ],
  "products": [
    {
      "id": 1,
      "title": "Cabe Jamu (Long Pepper)",
      "desc": "Piper Retrofractum Vahl pilihan, tersedia dalam bentuk kering utuh dan bubuk murni.",
      "img": "assets/img-39.jpeg",
      "badge": "Premium"
    },
    {
      "id": 2,
      "title": "Kopi Tunjuk Langit",
      "desc": "Ramuan kopi herbal khusus untuk stamina pria dewasa. Formula tradisional dengan sentuhan teknologi modern.",
      "img": "assets/img-40.jpeg",
      "badge": "Best Seller"
    },
    {
      "id": 3,
      "title": "Sapan Tea",
      "desc": "Minuman herbal eksotis dari kayu Secang pilihan. Memberikan kesegaran alami dan kaya akan antioksidan.",
      "img": "assets/img-41.jpeg",
      "badge": "Terbaru"
    }
  ],
  "services": {
    "title": "Pusat Budidaya & <br><span class=\"text-[#c89d10]\">Pelatihan Cabe Jamu</span>",
    "desc": "Kami tidak hanya menjual produk, tetapi juga mengedukasi masyarakat untuk melestarikan tanaman berkhasiat ini.",
    "items": [
      {"icon": "fa-seedling",      "title": "Jual Bibit Cabe Jamu",   "desc": "Bibit unggul hasil riset perkebunan mandiri."},
      {"icon": "fa-graduation-cap","title": "Pelatihan & Workshop",   "desc": "Materi budidaya Cabe Jamu serta teknik pengolahan."},
      {"icon": "fa-handshake",     "title": "Kemitraan & Kerjasama",  "desc": "Membuka peluang ekspor dan supply chain bagi petani lokal."}
    ],
    "gallery": [
      "assets/img-42.jpeg",
      "assets/img-38.jpeg"
    ]
  },
  "stats": [
    {"val": "15+",  "label": "Tahun Pengalaman"},
    {"val": "100%", "label": "Organik Alami"},
    {"val": "500+", "label": "Mitra Petani"},
    {"val": "24/7", "label": "Dukungan Teknis"}
  ],
  "contact": {
    "title": "Mulai Kerjasama Dengan Kami",
    "desc": "Hubungi tim kami untuk konsultasi produk atau pendaftaran pelatihan.",
    "wa": "6281229203967",
    "all_wa": ["081229203967", "085712306365", "081386578656"],
    "email": "cabejamubanten@gmail.com",
    "address": "Serang, Banten, Indonesia",
    "formOptions": ["Beli Cabe Jamu", "Beli Kopi Tunjuk Langit", "Beli Sapan Tea", "Pelatihan Budidaya", "Kemitraan Bisnis"]
  },
  "social": [
    {"platform": "Facebook",  "icon": "fa-facebook-f",  "link": "#"},
    {"platform": "Instagram", "icon": "fa-instagram",   "link": "#"},
    {"platform": "LinkedIn",  "icon": "fa-linkedin-in", "link": "#"}
  ]
}'
);

-- =====================================================
-- End of dump
-- =====================================================
