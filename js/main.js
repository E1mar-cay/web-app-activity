/*
  Savoria JavaScript - Mobile Menu Toggle & Interactive Accessibility Controls
*/

document.addEventListener('DOMContentLoaded', () => {
    // 1. Mobile Navigation Toggle
    const mobileToggle = document.getElementById('mobileNavToggle');
    const navMenu = document.getElementById('navMenu');

    if (mobileToggle && navMenu) {
        mobileToggle.addEventListener('click', () => {
            const isExpanded = mobileToggle.getAttribute('aria-expanded') === 'true';
            mobileToggle.setAttribute('aria-expanded', !isExpanded);
            navMenu.classList.toggle('show');
        });
    }

    // 2. Audio Transcript Toggle Functionality
    const transcriptBtns = document.querySelectorAll('.transcript-toggle');
    transcriptBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.getAttribute('data-target');
            const targetContent = document.getElementById(targetId);
            
            if (targetContent) {
                const isShowing = targetContent.classList.contains('show');
                targetContent.classList.toggle('show');
                btn.setAttribute('aria-expanded', !isShowing);
                btn.innerHTML = isShowing 
                    ? '<span>Show Audio Transcript</span> &#9660;' 
                    : '<span>Hide Audio Transcript</span> &#9650;';
            }
        });
    });

    // 3. Prevent auto-play audio with sound rule validation
    const audioElements = document.querySelectorAll('audio');
    audioElements.forEach(audio => {
        audio.autoplay = false;
    });
});
