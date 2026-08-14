<?php
session_start();
$page_title = "Media Gallery & Management | Savoria Filipina";
$active_page = "gallery";
include 'includes/header.php';

// Helper function to scan directories and collect media items with metadata
function getMediaItems() {
    $items = [];
    
    // Load metadata JSON
    $metadata_by_path = [];
    $json_file = "uploads/media_data.json";
    if (file_exists($json_file)) {
        $json_content = file_get_contents($json_file);
        $meta_list = json_decode($json_content, true) ?: [];
        foreach ($meta_list as $meta) {
            $metadata_by_path[$meta['filepath']] = $meta;
        }
    }

    // Media Directories
    $directories = [
        'image' => ['images/', 'uploads/images/'],
        'audio' => ['audio/', 'uploads/audio/'],
        'video' => ['videos/', 'uploads/videos/']
    ];

    foreach ($directories as $type => $paths) {
        foreach ($paths as $path) {
            if (file_exists($path)) {
                $files = scandir($path);
                foreach ($files as $file) {
                    if ($file === '.' || $file === '..' || strpos($file, '.vtt') !== false) continue;
                    
                    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    $isUpload = (strpos($path, 'uploads/') === 0);
                    $full_relative_path = $path . $file;

                    $title = $file;
                    $description = "";

                    if (isset($metadata_by_path[$full_relative_path])) {
                        $title = $metadata_by_path[$full_relative_path]['title'];
                        $description = $metadata_by_path[$full_relative_path]['description'];
                    }

                    if ($type === 'image' && in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'svg'])) {
                        $items[] = [
                            'name' => $file,
                            'title' => $title,
                            'description' => $description,
                            'path' => $full_relative_path,
                            'type' => 'image',
                            'is_upload' => $isUpload
                        ];
                    } elseif ($type === 'audio' && in_array($ext, ['mp3', 'ogg', 'wav'])) {
                        $items[] = [
                            'name' => $file,
                            'title' => $title,
                            'description' => $description,
                            'path' => $full_relative_path,
                            'type' => 'audio',
                            'is_upload' => $isUpload
                        ];
                    } elseif ($type === 'video' && in_array($ext, ['mp4', 'webm'])) {
                        $items[] = [
                            'name' => $file,
                            'title' => $title,
                            'description' => $description,
                            'path' => $full_relative_path,
                            'type' => 'video',
                            'is_upload' => $isUpload
                        ];
                    }
                }
            }
        }
    }
    return $items;
}

$media_items = getMediaItems();
?>

<section class="section" aria-labelledby="gallery-heading">
    <div class="container">
        <div class="section-header">
            <h1 id="gallery-heading">Media Gallery & Management</h1>
            <p>Tingnan ang aming mga larawan, i-edit ang pamagat at deskripsyon, at mamahala o burahin ang mga media file.</p>
        </div>

        <!-- Status Message Alert -->
        <?php if (isset($_SESSION['gallery_status'])): ?>
            <div class="alert alert-<?php echo $_SESSION['gallery_status']['type']; ?>" role="alert" style="max-width: 800px; margin: 0 auto 2rem;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z"/>
                </svg>
                <span><?php echo $_SESSION['gallery_status']['message']; ?></span>
            </div>
            <?php unset($_SESSION['gallery_status']); ?>
        <?php endif; ?>

        <!-- Category Filters -->
        <div class="gallery-filter" role="tablist" aria-label="Media Filters">
            <button class="filter-btn active" data-filter="all" role="tab" aria-selected="true">All Media (<?php echo count($media_items); ?>)</button>
            <button class="filter-btn" data-filter="image" role="tab" aria-selected="false">Images</button>
            <button class="filter-btn" data-filter="audio" role="tab" aria-selected="false">Audio</button>
            <button class="filter-btn" data-filter="video" role="tab" aria-selected="false">Videos</button>
        </div>

        <!-- Media Grid -->
        <div class="gallery-grid" id="galleryGrid">
            <?php if (empty($media_items)): ?>
                <div style="grid-column: 1/-1; text-align: center; padding: 3rem; background: #ffffff; border-radius: 12px; border: 1px solid var(--border-color);">
                    <p style="color: var(--text-muted); font-size: 1.1rem; margin-bottom: 1rem;">Walang nakitang media files sa gallery.</p>
                    <a href="upload.php" class="btn btn-primary">Mag-Upload ng Bagong Media &rarr;</a>
                </div>
            <?php else: ?>
                <?php foreach ($media_items as $item): ?>
                    <article class="gallery-card" data-category="<?php echo $item['type']; ?>">
                        <div class="gallery-media-preview">
                            <span class="type-tag"><?php echo strtoupper($item['type']); ?></span>
                            
                            <?php if ($item['type'] === 'image'): ?>
                                <img src="<?php echo htmlspecialchars($item['path']); ?>" alt="Filipino dish: <?php echo htmlspecialchars($item['title']); ?>" loading="lazy">
                            <?php elseif ($item['type'] === 'audio'): ?>
                                <div style="text-align: center; padding: 1rem; width: 100%;">
                                    <svg width="48" height="48" viewBox="0 0 24 24" fill="var(--primary)" aria-hidden="true">
                                        <path d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z"/>
                                    </svg>
                                    <audio controls style="margin-top: 0.5rem; width: 90%;">
                                        <source src="<?php echo htmlspecialchars($item['path']); ?>">
                                        Audio player not supported.
                                    </audio>
                                </div>
                            <?php elseif ($item['type'] === 'video'): ?>
                                <video controls style="width: 100%; height: 100%; object-fit: cover;">
                                    <source src="<?php echo htmlspecialchars($item['path']); ?>">
                                    Video player not supported.
                                </video>
                            <?php endif; ?>
                        </div>

                        <div class="gallery-card-footer" style="flex-direction: column; align-items: flex-start; gap: 0.75rem;">
                            <div style="width: 100%;">
                                <h4 style="font-size: 1.1rem; color: var(--secondary); margin-bottom: 0.25rem;">
                                    <?php echo htmlspecialchars($item['title']); ?>
                                </h4>
                                <?php if (!empty($item['description'])): ?>
                                    <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.5rem;">
                                        <?php echo htmlspecialchars($item['description']); ?>
                                    </p>
                                <?php endif; ?>
                                <small style="font-size: 0.75rem; color: var(--text-muted); display: block;">
                                    📁 File: <code><?php echo htmlspecialchars($item['name']); ?></code>
                                </small>
                            </div>

                            <div style="display: flex; justify-content: space-between; width: 100%; align-items: center; border-top: 1px solid var(--border-color); padding-top: 0.75rem; gap: 0.5rem;">
                                <span style="font-size: 0.75rem; color: var(--text-muted);">
                                    <?php echo $item['is_upload'] ? 'User Uploaded' : 'Filipino Dish Media'; ?>
                                </span>

                                <div style="display: flex; gap: 0.4rem;">
                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-secondary edit-btn" 
                                            style="padding: 0.4rem 0.75rem; font-size: 0.8rem; border-color: #0284c7; color: #0284c7;"
                                            data-path="<?php echo htmlspecialchars($item['path']); ?>"
                                            data-title="<?php echo htmlspecialchars($item['title']); ?>"
                                            data-desc="<?php echo htmlspecialchars($item['description']); ?>"
                                            aria-label="Edit <?php echo htmlspecialchars($item['name']); ?>">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                                        </svg>
                                        Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <form action="api/delete_handler.php" method="POST" onsubmit="return confirm('Sigurado ka bang gusto mong burahin ang file na \'<?php echo htmlspecialchars(addslashes($item['name'])); ?>\'?');">
                                        <input type="hidden" name="filepath" value="<?php echo htmlspecialchars($item['path']); ?>">
                                        <button type="submit" class="btn btn-danger" style="padding: 0.4rem 0.75rem; font-size: 0.8rem; display: inline-flex; align-items: center; gap: 0.35rem;" aria-label="Delete <?php echo htmlspecialchars($item['name']); ?>">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z"/>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Edit Media Modal Overlay -->
<div id="editModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.65); z-index: 9999; align-items: center; justify-content: center; padding: 1rem;">
    <div style="background: #ffffff; width: 100%; max-width: 550px; border-radius: var(--border-radius); padding: 2rem; box-shadow: var(--shadow-lg); position: relative;">
        <button type="button" id="closeEditModal" style="position: absolute; top: 1rem; right: 1rem; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--text-muted);">&times;</button>

        <h2 style="font-size: 1.4rem; color: var(--secondary); margin-bottom: 1rem;">I-Edit ang Media Details</h2>
        
        <form action="api/edit_handler.php" method="POST">
            <input type="hidden" id="editFilepath" name="filepath" value="">
            <input type="hidden" name="redirect" value="../gallery.php">

            <div class="form-group">
                <label for="editMediaTitle" class="form-label">Pamagat (Media Title): *</label>
                <input type="text" id="editMediaTitle" name="mediaTitle" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="editMediaDescription" class="form-label">Deskripsyon (Media Description):</label>
                <textarea id="editMediaDescription" name="mediaDescription" class="form-control" rows="4"></textarea>
            </div>

            <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 1.5rem;">
                <button type="button" class="btn btn-secondary" id="cancelEditBtn">Kanselahin</button>
                <button type="submit" class="btn btn-primary">I-Save ang Bagong Impormasyon</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal & Filter JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. Category Filtering
    const filterBtns = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.gallery-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            filterBtns.forEach(b => {
                b.classList.remove('active');
                b.setAttribute('aria-selected', 'false');
            });
            btn.classList.add('active');
            btn.setAttribute('aria-selected', 'true');

            const filter = btn.getAttribute('data-filter');

            cards.forEach(card => {
                if (filter === 'all' || card.getAttribute('data-category') === filter) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // 2. Edit Modal Functionality
    const editModal = document.getElementById('editModal');
    const closeEditModal = document.getElementById('closeEditModal');
    const cancelEditBtn = document.getElementById('cancelEditBtn');
    const editFilepathInput = document.getElementById('editFilepath');
    const editTitleInput = document.getElementById('editMediaTitle');
    const editDescInput = document.getElementById('editMediaDescription');

    const editBtns = document.querySelectorAll('.edit-btn');
    editBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const path = btn.getAttribute('data-path');
            const title = btn.getAttribute('data-title');
            const desc = btn.getAttribute('data-desc');

            if (editFilepathInput && editTitleInput && editDescInput && editModal) {
                editFilepathInput.value = path;
                editTitleInput.value = title;
                editDescInput.value = desc;
                editModal.style.display = 'flex';
            }
        });
    });

    function hideModal() {
        if (editModal) editModal.style.display = 'none';
    }

    if (closeEditModal) closeEditModal.addEventListener('click', hideModal);
    if (cancelEditBtn) cancelEditBtn.addEventListener('click', hideModal);

    window.addEventListener('click', (e) => {
        if (e.target === editModal) hideModal();
    });
});
</script>

<?php include 'includes/footer.php'; ?>
