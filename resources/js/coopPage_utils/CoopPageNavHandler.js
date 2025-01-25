import NavigationHandler from '../Utilities/TabNavigationHandler';

export default class CoopPageNavHandler extends NavigationHandler {
    constructor(
        TabContainer,
        userRole,
        MappedUrlsRoutes,
        PageFunctionsInitializer
    ) {
        super(
            TabContainer,
            userRole,
            MappedUrlsRoutes,
            PageFunctionsInitializer
        );
    }

    async _handleLoadPageResponse(response, activeLink, url) {
        try {
            // Initialize page context
            const functions = await this._initializePageContext(
                response,
                activeLink,
                url
            );

            // Determine the appropriate page function
            const pageFunction = await this._getPageFunction(url, functions);
            console.log('pageFunction', pageFunction)

            // Execute the page function if it exists
            if (typeof pageFunction === 'function') {
                await pageFunction();
            }

            // Persist navigation state
            this._persistNavigationState(url, activeLink);
        } catch (error) {
            this._handlePageLoadError(error);
        }
    }

    async _initializePageContext(response, activeLink, url) {
        // Load page functions
        const functions = await this.PageFunctionsInitializer();

        // Update UI
        this.tabContainer.html(response);
        this._setActiveLink(activeLink);
        history.pushState(null, '', url);

        return functions;
    }

    async _getPageFunction(url, functions) {
        const urlRoute = this.MappedUrlsRoutes;
        const parsedUrl = new URL(url);
        const urlParts = parsedUrl.pathname.split('/');
        
        // Check for quarterly report route
        const quarterlyReportUrlPath = urlParts.slice(0, 3).join('/');
        const reportSubmitted = urlParts[urlParts.length - 1] === 'true';
        console.log('quarterlyReportUrlPath', quarterlyReportUrlPath)
        const isQuarterlyReportRoute = quarterlyReportUrlPath === NAV_ROUTES.QUARTERLY_REPORT;
        const isReportSubmitted = reportSubmitted === true;

        if (isQuarterlyReportRoute && !isReportSubmitted) {
            return await urlRoute[NAV_ROUTES.QUARTERLY_REPORT](functions);
        } else {
            return await urlRoute[NAV_ROUTES.QUARTERLY_REPORT](functions, isReportSubmitted);
        }
    }

    _persistNavigationState(url, activeLink) {
        sessionStorage.setItem(`${this.userRole}LastUrl`, url);
        sessionStorage.setItem(`${this.userRole}LastActive`, activeLink);
    }

    _handlePageLoadError(error) {
        console.error('Page load error:', error);
        throw new Error(error.message || 'Failed to handle page response');
    }
}
