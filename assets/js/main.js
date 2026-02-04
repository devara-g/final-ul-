/**
 * SMP PGRI 3 Bogor - Main JavaScript
 * Vanilla JS untuk frontend (Hero slider, Navbar, Gallery filter, Forms)
 */

document.addEventListener('DOMContentLoaded', () => {
  // AOS Animation Init
  if (window.AOS) {
    AOS.init({
      duration: 800,
      once: true,
      easing: 'ease-out'
    });
  }

  // Hero Slider
  const slides = document.querySelectorAll('.hero-slide');
  let currentSlide = 0;
  if (slides.length) {
    slides[currentSlide].classList.add('active');
    setInterval(() => {
      slides[currentSlide].classList.remove('active');
      currentSlide = (currentSlide + 1) % slides.length;
      slides[currentSlide].classList.add('active');
    }, 5000);
  }

  // Hamburger Menu - Mobile Navigation
  const navToggle = document.getElementById('nav-toggle');
  const mainNav = document.querySelector('.main-nav');
  const navList = document.querySelector('.nav-list');

  if (navToggle && mainNav) {
    navToggle.addEventListener('click', () => {
      const isOpen = mainNav.classList.toggle('is-open');
      navToggle.setAttribute('aria-expanded', isOpen);
      document.body.style.overflow = isOpen ? 'hidden' : '';
    });

    // Tutup menu saat klik link (untuk SPA-like behavior)
    navList?.addEventListener('click', (e) => {
      if (e.target.closest('a')) {
        mainNav.classList.remove('is-open');
        navToggle.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      }
    });

    // Tutup menu saat resize ke desktop
    window.addEventListener('resize', () => {
      if (window.innerWidth > 960) {
        mainNav.classList.remove('is-open');
        navToggle?.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      }
    });
  }

  // Gallery Filter
  const filterButtons = document.querySelectorAll('.filter-btn[data-filter]');
  const galleryItems = document.querySelectorAll('.gallery-item[data-category]');

  if (filterButtons.length && galleryItems.length) {
    filterButtons.forEach((btn) => {
      btn.addEventListener('click', () => {
        const category = btn.dataset.filter;
        filterButtons.forEach((item) => item.classList.remove('active'));
        btn.classList.add('active');

        galleryItems.forEach((item) => {
          const isMatch = category === 'semua' || item.dataset.category === category;
          item.style.display = isMatch ? 'block' : 'none';
        });
      });
    });
  }

  // Login Tabs (jika ada)
  const loginTabs = document.querySelectorAll('.login-tabs button');
  const loginForms = document.querySelectorAll('.login-form');

  if (loginTabs.length && loginForms.length > 1) {
    loginTabs.forEach((tab) => {
      tab.addEventListener('click', () => {
        const target = tab.dataset.target;
        loginTabs.forEach((t) => t.classList.remove('active'));
        loginForms.forEach((form) => form.classList.remove('active'));
        tab.classList.add('active');
        document.getElementById(target)?.classList.add('active');
      });
    });
  }

  // Contact Form
  const contactForm = document.querySelector('.contact-form');
  if (contactForm) {
    contactForm.addEventListener('submit', (event) => {
      event.preventDefault();
      // TODO: Backend - Submit ke API handler untuk kirim email/store ke database
      alert('Pesan terkirim! Integrasikan dengan proses backend untuk pengiriman sebenarnya.');
    });
  }

  // Subscribe Form
  const subscribeForm = document.querySelector('.subscribe-form');
  if (subscribeForm) {
    subscribeForm.addEventListener('submit', (event) => {
      event.preventDefault();
      // TODO: Backend - Simpan email ke tabel newsletter
      alert('Terima kasih telah bergabung dengan newsletter kami.');
    });
  }
});
