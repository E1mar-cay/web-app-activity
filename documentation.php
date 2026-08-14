<?php
$page_title = "Technical & Media Documentation | Savoria Filipina Project";
$active_page = "documentation";
include 'includes/header.php';
?>

<section class="section" aria-labelledby="doc-title">
    <div class="container">
        <div class="section-header">
            <h1 id="doc-title">Technical Documentation & Media Report</h1>
            <p>Comprehensive activity documentation for IT AppDev 2 – Web Applications: Media Content Integration.</p>
        </div>

        <!-- Section 1: Project Overview -->
        <div style="background: var(--bg-card); padding: 2rem; border-radius: var(--border-radius); border: 1px solid var(--border-color); margin-bottom: 2.5rem;">
            <h2>1. Project Title & Description</h2>
            <p style="margin-top: 0.5rem; color: var(--text-muted);">
                <strong>Project Title:</strong> Savoria Filipina — Authentic Filipino Recipe & Media Hub<br>
                <strong>Course:</strong> IT AppDev 2 – Web Applications (Website Development Project)<br>
                <strong>Selected Theme:</strong> Food and Recipe Website (Filipino Cuisine)<br>
                <strong>Purpose:</strong> To deploy and serve web media content (Images, Audio, Video) within a fully functional, responsive, accessible, validated, and user-manageable web application.
            </p>
        </div>

        <!-- Section 2: Media Inventory -->
        <div style="background: var(--bg-card); padding: 2rem; border-radius: var(--border-radius); border: 1px solid var(--border-color); margin-bottom: 2.5rem;">
            <h2>2. Media Inventory</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-top: 1rem;">
                <div style="background: var(--bg-light); padding: 1rem; border-radius: 8px;">
                    <h3>Image Assets</h3>
                    <ul style="font-size: 0.9rem; color: var(--text-muted); margin-left: 1rem;">
                        <li><code>savoria-hero-desktop.jpg</code> (Filipino feast banner)</li>
                        <li><code>savoria-hero-tablet.jpg</code> (Tablet hero resolution)</li>
                        <li><code>savoria-hero-mobile.jpg</code> (Mobile hero resolution)</li>
                        <li><code>filipino-adobo.jpg</code> (Chicken & Pork Adobo)</li>
                        <li><code>sinigang-baboy.jpg</code> (Sinigang na Baboy)</li>
                        <li><code>halo-halo.jpg</code> (Special Filipino Halo-Halo)</li>
                        <li><code>chef-avatar.jpg</code> (Chef Maria Santos photo)</li>
                    </ul>
                </div>

                <div style="background: var(--bg-light); padding: 1rem; border-radius: 8px;">
                    <h3>Audio Assets</h3>
                    <ul style="font-size: 0.9rem; color: var(--text-muted); margin-left: 1rem;">
                        <li><code>recipe-guide.mp3</code> (Chef's Adobo audio guide)</li>
                        <li><code>kitchen-ambience.ogg</code> (Fallback format)</li>
                    </ul>
                </div>

                <div style="background: var(--bg-light); padding: 1rem; border-radius: 8px;">
                    <h3>Video & Subtitle Assets</h3>
                    <ul style="font-size: 0.9rem; color: var(--text-muted); margin-left: 1rem;">
                        <li><code>recipe-tutorial.mp4</code> (Filipino Masterclass Video)</li>
                        <li><code>subtitles.vtt</code> (WebVTT Captions track)</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Section 3: Media Format Documentation & Justification Table (Section IX Requirement) -->
        <div style="background: var(--bg-card); padding: 2rem; border-radius: var(--border-radius); border: 1px solid var(--border-color); margin-bottom: 2.5rem;">
            <h2>3. Media Format Documentation & Justification</h2>
            <p style="color: var(--text-muted); margin-bottom: 1rem;">
                The table below identifies the media formats used and justifies their selection as required by Section IX of the activity sheet:
            </p>

            <div style="overflow-x: auto;">
                <table class="doc-table">
                    <thead>
                        <tr>
                            <th>Media Type</th>
                            <th>Format Used</th>
                            <th>Purpose</th>
                            <th>Reason for Selection</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Image</strong></td>
                            <td>JPEG / WebP / SVG</td>
                            <td>Hero banners, recipe cards, chef photos, icons</td>
                            <td>Provides high visual fidelity with optimal compression for fast mobile delivery; SVG offers infinite crisp resolution.</td>
                        </tr>
                        <tr>
                            <td><strong>Audio</strong></td>
                            <td>MP3 / OGG</td>
                            <td>Chef's Adobo audio guide & kitchen ambience</td>
                            <td>MP3 delivers near-universal browser compatibility across desktop and mobile devices; OGG serves as an open fallback.</td>
                        </tr>
                        <tr>
                            <td><strong>Video</strong></td>
                            <td>MP4 (H.264) / WebM</td>
                            <td>Filipino culinary masterclass tutorial</td>
                            <td>MP4 H.264 enables hardware acceleration on all mobile browsers and natively supports WebVTT subtitle track overlays.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Section 4: Responsive & Adaptive Media -->
        <div style="background: var(--bg-card); padding: 2rem; border-radius: var(--border-radius); border: 1px solid var(--border-color); margin-bottom: 2.5rem;">
            <h2>4. Mobile & Desktop Responsive Design</h2>
            <p style="color: var(--text-muted); margin-bottom: 1rem;">
                Savoria Filipina automatically adapts to Desktop, Tablet, and Smartphone screens:
            </p>
            <ul style="margin-left: 1.5rem; color: var(--text-muted); line-height: 1.8;">
                <li><strong>Desktop (>1200px):</strong> 2-column grid layout, expanded header navigation bar, full resolution banner.</li>
                <li><strong>Tablet (600px - 1200px):</strong> Adaptive 2-column recipe grid and intermediate image srcset via <code>&lt;picture&gt;</code> element.</li>
                <li><strong>Smartphone (<600px):</strong> Touch-friendly mobile hamburger drawer navigation menu, 1-column stacked recipe cards, fluid CSS <code>max-width: 100%; height: auto;</code> for all media.</li>
            </ul>
        </div>

        <!-- Section 5: Accessibility Implementation -->
        <div id="accessibility" style="background: var(--bg-card); padding: 2rem; border-radius: var(--border-radius); border: 1px solid var(--border-color); margin-bottom: 2.5rem;">
            <h2>5. Accessibility Implementation (WCAG Compliant)</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; margin-top: 1rem;">
                <div style="background: #eef7ee; padding: 1rem; border-radius: 6px; border: 1px solid #c8e6c9;">
                    <h4 style="color: #2e7d32;">Meaningful Alt Text</h4>
                    <p style="font-size: 0.85rem; color: #1b5e20;">Every image includes descriptive alt text detailing the Filipino dish, ingredients, and setting.</p>
                </div>

                <div style="background: #eef7ee; padding: 1rem; border-radius: 6px; border: 1px solid #c8e6c9;">
                    <h4 style="color: #2e7d32;">Audio & Video Transcripts</h4>
                    <p style="font-size: 0.85rem; color: #1b5e20;">Expandable text transcripts provided for hearing-impaired users or quiet environments.</p>
                </div>

                <div style="background: #eef7ee; padding: 1rem; border-radius: 6px; border: 1px solid #c8e6c9;">
                    <h4 style="color: #2e7d32;">WebVTT Closed Captions</h4>
                    <p style="font-size: 0.85rem; color: #1b5e20;">The HTML5 video tutorial features an embedded <code>&lt;track kind="captions"&gt;</code> file (<code>subtitles.vtt</code>).</p>
                </div>

                <div style="background: #eef7ee; padding: 1rem; border-radius: 6px; border: 1px solid #c8e6c9;">
                    <h4 style="color: #2e7d32;">Keyboard & Form Labels</h4>
                    <p style="font-size: 0.85rem; color: #1b5e20;">Form fields bound with <code>&lt;label for="..."&gt;</code>, skip link, and high contrast colors.</p>
                </div>
            </div>
        </div>

        <!-- Section 6: Validation & Quality Audit Checklist -->
        <div id="validation" style="background: var(--bg-card); padding: 2rem; border-radius: var(--border-radius); border: 1px solid var(--border-color);">
            <h2>6. HTML5 & CSS Validation Audit</h2>
            <ul style="margin-left: 1.5rem; margin-top: 1rem; color: var(--text-muted); line-height: 1.8;">
                <li>&#9989; <strong>Valid HTML5 Structure:</strong> Zero missing closing tags, correct semantic element usage (<code>&lt;header&gt;</code>, <code>&lt;main&gt;</code>, <code>&lt;article&gt;</code>, <code>&lt;footer&gt;</code>).</li>
                <li>&#9989; <strong>Server File Validation:</strong> Upload handler checks MIME signatures and 15MB file size limits.</li>
                <li>&#9989; <strong>No Auto-Play Sound:</strong> Sound media playback requires explicit user action.</li>
            </ul>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
