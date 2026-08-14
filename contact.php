<?php
$page_title = "Contact Us & Media Credits | Savoria Culinary Hub";
$active_page = "contact";
include 'includes/header.php';
?>

<section class="section" aria-labelledby="contact-heading">
    <div class="container">
        <div class="section-header">
            <h1 id="contact-heading">Get in Touch & Media Credits</h1>
            <p>Have questions about our recipes or media submission guidelines? Send us a message or review asset attributions below.</p>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: flex-start;">
            <!-- Contact Form -->
            <div style="background: var(--bg-card); padding: 2rem; border-radius: var(--border-radius); border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
                <h2 style="font-size: 1.5rem; margin-bottom: 1.25rem;">Contact Savoria Team</h2>
                
                <form action="#" method="POST" onsubmit="event.preventDefault(); alert('Thank you for your message! Our team will respond shortly.');">
                    <div class="form-group">
                        <label for="fullName" class="form-label">Full Name:</label>
                        <input type="text" id="fullName" name="fullName" class="form-control" placeholder="e.g. Maria Santos" required aria-required="true">
                    </div>

                    <div class="form-group">
                        <label for="emailAddress" class="form-label">Email Address:</label>
                        <input type="email" id="emailAddress" name="emailAddress" class="form-control" placeholder="e.g. maria@example.com" required aria-required="true">
                    </div>

                    <div class="form-group">
                        <label for="subject" class="form-label">Subject:</label>
                        <select id="subject" name="subject" class="form-control" required aria-required="true">
                            <option value="">Select a topic...</option>
                            <option value="recipe">Recipe Inquiry</option>
                            <option value="upload">Media Upload Question</option>
                            <option value="accessibility">Accessibility Feedback</option>
                            <option value="general">General Support</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="messageText" class="form-label">Message:</label>
                        <textarea id="messageText" name="messageText" class="form-control" rows="4" placeholder="Your inquiry or feedback..." required aria-required="true"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
                </form>
            </div>

            <!-- Credits & Acknowledgements -->
            <div style="background: var(--bg-card); padding: 2rem; border-radius: var(--border-radius); border: 1px solid var(--border-color); box-shadow: var(--shadow-sm);">
                <h2 style="font-size: 1.5rem; margin-bottom: 1.25rem;">Media & Asset Credits</h2>
                <p style="color: var(--text-muted); margin-bottom: 1.5rem; font-size: 0.95rem;">
                    Savoria incorporates high-quality royalty-free imagery, audio tracks, and video clips under Creative Commons guidelines for educational purposes.
                </p>

                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <div style="border-left: 4px solid var(--primary); padding-left: 1rem;">
                        <h4 style="font-size: 1rem;">Photography Assets</h4>
                        <p style="font-size: 0.85rem; color: var(--text-muted);">Hero Banner & Recipe Spotlights generated and curated via Google DeepMind Imagen Studio (WebP/JPEG format).</p>
                    </div>

                    <div style="border-left: 4px solid var(--accent); padding-left: 1rem;">
                        <h4 style="font-size: 1rem;">Audio Narration & Ambience</h4>
                        <p style="font-size: 0.85rem; color: var(--text-muted);">Audio guides sampled from standard open WebAudio libraries (MP3/OGG formats with HTML5 transcripts).</p>
                    </div>

                    <div style="border-left: 4px solid var(--secondary); padding-left: 1rem;">
                        <h4 style="font-size: 1rem;">Video Demonstration & Subtitles</h4>
                        <p style="font-size: 0.85rem; color: var(--text-muted);">MP4 Video tutorial accompanied by custom WebVTT subtitle track (<code>subtitles.vtt</code>).</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
