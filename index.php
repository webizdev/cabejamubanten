<?php
require_once 'db.php';

// Fetch site data
$siteData = null;
try {
    $stmt = $pdo->prepare("SELECT value FROM site_settings WHERE key_name = 'site_data'");
    $stmt->execute();
    $row = $stmt->fetch();
    if ($row) {
        $siteData = $row['value'];
    }
} catch (PDOException $e) {
    // Fallback to empty or default if needed
}
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PT Cabe Jamu Banten | Premium Long Pepper Exporter & Commodity Supplier</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="PT Cabe Jamu Banten is a leading exporter of premium Indonesian Long Pepper (Piper Retrofractum). Wholesale supplier of high-quality spices and agricultural commodities.">
    <meta name="keywords" content="cabe jamu exporter, long pepper supplier, piper retrofractum wholesale, indonesian spices commodity, exports banten, agricultural supplier indonesia, cabe jamu banten">
    <meta name="author" content="PT Cabe Jamu Banten">
    <link rel="canonical" href="https://cabejamubanten.my.id/">
    
    <!-- Google Site Verification -->
    <meta name="google-site-verification" content="GqtDzPT9Qpp5XYaKxRg1cNL3PzJJDRKLyC3Z64qAKaI" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://cabejamubanten.my.id/">
    <meta property="og:title" content="PT Cabe Jamu Banten | Premium Long Pepper Exporter">
    <meta property="og:description" content="Premium Indonesian Long Pepper (Cabe Jamu) Exporter & Supplier. High-quality agricultural commodities for global markets.">
    <meta property="og:image" content="https://cabejamubanten.my.id/assets/og.png">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://cabejamubanten.my.id/">
    <meta property="twitter:title" content="PT Cabe Jamu Banten | Premium Long Pepper Exporter">
    <meta property="twitter:description" content="Premium Indonesian Long Pepper (Cabe Jamu) Exporter & Supplier. High-quality agricultural commodities for global markets.">
    <meta property="twitter:image" content="https://cabejamubanten.my.id/assets/og.png">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://cabejamubanten.my.id/assets/favicon.png">
    <link rel="apple-touch-icon" href="https://cabejamubanten.my.id/assets/favicon.png">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400;0,700;1,400&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --jamu-green: #1b4332;
            --jamu-gold: #c89d10;
            --jamu-earth: #fdf8f1;
            --jamu-wood: #582f0e;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--jamu-earth);
            color: #2d3436;
        }

        h1,
        h2,
        h3,
        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .text-glow {
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.8);
        }

        .transition-all {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(-100% / 2));
            }
        }

        .animate-ticker {
            display: flex;
            width: max-content;
            animation: scroll 60s linear infinite;
        }

        .animate-ticker:hover {
            animation-play-state: paused;
        }
    </style>
    
    <!-- JSON-LD Structured Data -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "PT Cabe Jamu Banten",
      "url": "https://cabejamubanten.my.id/",
      "logo": "https://cabejamubanten.my.id/assets/img-1.png",
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+6281229203967",
        "contactType": "customer service",
        "areaServed": "ID",
        "availableLanguage": ["Indonesian", "English"]
      },
      "sameAs": [
        "https://facebook.com/cabejamubanten",
        "https://instagram.com/cabejamubanten"
      ]
    }
    </script>
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "LocalBusiness",
      "name": "PT Cabe Jamu Banten",
      "image": "https://cabejamubanten.my.id/assets/og.png",
      "@id": "https://cabejamubanten.my.id/",
      "url": "https://cabejamubanten.my.id/",
      "telephone": "+6281229203967",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Serang",
        "addressLocality": "Banten",
        "addressCountry": "ID"
      },
      "geo": {
        "@type": "GeoCoordinates",
        "latitude": -6.1104,
        "longitude": 106.1541
      },
      "openingHoursSpecification": {
        "@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday"
        ],
        "opens": "08:00",
        "closes": "17:00"
      }
    }
    </script>
</head>

<body class="overflow-x-hidden">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300 px-4 md:px-6 py-4" id="navbar">
        <div class="max-w-7xl mx-auto flex justify-between items-center glass rounded-full px-4 md:px-8 py-3 shadow-sm">
            <div class="flex items-center gap-2">
                <img src="assets/img-1.png" alt="Logo PT Cabe Jamu Banten" class="h-12 md:h-16 w-auto object-contain">
            </div>
            <div class="hidden md:flex gap-8 font-medium">
                <a href="#home" class="hover:text-[#c89d10] transition-colors">Beranda</a>
                <a href="#produk" class="hover:text-[#c89d10] transition-colors">Produk</a>
                <a href="#layanan" class="hover:text-[#c89d10] transition-colors">Pelatihan</a>
                <a href="#kontak" class="hover:text-[#c89d10] transition-colors">Kontak</a>
            </div>
            <div class="flex items-center gap-4">
                <a id="nav-wa" href="#" target="_blank"
                    class="hidden sm:block bg-[#1b4332] text-white px-6 py-2 rounded-full font-semibold hover:bg-[#c89d10] transition-all">Hubungi
                    Kami</a>
                <button id="mobile-menu-btn" class="md:hidden text-[#1b4332] p-2">
                    <i class="fas fa-bars text-xl"></i>
                </button>
            </div>
        </div>
    </nav>

    <!-- Floating WhatsApp -->
    <a id="float-wa" href="#" target="_blank"
        class="fixed bottom-8 right-8 z-[60] bg-[#25d366] text-white w-16 h-16 rounded-full flex items-center justify-center shadow-2xl hover:scale-110 transition-transform animate-bounce">
        <i class="fab fa-whatsapp text-3xl"></i>
    </a>

    <!-- Hero Section -->
    <section id="home" class="relative h-screen flex items-center justify-center text-white bg-cover bg-center">
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-[#fdf8f1]"></div>
        <div class="relative z-10 text-center px-4 max-w-4xl">
            <span id="hero-tag" class="inline-block px-4 py-1 border border-white/30 rounded-full mb-6 glass text-sm uppercase tracking-widest animate-pulse">Eksportir & Produsen Terpercaya 2026</span>
            <h1 id="hero-title" class="text-5xl md:text-7xl font-bold mb-6 leading-tight text-glow">Melestarikan Warisan
                Jamu Banten</h1>
            <p id="hero-sub" class="text-lg md:text-xl mb-10 text-white font-medium text-glow max-w-2xl mx-auto italic">
                Dedikasi kami dalam mengolah rempah tradisional Indonesia.</p>
            <div class="flex flex-col md:flex-row gap-4 justify-center">
                <a href="#produk"
                    class="bg-[#c89d10] text-white px-10 py-4 rounded-full text-lg font-bold hover:bg-[#1b4332] transition-all flex items-center justify-center gap-2 shadow-lg">
                    Lihat Produk <i class="fas fa-arrow-right"></i>
                </a>
                <a href="#layanan"
                    class="glass text-[#1b4332] border-white px-10 py-4 rounded-full text-lg font-bold hover:bg-white transition-all flex items-center justify-center gap-2">
                    Pelatihan Budidaya
                </a>
            </div>
        </div>
    </section>

    <!-- Cultivation Highlight Slider -->
    <section id="cultivation-slider" class="py-12 bg-white/50 backdrop-blur-sm overflow-hidden">
        <div class="px-6 mb-8 max-w-7xl mx-auto">
            <h2 class="text-2xl font-bold text-[#1b4332]">Budidaya Cabe Jamu</h2>
            <p class="text-sm text-gray-500 italic">Dokumentasi proses pertanian organik kami (Auto-looping Gallery)</p>
        </div>
        <div class="relative overflow-hidden group">
            <div id="slider-container" class="animate-ticker gap-6 flex">
                <!-- Dynamic Slider Cards -->
            </div>
        </div>
    </section>

    <!-- Products -->
    <section id="produk" class="py-24 px-6 max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold mb-4 text-[#1b4332]">Produk Unggulan Kami</h2>
            <div class="w-24 h-1 bg-[#c89d10] mx-auto mb-6"></div>
            <p class="text-gray-600 max-w-2xl mx-auto italic font-serif">Kualitas rempah pilihan dari tanah Banten untuk
                vitalitas dan kesehatan optimal.</p>
        </div>
        <div id="product-container" class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Dynamic Content -->
        </div>
    </section>

    <!-- Services -->
    <section id="layanan" class="py-24 bg-[#1b4332] text-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex flex-col md:flex-row items-center gap-16">
                <div class="md:w-1/2">
                    <h2 id="service-title" class="text-4xl md:text-5xl font-bold mb-6 leading-tight"></h2>
                    <p id="service-desc" class="text-lg text-white/80 mb-8 leading-relaxed"></p>
                    <div id="service-list" class="space-y-6">
                        <!-- Dynamic Content -->
                    </div>
                </div>
                <div class="md:w-1/2 grid grid-cols-2 gap-4" id="service-gallery">
                    <!-- Dynamic Images -->
                </div>
            </div>
        </div>
    </section>

    <!-- Stats -->
    <section class="py-24 px-6 bg-[#fdf8f1]">
        <div class="max-w-7xl mx-auto">
            <div id="stats-container" class="grid md:grid-cols-4 gap-8">
                <!-- Dynamic Content -->
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="kontak" class="py-24 px-6 max-w-7xl mx-auto">
        <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden flex flex-col md:flex-row">
            <div id="contact-info-bg" class="md:w-1/2 p-12 md:p-16 bg-[#c89d10]">
                <h2 id="contact-title" class="text-4xl font-bold mb-6 text-black"></h2>
                <p id="contact-desc" class="mb-10 text-[#1b4332] font-bold"></p>
                <div id="contact-details" class="space-y-6">
                    <!-- Dynamic Content -->
                </div>
            </div>
            <div class="md:w-1/2 p-12 md:p-16">
                <form id="contactForm" class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                        <input type="text" required class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#1b4332] outline-none" placeholder="Masukkan nama Anda">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Subjek Ketertarikan</label>
                        <select id="form-options" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#1b4332] outline-none">
                            <!-- Dynamic Content -->
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Pesan</label>
                        <textarea required class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-[#1b4332] outline-none h-32" placeholder="Apa yang bisa kami bantu?"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-[#1b4332] text-white py-4 rounded-xl font-bold hover:bg-[#c89d10] transition-all shadow-lg">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-16 px-6">
        <div class="max-w-7xl mx-auto text-center md:text-left">
            <div class="flex flex-col md:flex-row justify-between items-center border-b border-gray-800 pb-10 mb-10">
                <div class="mb-6 md:mb-0">
                    <div class="flex items-center justify-center md:justify-start gap-4 mb-4">
                        <img src="assets/img-1.png" alt="Logo PT Cabe Jamu Banten" class="h-20 w-auto object-contain">
                    </div>
                    <p id="footer-tagline" class="text-gray-400 max-w-sm mx-auto md:mx-0"></p>
                </div>
                <div id="social-links" class="flex gap-6">
                    <!-- Dynamic Icons -->
                </div>
            </div>
            <div class="flex flex-col md:flex-row justify-between items-center text-sm text-gray-500">
                <p><span id="adminTrigger" class="cursor-pointer hover:text-white transition-colors p-2 inline-block">&copy;</span>
                    2026 PT Cabe Jamu Banten.</p>
                <div class="flex gap-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        const currentData = <?php echo $siteData ?: 'null'; ?>;
        
        // --- RENDER ENGINE ---
        function renderSite() {
            if (!currentData) return;

            // Hero
            document.getElementById('home').style.backgroundImage = `url('${currentData.hero.bg}')`;
            document.getElementById('hero-tag').innerText = currentData.hero.tag;
            document.getElementById('hero-title').innerText = currentData.hero.title;
            document.getElementById('hero-sub').innerText = currentData.hero.sub;

            // Slider (Budidaya)
            const sliderContainer = document.getElementById('slider-container');
            const tickerItems = [...currentData.cultivation, ...currentData.cultivation];
            sliderContainer.innerHTML = tickerItems.map(c => `
                <div class="min-w-[280px] md:min-w-[450px]">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-xl border border-gray-100 group relative mr-6">
                        <div class="h-64 overflow-hidden">
                            <img src="${c.img}" alt="${c.title} - Budidaya Cabe Jamu Banten" class="w-full h-full object-cover group-hover:scale-110 transition-all duration-700">
                        </div>
                    </div>
                </div>
            `).join('');

            // Products
            const prodContainer = document.getElementById('product-container');
            prodContainer.innerHTML = currentData.products.map(p => `
                <div class="bg-white rounded-[2rem] overflow-hidden shadow-xl hover:translate-y-[-10px] transition-all group">
                    <div class="h-64 overflow-hidden relative">
                        <img src="${p.img}" alt="${p.title} - Produk Ekspor Premium" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute top-4 right-4 bg-[#c89d10] text-white px-3 py-1 rounded-full text-xs font-bold">${p.badge}</div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-bold mb-3 text-[#1b4332]">${p.title}</h3>
                        <p class="text-gray-500 text-sm mb-6">${p.desc}</p>
                        <button class="w-full border-2 border-[#1b4332] text-[#1b4332] py-3 rounded-xl font-bold hover:bg-[#1b4332] hover:text-white transition-all">Pesan Sekarang</button>
                    </div>
                </div>
            `).join('');

            // Services
            document.getElementById('service-title').innerHTML = currentData.services.title;
            document.getElementById('service-desc').innerText = currentData.services.desc;
            document.getElementById('service-list').innerHTML = currentData.services.items.map(s => `
                <div class="flex gap-4 p-5 bg-white/95 rounded-2xl shadow-xl transform hover:scale-105 transition-all">
                    <div class="w-12 h-12 bg-[#c89d10] rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fas ${s.icon} text-white text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-xl mb-1 text-black">${s.title}</h4>
                        <p class="text-sm text-[#1b4332] font-bold leading-relaxed">${s.desc}</p>
                    </div>
                </div>
            `).join('');
            
            document.getElementById('service-gallery').innerHTML = currentData.services.gallery.map((img, idx) => `
                <img src="${img}" alt="Fasilitas Pelatihan Budidaya Cabe Jamu Banten" class="rounded-3xl shadow-2xl h-80 w-full object-cover ${idx % 2 === 0 ? 'mt-12' : ''}">
            `).join('');

            // Stats
            document.getElementById('stats-container').innerHTML = currentData.stats.map(s => `
                <div class="text-center">
                    <div class="text-5xl font-bold text-[#1b4332] mb-2">${s.val}</div>
                    <p class="text-gray-500 font-serif italic uppercase tracking-wider text-xs">${s.label}</p>
                </div>
            `).join('');

            // Contact
            document.getElementById('contact-title').innerText = currentData.contact.title;
            document.getElementById('contact-desc').innerText = currentData.contact.desc;
            const waList = currentData.contact.all_wa || [];
            document.getElementById('contact-details').innerHTML = `
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center flex-shrink-0 shadow-sm"><i class="fab fa-whatsapp text-2xl text-[#1b4332]"></i></div>
                    <div>
                        <p class="text-sm font-bold text-black uppercase tracking-wider">WhatsApp Tim Kami</p>
                        ${waList.map(num => `<p class="font-bold leading-tight mt-1 text-[#1b4332]">${num}</p>`).join('')}
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center flex-shrink-0 shadow-sm"><i class="fas fa-envelope text-xl text-[#1b4332]"></i></div>
                    <div><p class="text-sm font-bold text-black uppercase tracking-wider">Email Kami</p><p class="font-bold text-[#1b4332]">${currentData.contact.email}</p></div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center flex-shrink-0 shadow-sm"><i class="fas fa-map-marker-alt text-xl text-[#1b4332]"></i></div>
                    <div><p class="text-sm font-bold text-black uppercase tracking-wider">Kantor</p><p class="font-bold text-[#1b4332]">${currentData.contact.address}</p></div>
                </div>
            `;
            document.getElementById('form-options').innerHTML = currentData.contact.formOptions.map(o => `<option>${o}</option>`).join('');
            document.getElementById('nav-wa').href = `https://wa.me/${currentData.contact.wa}`;
            document.getElementById('float-wa').href = `https://wa.me/${currentData.contact.wa}`;

            // Footer
            document.getElementById('social-links').innerHTML = currentData.social.map(s => `
                <a href="${s.link}" class="w-10 h-10 rounded-full border border-gray-700 flex items-center justify-center hover:bg-[#c89d10] hover:border-[#c89d10] transition-all"><i class="fab ${s.icon}"></i></a>
            `).join('');
        }

        // --- ADMIN TRIGGER ---
        document.getElementById('adminTrigger').onclick = () => {
             window.location.href = 'admin.php';
        };

        // --- INIT ---
        window.addEventListener('scroll', () => {
            const nav = document.getElementById('navbar');
            if (window.scrollY > 50) nav.querySelector('div').classList.add('shadow-md');
            else nav.querySelector('div').classList.remove('shadow-md');
        });

        document.getElementById('contactForm').onsubmit = (e) => {
            e.preventDefault();
            alert('Pesan terkirim! Tim kami akan segera memproses permintaan Anda.');
            e.target.reset();
        };

        renderSite();
    </script>
</body>

</html>
