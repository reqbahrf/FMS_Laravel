import { showToastFeedback } from './utilFunctions';

export default class NavigationHandler {
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
    }

    init() {
        const lastUrl = sessionStorage.getItem(`${this.userRole}LastUrl`);
        const lastActive = sessionStorage.getItem(`${this.userRole}LastActive`);
        if (lastUrl && lastActive) {
            this.loadPage(lastUrl, lastActive);
        }else{
            this.loadPage(NAV_ROUTES.DASHBOARD, 'dashboardLink');
        }
    }

    setActiveLink(activeLink) {
        $('.nav-item a').removeClass('active');
        const defaultLink = 'dashboardLink';
        const linkToActivate = $('#' + (activeLink || defaultLink));
        linkToActivate.addClass('active');
    }

    async loadPage(url, activeLink) {
        try {
            this.spinner.removeClass('d-none');
            this.tabContainer.hide();
            const cachedPage = sessionStorage.getItem(url);
            if (cachedPage) {
                // If cached, use the cached response
                this.handleLoadPageResponse(cachedPage, activeLink, url);
            } else {
                const response = await $.ajax({
                    url: url,
                    method: 'GET',
                    accepts: 'text/html',
                });
                await this.handleLoadPageResponse(response, activeLink, url);
            }
        } catch (error) {
            this.spinner.addClass('d-none');
            showToastFeedback('text-bg-danger', error);
        } finally {
            this.spinner.addClass('d-none');
            this.tabContainer.show();
        }
    }

    async handleLoadPageResponse(response, activeLink, url) {
        try {
            const functions = await this.PageFunctionsInitializer();
            const urlRoute = this.MappedUrlsRoutes;

            this.tabContainer.html(response);
            this.setActiveLink(activeLink);
            history.pushState(null, '', url);

            if (urlRoute[url]) {
                const pageFunction = await urlRoute[url](functions);
                if (typeof pageFunction === 'function') {
                    await pageFunction();
                }
            }

            sessionStorage.setItem(`${this.userRole}LastUrl`, url);
            sessionStorage.setItem(`${this.userRole}LastActive`, activeLink);
        } catch (error) {
            console.error('Page load error:', error);
            throw new Error(error.message || 'Failed to handle page response');
        }
    }
}
