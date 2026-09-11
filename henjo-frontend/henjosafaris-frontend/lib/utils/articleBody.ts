// ============================================
// ARTICLE BODY PARSER
// ============================================
// Turns a plain-text CMS "body" field into renderable blocks. Admin-entered
// convention: a line starting with "## " is a subheading, a line starting
// with "- " is a bullet point, blank lines separate paragraphs.

export type ArticleBlock =
    | { type: 'heading'; text: string }
    | { type: 'list'; items: string[] }
    | { type: 'paragraph'; text: string };

export function parseArticleBody(raw: string | null | undefined): ArticleBlock[] {
    if (!raw) return [];

    const blocks: ArticleBlock[] = [];
    let currentList: string[] | null = null;

    const flushList = () => {
        if (currentList && currentList.length) {
            blocks.push({ type: 'list', items: currentList });
        }
        currentList = null;
    };

    for (const rawLine of raw.split('\n')) {
        const line = rawLine.trim();
        if (!line) {
            flushList();
            continue;
        }
        if (line.startsWith('## ')) {
            flushList();
            blocks.push({ type: 'heading', text: line.slice(3).trim() });
        } else if (line.startsWith('- ')) {
            if (!currentList) currentList = [];
            currentList.push(line.slice(2).trim());
        } else {
            flushList();
            blocks.push({ type: 'paragraph', text: line });
        }
    }
    flushList();

    return blocks;
}
