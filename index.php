<?php
$page_title = "Savoria Filipina | Authentic Filipino Recipes";
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
            <span class="badge">Home Cooking & Culinary Heritage</span>
            <h1>Savor the Flavor of Authentic Filipino Recipes</h1>
            <p>Welcome to <strong>Savoria Filipina</strong> — your ultimate culinary hub for authentic Filipino dishes. Discover timeless recipes like Chicken Pork Adobo, Sinigang na Baboy, and Halo-Halo through interactive media, upload forms, and complete media gallery management.</p>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                <a href="#recipes" class="btn btn-primary">Discover Recipes</a>
                <a href="upload.php" class="btn btn-secondary">Upload Media</a>
            </div>

            <!-- Background Audio for Home Tab (Kitchen Ambiance Loop) -->
            <audio id="homeBgAudio" loop preload="auto">
                <source src="audio/kitchen-ambiance.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>

            <!-- Ambient Background Music Controller Widget -->
            <div class="ambient-audio-container paused" id="ambientAudioWidget" role="region" aria-label="Kitchen Ambiance Background Music Controls">
                <button class="ambient-audio-btn" id="ambientAudioToggleBtn" aria-label="Play Kitchen Ambiance background music">
                    <svg id="ambientAudioPlayIcon" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                    </svg>
                    <svg id="ambientAudioPauseIcon" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="display: none;">
                        <rect x="6" y="4" width="4" height="16"></rect>
                        <rect x="14" y="4" width="4" height="16"></rect>
                    </svg>
                </button>
                <div class="ambient-audio-info">
                    <div class="sound-wave-icon" aria-hidden="true">
                        <span class="sound-wave-bar"></span>
                        <span class="sound-wave-bar"></span>
                        <span class="sound-wave-bar"></span>
                    </div>
                    <span>Kitchen Ambiance</span>
                    <span class="ambient-audio-status-badge" id="ambientAudioStatusText">Click to Play</span>
                </div>
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
            <h2 id="featured-recipes-heading">National Favorites (Featured Filipino Dishes)</h2>
            <p>Try our tried-and-tested recipe favorites for the whole family.</p>
        </div>

        <div class="recipe-grid">
            <!-- Recipe Card 1: Adobo -->
            <article class="recipe-card">
                <img src="images/filipino-adobo.jpg" alt="Authentic Filipino Chicken and Pork Adobo garnished with garlic chips and bay leaves in a brown savory sauce" class="recipe-card-img" loading="lazy" width="400" height="220">
                <div class="recipe-card-body">
                    <span class="badge" style="align-self: flex-start;">National Dish</span>
                    <h3 class="recipe-card-title">Classic Chicken & Pork Adobo</h3>
                    <p class="recipe-card-desc">The quintessential Filipino family adobo. Marinated in soy sauce, vinegar, garlic, and bay leaves.</p>
                    <a href="gallery.php" class="btn btn-secondary" style="margin-top: auto;">View in Gallery &rarr;</a>
                </div>
            </article>

            <!-- Recipe Card 2: Sinigang -->
            <article class="recipe-card">
                <img src="images/sinigang-baboy.jpg" alt="Traditional Filipino Sinigang na Baboy tamarind soup with kangkong water spinach, radish, and tomatoes" class="recipe-card-img" loading="lazy" width="400" height="220">
                <div class="recipe-card-body">
                    <span class="badge" style="align-self: flex-start;">Savory Soup</span>
                    <h3 class="recipe-card-title">Tamarind Pork Sinigang (Sinigang na Baboy)</h3>
                    <p class="recipe-card-desc">Warm and sour pork belly soup with fresh water spinach, radish, tomatoes, and green chili.</p>
                    <a href="gallery.php" class="btn btn-secondary" style="margin-top: auto;">View in Gallery &rarr;</a>
                </div>
            </article>

            <!-- Recipe Card 3: Halo-Halo -->
            <article class="recipe-card">
                <img src="images/halo-halo.jpg" alt="Tall glass of colorful Filipino Halo-Halo shaved ice dessert topped with ube halaya ice cream and leche flan" class="recipe-card-img" loading="lazy" width="400" height="220">
                <div class="recipe-card-body">
                    <span class="badge" style="align-self: flex-start;">Dessert</span>
                    <h3 class="recipe-card-title">Special Filipino Halo-Halo</h3>
                    <p class="recipe-card-desc">Delicious shaved ice topped with purple yam (ube halaya), leche flan, sweet banana, macapuno, and toasted rice.</p>
                    <a href="gallery.php" class="btn btn-secondary" style="margin-top: auto;">View in Gallery &rarr;</a>
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
            <h2 id="community-media-heading">User Uploaded Recipes & Media</h2>
            <p>View recently uploaded photos, titles, and descriptions submitted by users.</p>
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
                            <?php echo !empty($item['description']) ? htmlspecialchars($item['description']) : 'No additional description provided.'; ?>
                        </p>
                        
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto; padding-top: 1rem; border-top: 1px solid var(--border-color);">
                            <small style="color: var(--text-muted);">
                                📅 <?php echo date('M d, Y', strtotime($item['upload_date'])); ?>
                            </small>
                            <a href="gallery.php" class="btn btn-secondary" style="padding: 0.35rem 0.75rem; font-size: 0.85rem;">Manage in Gallery &rarr;</a>
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
        <h2 style="color: var(--primary);">Upload & Manage Your Own Media</h2>
        <p style="color: var(--text-main); font-size: 1.1rem; margin-bottom: 2rem;">
            You can upload your own photos of Filipino dishes, write titles and descriptions, and manage them in the Media Gallery!
        </p>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <a href="upload.php" class="btn btn-primary">Go to Upload Page &rarr;</a>
            <a href="gallery.php" class="btn btn-secondary">Open Media Gallery &rarr;</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
