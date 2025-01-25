import { showToastFeedback } from './utilFunctions';
/**
 * @class NavigationHandler
 * @description Handles tab-based navigation in the application, including page loading, caching, and state management.
 */
export default class NavigationHandler {
    /**
     * Creates an instance of NavigationHandler.
     * @param {jQuery} TabContainer - jQuery object representing the container where tab content will be loaded
     * @param {string} userRole - The role of the current user
     * @param {Object.<string, Function>} MappedUrlsRoutes - Object mapping URLs to their corresponding route handler functions
     * @param {Function} PageFunctionsInitializer - Function that initializes page-specific functionality
     */
    constructor(
        TabContainer,
        userRole,
        MappedUrlsRoutes,
        PageFunctionsInitializer
    ) {
        this.tabContainer = TabContainer;
        this.userRole = userRole;
        this.MappedUrlsRoutes = MappedUrlsRoutes;
        this.PageFunctionsInitializer = PageFunctionsInitializer;
        this.spinner = $('.spinner');
        this.currentPage = null;
    }

    /**
     * Initializes the navigation handler by loading the last visited page or dashboard as default
     * @returns {void}
     */
    init() {
        const lastUrl = sessionStorage.getItem(`${this.userRole}LastUrl`);
        const lastActive = sessionStorage.getItem(`${this.userRole}LastActive`);
        if (lastUrl && lastActive) {
            this.loadPage(lastUrl, lastActive);
        } else {
            this.loadPage(NAV_ROUTES.DASHBOARD, 'dashboardLink');
        }
    }

    /**
     * Sets the active navigation link in the UI
     * @param {string} activeLink - The ID of the link to be activated
     * @returns {void}
     */
    _setActiveLink(activeLink) {
        $('.nav-item a').removeClass('active');
        const defaultLink = 'dashboardLink';
        const linkToActivate = $('#' + (activeLink || defaultLink));
        linkToActivate.addClass('active');
    }

    /**
     * Loads a page content via AJAX or from session storage cache
     * @param {string} url - The URL of the page to load
     * @param {string} activeLink - The ID of the navigation link to activate
     * @returns {Promise<void>}
     * @throws {Error} When page loading fails
     */
    async loadPage(url, activeLink) {
        try {
            $(document).trigger('page:changing', {
                from: this.currentPage,
                to: activeLink,
            });

            this.currentPage = activeLink;

            this.spinner.removeClass('d-none');
            this.tabContainer.hide();
            const cachedPage = sessionStorage.getItem(url);
            if (cachedPage) {
                // If cached, use the cached response
                this._handleLoadPageResponse(cachedPage, activeLink, url);
            } else {
                const response = await $.ajax({
                    url: url,
                    method: 'GET',
                    accepts: 'text/html',
                });
                await this._handleLoadPageResponse(response, activeLink, url);
            }
        } catch (error) {
            this.spinner.addClass('d-none');
            showToastFeedback('text-bg-danger', error);
        } finally {
            this.spinner.addClass('d-none');
            this.tabContainer.show();
        }
    }

    /**
     * Handles the response from page loading, updates the UI, and initializes page functions
     * @param {string} response - The HTML content of the loaded page
     * @param {string} activeLink - The ID of the navigation link to activate
     * @param {string} url - The URL of the loaded page
     * @returns {Promise<void>}
     * @throws {Error} When handling page response fails
     * @private
     */
    async _handleLoadPageResponse(response, activeLink, url) {
        try {
            const functions = await this.PageFunctionsInitializer();
            const urlRoute = this.MappedUrlsRoutes;

            this.tabContainer.html(response);
            this._setActiveLink(activeLink);
            history.pushState(null, '', url);

            if (urlRoute[url]) {
                const pageFunction = await urlRoute[url](functions);
                if (typeof pageFunction === 'function') {
                    await pageFunction();
                }
            }

            //sessionStorage.setItem(url, response);
            sessionStorage.setItem(`${this.userRole}LastUrl`, url);
            sessionStorage.setItem(`${this.userRole}LastActive`, activeLink);
        } catch (error) {
            console.error('Page load error:', error);
            throw new Error(error.message || 'Failed to handle page response');
        }
    }

    /**
     * Gets the current page
     * @returns {string|null} The current page
     */
    getCurrentPage() {
        return this.currentPage;
    }
}
