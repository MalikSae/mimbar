import Alpine from 'alpinejs';
import { Editor, Extension } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Placeholder from '@tiptap/extension-placeholder';
import Link from '@tiptap/extension-link';
import Image from '@tiptap/extension-image';

// Extension custom: toggle dir="rtl"/"ltr" pada semua block node
const TextDirection = Extension.create({
    name: 'textDirection',
    addGlobalAttributes() {
        return [{
            types: ['paragraph', 'heading', 'bulletList', 'orderedList', 'blockquote'],
            attributes: {
                dir: {
                    default: 'ltr',
                    parseHTML: el => el.getAttribute('dir') || 'ltr',
                    renderHTML: attrs => attrs.dir ? { dir: attrs.dir } : {},
                },
            },
        }];
    },
    addCommands() {
        return {
            setTextDirection: dir => ({ commands }) => {
                return commands.updateAttributes('paragraph', { dir }) ||
                       commands.updateAttributes('heading', { dir });
            },
        };
    },
});

window.Alpine = Alpine;
Alpine.start();

// Registry semua instance Tiptap editor
window.tiptapEditors = window.tiptapEditors || {};

window.createEditor = function (content, inputId, options = {}) {
    const editorId = options.editorId || 'tiptap-editor';
    const toolbarId = options.toolbarId || 'tiptap-toolbar';
    const rtl = options.rtl === true;
    const placeholderText = options.placeholder || 'Tulis konten artikel di sini...';

    const editorEl = document.getElementById(editorId);
    const inputEl  = document.getElementById(inputId);

    if (!editorEl || !inputEl) return;

    const editor = new Editor({
        element: editorEl,
        extensions: [
            StarterKit,
            TextDirection,
            Placeholder.configure({
                placeholder: placeholderText,
            }),
            Link.configure({
                openOnClick: false,
                HTMLAttributes: {
                    rel: 'noopener noreferrer',
                    target: '_blank',
                },
            }),
            Image.extend({
                addAttributes() {
                    return {
                        ...this.parent?.(),
                        width: {
                            default: null,
                            parseHTML: el => el.getAttribute('width'),
                            renderHTML: attrs => {
                                const w = attrs.width;
                                return w
                                    ? { width: w, style: `width: ${/^\d+$/.test(w) ? w + 'px' : w}; max-width: 100%; height: auto; border-radius: 6px;` }
                                    : { style: 'max-width: 100%; height: auto; border-radius: 6px;' };
                            },
                        },
                    };
                },
            }).configure({
                inline: false,
                selectable: true,
                draggable: true,
                HTMLAttributes: { class: 'tiptap-image' },
            }),
        ],
        content: content || '',
        editorProps: rtl ? {
            attributes: {
                dir: 'rtl',
                style: "font-family: 'Amiri', 'Scheherazade New', serif; font-size: 1.1rem; line-height: 2; text-align: right;"
            }
        } : {},
        onUpdate({ editor }) {
            inputEl.value = editor.getHTML();
        },
    });

    window.tiptapEditors[inputId] = editor;

    // Listen event set-content dari translate button
    const editorElRef = document.getElementById(editorId);
    if (editorElRef) {
        editorElRef.addEventListener('tiptap:set-content', (e) => {
            const newContent = e.detail?.content || '';
            editor.commands.setContent(newContent);
            // Sync ke hidden input
            if (inputEl) inputEl.value = editor.getHTML();
        });
        // Juga listen di hidden input (cara lama sebagai fallback)
        inputEl.addEventListener('tiptap:set-content', (e) => {
            const newContent = e.detail?.content || '';
            editor.commands.setContent(newContent);
            if (inputEl) inputEl.value = editor.getHTML();
        });
    }

    // Simpan referensi global agar bisa diakses oleh Alpine modal
    if (!rtl) {
        window.tiptapEditor = editor;
    } else {
        window.tiptapEditorAr = editor;
    }

    // ── Toolbar mini gambar ──────────────────────────────────────
    const proseMirrorEl = editorEl.querySelector('.ProseMirror');
    if (proseMirrorEl) {
        proseMirrorEl.style.position = 'relative';

        proseMirrorEl.addEventListener('click', function (e) {
            // Hapus toolbar lama
            const old = document.getElementById('img-toolbar');
            if (old) old.remove();

            if (e.target.tagName === 'IMG') {
                const img = e.target;

                const toolbar = document.createElement('div');
                toolbar.id = 'img-toolbar';
                toolbar.style.cssText = [
                    'position: absolute',
                    'top: ' + (img.offsetTop - 40) + 'px',
                    'left: ' + img.offsetLeft + 'px',
                    'background: var(--color-gray-900)',
                    'border-radius: 6px',
                    'padding: 4px 8px',
                    'display: flex',
                    'gap: 8px',
                    'z-index: 100',
                    'box-shadow: 0 2px 8px rgba(0,0,0,0.3)',
                    'pointer-events: all',
                ].join('; ');

                const btnStyle = [
                    'background: none',
                    'border: none',
                    'color: white',
                    'font-size: 12px',
                    'cursor: pointer',
                    'padding: 2px 6px',
                    'display: flex',
                    'align-items: center',
                    'gap: 4px',
                    'white-space: nowrap',
                ].join('; ');

                // Tombol: Teks Sebelum
                const beforeBtn = document.createElement('button');
                beforeBtn.type = 'button';
                beforeBtn.innerHTML = '↑ Teks Sebelum';
                beforeBtn.style.cssText = btnStyle;
                beforeBtn.addEventListener('click', function (ev) {
                    ev.stopPropagation();
                    const pos = editor.state.selection.from;
                    editor.chain().focus().insertContentAt(Math.max(0, pos - 1), { type: 'paragraph' }).run();
                    toolbar.remove();
                });

                // Tombol: Hapus Gambar
                const deleteBtn = document.createElement('button');
                deleteBtn.type = 'button';
                deleteBtn.innerHTML = '🗑 Hapus Gambar';
                deleteBtn.style.cssText = btnStyle + '; color: #ff8080;';
                deleteBtn.addEventListener('click', function (ev) {
                    ev.stopPropagation();
                    editor.chain().focus().deleteSelection().run();
                    toolbar.remove();
                });

                // Tombol: Teks Sesudah
                const afterBtn = document.createElement('button');
                afterBtn.type = 'button';
                afterBtn.innerHTML = '↓ Teks Sesudah';
                afterBtn.style.cssText = btnStyle;
                afterBtn.addEventListener('click', function (ev) {
                    ev.stopPropagation();
                    const pos = editor.state.selection.to;
                    editor.chain().focus().insertContentAt(pos + 1, { type: 'paragraph' }).run();
                    toolbar.remove();
                });

                toolbar.appendChild(beforeBtn);
                toolbar.appendChild(deleteBtn);
                toolbar.appendChild(afterBtn);
                proseMirrorEl.appendChild(toolbar);
            }
        });

        // Hapus toolbar saat ketik
        proseMirrorEl.addEventListener('keydown', function () {
            const t = document.getElementById('img-toolbar');
            if (t) t.remove();
        });
    }

    // Toolbar button handlers
    let toolbarEl = document.getElementById(options.toolbarId || 'tiptap-toolbar');
    if (!toolbarEl) toolbarEl = document;
    
    toolbarEl.querySelectorAll('[data-editor-action]').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const action = btn.getAttribute('data-editor-action');
            switch (action) {
                case 'bold':           editor.chain().focus().toggleBold().run(); break;
                case 'italic':         editor.chain().focus().toggleItalic().run(); break;
                case 'strike':         editor.chain().focus().toggleStrike().run(); break;
                case 'h2':             editor.chain().focus().toggleHeading({ level: 2 }).run(); break;
                case 'h3':             editor.chain().focus().toggleHeading({ level: 3 }).run(); break;
                case 'bulletList':     editor.chain().focus().toggleBulletList().run(); break;
                case 'orderedList':    editor.chain().focus().toggleOrderedList().run(); break;
                case 'blockquote':     editor.chain().focus().toggleBlockquote().run(); break;
                case 'horizontalRule': editor.chain().focus().setHorizontalRule().run(); break;
                case 'undo':           editor.chain().focus().undo().run(); break;
                case 'redo':           editor.chain().focus().redo().run(); break;
                case 'rtl':            editor.chain().focus().setTextDirection('rtl').run(); break;
                case 'ltr':            editor.chain().focus().setTextDirection('ltr').run(); break;
                case 'link':
                    document.dispatchEvent(new CustomEvent('editor:open-link', {
                        detail: { active: editor.isActive('link'), href: editor.getAttributes('link').href || '', isRtl: rtl }
                    }));
                    break;
                case 'image':
                    document.dispatchEvent(new CustomEvent('editor:open-image', { detail: { isRtl: rtl } }));
                    break;
            }

            // Update active state semua tombol
            toolbarEl.querySelectorAll('[data-editor-action]').forEach(b => {
                const a = b.getAttribute('data-editor-action');
                const isActive =
                    (a === 'bold'        && editor.isActive('bold'))        ||
                    (a === 'italic'      && editor.isActive('italic'))      ||
                    (a === 'strike'      && editor.isActive('strike'))      ||
                    (a === 'h2'          && editor.isActive('heading', { level: 2 })) ||
                    (a === 'h3'          && editor.isActive('heading', { level: 3 })) ||
                    (a === 'bulletList'  && editor.isActive('bulletList'))  ||
                    (a === 'orderedList' && editor.isActive('orderedList')) ||
                    (a === 'blockquote'  && editor.isActive('blockquote'))  ||
                    (a === 'link'        && editor.isActive('link'));

                b.style.background    = isActive ? 'var(--color-primary-light)' : 'white';
                b.style.color         = isActive ? 'var(--color-primary)' : 'var(--color-gray-900)';
                b.style.borderColor   = isActive ? 'var(--color-primary)' : 'var(--color-border)';
            });
        });
    });

    return editor;
};
