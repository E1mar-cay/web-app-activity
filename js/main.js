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

    // 3. Audio elements default handling
    const audioElements = document.querySelectorAll('audio:not(#homeBgAudio)');
    audioElements.forEach(audio => {
        audio.autoplay = false;
    });

    // 4. Home Tab Looping Background Music (kitchen-ambiance.mp3)
    const homeBgAudio = document.getElementById('homeBgAudio');
    const ambientWidget = document.getElementById('ambientAudioWidget');
    const toggleBtn = document.getElementById('ambientAudioToggleBtn');
    const playIcon = document.getElementById('ambientAudioPlayIcon');
    const pauseIcon = document.getElementById('ambientAudioPauseIcon');
    const statusText = document.getElementById('ambientAudioStatusText');

    if (homeBgAudio) {
        homeBgAudio.loop = true;

        const updateUIState = (isPlaying) => {
            if (!ambientWidget || !toggleBtn) return;
            if (isPlaying) {
                ambientWidget.classList.remove('paused');
                if (playIcon) playIcon.style.display = 'none';
                if (pauseIcon) pauseIcon.style.display = 'block';
                if (statusText) statusText.textContent = 'Playing (Looping)';
                toggleBtn.setAttribute('aria-label', 'Pause Kitchen Ambiance background music');
            } else {
                ambientWidget.classList.add('paused');
                if (playIcon) playIcon.style.display = 'block';
                if (pauseIcon) pauseIcon.style.display = 'none';
                if (statusText) statusText.textContent = 'Paused';
                toggleBtn.setAttribute('aria-label', 'Play Kitchen Ambiance background music');
            }
        };

        const playAudio = () => {
            homeBgAudio.play().then(() => {
                updateUIState(true);
            }).catch(err => {
                console.log('Autoplay restricted by browser until user interaction:', err);
                updateUIState(false);
            });
        };

        // Attempt initial autoplay on home tab load
        playAudio();

        // Autoplay fallback on user interaction
        const startOnUserInteraction = () => {
            if (homeBgAudio.paused) {
                playAudio();
            }
        };
        window.addEventListener('click', startOnUserInteraction, { once: true });
        window.addEventListener('keydown', startOnUserInteraction, { once: true });

        if (toggleBtn) {
            toggleBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                if (homeBgAudio.paused) {
                    playAudio();
                } else {
                    homeBgAudio.pause();
                    updateUIState(false);
                }
            });
        }
    }
});

