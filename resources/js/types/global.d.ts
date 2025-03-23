interface Window {
    loadPage: (url: string, activeLink: string) => Promise<void>;
}

var loadPage: (url: string, activeLink: string) => Promise<void>;
