import NavigationHandler from '../Utilities/TabNavigationHandler';

export default class CoopPageNavHandler extends NavigationHandler {
    constructor(
        TabContainer: JQuery<HTMLElement>,
        userRole: string,
        MappedUrlsRoutes: { [key: string]: Function },
        PageFunctionsInitializer: Function
    ) {
        super(
            TabContainer,
            userRole,
            MappedUrlsRoutes,
            PageFunctionsInitializer
        );
    }

    protected async _getPageFunction(
        url: string,
        functions: Function
    ): Promise<Function> {
        const urlRoute = this.getUrlRoutes();
        const parsedUrl = new URL(url);
        const urlParts = parsedUrl.pathname.split('/');

        // Check for quarterly report route
        const quarterlyReportUrlPath = urlParts.slice(0, 3).join('/');
        const reportSubmitted = urlParts[urlParts.length - 1] === 'true';
        console.log('quarterlyReportUrlPath', quarterlyReportUrlPath);
        const isQuarterlyReportRoute =
            quarterlyReportUrlPath === NAV_ROUTES.QUARTERLY_REPORT;
        const isReportSubmitted = reportSubmitted === true;

        if (!isQuarterlyReportRoute && !isReportSubmitted) {
            return await urlRoute[url](functions);
        }
        if (isQuarterlyReportRoute && !isReportSubmitted) {
            return await urlRoute[NAV_ROUTES.QUARTERLY_REPORT](functions);
        } else {
            return await urlRoute[NAV_ROUTES.QUARTERLY_REPORT](
                functions,
                isReportSubmitted
            );
        }
    }
}
