<?php
session_start();
$page_title = "Upload Recipe & Media | Savoria Filipina";
$active_page = "upload";
include 'includes/header.php';
?>

<section class="section" aria-labelledby="upload-heading">
    <div class="container">
        <div class="section-header">
            <h1 id="upload-heading">Upload Recipe & Media</h1>
            <p>Share your own photos of Filipino dishes, audio notes, or cooking demonstrations on Savoria Filipina.</p>
        </div>

        <div class="upload-card">
            <!-- Display Upload Status Message Alert -->
            <?php if (isset($_SESSION['upload_status'])): ?>
                <div class="alert alert-<?php echo $_SESSION['upload_status']['type']; ?>" role="alert">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    <span><?php echo $_SESSION['upload_status']['message']; ?></span>
                </div>
                <?php unset($_SESSION['upload_status']); ?>
            <?php endif; ?>

            <!-- HTML Form for File Upload with Title & Description -->
            <form action="api/upload_handler.php" method="POST" enctype="multipart/form-data" id="uploadForm">
                
                <!-- Media Title Input -->
                <div class="form-group">
                    <label for="mediaTitle" class="form-label">Dish / Media Title: *</label>
                    <input type="text" id="mediaTitle" name="mediaTitle" class="form-control" placeholder="e.g. Grandma's Special Pork Menudo" required aria-required="true">
                </div>

                <!-- Media Description Input -->
                <div class="form-group">
                    <label for="mediaDescription" class="form-label">Food Description / Cooking Notes:</label>
                    <textarea id="mediaDescription" name="mediaDescription" class="form-control" rows="3" placeholder="Write ingredients, flavors, or cooking notes for this recipe..."></textarea>
                </div>

                <!-- File Selection Zone -->
                <div class="form-group">
                    <label for="mediaFile" class="form-label">Select Media File: *</label>
                    
                    <div class="file-dropzone" id="dropzone">
                        <svg class="dropzone-icon" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM14 13v4h-4v-4H7l5-5 5 5h-3z"/>
                        </svg>
                        <p style="font-weight: 600; font-size: 1.1rem; color: var(--secondary);" id="selectedFileName">Click or Drag Media File Here</p>
                        <p style="font-size: 0.85rem; color: var(--text-muted); margin-top: 0.5rem;">Supported Formats: JPEG, WebP, PNG, SVG, MP3, OGG, WAV, MP4, WebM (Max size: 25 MB)</p>
                        
                        <input type="file" id="mediaFile" name="mediaFile" accept="image/*,audio/*,video/*" required aria-required="true">
                    </div>
                </div>

                <div style="text-align: center; margin-top: 2rem;">
                    <button type="submit" class="btn btn-primary" id="submitBtn" style="width: 100%; max-width: 320px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                            <path d="M9 16h6v-6h4l-7-7-7 7h4v6zm-4 2h14v2H5v-2z"/>
                        </svg>
                        Upload Media File
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Upload Loading Spinner Modal Overlay -->
<div id="loadingOverlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.75); z-index: 9999; flex-direction: column; align-items: center; justify-content: center; color: #ffffff; text-align: center; padding: 1rem;">
    <div class="spinner" style="width: 60px; height: 60px; border: 6px solid rgba(255, 255, 255, 0.3); border-top: 6px solid var(--primary); border-radius: 50%; animation: spin 1s linear infinite; margin-bottom: 1.5rem;"></div>
    <h2 style="color: #ffffff; font-size: 1.6rem; margin-bottom: 0.5rem;">Uploading your Media File...</h2>
    <p style="color: #e5dec9; font-size: 1.05rem;">Please wait while the server processes your image, video, or audio file.</p>
</div>

<style>
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const fileInput = document.getElementById('mediaFile');
    const fileNameDisplay = document.getElementById('selectedFileName');
    const uploadForm = document.getElementById('uploadForm');
    const loadingOverlay = document.getElementById('loadingOverlay');

    // Display selected file name
    if (fileInput && fileNameDisplay) {
        fileInput.addEventListener('change', () => {
            if (fileInput.files.length > 0) {
                fileNameDisplay.innerHTML = '📁 Selected File: <strong>' + fileInput.files[0].name + '</strong>';
            }
        });
    }

    // Show loading spinner on form submit
    if (uploadForm && loadingOverlay) {
        uploadForm.addEventListener('submit', () => {
            loadingOverlay.style.display = 'flex';
        });
    }
});
</script>

<?php include 'includes/footer.php'; ?>
