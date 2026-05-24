document.addEventListener('DOMContentLoaded', () => {
    const body = document.body;
    const panels = Array.from(document.querySelectorAll('[data-section-panel]'));
    const navItems = Array.from(document.querySelectorAll('.organizer-nav__item[data-section-target]'));
    const sectionTriggers = Array.from(document.querySelectorAll('[data-section-target]'));
    const title = document.querySelector('[data-topbar-title]');
    const subtitle = document.querySelector('[data-topbar-subtitle]');
    const globalSearch = document.querySelector('[data-global-search]');
    const sidebarToggle = document.querySelector('[data-sidebar-toggle]');
    const sidebarClose = document.querySelector('[data-sidebar-close]');
    const sidebarOverlay = document.querySelector('[data-sidebar-overlay]');
    const modal = document.querySelector('[data-create-modal]');
    const modalOpeners = Array.from(document.querySelectorAll('[data-open-create]'));
    const modalClosers = Array.from(document.querySelectorAll('[data-close-create]'));
    const profileToggle = document.querySelector('[data-profile-toggle]');
    const profileMenu = document.querySelector('[data-profile-menu]');

    const getActivePanel = () => panels.find((panel) => panel.classList.contains('is-active'));

    const closeSidebar = () => {
        body.classList.remove('is-sidebar-open');
    };

    const closeProfileMenu = () => {
        if (!profileMenu || !profileToggle) {
            return;
        }

        profileMenu.hidden = true;
        profileToggle.setAttribute('aria-expanded', 'false');
    };

    const openModal = () => {
        if (!modal) {
            return;
        }

        modal.classList.add('is-open');
        modal.setAttribute('aria-hidden', 'false');
        body.classList.add('is-modal-open');

        const firstInput = modal.querySelector('input:not([type="hidden"]), textarea, select, button');
        if (firstInput) {
            window.setTimeout(() => firstInput.focus(), 80);
        }
    };

    const closeModal = () => {
        if (!modal) {
            return;
        }

        modal.classList.remove('is-open');
        modal.setAttribute('aria-hidden', 'true');
        body.classList.remove('is-modal-open');
    };

    const updateTopbar = (section) => {
        const nav = navItems.find((item) => item.dataset.sectionTarget === section);

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

    const clearLocalSearches = () => {
        document.querySelectorAll('[data-panel-search]').forEach((input) => {
            input.value = '';
        });
    };

    const applyFilters = () => {
        const panel = getActivePanel();

        if (!panel) {
            return;
        }

        const localSearch = panel.querySelector('[data-panel-search]');
        const query = ((localSearch && localSearch.value) || (globalSearch && globalSearch.value) || '').trim().toLowerCase();
        const activeStatus = panel.querySelector('[data-status-filter].is-active');
        const status = activeStatus ? activeStatus.dataset.statusFilter : 'all';

        panel.querySelectorAll('[data-searchable]').forEach((item) => {
            const matchesQuery = !query || item.textContent.toLowerCase().includes(query);
            const itemStatus = item.dataset.status;
            const matchesStatus = !itemStatus || status === 'all' || itemStatus === status;

            item.classList.toggle('is-search-hidden', !matchesQuery);
            item.classList.toggle('is-status-hidden', !matchesStatus);
        });
    };

    const activateSection = (section, updateHash = true) => {
        const targetPanel = panels.find((panel) => panel.dataset.sectionPanel === section);

        if (!targetPanel) {
            return;
        }

        panels.forEach((panel) => {
            const active = panel === targetPanel;
            panel.hidden = !active;
            panel.classList.toggle('is-active', active);
        });

        navItems.forEach((item) => {
            const active = item.dataset.sectionTarget === section;
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

    sectionTriggers.forEach((trigger) => {
        trigger.addEventListener('click', (event) => {
            const section = trigger.dataset.sectionTarget;

            if (!section) {
                return;
            }

            event.preventDefault();
            activateSection(section);
        });
    });

    document.querySelectorAll('[data-panel-search]').forEach((input) => {
        input.addEventListener('input', applyFilters);
    });

    if (globalSearch) {
        globalSearch.addEventListener('input', applyFilters);
    }

    document.querySelectorAll('[data-status-filter]').forEach((button) => {
        button.addEventListener('click', () => {
            const group = button.closest('[data-status-filters]');

            if (group) {
                group.querySelectorAll('[data-status-filter]').forEach((item) => item.classList.remove('is-active'));
            }

            button.classList.add('is-active');
            applyFilters();
        });
    });

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', () => body.classList.add('is-sidebar-open'));
    }

    if (sidebarClose) {
        sidebarClose.addEventListener('click', closeSidebar);
    }

    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeSidebar);
    }

    modalOpeners.forEach((button) => button.addEventListener('click', openModal));
    modalClosers.forEach((button) => button.addEventListener('click', closeModal));

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

        closeModal();
        closeSidebar();
        closeProfileMenu();
    });

    const initialSection = window.location.hash.replace('#', '') || 'overview';
    activateSection(initialSection, false);

    if (document.querySelector('.organizer-flash--error')) {
        openModal();
    }
});
