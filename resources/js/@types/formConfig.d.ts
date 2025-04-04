declare module 'global-form-config' {
    export interface TableRowConfig {
        createRow: (rowData: any) => string;
    }

    export interface TableSelectors {
        [key: string]: string;
    }

    export interface TableRowConfigs {
        [key: string]: TableRowConfig;
    }

    export interface DraftFormConfig {
        formSelector: string;
        tableSelectors: TableSelectors;
        tableRowConfigs: TableRowConfigs;
        filepondSelector?: string[];
        excludedFields?: string[];
    }

    global {
        var FormConfig: DraftFormConfig;
    }
}
