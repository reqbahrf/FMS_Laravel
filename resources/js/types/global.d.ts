interface Window {
    loadTab: (
        url: string,
        activeLink: string,
        optionalHeaders?: Record<string, string | boolean>
    ) => Promise<void>;
}

var loadTab: (
    url: string,
    activeLink: string,
    optionalHeaders?: Record<string, string | boolean>
) => Promise<void>;
