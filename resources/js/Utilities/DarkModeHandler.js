class DarkMode {
    constructor() {
        this.documentData = $('html');
        this.toggleButton = $('#toggleDarkMode');
        this.storageKey = 'theme-preference';
        this.setupToggleButton();
    }

    initializeTheme() {
        const savedTheme = localStorage.getItem(this.storageKey);
        if (savedTheme) {
            this._setTheme(savedTheme);
            this._updateToggleButton(savedTheme);
        } else {
            const prefersDark = window.matchMedia(
                '(prefers-color-scheme: dark)'
            ).matches;
            const initialTheme = prefersDark ? 'dark' : 'light';
            this._setTheme(initialTheme);
            this._updateToggleButton(initialTheme);
        }
    }

    setupToggleButton() {
        this.toggleButton.html(this._getButtonContent(this._getCurrentTheme()));

        this.toggleButton.on('click', () => {
            const currentTheme = this._getCurrentTheme();
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            this._setTheme(newTheme);
            this._updateToggleButton(newTheme);
            localStorage.setItem(this.storageKey, newTheme);
        });
    }

    _getCurrentTheme() {
        return this.documentData.attr('data-bs-theme') || 'light';
    }

    _setTheme(theme) {
        this.documentData.attr('data-bs-theme', theme);
    }

    _updateToggleButton(theme) {
        this.toggleButton.html(this._getButtonContent(theme));
    }

    _getButtonContent(theme) {
        return theme === 'dark'
            ? '<i class="ri-sun-fill ri-2x"></i>'
            : '<i class="ri-moon-fill ri-2x"></i>';
    }
}

export default DarkMode;
