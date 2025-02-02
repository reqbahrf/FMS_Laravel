declare module 'global-form-config' {
   export interface RowConfig {
        createRow: (rowData: any) => HTMLElement;
    }
    
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
        filepondSelector: string[];
    }

    global {
        var FormConfig: DraftFormConfig;
    }

}