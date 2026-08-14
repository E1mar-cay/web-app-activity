<?php
$page_title = "Savoria Filipina | Otentikong Resipeng Pilipino";
$active_page = "home";
include 'includes/header.php';

// Load User-Uploaded Media from JSON
$uploaded_media = [];
$json_file = "uploads/media_data.json";
if (file_exists($json_file)) {
    $json_content = file_get_contents($json_file);
    $uploaded_media = json_decode($json_content, true) ?: [];
    // Sort newest first
    $uploaded_media = array_reverse($uploaded_media);
}
?>

<!-- Hero Section with Responsive Media Element (<picture> Tag Requirement Section III.B) -->
<section class="hero" aria-label="Hero Section">
    <div class="container hero-grid">
        <div class="hero-content">
            <span class="badge">Lutong Bahay & Culinary Heritage</span>
            <h1>Lasapin ang Sarap ng Otentikong Resipeng Pilipino</h1>
            <p>Welcome to <strong>Savoria Filipina</strong> — your ultimate culinary hub for authentic Filipino dishes. Discover timeless recipes like Chicken Pork Adobo, Sinigang na Baboy, and Halo-Halo through interactive media, upload forms, and complete media gallery management.</p>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="#recipes" class="btn btn-primary">Tuklasin ang Mga Resipi</a>
                <a href="upload.php" class="btn btn-secondary">Mag-Upload ng Media</a>
            </div>
        </div>

        <!-- Responsive Media Element using <picture> Tag -->
        <div class="hero-media-wrapper">
            <picture>
                <source media="(max-width: 600px)" srcset="images/savoria-hero-mobile.jpg">
                <source media="(max-width: 1200px)" srcset="images/savoria-hero-tablet.jpg">
                <img src="images/savoria-hero-desktop.jpg" alt="Filipino food feast table featuring Adobo, Sinigang, and fresh rice served on banana leaves" width="600" height="400">
            </picture>
        </div>
    </div>
</section>

<!-- Featured Recipe Showcase (Authentic Filipino Dishes) -->
<section class="section" id="recipes" style="background-color: var(--bg-light);" aria-labelledby="featured-recipes-heading">
    <div class="container">
        <div class="section-header">
            <h2 id="featured-recipes-heading">Mga Pambansang Paborito (Featured Filipino Dishes)</h2>
            <p>Subukan ang aming mga subok at paboritong resape para sa pamilyang Pilipino.</p>
        </div>

        <div class="recipe-grid">
            <!-- Recipe Card 1: Adobo -->
            <article class="recipe-card">
                <img src="images/filipino-adobo.jpg" alt="Authentic Filipino Chicken and Pork Adobo garnished with garlic chips and bay leaves in a brown savory sauce" class="recipe-card-img" loading="lazy" width="400" height="220">
                <div class="recipe-card-body">
                    <span class="badge" style="align-self: flex-start;">Pambansang Ulam</span>
                    <h3 class="recipe-card-title">Classic Chicken & Pork Adobo</h3>
                    <p class="recipe-card-desc">Ang walang katulad na adobo ng pamilyang Pilipino. Naka-marinate sa toyo, suka, bawang, at dahon ng laurel.</p>
                    <a href="gallery.php" class="btn btn-secondary" style="margin-top: auto;">Tingnan sa Gallery &rarr;</a>
                </div>
            </article>

            <!-- Recipe Card 2: Sinigang -->
            <article class="recipe-card">
                <img src="images/sinigang-baboy.jpg" alt="Traditional Filipino Sinigang na Baboy tamarind soup with kangkong water spinach, radish, and tomatoes" class="recipe-card-img" loading="lazy" width="400" height="220">
                <div class="recipe-card-body">
                    <span class="badge" style="align-self: flex-start;">Mainit na Sabaw</span>
                    <h3 class="recipe-card-title">Sinigang na Baboy sa Sampalok</h3>
                    <p class="recipe-card-desc">Mainit at maasim na sabaw ng pork belly na may sariwang kangkong, labanos, kamatis, at siling haba.</p>
                    <a href="gallery.php" class="btn btn-secondary" style="margin-top: auto;">Tingnan sa Gallery &rarr;</a>
                </div>
            </article>

            <!-- Recipe Card 3: Halo-Halo -->
            <article class="recipe-card">
                <img src="images/halo-halo.jpg" alt="Tall glass of colorful Filipino Halo-Halo shaved ice dessert topped with ube halaya ice cream and leche flan" class="recipe-card-img" loading="lazy" width="400" height="220">
                <div class="recipe-card-body">
                    <span class="badge" style="align-self: flex-start;">Panghimagas (Dessert)</span>
                    <h3 class="recipe-card-title">Special Filipino Halo-Halo</h3>
                    <p class="recipe-card-desc">Masarap na shaved ice na may halayang ube, leche flan, saging na saba, macapuno, at pinipig.</p>
                    <a href="gallery.php" class="btn btn-secondary" style="margin-top: auto;">Tingnan sa Gallery &rarr;</a>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- Community Uploaded Media Section (Dynamic Home Rendering) -->
<?php if (!empty($uploaded_media)): ?>
<section class="section" style="background-color: #ffffff;" aria-labelledby="community-media-heading">
    <div class="container">
        <div class="section-header">
            <h2 id="community-media-heading">In-Upload na Mga Resape & Media (User Submissions)</h2>
            <p>Tingnan ang mga bagong ini-upload na larawan, pamagat, at deskripsyon ng mga manonood.</p>
        </div>

        <div class="recipe-grid">
            <?php foreach ($uploaded_media as $item): ?>
                <article class="recipe-card">
                    <?php if ($item['category'] === 'image'): ?>
                        <img src="<?php echo htmlspecialchars($item['filepath']); ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" class="recipe-card-img" loading="lazy">
                    <?php elseif ($item['category'] === 'video'): ?>
                        <div style="height: 220px; background: #000;">
                            <video controls style="width: 100%; height: 100%; object-fit: cover;">
                                <source src="<?php echo htmlspecialchars($item['filepath']); ?>">
                            </video>
                        </div>
                    <?php elseif ($item['category'] === 'audio'): ?>
                        <div style="height: 220px; background: var(--primary-light); display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1rem;">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="var(--primary)">
                                <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                            </svg>
                            <audio controls style="margin-top: 1rem; width: 90%;">
                                <source src="<?php echo htmlspecialchars($item['filepath']); ?>">
                            </audio>
                        </div>
                    <?php endif; ?>

                    <div class="recipe-card-body">
                        <span class="badge" style="align-self: flex-start; background-color: var(--secondary); color: #fff;">
                            User Submission &bull; <?php echo strtoupper($item['category']); ?>
                        </span>
                        <h3 class="recipe-card-title"><?php echo htmlspecialchars($item['title']); ?></h3>
                        <p class="recipe-card-desc">
                            <?php echo !empty($item['description']) ? htmlspecialchars($item['description']) : 'Walang karagdagang deskripsyon.'; ?>
                        </p>
                        
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto; padding-top: 1rem; border-top: 1px solid var(--border-color);">
                            <small style="color: var(--text-muted);">
                                📅 <?php echo date('M d, Y', strtotime($item['upload_date'])); ?>
                            </small>
                            <a href="gallery.php" class="btn btn-secondary" style="padding: 0.35rem 0.75rem; font-size: 0.85rem;">Pamahalaan sa Gallery &rarr;</a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Call to Action for Media Management -->
<section class="section" style="background-color: var(--primary-light);">
    <div class="container" style="text-align: center; max-width: 800px;">
        <h2 style="color: var(--primary);">Mag-Upload at Mamahala ng Sariling Media</h2>
        <p style="color: var(--text-main); font-size: 1.1rem; margin-bottom: 2rem;">
            Maaari kang mag-upload ng iyong sariling mga kuha ng pagkaing Pilipino, isulat ang pamagat at deskripsyon, at mamahala sa Media Gallery!
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="upload.php" class="btn btn-primary">Pumunta sa Upload Page &rarr;</a>
            <a href="gallery.php" class="btn btn-secondary">Buksan ang Media Gallery &rarr;</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
