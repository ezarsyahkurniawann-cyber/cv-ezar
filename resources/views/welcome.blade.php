<?php
function perkenalan($nama)
{
    return "Hello, I'm " . htmlspecialchars($nama);
}
function getStatusBadge($status)
{
    if ($status) {
        return "<div class='badge-status'>Mahasiswa Aktif</div>";
    } else {
        return "<div class='badge-status' style='background-color: #dc3545;'>Bukan Mahasiswa Aktif</div>";
    }
}

$nama = "Ezarsyah Kurniawan";
$nrp = "5325600063";
$prodi = "Teknologi Rekayasa Multimedia";
$email = "ezarsyah.kurniawann@gmail.com";
$posisi = "Front-End Web Dev & Graphic Designer";
$deskripsi = "Ezarsyah Kurniawan is a dedicated Front-End Web Developer and Graphic Designer focused on professional brand design and interactive web interfaces. Combining modern technical development stacks with robust visual aesthetics, I am committed to delivering digital solutions that are both technically reliable and visually compelling.";
$status = true;

$skills = [
    "HTML",
    "CSS",
    "PHP",
    "JavaScript",
    "Graphic Desainer",
    "UI/UX Design (Figma)",
];

$experience = [
    [
        "posisi" => "Staff Riset & Kretivitas",
        "instansi" => "BSO TRM PENS",
        "tahun" => "NOW",
        "deskripsi" => "berfokus pada pengembangan keilmuan berbasis data dan pemanfaatan teknologi untuk mendukung kinerja organisasi.",
        "logo" => "assets/img/logotrm.png"
    ],
    
];

$education = [
    [
        "jurusan" => "D4 Multimedia Engineering Technology",
        "instansi" => "Politeknik Elektronika Negeri Surabaya",
        "tahun" => "2025 - NOW",
        "deskripsi" => "Pursuing higher education with deep focus on multimedia engineering, front-end programming, and digital design.",
        "logo" => "https://thumb.wikimedia.org/wikipedia/id/thumb/4/44/Logo_PENS.png/250px-Logo_PENS.png"
    ],
    [
        "jurusan" => "High School Education",
        "instansi" => "SMK 1 KRIAN SIDOARJO",
        "tahun" => "2021 - 2025",
        "deskripsi" => "Completed secondary education with active organizational involvement and academic foundations.",
        "logo" => "https://smkkrian1.sch.id/images_thumbnail/1706801271.png"
    ]
];

$projects = [
    [
        "judul" => "Kyai Pacet",
        "kategori" => "Game",
        "tahun" => 2026,
        "deskripsi" => "Interactive 2D visual novel game developed using Ren'Py engine and custom Python scripting."
    ],
    [
        "judul" => "Pindah tangan",
        "kategori" => "Web",
        "tahun" => 2026,
        "deskripsi" => "Web Trifthing berbasis PHP dan MySQL yang memungkinkan pengguna untuk melakukan transaksi jual beli barang bekas secara online."
    ],
    
];

usort($projects, function ($a, $b) {
    return $b['tahun'] - $a['tahun'];
});

$searchKey = isset($_GET['search']) ? trim($_GET['search']) : '';
$kategoriFilter = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';

$filteredProjects = array_filter($projects, function ($item) use ($searchKey, $kategoriFilter) {
    $matchSearch = empty($searchKey) || stripos($item['judul'], $searchKey) !== false;
    $matchKategori = empty($kategoriFilter) || strtolower($item['kategori']) === strtolower($kategoriFilter);
    return $matchSearch && $matchKategori;
});

$errors = [];
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $postNama = trim($_POST['name'] ?? '');
    $postEmail = trim($_POST['email'] ?? '');
    $postSubjek = trim($_POST['subjek'] ?? '');
    $postPesan = trim($_POST['pesan'] ?? '');

    if (empty($postNama)) {
        $errors['name'] = "Nama wajib diisi!";
    }
    if (empty($postEmail)) {
        $errors['email'] = "Email wajib diisi!";
    } elseif (!filter_var($postEmail, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid!";
    }
    if (empty($postSubjek)) {
        $errors['subjek'] = "Subjek wajib diisi!";
    }
    if (empty($postPesan)) {
        $errors['pesan'] = "Pesan wajib diisi!";
    }

    if (empty($errors)) {
        $successMessage = "Terima kasih, " . htmlspecialchars($postNama) . "! Pesan Anda berhasil dikirim.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($nama); ?> — Portfolio & CV</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css"
        integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <script src="assets/js/script.js" defer></script>
</head>

<body>
    <header class="site-header">
        <div class="nav-container">
            <a href="#" class="logo"><?php echo htmlspecialchars($nama); ?>'s Portfolio</a>

            <button type="button" class="hamburger-btn" aria-label="Toggle navigation">☰</button>

            <ul class="nav-links">
                <li><a href="#about">About</a></li>
                <li><a href="#skills">Skills</a></li>
                <li><a href="#experience">Experience</a></li>
                <li><a href="#education">Education</a></li>
                <li><a href="#projects">Projects</a></li>
                
                <li><a href="#contact">Contact</a></li>
                <li><button type="button" id="theme-toggle" class="theme-toggle-btn"
                        aria-label="Toggle Theme">🌙</button></li>
            </ul>
        </div>
    </header>

    <div class="main-container">
        <header class="hero-section">
            <div class="hero-content">
                <?php echo getStatusBadge($status); ?>
                <h1><?php echo perkenalan($nama); ?>
                    <br>(<?php echo htmlspecialchars($nrp); ?>)
                    <br><?php echo htmlspecialchars($prodi); ?>
                </h1>
                <div class="hero-subtitle"><?php echo htmlspecialchars($posisi); ?></div>
                <p><?php echo htmlspecialchars($deskripsi); ?></p>
            </div>
            <div class="hero-image-wrapper">
                <img src="assets/img/foto-ilyas.png" alt="Ezarsyah Kurniawan"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                <span class="placeholder-img-text" style="display:none;">Photo Profile</span>
            </div>
        </header>

        <section id="about">
            <h2 class="section-title">Career Summary</h2>
            <p class="summary-text"><?php echo htmlspecialchars($deskripsi); ?></p>
        </section>

        <section id="skills">
            <h2 class="section-title">Skills</h2>
            <ul style="padding-left: 20px;">
                <?php foreach ($skills as $skill): ?>
                    <li style="margin-bottom: 8px; font-weight: 500;"><?= htmlspecialchars($skill) ?></li>
                <?php endforeach; ?>
            </ul>
        </section>

        <section id="experience">
            <h2 class="section-title">Experience & Organization</h2>
            <div class="timeline-list">
                <?php foreach ($experience as $exp): ?>
                    <div class="timeline-card accordion-item">
                        <div class="accordion-header">
                            <div class="header-left">
                                <div class="timeline-logo-box">
                                    <img src="<?= htmlspecialchars($exp['logo']) ?>" alt="<?= htmlspecialchars($exp['instansi']) ?>"
                                        onerror="this.style.display='none';">
                                </div>
                                <div class="timeline-details">
                                    <h3><?= htmlspecialchars($exp['posisi']) ?></h3>
                                    <div class="institution"><?= htmlspecialchars($exp['instansi']) ?></div>
                                </div>
                            </div>
                            <div class="header-right">
                                <span class="timeline-date"><?= htmlspecialchars($exp['tahun']) ?></span>
                                <span class="accordion-icon">+</span>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <div class="desc"><?= htmlspecialchars($exp['deskripsi']) ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="education">
            <h2 class="section-title">Education</h2>
            <div class="timeline-list">
                <?php foreach ($education as $edu): ?>
                    <div class="timeline-card accordion-item">
                        <div class="accordion-header">
                            <div class="header-left">
                                <div class="timeline-logo-box">
                                    <img src="<?= htmlspecialchars($edu['logo']) ?>" alt="<?= htmlspecialchars($edu['instansi']) ?>">
                                </div>
                                <div class="timeline-details">
                                    <h3><?= htmlspecialchars($edu['jurusan']) ?></h3>
                                    <div class="institution"><?= htmlspecialchars($edu['instansi']) ?></div>
                                </div>
                            </div>
                            <div class="header-right">
                                <span class="timeline-date"><?= htmlspecialchars($edu['tahun']) ?></span>
                                <span class="accordion-icon">+</span>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <div class="desc"><?= htmlspecialchars($edu['deskripsi']) ?></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <section id="projects">
            <h2 class="section-title">Projects Showcase</h2>

            <!-- Form Filter & Search (GET) -->
            <form action="#projects" method="GET" style="display: flex; gap: 10px; margin-bottom: 25px; flex-wrap: wrap;">
                <input type="text" name="search" placeholder="Cari judul project..." value="<?= htmlspecialchars($searchKey) ?>"
                    style="padding: 10px 14px; border-radius: 8px; border: 1px solid #ccc; flex: 1; min-width: 200px;">
                
                <select name="kategori" style="padding: 10px 14px; border-radius: 8px; border: 1px solid #ccc; background: white;">
                    <option value="">Semua Kategori</option>
                    <option value="Web" <?= $kategoriFilter === 'Web' ? 'selected' : '' ?>>Web</option>
                    <option value="Game" <?= $kategoriFilter === 'Game' ? 'selected' : '' ?>>Game</option>
                    <option value="Design" <?= $kategoriFilter === 'Design' ? 'selected' : '' ?>>Design</option>
                </select>

                <button type="submit" class="btn-submit" style="width: auto; padding: 10px 20px;">Filter</button>
                <a href="index.php#projects" style="padding: 10px 16px; background: #e0e0e0; color: #111; border-radius: 8px; text-decoration: none; font-size: 14px; display: inline-flex; align-items: center;">Reset</a>
            </form>

            <?php if (empty($filteredProjects)): ?>
                <div style="background-color: #fff; padding: 25px; border-radius: 12px; text-align: center; border: 1px solid #eee;">
                    <p style="margin: 0; color: #666; font-weight: 500;">Maaf, project tidak ditemukan berdasarkan pencarian atau filter Anda.</p>
                </div>
            <?php else: ?>
                <div class="expertise-grid">
                    <?php foreach ($filteredProjects as $prj): ?>
                        <div class="expertise-card" style="cursor: default;">
                            <div class="card-body">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                    <span style="font-size: 12px; font-weight: 700; background: #111; color: #fff; padding: 2px 8px; border-radius: 12px;"><?= htmlspecialchars($prj['kategori']) ?></span>
                                    <span style="font-size: 12px; font-weight: 600; opacity: 0.7;"><?= $prj['tahun'] ?></span>
                                </div>
                                <h3><?= htmlspecialchars($prj['judul']) ?></h3>
                                <p><?= htmlspecialchars($prj['deskripsi']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <section id="expertise">
            <h2 class="section-title">Expertise</h2>
            <div class="expertise-grid">
                <div class="expertise-card">
                    <div class="card-img-box">
                        <img src="assets/img/" alt="Front-End Web Dev" onerror="this.style.display='none';">
                    </div>
                    <div class="card-body">
                        <h3>Front-End Web Dev</h3>
                        <p>Building responsive, interactive, and high-performance modern user interfaces.</p>
                    </div>
                </div>

                <div class="expertise-card">
                    <div class="card-img-box">
                        <img src="assets/img/" alt="Graphic Designer" onerror="this.style.display='none';">
                    </div>
                    <div class="card-body">
                        <h3>Graphic Designer</h3>
                        <p>Designing strong visual identities, professional branding, and creative layouts.</p>
                    </div>
                </div>

                <div class="expertise-card">
                    <div class="card-img-box">
                        <img src="assets/img/" alt="Social Media Designer" onerror="this.style.display='none';">
                    </div>
                    <div class="card-body">
                        <h3>Social Media Designer</h3>
                        <p>Creating strategic digital publication assets and engaging promotional media.</p>
                    </div>
                </div>
            </div>
        </section>

        <div class="contact-section" id="contact">
            <h2>Let's build something great together.</h2>
            <p>Have a project in mind or want to collaborate? Feel free to reach out.</p>

            <?php if (!empty($successMessage)): ?>
                <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-weight: 600; text-align: center;">
                    <?= $successMessage ?>
                </div>
            <?php endif; ?>

            <form action="#contact" method="POST" class="contact-form" novalidate>
                <div class="form-group">
                    <label for="name">Nama</label>
                    <input type="text" id="name" name="name" placeholder="Masukkan nama Anda" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                    <?php if (isset($errors['name'])): ?>
                        <small style="color: #ff6b6b; font-size: 0.85rem; margin-top: 4px; display: block;"><?= $errors['name'] ?></small>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="nama@email.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                    <?php if (isset($errors['email'])): ?>
                        <small style="color: #ff6b6b; font-size: 0.85rem; margin-top: 4px; display: block;"><?= $errors['email'] ?></small>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="subjek">Subjek</label>
                    <input type="text" id="subjek" name="subjek" placeholder="Subjek pesan Anda" value="<?= htmlspecialchars($_POST['subjek'] ?? '') ?>">
                    <?php if (isset($errors['subjek'])): ?>
                        <small style="color: #ff6b6b; font-size: 0.85rem; margin-top: 4px; display: block;"><?= $errors['subjek'] ?></small>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="pesan">Pesan</label>
                    <textarea id="pesan" name="pesan" rows="5" placeholder="Tuliskan pesan atau project Anda di sini..."><?= htmlspecialchars($_POST['pesan'] ?? '') ?></textarea>
                    <?php if (isset($errors['pesan'])): ?>
                        <small style="color: #ff6b6b; font-size: 0.85rem; margin-top: 4px; display: block;"><?= $errors['pesan'] ?></small>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn-submit">Kirim Pesan</button>
            </form>
        </div>

        <footer class="site-footer">
            <div class="main-container">
                <p>&copy; 2026 Ezarsyah Kurniawan. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>

</html>