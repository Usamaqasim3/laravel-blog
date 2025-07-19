import EditorJsHtml from 'editorjs-html';

document.addEventListener('DOMContentLoaded', () => {
    const rawJsonElement = document.getElementById('editorjs-content-json');
    const target = document.getElementById('editorjs-render');

    if (!rawJsonElement || !target) return;

    const data = JSON.parse(rawJsonElement.textContent);
    const edjsParser = EditorJsHtml();

    let html = '';
    data.blocks.forEach(block => {
        const rendered = edjsParser.parseBlock(block);
        html += rendered;
    });
    target.innerHTML = html;
});
