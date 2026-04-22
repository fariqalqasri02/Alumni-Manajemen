import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Page transition animations
document.addEventListener('DOMContentLoaded', () => {
    // Handle all navigation links
    document.addEventListener('click', (e) => {
        const link = e.target.closest('a');
        
        if (!link) return;
        
        // Skip if link has special attributes
        if (link.hasAttribute('data-no-animation') || 
            link.target === '_blank' || 
            link.hasAttribute('download') ||
            link.href.includes('#')) {
            return;
        }
        
        // Skip external links
        if (link.hostname !== window.location.hostname) {
            return;
        }
        
        // Skip form submissions
        if (link.closest('form')) {
            return;
        }
        
        const shellPage = document.querySelector('.shell-page');
        if (!shellPage) return;
        
        // Add page-exit class for fade out animation
        shellPage.classList.add('page-exit');
        
        // Wait for animation to complete before navigating
        setTimeout(() => {
            window.location.href = link.href;
        }, 300);
        
        e.preventDefault();
    });
    
    // Add fade-in animation when page loads
    const shellPage = document.querySelector('.shell-page');
    if (shellPage) {
        shellPage.classList.remove('page-exit');
    }

    const revealItems = document.querySelectorAll('[data-reveal]');
    if (revealItems.length > 0) {
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('is-visible');
                revealObserver.unobserve(entry.target);
            });
        }, {
            threshold: 0.15,
        });

        revealItems.forEach((item) => {
            item.classList.add('reveal');
            revealObserver.observe(item);
        });
    }
});
