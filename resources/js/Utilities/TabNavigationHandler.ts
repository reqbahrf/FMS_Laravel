
import {
    showToastFeedback,
} from '../Utilities/feedback-toast';
import 'jquery';

type HTMLContent = string;
/**
 * @class NavigationHandler
 * @description Handles tab-based navigation in the application, including page loading, caching, and state management.
 */
export default class NavigationHandler {
    private tabContainer: JQuery<HTMLElement>;
    private userRole: string;
    protected MappedUrlsRoutes: { [key: string]: Function };
    private PageFunctionsInitializer: Function;
    private tabNavItem: JQuery<HTMLElement> | null;
    private spinner: JQuery<HTMLElement>;
    private currentPage: string | null;

    /**
     * Creates an instance of NavigationHandler.
     * @param {JQuery} TabContainer - jQuery object representing the container where tab content will be loaded
     * @param {string} userRole - The role of the current user
     * @param {Object.<string, Function>} MappedUrlsRoutes - Object mapping URLs to their corresponding route handler functions
     * @param {Function} PageFunctionsInitializer - Function that initializes page-specific functionality
     */
    constructor(
        TabContainer: JQuery,
        userRole: string,
        MappedUrlsRoutes: { [key: string]: Function },
        PageFunctionsInitializer: Function
    ) {
        this.tabContainer = TabContainer;
        this.userRole = userRole;
        this.MappedUrlsRoutes = MappedUrlsRoutes;
        this.PageFunctionsInitializer = PageFunctionsInitializer;
        this.tabNavItem = null;
        this.spinner = $('.spinner');
        this.currentPage = null;
    }

    /**
     * Initializes the navigation handler by loading the last visited page or dashboard as default
     * @returns {void}
     */
    public init(): void {
        const lastUrl = sessionStorage.getItem(`${this.userRole}LastUrl`);
        const lastActive = sessionStorage.getItem(`${this.userRole}LastActive`);
        if (lastUrl && lastActive) {
            this.loadPage(lastUrl, lastActive);
        } else {
            this.loadPage(NAV_ROUTES.DASHBOARD, 'dashboardTab');
        }
    }

    /**
     * Sets the active navigation link in the UI
     * @param {string} activeLink - The ID of the link to be activated
     * @returns {void}
     */
    private _setActiveLink(activeLink: string): void {
        this.tabNavItem?.removeClass('active');
        this.tabNavItem = $('#' + activeLink);
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
    public async loadPage(url: string, activeLink: string): Promise<void> {
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
                    type: 'GET',
                    dataType: 'html',
                } as JQuery.AjaxSettings);
                await this._handleLoadPageResponse(response, activeLink, url);
            }
        } catch (error) {
            this.spinner.addClass('d-none');
            showToastFeedback('text-bg-danger', error as string);
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
    async _handleLoadPageResponse(
        response: HTMLContent,
        activeLink: string,
        url: string
    ): Promise<void> {
        try {
            const functions = await this._initializePageContext(
                response,
                activeLink,
                url
            );

            const pageFunction = await this._getPageFunction(url, functions);
            if (typeof pageFunction === 'function') {
                await pageFunction();
            }

            this._persistNavigationState(url, activeLink);
        } catch (error) {
            this._handlePageLoadError(error as Error);
        }
    }

    protected async _getPageFunction(
        url: string,
        functions: Function
    ): Promise<Function> {
        const urlRoute = this.MappedUrlsRoutes;
        return urlRoute[url](functions);
    }

    protected async _initializePageContext(
        response: HTMLContent,
        activeLink: string,
        url: string
    ): Promise<Function> {
        // Load page functions
        const functions = await this.PageFunctionsInitializer();

        // Update UI
        this.tabContainer.html(response);
        this._setActiveLink(activeLink);
        history.pushState(null, '', url);

        return functions;
    }

    private _persistNavigationState(url: string, activeLink: string): void {
        sessionStorage.setItem(`${this.userRole}LastUrl`, url);
        sessionStorage.setItem(`${this.userRole}LastActive`, activeLink);
    }

    private _handlePageLoadError(error: Error): void {
        console.error('Page load error:', error);
        throw new Error(error.message || 'Failed to handle page response');
    }

    /**
     * Gets the current page
     * @returns {string|null} The current page
     */
    public getCurrentPage(): string | null {
        return this.currentPage;
    }

    /**
     * Getter method to access MappedUrlsRoutes
     * @returns {Object.<string, Function>} The mapped URL routes
     */
    protected getUrlRoutes(): { [key: string]: Function } {
        return this.MappedUrlsRoutes;
    }
}
