/**
 * Markdown Renderer for Forum
 * Automatically detects and renders Markdown content
 */

(function() {
    'use strict';

    // Configure marked.js
    if (typeof marked !== 'undefined') {
        marked.setOptions({
            breaks: true,
            gfm: true,
            headerIds: true,
            mangle: false,
            sanitize: false,
            smartLists: true,
            smartypants: true,
            xhtml: false,
            highlight: function(code, lang) {
                if (typeof hljs !== 'undefined' && lang && hljs.getLanguage(lang)) {
                    try {
                        return hljs.highlight(code, { language: lang }).value;
                    } catch (e) {
                        console.error('Highlight.js error:', e);
                    }
                }
                return code;
            }
        });
    }

    /**
     * Detect if content contains Markdown syntax
     */
    function isMarkdown(text) {
        if (!text || typeof text !== 'string') return false;

        const markdownPatterns = [
            /^#{1,6}\s+/m,                    // Headers
            /\*\*.*?\*\*/,                     // Bold
            /__.*?__/,                         // Bold alternative
            /\*.*?\*/,                         // Italic
            /_.*?_/,                           // Italic alternative
            /\[.*?\]\(.*?\)/,                  // Links
            /!\[.*?\]\(.*?\)/,                 // Images
            /^[-*+]\s+/m,                      // Unordered lists
            /^\d+\.\s+/m,                      // Ordered lists
            /^>\s+/m,                          // Blockquotes
            /`{1,3}.*?`{1,3}/,                 // Code (inline or block)
            /^```/m,                           // Code blocks
            /^\|.*\|.*\|$/m,                   // Tables
            /^---+$/m,                         // Horizontal rules
            /~~.*?~~/,                         // Strikethrough
        ];

        return markdownPatterns.some(pattern => pattern.test(text));
    }

    /**
     * Render Markdown content
     */
    function renderMarkdown(element) {
        if (!element || typeof marked === 'undefined') return;

        const rawContent = element.getAttribute('data-content');
        if (!rawContent) return;

        // Decode HTML entities
        const textarea = document.createElement('textarea');
        textarea.innerHTML = rawContent;
        const decodedContent = textarea.value;

        // Check if content contains Markdown
        if (isMarkdown(decodedContent)) {
            try {
                const htmlContent = marked.parse(decodedContent);
                element.innerHTML = htmlContent;
                element.classList.add('markdown-rendered');

                // Highlight code blocks
                if (typeof hljs !== 'undefined') {
                    element.querySelectorAll('pre code').forEach((block) => {
                        hljs.highlightElement(block);
                    });
                }
            } catch (error) {
                console.error('Markdown rendering error:', error);
            }
        }
    }

    /**
     * Initialize Markdown rendering
     */
    function initMarkdownRenderer() {
        // Wait for marked.js to load
        if (typeof marked === 'undefined') {
            setTimeout(initMarkdownRenderer, 100);
            return;
        }

        // Render all markdown content
        const markdownElements = document.querySelectorAll('.markdown-content');
        markdownElements.forEach(renderMarkdown);

        // Watch for dynamically added content
        const observer = new MutationObserver((mutations) => {
            mutations.forEach((mutation) => {
                mutation.addedNodes.forEach((node) => {
                    if (node.nodeType === 1) { // Element node
                        if (node.classList && node.classList.contains('markdown-content')) {
                            renderMarkdown(node);
                        }
                        // Check children
                        const children = node.querySelectorAll('.markdown-content');
                        children.forEach(renderMarkdown);
                    }
                });
            });
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initMarkdownRenderer);
    } else {
        initMarkdownRenderer();
    }
})();
