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
        ADD_APPLICANT?: string;
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

    interface APPLICANT_TAB_ROUTE {
        GET_TNA_FORM_STATUS: string;
        GET_APPLICANTS: string;
        ADD_NEW_REQUIREMENT: string;
        GET_APPLICANT_REQUIREMENTS: string;
        UPDATE_APPLICANT_REQUIREMENTS: string;
        GET_TNA_DOCUMENT: string;
        GET_PROJECT_PROPOSAL_STATUS: string;
        GET_PROJECT_PROPOSAL: string;
        GET_RTEC_REPORT_STATUS: string;
        GET_RTEC_REPORT: string;
    }

    interface ORG_USER_DASHBOARD_ROUTE {
        GET_PROJECT_LINKS: string;
        STORE_PROJECT_FILES: string;
        UPDATE_PROJECT_LINKS: string;
        STORE_PAYMENT_RECORDS: string;
        UPDATE_PAYMENT_RECORDS: string;
        DELETE_PAYMENT_RECORDS: string;
        DELETE_PROJECT_LINK: string;
        DELETE_QUARTERLY_REPORT: string;
        GET_DASHBOARD_CHARTS_DATA: string;
        GENERATE_DASHBOARD_REPORT: string;
    }
    interface UPDATE_PROJECT_SETTINGS_ROUTE {
        UPDATE_PROJECT_SETTINGS: string;
    }
    interface GENERATE_PROJECT_SHEETS_ROUTE {
        CREATE_STATUS_REPORT_FORM: string;
        CREATE_PROJECT_INFORMATION_SHEET_FORM: string;
        GET_PROJECT_INFORMATION_SHEET_FORM: string;
        GET_DATA_SHEET_REPORT_FORM: string;
        GET_STATUS_REPORT_DATA: string;

        GET_AVAILABLE_QUARTERLY_REPORT: string;

        GET_STATUS_REPORT_YEAR_RECORDS: string;
        GET_PROJECT_INFORMATION_YEAR_RECORDS: string;
    }
    // Declare NAV_ROUTES as a global variable
    global {
        var DASHBOARD_TAB_ROUTE: ORG_USER_DASHBOARD_ROUTE;
        var NAV_ROUTES: NavRoutes;
        var USER_ACTIVITY_LOG_ROUTE: string;
        var USERS_LIST_ROUTE: USERS_LIST_ROUTE;
        var GET_DRAFT_FILE: string;
        var PROJECT_SHEETS_ROUTE: GENERATE_PROJECT_SHEETS_ROUTE;
        var PROJECT_SETTINGS_ROUTE: UPDATE_PROJECT_SETTINGS_ROUTE;
        var APPLICANT_TAB_ROUTE: APPLICANT_TAB_ROUTE;
        var PROJECTS_PAYMENT_RECORDS_ROUTE: string;
    }
}
