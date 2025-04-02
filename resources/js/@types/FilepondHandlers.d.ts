export interface FilePondResponse {
    file_path: string;
    unique_id: string;
}

export type CaptureMethod = 'environment' | 'user';

// Define the function type for process
export type ProcessServerConfigFunction = (
    fieldName: string,
    file: File,
    metadata: { [key: string]: any },
    load: (p: string | { [key: string]: any }) => void,
    error: (errorText: string) => void,
    progress: (computableEvent: {
        lengthComputable: boolean;
        loaded: number;
        total: number;
    }) => void,
    abort: () => void,
    transfer?: (url: string) => void
) => { abort: () => void } | undefined;

// Define the object type for process
export type ProcessConfigObject = {
    url: string;
    method: string;
    headers: {
        [key: string]: string;
    };
    onload?: (response: any) => any;
    onerror?: (response: any) => void;
};

// Process can be either an object or a function
export type ProcessConfig = ProcessConfigObject | ProcessServerConfigFunction;

export type CustomFilePondConfig = FilePond.FilePondOptions & {
    allowMultiple?: boolean;
    allowFileTypeValidation?: boolean;
    allowFileSizeValidation?: boolean;
    allowRevert?: boolean;
    captureMethod?: CaptureMethod | string;
    maxFileSize?: string;
    server: {
        process: ProcessConfig;
        revert?: (
            uniqueFileId: string,
            load: () => void,
            error: (arg0: string) => void
        ) => Promise<void>;
    };
};

export type ServerConfig = {
    process: ProcessConfig;
    fieldName: string;
    file: File;
    metadata: any;
    load: (file: Blob | File) => void;
    error: (errorText: string) => void;
    progress: (computableEvent: {
        lengthComputable: boolean;
        loaded: number;
        total: number;
    }) => void;
    abort: () => void;
    transfer: (file: File, chunkSize: number) => Promise<void>;
    revert?: (
        uniqueFileId: string,
        load: () => void,
        error: (arg0: string) => void
    ) => Promise<void>;
    load?: (
        source: string,
        load: (file: Blob | File) => void,
        error: (errorText: string) => void,
        progress: (computableEvent: {
            lengthComputable: boolean;
            loaded: number;
            total: number;
        }) => void,
        abort: () => void,
        headers: () => Record<string, string>
    ) => Promise<void>;
};

export type InitializeFilePondConfig = CustomFilePondConfig & {
    server: ServerConfig;
    onremovefile: (
        error: FilePond.FilePondErrorDescription | null,
        file: FilePond.FilePondFile
    ) => Promise<void>;
};
