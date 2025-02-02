/**
 * Global interface for navigation routes
 * This allows type-safe access to routes across different user roles
 */
declare module 'global' {
    interface NavRoutes {
        // Common routes
        DASHBOARD: string;

        // Optional role-specific routes
        PROJECT?: string;
        ADD_PROJECT?: string;
        APPLICANT?: string;
        PROJECTS?: string;
        APPLICATIONS?: string;
        USERS?: string;
        SETTINGS?: string;
    }
    interface USERS_LIST_ROUTE {
        GET_STAFF_USER_ACTIVITY_LOGS: string;
    }

    // Declare NAV_ROUTES as a global variable
    global {
        var NAV_ROUTES: NavRoutes;
        var USER_ACTIVITY_LOG_ROUTE: string;
        var USERS_LIST_ROUTE: USERS_LIST_ROUTE;
    }
}