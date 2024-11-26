import EditorJS from "@editorjs/editorjs";
import Header from "@editorjs/header";
import List from "@editorjs/list";
//import docx from 'docx-preview';
import mammoth from "mammoth";

/**
 * DocxHandler - A class to handle DOCX file operations in the browser
 */

class DocxHandler {
    constructor(options = {}) {
        this.editor = null;
        this.previewElement = options.previewElement || "docPreview";
        this.editorElement = options.editorElement || "editorjs";
        this.initializeEditor();
    }

    /**
     * Initialize the Editor.js instance
     */
    initializeEditor() {
        this.editor = new EditorJS({
            holder: this.editorElement,
            tools: {
                header: {
                    class: Header,
                    config: {
                        levels: [1, 2, 3],
                        defaultLevel: 1,
                    },
                },
                list: {
                    class: List,
                    inlineToolbar: true,
                },
            },
            onChange: () => {
                // You can add auto-save functionality here
                console.log("Content changed");
            },
        });
    }

    /**
     * Load and display a DOCX file
     * @param {string} url - URL of the DOCX file
     */
    async loadDocument(url) {
        try {
            // Fetch the document
            const response = await fetch(url);
            const blob = await response.blob();

            // Preview original document
            await this.previewDocument(blob);

            // Convert to HTML for editing
            await this.convertToEditor(blob);
        } catch (error) {
            console.error("Error loading document:", error);
            throw error;
        }
    }

    /**
     * Preview the DOCX file using docx-preview
     * @param {Blob} blob - The DOCX file blob
     */
    async previewDocument(blob) {
        try {
            const previewElement = document.getElementById(this.previewElement);
            if (!previewElement) {
                throw new Error("Preview element not found");
            }
            await docx.renderAsync(blob, previewElement);
        } catch (error) {
            console.error("Error previewing document:", error);
            throw error;
        }
    }

    /**
     * Convert DOCX to Editor.js blocks
     * @param {Blob} blob - The DOCX file blob
     */
    async convertToEditor(blob) {
        try {
            const arrayBuffer = await blob.arrayBuffer();
            const options = {
                styleMap: [
                    "p[style-name='Normal'] => p:fresh",
                    "table => table.table.table-bordered",
                    "tr => tr",
                    "td => td",
                ],
                transformDocument: (element) => {
                    if (element.type === "table") {
                        element.styleId = "table";
                        element.styleName = "table";
                    }
                    return element;
                },
            };
            const result = await mammoth.convertToHtml(
                { arrayBuffer },
                options
            );
            const blocks = this.convertHtmlToBlocks(result.value);
            await this.editor.render({ blocks });
        } catch (error) {
            console.error("Error converting document:", error);
            throw error;
        }
    }

    /**
     * Convert HTML to Editor.js blocks
     * @param {string} html - HTML content
     * @returns {Array} Array of Editor.js blocks
     */
    convertHtmlToBlocks(html) {
        const temp = document.createElement("div");
        temp.innerHTML = html;

        const blocks = [];
        temp.childNodes.forEach((node) => {
            if (node.nodeType === Node.ELEMENT_NODE) {
                const block = this.createBlockFromNode(node);
                if (block) {
                    blocks.push(block);
                }
            }
        });

        return blocks;
    }

    /**
     * Create an Editor.js block from a DOM node
     * @param {Node} node - DOM node
     * @returns {Object|null} Editor.js block object
     */
    createBlockFromNode(node) {
        switch (node.tagName.toLowerCase()) {
            case "h1":
            case "h2":
            case "h3":
                return {
                    type: "header",
                    data: {
                        text: node.textContent,
                        level: parseInt(node.tagName[1]),
                    },
                };
            case "p":
                return {
                    type: "paragraph",
                    data: {
                        text: node.textContent,
                    },
                };
            case "ul":
            case "ol":
                return {
                    type: "list",
                    data: {
                        style:
                            node.tagName.toLowerCase() === "ul"
                                ? "unordered"
                                : "ordered",
                        items: Array.from(node.children).map(
                            (li) => li.textContent
                        ),
                    },
                };
            default:
                return null;
        }
    }

    /**
     * Get the edited content from Editor.js
     * @returns {Promise<Object>} Editor.js output data
     */
    async getContent() {
        try {
            return await this.editor.save();
        } catch (error) {
            console.error("Error getting content:", error);
            throw error;
        }
    }

    /**
     * Convert Editor.js blocks to HTML
     * @param {Array} blocks - Editor.js blocks
     * @returns {string} HTML content
     */
    convertBlocksToHtml(blocks) {
        let html = "";
        blocks.forEach((block) => {
            switch (block.type) {
                case "header":
                    html += `<h${block.data.level}>${block.data.text}</h${block.data.level}>`;
                    break;
                case "paragraph":
                    html += `<p>${block.data.text}</p>`;
                    break;
                case "list":
                    const tag = block.data.style === "ordered" ? "ol" : "ul";
                    html += `<${tag}>${block.data.items
                        .map((item) => `<li>${item}</li>`)
                        .join("")}</${tag}>`;
                    break;
            }
        });
        return html;
    }

    /**
     * Convert uploaded DOCX file to HTML
     * @param {File} file - The uploaded DOCX file
     * @returns {Promise} - Promise that resolves with the HTML content
     */
    async convertDocxToHtml(file) {
        try {
            const arrayBuffer = await file.arrayBuffer();
            const options = {
                styleMap: [
                    "p[style-name='Normal'] => p:fresh",
                    "table => table.table.table-bordered",
                    "tr => tr",
                    "td => td",
                ],
                transformDocument: (element) => {
                    if (element.type === "table") {
                        element.styleId = "table";
                        element.styleName = "table";
                    }
                    return element;
                },
            };
            const result = await mammoth.convertToHtml(
                { arrayBuffer },
                options
            );
            return result.value;
        } catch (error) {
            console.error("Error converting DOCX to HTML:", error);
            throw error;
        }
    }

    /**
     * Preview the DOCX file in the specified preview element
     * @param {File} file - The DOCX file to preview
     */
    async previewDocx(file) {
        try {
            const previewContainer = document.getElementById(
                this.previewElement
            );
            if (!previewContainer) {
                throw new Error("Preview container not found");
            }

            const html = await this.convertDocxToHtml(file);
            previewContainer.innerHTML = html;
        } catch (error) {
            console.error("Error previewing DOCX:", error);
            throw error;
        }
    }

    /**
     * Load DOCX content into the editor
     * @param {File} file - The DOCX file to load
     */
    async loadDocxToEditor(file) {
        try {
            const html = await this.convertDocxToHtml(file);
            // Clear existing content
            await this.editor.clear();

            // Convert HTML to Editor.js blocks and set content
            // Note: This is a simple implementation. You might need to enhance it based on your needs
            const blocks = [
                {
                    type: "paragraph",
                    data: {
                        text: html,
                    },
                },
            ];

            await this.editor.render({ blocks });
        } catch (error) {
            console.error("Error loading DOCX to editor:", error);
            throw error;
        }
    }
}

export default DocxHandler;
