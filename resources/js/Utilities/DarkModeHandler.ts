enum themeMode {
    Dark = 'dark',
    Light = 'light'
}

class DarkMode {
    documentData: JQuery<HTMLElement>;
    toggleButton: JQuery<HTMLElement>;
    storageKey: string;
    constructor() {
        this.documentData = $('html');
        this.toggleButton = $('#toggleDarkMode');
        this.storageKey = 'theme-preference';
        this.setupToggleButton();
    }

    initializeTheme() {
        const savedTheme = localStorage.getItem(this.storageKey);
        if (savedTheme) {
            this._setTheme(savedTheme as themeMode);
            this._updateToggleButton(savedTheme as themeMode);
        } else {
            const prefersDark = window.matchMedia(
                '(prefers-color-scheme: dark)'
            ).matches;
            const initialTheme = prefersDark ? themeMode.Dark : themeMode.Light;
            this._setTheme(initialTheme);
            this._updateToggleButton(initialTheme);
        }
    }

    setupToggleButton() {
        this.toggleButton.html(this._getButtonContent(this._getCurrentTheme()));

        this.toggleButton.on('click', () => {
            const currentTheme = this._getCurrentTheme();
            const newTheme = currentTheme === themeMode.Dark ? themeMode.Light : themeMode.Dark;

            this._setTheme(newTheme);
            this._updateToggleButton(newTheme);
            localStorage.setItem(this.storageKey, newTheme);
        });
    }

    _getCurrentTheme(): themeMode {
        const currentTheme = this.documentData.attr('data-bs-theme') || 'light';
        return currentTheme === 'dark' ? themeMode.Dark : themeMode.Light;
    }

    _setTheme(theme: themeMode) {
        this.documentData.attr('data-bs-theme', theme);
    }

    _updateToggleButton(theme: themeMode) {
        this.toggleButton.html(this._getButtonContent(theme));
    }

    _getButtonContent(theme: themeMode) {
        return theme === themeMode.Dark
            ? '<i class="ri-sun-fill ri-2x"></i>'
            : '<i class="ri-moon-fill ri-2x"></i>';
    }
}

export default DarkMode;
