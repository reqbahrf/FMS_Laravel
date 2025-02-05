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

        QUARTERLY_REPORT: string;
    }
    interface USERS_LIST_ROUTE {
        GET_STAFF_USER_ACTIVITY_LOGS: string;
    }
    interface DRAFT_ROUTE {
        GET_FILE: string;
        GET: string;
        STORE: string;
    }

    interface APPLICANT_TAB_ROUTE {
        GET_APPLICANTS: string;
        GET_TNA_DOCUMENT: string;
        GET_PROJECT_PROPOSAL: string;
    }

   interface STAFF_DASHBOARD_ROUTE {
        STORE_PAYMENT_RECORDS: string;
        UPDATE_PAYMENT_RECORDS: string;
   }

    

    // Declare NAV_ROUTES as a global variable
    global {
        var DASHBOARD_TAB_ROUTE: STAFF_DASHBOARD_ROUTE;
        var NAV_ROUTES: NavRoutes;
        var USER_ACTIVITY_LOG_ROUTE: string;
        var USERS_LIST_ROUTE: USERS_LIST_ROUTE;
        var DRAFT_ROUTE: DRAFT_ROUTE;
        var APPLICANT_TAB_ROUTE: APPLICANT_TAB_ROUTE;
        var PROJECTS_PAYMENT_RECORDS_ROUTE: string
    }
}