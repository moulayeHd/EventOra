document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const panels = Array.from(document.querySelectorAll('[data-admin-section-panel]'));
    const navItems = Array.from(document.querySelectorAll('.admin-nav__item[data-admin-section-target]'));
    const sectionTriggers = Array.from(document.querySelectorAll('[data-admin-section-target]'));
    const title = document.querySelector('[data-admin-topbar-title]');
    const subtitle = document.querySelector('[data-admin-topbar-subtitle]');
    const sidebarToggle = document.querySelector('[data-admin-sidebar-toggle]');
    const sidebarClose = document.querySelector('[data-admin-sidebar-close]');
    const sidebarOverlay = document.querySelector('[data-admin-sidebar-overlay]');
    const profileToggle = document.querySelector('[data-admin-profile-toggle]');
    const profileMenu = document.querySelector('[data-admin-profile-menu]');
    const toastBox = document.querySelector('[data-admin-toast-box]');

    let toastTimer = null;

    const closeSidebar = () => {
        body.classList.remove('is-admin-sidebar-open');
    };

    const closeProfileMenu = () => {
        if (!profileToggle || !profileMenu) {
            return;
        }

        profileMenu.hidden = true;
        profileToggle.setAttribute('aria-expanded', 'false');
    };

    const getActivePanel = () => panels.find((panel) => panel.classList.contains('is-active'));

    const updateTopbar = (section) => {
        const nav = navItems.find((item) => item.dataset.adminSectionTarget === section);

        if (!nav) {
            return;
        }

        if (title) {
            title.textContent = nav.dataset.title || nav.textContent.trim();
        }

        if (subtitle) {
            subtitle.textContent = nav.dataset.subtitle || '';
        }
    };

    const applyFilters = () => {
        const panel = getActivePanel();

        if (!panel) {
            return;
        }

        const localSearch = panel.querySelector('[data-admin-panel-search]');
        const query = (localSearch?.value || '').trim().toLowerCase();

        panel.querySelectorAll('[data-admin-searchable]').forEach((item) => {
            const matches = !query || item.textContent.toLowerCase().includes(query);
            item.classList.toggle('is-admin-search-hidden', !matches);
        });
    };

    const clearLocalSearches = () => {
        document.querySelectorAll('[data-admin-panel-search]').forEach((input) => {
            input.value = '';
        });
    };

    const activateSection = (section, updateHash = true) => {
        const targetPanel = panels.find((panel) => panel.dataset.adminSectionPanel === section);

        if (!targetPanel) {
            return;
        }

        panels.forEach((panel) => {
            const active = panel === targetPanel;
            panel.hidden = !active;
            panel.classList.toggle('is-active', active);
        });

        navItems.forEach((item) => {
            const active = item.dataset.adminSectionTarget === section;
            item.classList.toggle('is-active', active);
            item.setAttribute('aria-current', active ? 'page' : 'false');
        });

        updateTopbar(section);
        clearLocalSearches();
        applyFilters();
        closeSidebar();
        closeProfileMenu();

        if (updateHash) {
            history.replaceState(null, '', `#${section}`);
        }
    };

    const showToast = (message) => {
        if (!toastBox || !message) {
            return;
        }

        window.clearTimeout(toastTimer);
        toastBox.textContent = message;
        toastBox.hidden = false;
        toastBox.classList.add('is-visible');

        toastTimer = window.setTimeout(() => {
            toastBox.classList.remove('is-visible');
            toastBox.hidden = true;
        }, 2600);
    };

    sectionTriggers.forEach((trigger) => {
        trigger.addEventListener('click', (event) => {
            const section = trigger.dataset.adminSectionTarget;

            if (!section) {
                return;
            }

            event.preventDefault();
            activateSection(section);
        });
    });

    document.querySelectorAll('[data-admin-panel-search]').forEach((input) => {
        input.addEventListener('input', applyFilters);
    });

    document.querySelectorAll('[data-admin-toast]').forEach((trigger) => {
        trigger.addEventListener('click', () => showToast(trigger.dataset.adminToast));
    });

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', () => body.classList.add('is-admin-sidebar-open'));
    }

    if (sidebarClose) {
        sidebarClose.addEventListener('click', closeSidebar);
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }

    if (profileToggle && profileMenu) {
        profileToggle.addEventListener('click', (event) => {
            event.stopPropagation();
            const willOpen = profileMenu.hidden;
            profileMenu.hidden = !willOpen;
            profileToggle.setAttribute('aria-expanded', willOpen ? 'true' : 'false');
        });

        profileMenu.addEventListener('click', (event) => event.stopPropagation());
        document.addEventListener('click', closeProfileMenu);
    }

    document.addEventListener('keydown', (event) => {
        if (event.key !== 'Escape') {
            return;
        }

        closeSidebar();
        closeProfileMenu();
    });

    const initialSection = window.location.hash.replace('#', '') || 'dashboard';
    activateSection(initialSection, false);
});
