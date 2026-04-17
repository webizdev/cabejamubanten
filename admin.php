<?php
session_start();

// Auth Check
if (!isset($_SESSION['admin_logged_in'])) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
        if ($_POST['password'] === 'cabe') {
            $_SESSION['admin_logged_in'] = true;
            header('Location: admin.php');
            exit;
        } else {
            $loginError = "Password salah, coba lagi.";
        }
    }
    // Show login form
    ?>
    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Login | PT Cabe Jamu Banten</title>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
        <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
    </head>
    <body class="bg-[#1b4332] min-h-screen flex items-center justify-center p-6">
        <div class="max-w-md w-full bg-white rounded-3xl p-10 shadow-2xl text-center">
            <div class="w-16 h-16 bg-[#1b4332] rounded-2xl flex items-center justify-center mx-auto mb-6">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <h1 class="text-2xl font-bold mb-2 text-gray-900">Admin Access</h1>
            <p class="text-gray-500 mb-8 text-sm">Masukkan password untuk mengakses dashboard PT Cabe Jamu Banten</p>
            <?php if (!empty($loginError)): ?>
                <p class="text-red-500 text-sm font-bold mb-4 bg-red-50 py-2 px-4 rounded-xl"><?= htmlspecialchars($loginError) ?></p>
            <?php endif; ?>
            <form method="POST">
                <input type="password" name="password" placeholder="Masukkan Password" autofocus
                    class="w-full px-6 py-4 rounded-2xl bg-gray-50 border border-gray-200 focus:border-[#1b4332] outline-none mb-4 text-center text-lg">
                <button type="submit" class="w-full bg-[#1b4332] text-white py-4 rounded-2xl font-bold shadow-lg hover:bg-[#c89d10] transition-all">
                    Masuk Dashboard
                </button>
            </form>
            <a href="index.php" class="block mt-6 text-sm text-gray-400 hover:text-gray-600">← Kembali ke Website</a>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Handle Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

require_once 'db.php';

// Fetch current data
$siteData = null;
$jsonData = null;
try {
    $stmt = $pdo->prepare("SELECT value FROM site_settings WHERE key_name = 'site_data'");
    $stmt->execute();
    $row = $stmt->fetch();
    if ($row) {
        $jsonData = $row['value'];
        $siteData = json_decode($jsonData, true);
    }
} catch (PDOException $e) {
    $dbError = $e->getMessage();
}

// Handle Save (POST)
$saveMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'upload_image') {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg','jpeg','png','gif','webp'];
            if (in_array($ext, $allowed)) {
                $newFilename = 'upload_' . time() . '_' . rand(100,999) . '.' . $ext;
                $targetPath = 'assets/' . $newFilename;
                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    echo json_encode(['success' => true, 'url' => $targetPath]);
                } else {
                    echo json_encode(['success' => false, 'msg' => 'Gagal memindahkan file.']);
                }
            } else {
                echo json_encode(['success' => false, 'msg' => 'Format file tidak didukung.']);
            }
            exit;
        }
    }

    if ($action === 'save_data') {
        $newData = $_POST['data'] ?? null;
        if ($newData && json_decode($newData)) {
            try {
                $stmt = $pdo->prepare("UPDATE site_settings SET value = ? WHERE key_name = 'site_data'");
                $stmt->execute([$newData]);
                $saveMessage = 'success';
            } catch (PDOException $e) {
                $saveMessage = 'error: ' . $e->getMessage();
            }
        }
        header('Content-Type: application/json');
        echo json_encode(['success' => $saveMessage === 'success', 'message' => $saveMessage]);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | PT Cabe Jamu Banten</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --jamu-green: #1b4332; --jamu-gold: #c89d10; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc; }
        .sidebar-link.active { background-color: var(--jamu-green); color: white; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .fade-in { animation: fadeIn 0.25s ease; }
        @keyframes fadeIn { from { opacity:0; transform:translateY(8px); } to { opacity:1; transform:translateY(0); } }
        .img-preview { width:100%; height:160px; object-fit:cover; border-radius:1rem; background:#f1f5f9; }
        .upload-zone { border:2px dashed #c89d10; border-radius:1rem; padding:1rem; text-align:center; cursor:pointer; transition:background 0.2s; }
        .upload-zone:hover { background:#fefce8; }
    </style>
</head>
<body class="overflow-hidden">

<div class="flex h-screen">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-100 flex flex-col shrink-0">
        <div class="p-6 border-b border-gray-50">
            <h2 class="font-extrabold text-[#1b4332] text-sm">PT CABE JAMU</h2>
            <p class="text-[10px] text-[#c89d10] font-bold tracking-[0.2em]">CONTROL CENTER</p>
        </div>
        <nav class="p-4 space-y-1 flex-1">
            <?php
            $tabs = [
                'hero'     => ['icon'=>'fa-magic',       'label'=>'Hero Section'],
                'budidaya' => ['icon'=>'fa-seedling',    'label'=>'Slider Budidaya'],
                'produk'   => ['icon'=>'fa-box-open',    'label'=>'Produk Utama'],
                'layanan'  => ['icon'=>'fa-graduation-cap','label'=>'Layanan'],
                'stats'    => ['icon'=>'fa-chart-line',  'label'=>'Statistik'],
                'kontak'   => ['icon'=>'fa-headset',     'label'=>'Kontak'],
                'social'   => ['icon'=>'fa-share-nodes', 'label'=>'Media Sosial'],
            ];
            foreach ($tabs as $key => $tab): ?>
            <button onclick="switchTab('<?= $key ?>')"
                class="sidebar-link <?= $key === 'hero' ? 'active' : '' ?> w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-gray-500 hover:bg-gray-50 transition-all"
                id="tab-btn-<?= $key ?>">
                <i class="fas <?= $tab['icon'] ?> w-4"></i> <?= $tab['label'] ?>
            </button>
            <?php endforeach; ?>
        </nav>
        <div class="p-4 border-t border-gray-50 space-y-2">
            <a href="index.php" target="_blank" class="flex items-center justify-center gap-2 w-full py-3 bg-gray-900 text-white rounded-xl text-xs font-bold hover:bg-[#c89d10] transition-all">
                <i class="fas fa-external-link-alt"></i> Lihat Website
            </a>
            <a href="admin.php?logout=1" class="block text-center text-[10px] font-bold text-red-400 hover:text-red-600 py-2">Keluar</a>
        </div>
    </aside>

    <!-- Main -->
    <main class="flex-1 overflow-y-auto no-scrollbar">
        <!-- Header -->
        <header class="sticky top-0 bg-white/90 backdrop-blur z-10 px-10 py-5 border-b border-gray-100 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900" id="sectionTitle">Hero Section</h1>
                <p class="text-gray-400 text-sm mt-0.5">Kelola konten website secara real-time.</p>
            </div>
            <div class="flex items-center gap-3">
                <span id="saveStatus" class="hidden text-xs font-bold text-green-600 bg-green-50 border border-green-100 px-4 py-2 rounded-full">
                    <i class="fas fa-check-circle mr-1"></i> Tersimpan!
                </span>
                <button onclick="saveAll()" class="px-6 py-3 bg-[#1b4332] text-white rounded-2xl font-bold hover:bg-[#c89d10] transition-all shadow-lg">
                    <i class="fas fa-save mr-2"></i>SIMPAN
                </button>
            </div>
        </header>

        <div id="contentArea" class="p-10 max-w-5xl">
            <!-- Tab content rendered here by JS -->
        </div>
    </main>
</div>

<script>
const D = <?php echo $jsonData ?? 'null'; ?>;
let data = D ? JSON.parse(JSON.stringify(D)) : {};

// ── HELPERS ─────────────────────────────────────────────────────────────────
function field(label, val, path, type='text') {
    return `<div>
        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1b4332] mb-1">${label}</label>
        <input type="${type}" value="${escHtml(String(val))}" onchange="setPath('${path}', this.value)"
            class="w-full px-5 py-3 rounded-xl bg-gray-50 border border-gray-100 outline-none focus:ring-2 focus:ring-[#c89d10]/30">
    </div>`;
}
function textarea(label, val, path) {
    return `<div>
        <label class="block text-[10px] font-extrabold uppercase tracking-widest text-[#1b4332] mb-1">${label}</label>
        <textarea onchange="setPath('${path}', this.value)"
            class="w-full px-5 py-3 rounded-xl bg-gray-50 border border-gray-100 outline-none h-24 focus:ring-2 focus:ring-[#c89d10]/30">${escHtml(String(val))}</textarea>
    </div>`;
}
function imgUploader(currentSrc, onUploadCallback) {
    const uid = 'up_' + Math.random().toString(36).slice(2);
    return `
    <div>
        <img id="prev_${uid}" src="${currentSrc}" class="img-preview mb-2" onerror="this.src='assets/img-1.png'">
        <div class="upload-zone" onclick="document.getElementById('file_${uid}').click()">
            <i class="fas fa-cloud-upload-alt text-[#c89d10] text-2xl mb-1"></i>
            <p class="text-xs font-bold text-gray-500">Klik untuk upload gambar baru</p>
            <p class="text-[10px] text-gray-400">JPG, PNG, WEBP max 5MB</p>
        </div>
        <input type="file" id="file_${uid}" accept="image/*" class="hidden" onchange="uploadFile(this, 'prev_${uid}', ${onUploadCallback})">
    </div>`;
}
function escHtml(s) {
    return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;').replace(/'/g,'&#39;');
}
function setPath(path, val) {
    const keys = path.split('.');
    let obj = data;
    for (let i = 0; i < keys.length - 1; i++) {
        if (!isNaN(keys[i])) keys[i] = parseInt(keys[i]);
        obj = obj[keys[i]];
    }
    const lastKey = isNaN(keys[keys.length-1]) ? keys[keys.length-1] : parseInt(keys[keys.length-1]);
    obj[lastKey] = val;
}
function card(content, extra='') {
    return `<div class="bg-white p-8 rounded-[1.5rem] shadow-sm border border-gray-50 ${extra}">${content}</div>`;
}

// ── UPLOAD ───────────────────────────────────────────────────────────────────
function uploadFile(input, previewId, callbackStr) {
    const file = input.files[0];
    if (!file) return;
    const form = new FormData();
    form.append('action', 'upload_image');
    form.append('image', file);
    fetch('admin.php', { method:'POST', body: form })
        .then(r => r.json())
        .then(res => {
            if (res.success) {
                document.getElementById(previewId).src = res.url;
                const cb = new Function('url', callbackStr);
                cb(res.url);
            } else {
                alert('Upload gagal: ' + res.msg);
            }
        });
}

// ── TABS ─────────────────────────────────────────────────────────────────────
const tabTitles = { hero:'Hero Section', budidaya:'Slider Budidaya', produk:'Produk Utama', layanan:'Layanan', stats:'Statistik', kontak:'Kontak', social:'Media Sosial' };
let activeTab = 'hero';

function switchTab(tab) {
    activeTab = tab;
    document.querySelectorAll('.sidebar-link').forEach(b => b.classList.remove('active'));
    document.getElementById('tab-btn-' + tab).classList.add('active');
    document.getElementById('sectionTitle').innerText = tabTitles[tab];
    renderTab(tab);
}

function renderTab(tab) {
    const area = document.getElementById('contentArea');
    area.innerHTML = '<div class="fade-in">' + buildTab(tab) + '</div>';
}

function buildTab(tab) {
    if (!data) return '<p class="text-red-500 font-bold">Tidak ada data. Jalankan <a href="install.php" class="underline">install.php</a> terlebih dahulu.</p>';
    let html = '';

    if (tab === 'hero') {
        html = card(`
            <h3 class="font-bold text-lg mb-6 border-b pb-3">Teks Hero</h3>
            <div class="space-y-5">
                ${field('Tagline', data.hero.tag, 'hero.tag')}
                ${field('Judul Utama', data.hero.title, 'hero.title')}
                ${textarea('Deskripsi', data.hero.sub, 'hero.sub')}
            </div>
        `) + '<div class="mt-6">' + card(`
            <h3 class="font-bold text-lg mb-4 border-b pb-3">Background Hero</h3>
            ${imgUploader(data.hero.bg, "setPath('hero.bg', url)")}
        `) + '</div>';

    } else if (tab === 'budidaya') {
        html = '<div class="grid grid-cols-2 gap-4">';
        data.cultivation.forEach((c, i) => {
            html += card(`
                <div class="relative group">
                    <button onclick="deleteItem('cultivation',${i})" class="absolute top-0 right-0 bg-red-100 text-red-500 w-7 h-7 rounded-full text-xs hover:bg-red-500 hover:text-white transition-all opacity-0 group-hover:opacity-100 z-10">✕</button>
                    ${imgUploader(c.img, `setPath('cultivation.${i}.img', url)`)}
                    <input type="text" value="${escHtml(c.title)}" onchange="setPath('cultivation.${i}.title', this.value)"
                        class="mt-2 w-full px-3 py-2 text-xs font-bold bg-gray-50 rounded-lg outline-none" placeholder="Judul gambar">
                </div>
            `, 'relative');
        });
        html += `<button onclick="addCultivation()" class="flex items-center justify-center gap-2 border-2 border-dashed border-[#c89d10] text-[#c89d10] font-bold rounded-[1.5rem] hover:bg-yellow-50 transition-all p-10 text-sm">
            <i class="fas fa-plus-circle text-xl"></i> Tambah Item
        </button></div>`;

    } else if (tab === 'produk') {
        html = '<div class="space-y-6">';
        data.products.forEach((p, i) => {
            html += card(`
                <div class="flex gap-8 relative group">
                    <button onclick="deleteItem('products',${i})" class="absolute top-0 right-0 text-xs font-bold text-red-400 hover:text-red-600 opacity-0 group-hover:opacity-100 transition-all">HAPUS</button>
                    <div class="w-1/3 shrink-0">
                        ${imgUploader(p.img, `setPath('products.${i}.img', url)`)}
                    </div>
                    <div class="flex-1 space-y-4">
                        ${field('Nama Produk', p.title, `products.${i}.title`)}
                        ${field('Badge', p.badge, `products.${i}.badge`)}
                        ${textarea('Deskripsi', p.desc, `products.${i}.desc`)}
                    </div>
                </div>
            `);
        });
        html += `<button onclick="addProduct()" class="w-full p-6 border-2 border-dashed border-[#c89d10] text-[#c89d10] font-bold rounded-[1.5rem] hover:bg-yellow-50 transition-all">
            <i class="fas fa-plus-circle mr-2"></i> Tambah Produk Baru
        </button></div>`;

    } else if (tab === 'layanan') {
        html = card(`
            <h3 class="font-bold text-lg mb-5 border-b pb-3">Header Layanan</h3>
            <div class="space-y-4">
                ${field('Judul (boleh HTML)', data.services.title, 'services.title')}
                ${textarea('Deskripsi', data.services.desc, 'services.desc')}
            </div>
        `);
        html += '<div class="grid grid-cols-3 gap-4 mt-6">';
        data.services.items.forEach((it, i) => {
            html += card(`
                ${field('Icon (fa-xxx)', it.icon, `services.items.${i}.icon`)}
                ${field('Judul', it.title, `services.items.${i}.title`)}
                ${textarea('Deskripsi', it.desc, `services.items.${i}.desc`)}
            `);
        });
        html += '</div>';
        html += '<div class="mt-6">' + card(`
            <h3 class="font-bold text-lg mb-4 border-b pb-3">Galeri Layanan</h3>
            <div class="grid grid-cols-2 gap-4">
                ${data.services.gallery.map((img, i) => imgUploader(img, `setPath('services.gallery.${i}', url)`)).join('')}
            </div>
        `) + '</div>';

    } else if (tab === 'stats') {
        html = '<div class="grid grid-cols-2 md:grid-cols-4 gap-4">';
        data.stats.forEach((s, i) => {
            html += card(`
                <input type="text" value="${escHtml(s.val)}" onchange="setPath('stats.${i}.val', this.value)"
                    class="w-full text-center text-3xl font-extrabold text-[#1b4332] bg-transparent outline-none mb-2">
                <input type="text" value="${escHtml(s.label)}" onchange="setPath('stats.${i}.label', this.value)"
                    class="w-full text-center text-xs font-bold text-[#c89d10] bg-transparent outline-none">
            `, 'text-center');
        });
        html += '</div>';

    } else if (tab === 'kontak') {
        const c = data.contact;
        html = card(`
            <h3 class="font-bold text-lg mb-5 border-b pb-3">Informasi Kontak</h3>
            <div class="grid grid-cols-2 gap-5">
                ${field('WhatsApp Utama (62xxx)', c.wa, 'contact.wa')}
                ${field('Email', c.email, 'contact.email')}
                <div class="col-span-2">${field('Semua Nomor WA (pisah koma)', c.all_wa.join(', '), '__wa_list')}</div>
                <div class="col-span-2">${field('Alamat', c.address, 'contact.address')}</div>
                <div class="col-span-2">${field('Judul Kontak', c.title, 'contact.title')}</div>
                <div class="col-span-2">${textarea('Deskripsi Kontak', c.desc, 'contact.desc')}</div>
            </div>
        `);

    } else if (tab === 'social') {
        html = '<div class="space-y-4">';
        data.social.forEach((s, i) => {
            html += card(`
                <div class="flex items-center gap-6">
                    <div class="w-10 h-10 bg-gray-100 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fab ${s.icon} text-[#1b4332]"></i>
                    </div>
                    <div class="grid grid-cols-3 gap-3 flex-1">
                        <input type="text" value="${escHtml(s.platform)}" onchange="setPath('social.${i}.platform', this.value)" class="px-3 py-2 bg-gray-50 rounded-lg text-sm font-bold outline-none" placeholder="Nama">
                        <input type="text" value="${escHtml(s.icon)}" onchange="setPath('social.${i}.icon', this.value)" class="px-3 py-2 bg-gray-50 rounded-lg text-xs outline-none" placeholder="fa-xxx">
                        <input type="text" value="${escHtml(s.link)}" onchange="setPath('social.${i}.link', this.value)" class="px-3 py-2 bg-gray-50 rounded-lg text-xs outline-none" placeholder="URL">
                    </div>
                    <button onclick="deleteItem('social',${i})" class="text-red-400 hover:text-red-600 p-2"><i class="fas fa-trash"></i></button>
                </div>
            `);
        });
        html += `<button onclick="addSocial()" class="w-full p-5 border-2 border-dashed border-[#c89d10] text-[#c89d10] font-bold rounded-2xl hover:bg-yellow-50 transition-all">
            <i class="fas fa-plus-circle mr-2"></i> Tambah Platform
        </button></div>`;
    }
    return html;
}

// ── CRUD ─────────────────────────────────────────────────────────────────────
function deleteItem(type, i) {
    if (confirm('Hapus item ini?')) {
        data[type].splice(i, 1);
        renderTab(activeTab);
    }
}
function addProduct() {
    data.products.push({ id: Date.now(), title:'Produk Baru', desc:'Deskripsi produk.', img:'assets/img-39.jpeg', badge:'Baru' });
    renderTab('produk');
}
function addCultivation() {
    data.cultivation.push({ title:'Aktivitas Baru', img:'assets/img-3.jpeg' });
    renderTab('budidaya');
}
function addSocial() {
    data.social.push({ platform:'Platform', icon:'fa-link', link:'#' });
    renderTab('social');
}

// ── SAVE ─────────────────────────────────────────────────────────────────────
function saveAll() {
    // Handle WA list field if on kontak tab
    const waInput = document.getElementById ? document.querySelector('input[onchange*="__wa_list"]') : null;
    if (waInput) {
        data.contact.all_wa = waInput.value.split(',').map(s => s.trim());
    }

    fetch('admin.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'action=save_data&data=' + encodeURIComponent(JSON.stringify(data))
    })
    .then(r => r.json())
    .then(res => {
        const el = document.getElementById('saveStatus');
        el.classList.remove('hidden');
        if (res.success) {
            el.className = 'text-xs font-bold text-green-600 bg-green-50 border border-green-100 px-4 py-2 rounded-full';
            el.innerHTML = '<i class="fas fa-check-circle mr-1"></i> Berhasil Disimpan!';
        } else {
            el.className = 'text-xs font-bold text-red-600 bg-red-50 border border-red-100 px-4 py-2 rounded-full';
            el.innerHTML = '<i class="fas fa-times-circle mr-1"></i> Gagal: ' + res.message;
        }
        setTimeout(() => el.classList.add('hidden'), 3000);
    });
}

// ── INIT ─────────────────────────────────────────────────────────────────────
renderTab('hero');
</script>
</body>
</html>
