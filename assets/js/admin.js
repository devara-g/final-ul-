/**
 * Admin Dashboard - SMP PGRI 3 Bogor
 * Vanilla JS untuk interaksi Admin: Section switching, Form toggle, Submit handlers
 * TODO: Integrasikan dengan API/endpoint backend untuk CRUD database
 */

document.addEventListener("DOMContentLoaded", () => {
  const sidebarLinks = document.querySelectorAll(
    ".admin-sidebar a[data-section]",
  );
  const sections = document.querySelectorAll(".admin-section");

  // Sidebar Navigation - switch sections
  if (sidebarLinks.length && sections.length) {
    sidebarLinks.forEach((link) => {
      link.addEventListener("click", (e) => {
        if (link.getAttribute("href") === "#") e.preventDefault();
        const target = link.dataset.section;

        sidebarLinks.forEach((item) => item.classList.remove("active"));
        sections.forEach((section) => section.classList.remove("active"));

        link.classList.add("active");
        const targetSection = document.getElementById(target);
        if (targetSection) targetSection.classList.add("active");
      });
    });
  }

  // ========== MANAGE BERITA ==========
  const btnTambahBerita = document.getElementById("btn-tambah-berita");
  const formBeritaWrapper = document.getElementById("form-berita-wrapper");
  const formBerita = document.getElementById("formBerita");
  const btnBatalBerita = document.getElementById("btn-batal-berita");

  if (btnTambahBerita && formBeritaWrapper) {
    btnTambahBerita.addEventListener("click", () => {
      formBeritaWrapper.style.display =
        formBeritaWrapper.style.display === "none" ? "block" : "none";
      document.getElementById("form-berita-title").textContent =
        "Tambah Berita Baru";
      formBerita?.reset();
    });
  }

  if (btnBatalBerita && formBeritaWrapper) {
    btnBatalBerita.addEventListener("click", () => {
      formBeritaWrapper.style.display = "none";
    });
  }

  if (formBerita) {
    formBerita.addEventListener("submit", (e) => {
      e.preventDefault();
      // TODO: Backend - POST ke API/endpoint simpan berita (INSERT/UPDATE tabel berita)
      alert("Berita berhasil disimpan! Sambungkan dengan endpoint backend.");
      formBeritaWrapper.style.display = "none";
    });
  }

  // Edit & Delete Berita (tombol di tabel)
  document.querySelectorAll("#section-berita .btn-edit").forEach((btn) => {
    btn.addEventListener("click", () => {
      const id = btn.dataset.id;
      // TODO: Backend - Fetch data berita by ID, populate form, tampilkan form edit
      alert(
        "Edit berita ID: " + id + ". Sambungkan dengan API GET berita by ID.",
      );
    });
  });

  document.querySelectorAll("#section-berita .btn-delete").forEach((btn) => {
    btn.addEventListener("click", () => {
      const id = btn.dataset.id;
      if (confirm("Yakin hapus berita ini?")) {
        // TODO: Backend - DELETE FROM berita WHERE id = ?
        alert("Berita dihapus. Sambungkan dengan endpoint DELETE.");
      }
    });
  });

  // ========== MANAGE GALERI ==========
  const btnTambahGaleri = document.getElementById("btn-tambah-galeri");
  const formGaleriWrapper = document.getElementById("form-galeri-wrapper");
  const formGaleri = document.getElementById("formGaleri");
  const btnBatalGaleri = document.getElementById("btn-batal-galeri");

  if (btnTambahGaleri && formGaleriWrapper) {
    btnTambahGaleri.addEventListener("click", () => {
      formGaleriWrapper.style.display =
        formGaleriWrapper.style.display === "none" ? "block" : "none";
    });
  }

  if (btnBatalGaleri && formGaleriWrapper) {
    btnBatalGaleri.addEventListener("click", () => {
      formGaleriWrapper.style.display = "none";
    });
  }

  if (formGaleri) {
    formGaleri.addEventListener("submit", (e) => {
      e.preventDefault();
      // TODO: Backend - Handle file upload, simpan ke tabel galeri
      alert("Foto berhasil diupload! Sambungkan dengan endpoint backend.");
      formGaleriWrapper.style.display = "none";
    });
  }

  // ========== KALENDER ACARA ==========
  const formKalender = document.getElementById("formKalender");

  if (formKalender) {
    formKalender.addEventListener("submit", (e) => {
      e.preventDefault();
      const formData = new FormData(formKalender);
      // TODO: Backend - INSERT INTO kalender_acara (judul, tanggal, waktu, lokasi, keterangan)
      alert(
        "Kegiatan berhasil ditambahkan! Sambungkan dengan endpoint backend.",
      );
      formKalender.reset();
    });
  }

  // ========== MANAGE PESAN ==========
  document.querySelectorAll("#section-pesan .btn-reply").forEach((btn) => {
    btn.addEventListener("click", () => {
      const email = btn.dataset.email;
      window.location.href = `mailto:${email}`;
    });
  });

  document.querySelectorAll("#section-pesan .btn-delete").forEach((btn) => {
    btn.addEventListener("click", () => {
      const id = btn.dataset.id;
      if (confirm("Yakin hapus pesan ini?")) {
        // TODO: Backend - DELETE FROM pesan WHERE id = ?
        alert("Pesan dihapus. Sambungkan dengan endpoint DELETE.");
      }
    });
  });
});
