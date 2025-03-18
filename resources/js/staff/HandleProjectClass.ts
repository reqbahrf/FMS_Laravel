import * as DataTables from 'datatables.net';
import ProjectInfoSheet from './project-form-class/ProjectInfoSheet';
import FileCoopRequirementHandler from './FileCoopRequirementHandler';
import ProjectDataSheet from './project-form-class/ProjectDataSheet';
import ProjectStatusReportSheet from './project-form-class/ProjectStatusReportSheet';
import PaymentHandler from './PaymentHandler';
/**
 * HandleProjectClass manages the initialization and destruction of project-related classes.
 * This centralized manager helps with organizing code and providing a clean interface
 * for working with multiple project-related components.
 */
export default class HandleProjectClass {
    private formContainer: JQuery;
    private projectId: string;
    private businessId: string;
    private applicationId: string;
    private actualAmount: string;
    private projectFileClass: FileCoopRequirementHandler | null;
    private pisClass: ProjectInfoSheet | null;
    private pdsClass: ProjectDataSheet | null;
    private psrClass: ProjectStatusReportSheet | null;
    private paymentHandler: PaymentHandler | null;
    private paymentHistoryDataTable: DataTables.Api;
    private projectFileLinkDataTable: DataTables.Api;

    /**
     * Creates an instance of HandleProjectClass.
     * @param {JQuery} formContainer - The container where forms will be rendered
     * @param {string} projectId - The ID of the project
     * @param {string} businessId - The ID of the business
     * @param {string} applicationId - The ID of the application
     * @param {string} actualAmount - The actual amount for the project
     * @param {DataTables.Api} paymentHistoryDataTable - DataTable instance for payment history
     * @param {DataTables.Api} projectFileLinkDataTable - DataTable instance for project file links
     */
    constructor(
        formContainer: JQuery,
        projectId: string,
        businessId: string,
        applicationId: string,
        actualAmount: string,
        paymentHistoryDataTable: DataTables.Api,
        projectFileLinkDataTable: DataTables.Api
    ) {
        this.formContainer = formContainer;
        this.projectId = projectId;
        this.businessId = businessId;
        this.applicationId = applicationId;
        this.actualAmount = actualAmount;
        this.paymentHistoryDataTable = paymentHistoryDataTable;
        this.projectFileLinkDataTable = projectFileLinkDataTable;

        // Initialize as null, they will be instantiated in the initialize method
        this.projectFileClass = null;
        this.pisClass = null;
        this.pdsClass = null;
        this.psrClass = null;
        this.paymentHandler = null;
    }

    /**
     * Initializes all project-related classes
     * @returns {Promise<void>}
     */
    async initialize(): Promise<void> {
        // Clean up any existing instances before creating new ones
        this.destroy();

        // Initialize all classes
        this.pisClass = new ProjectInfoSheet(
            this.formContainer,
            this.projectId,
            this.businessId,
            this.applicationId
        );

        this.projectFileClass = new FileCoopRequirementHandler(
            this.projectFileLinkDataTable
        );

        this.pdsClass = new ProjectDataSheet(
            this.formContainer,
            this.projectId
        );

        this.psrClass = new ProjectStatusReportSheet(
            this.formContainer,
            this.projectId,
            this.businessId,
            this.applicationId
        );

        this.paymentHandler = new PaymentHandler(
            this.paymentHistoryDataTable,
            this.projectId,
            this.actualAmount
        );
    }

    /**
     * Loads all data for the project
     * @returns {Promise<any[]>} Results of all data loading operations
     */
    async loadData(): Promise<any[]> {
        // Ensure classes are initialized
        if (!this.paymentHandler || !this.projectFileClass) {
            throw new Error(
                'Classes not initialized. Call initialize() first.'
            );
        }

        // Load all data in parallel
        return Promise.allSettled([
            this.paymentHandler.getPaymentAndCalculation(),
            // Need to access the global function for the next call
            (window as any).getProjectLedger(this.projectId),
            this.projectFileClass.getProjectLinks(this.projectId),
            // Need to access the global function for the next call
            (window as any).getQuarterlyReports(this.projectId),
        ]);
    }

    /**
     * Destroys all instances to prevent memory leaks
     */
    destroy(): void {
        if (this.pisClass) {
            this.pisClass.destroy();
            this.pisClass = null;
        }

        if (this.pdsClass) {
            this.pdsClass.destroy();
            this.pdsClass = null;
        }

        if (this.projectFileClass) {
            this.projectFileClass.destroy();
            this.projectFileClass = null;
        }

        if (this.psrClass) {
            this.psrClass.destroy();
            this.psrClass = null;
        }

        if (this.paymentHandler) {
            this.paymentHandler.destroy();
            this.paymentHandler = null;
        }
    }

    /**
     * Get the payment handler instance
     * @returns {PaymentHandler} The payment handler instance
     */
    getPaymentHandler(): PaymentHandler {
        return this.paymentHandler!;
    }

    /**
     * Get the project file class instance
     * @returns {FileCoopRequirementHandler | null} The project file class instance
     */
    getProjectFileClass(): FileCoopRequirementHandler | null {
        return this.projectFileClass || null;
    }

    /**
     * Get the project info sheet instance
     * @returns {ProjectInfoSheet | null} The project info sheet instance
     */
    getProjectInfoSheet(): ProjectInfoSheet | null {
        return this.pisClass || null;
    }

    /**
     * Get the project data sheet instance
     * @returns {ProjectDataSheet | null} The project data sheet instance
     */
    getProjectDataSheet(): ProjectDataSheet | null {
        return this.pdsClass || null;
    }

    /**
     * Get the project status report sheet instance
     * @returns {ProjectStatusReportSheet | null} The project status report sheet instance
     */
    getProjectStatusReportSheet(): ProjectStatusReportSheet | null {
        return this.psrClass || null;
    }
}
