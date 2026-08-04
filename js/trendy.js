(function() {
  'use strict';

  const STORAGE_KEY = 'trendy-theme';

  // =========== THEME TOGGLE ===========
  function getTheme() {
    return localStorage.getItem(STORAGE_KEY) || 'light';
  }

  function setTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem(STORAGE_KEY, theme);
    const icon = document.querySelector('.theme-toggle i');
    if (icon) {
      icon.className = theme === 'dark' ? 'fas fa-sun' : 'fas fa-moon';
    }
  }

  function toggleTheme() {
    const current = getTheme();
    setTheme(current === 'dark' ? 'light' : 'dark');
  }

  // =========== SIDEBAR TOGGLE ===========
  function toggleSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.querySelector('.sidebar-overlay');
    sidebar.classList.toggle('show');
    if (overlay) overlay.classList.toggle('show');
  }

  function closeSidebar() {
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.querySelector('.sidebar-overlay');
    sidebar.classList.remove('show');
    if (overlay) overlay.classList.remove('show');
  }

  // =========== MODAL SYSTEM ===========
  function openModal(id) {
    const modal = document.getElementById(id);
    if (!modal) return;
    modal.classList.add('show');
    modal.style.display = '';
    document.body.style.overflow = 'hidden';
    modal.dispatchEvent(new CustomEvent('trendy:open'));
  }

  function closeModal(modal) {
    modal.classList.remove('show');
    modal.style.display = '';
    document.body.style.overflow = '';
    modal.dispatchEvent(new CustomEvent('trendy:close'));
  }

  // =========== ACTIVE SIDEBAR LINK ===========
  function setActiveSidebar() {
    const path = window.location.pathname;
    const filename = path.substring(path.lastIndexOf('/') + 1);
    document.querySelectorAll('.sidebar-nav .nav-link').forEach(function(link) {
      const href = link.getAttribute('href');
      if (!href || href === '' || href.startsWith('http')) return;
      const base = href.replace('.php', '');
      if (filename === href || filename.startsWith(base)) {
        link.classList.add('active');
      }
    });
  }

  // =========== SIDEBAR SUBMENU ===========
  function setupSubmenus() {
    document.querySelectorAll('.nav-parent-toggle').forEach(function(toggle) {
      toggle.addEventListener('click', function(e) {
        e.preventDefault();
        var parent = toggle.closest('.nav-parent');
        if (parent) parent.classList.toggle('open');
      });
    });

    // Auto-expand parent if one of its children is active
    document.querySelectorAll('.sidebar-subnav .nav-link.active').forEach(function(link) {
      var parent = link.closest('.nav-parent');
      if (parent) parent.classList.add('open');
    });
  }

  // =========== TOAST NOTIFICATIONS ===========
  function showToast(message, type) {
    type = type || 'info';
    const container = document.querySelector('.toast-container');
    if (!container) {
      const div = document.createElement('div');
      div.className = 'toast-container';
      document.body.appendChild(div);
    }
    const toast = document.createElement('div');
    toast.className = 'toast toast-' + type;
    const icons = { success: 'fa-check-circle', error: 'fa-times-circle', warning: 'fa-exclamation-triangle', info: 'fa-info-circle' };
    toast.innerHTML = '<i class="fas ' + (icons[type] || icons.info) + '"></i> ' + message;
    document.querySelector('.toast-container').appendChild(toast);
    setTimeout(function() {
      toast.style.opacity = '0';
      toast.style.transform = 'translateX(100%)';
      toast.style.transition = 'all 0.3s ease';
      setTimeout(function() { toast.remove(); }, 300);
    }, 3000);
  }

  // =========== AUTO-HIDE ALERTS ===========
  function autoHideAlerts() {
    document.querySelectorAll('.alert-auto-hide').forEach(function(alert) {
      setTimeout(function() {
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-10px)';
        alert.style.transition = 'all 0.3s ease';
        setTimeout(function() { alert.remove(); }, 300);
      }, 4000);
    });
  }

  // =========== INIT ===========
  function init() {
    setTheme(getTheme());
    setActiveSidebar();
    setupSubmenus();
    autoHideAlerts();

    // Sidebar toggle
    var toggles = document.querySelectorAll('.sidebar-toggle');
    toggles.forEach(function(el) {
      el.addEventListener('click', function(e) {
        e.preventDefault();
        toggleSidebar();
      });
    });

    // Sidebar overlay close
    var overlay = document.querySelector('.sidebar-overlay');
    if (overlay) {
      overlay.addEventListener('click', closeSidebar);
    }

    // Theme toggle
    var themeToggles = document.querySelectorAll('.theme-toggle');
    themeToggles.forEach(function(el) {
      el.addEventListener('click', function(e) {
        e.preventDefault();
        toggleTheme();
      });
    });

    // Modal triggers
    document.querySelectorAll('[data-toggle="modal"]').forEach(function(btn) {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var target = this.getAttribute('data-target');
        if (target) openModal(target.replace('#', ''));
      });
    });

    // Modal close buttons
    document.querySelectorAll('.modal-close, .modal .btn-close-modal').forEach(function(el) {
      el.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        var modal = this.closest('.modal-overlay');
        if (modal) closeModal(modal);
      });
    });

    // Close modal on Escape
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        document.querySelectorAll('.modal-overlay.show').forEach(closeModal);
      }
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
  } else {
    init();
  }

  // Expose to global scope
  window.trendy = {
    openModal: openModal,
    closeModal: closeModal,
    toggleSidebar: toggleSidebar,
    toggleTheme: toggleTheme,
    showToast: showToast,
    getTheme: getTheme,
    setTheme: setTheme
  };
})();
