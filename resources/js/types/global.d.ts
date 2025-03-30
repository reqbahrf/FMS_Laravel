interface Window {
    loadTab: (url: string, activeLink: string) => Promise<void>;
}

var loadTab: (url: string, activeLink: string) => Promise<void>;
