<?php
if (!isset($page_title)) {
    $page_title = "Savoria Filipina | Authentic Filipino Recipes & Culinary Media";
}
if (!isset($active_page)) {
    $active_page = "home";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Savoria Filipina - Explore authentic Filipino recipes like Adobo, Sinigang, and Halo-Halo with step-by-step video masterclasses, audio cooking guides, and responsive media gallery.">
    <meta name="author" content="IT AppDev 2 Student Project">
    <title><?php echo htmlspecialchars($page_title); ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Accessibility Skip Link -->
    <a href="#main-content" class="skip-link">Skip to main content</a>

    <!-- Header Navigation -->
    <header class="header" role="banner">
        <div class="container header-container">
            <a href="index.php" class="logo" aria-label="Savoria Filipina Home Page">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/>
                </svg>
                <span>Savoria Filipina</span>
            </a>

            <button class="mobile-nav-toggle" id="mobileNavToggle" aria-label="Toggle Navigation Menu" aria-expanded="false" aria-controls="primaryNav">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>

            <nav id="primaryNav" aria-label="Primary Navigation">
                <ul class="nav-menu" id="navMenu">
                    <li><a href="index.php" class="nav-link <?php echo ($active_page === 'home') ? 'active' : ''; ?>">Home</a></li>
                    <li><a href="about.php" class="nav-link <?php echo ($active_page === 'about') ? 'active' : ''; ?>">About</a></li>
                    <li><a href="gallery.php" class="nav-link <?php echo ($active_page === 'gallery') ? 'active' : ''; ?>">Media Gallery</a></li>
                    <li><a href="upload.php" class="nav-link <?php echo ($active_page === 'upload') ? 'active' : ''; ?>">Upload Media</a></li>
                    <li><a href="contact.php" class="nav-link <?php echo ($active_page === 'contact') ? 'active' : ''; ?>">Contact & Credits</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main id="main-content" role="main">
