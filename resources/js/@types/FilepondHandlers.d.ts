import * as FilePond from 'filepond';

export interface FilePondResponse {
    file_path: string;
    unique_id: string;
}

export type CaptureMethod = 'environment' | 'user';

export type CustomFilePondConfig = FilePond.FilePondOptions & {
    allowMultiple?: boolean;
    allowFileTypeValidation?: boolean;
    allowFileSizeValidation?: boolean;
    allowRevert?: boolean;
    captureMethod?: CaptureMethod | string;
    maxFileSize?: string;
    server: {
        process: {
            url: string;
            method: string;
            headers: {
                [key: string]: string;
            };
            onload: (response: any) => any;
            onerror: (response: any) => void;
        };
        revert?: (
            uniqueFileId: string,
            load: () => void,
            error: (arg0: string) => void
        ) => Promise<void>;
    };
};

export type ProcessConfig = {
    url: string;
    method: 'GET' | 'POST' | 'PUT' | 'DELETE';
    headers: {
        'X-CSRF-TOKEN': string;
    };
    onload: (response: any) => any;
    onerror: (response: any) => void;
};

export type ServerConfig = {
    process: ProcessConfig;
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
