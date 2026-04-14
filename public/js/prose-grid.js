/**
 * Auto-Grid untuk gambar berurutan di dalam konten prose
 * Mimbar Al-Tauhid — prose-grid.js
 */
document.addEventListener('DOMContentLoaded', function () {
  var proseContainers = document.querySelectorAll('.prose-content');

  proseContainers.forEach(function (prose) {
    groupConsecutiveImages(prose);
  });
});

function groupConsecutiveImages(container) {
  var children = Array.from(container.childNodes);
  var imageGroup = [];
  var toProcess = [];

  // Kumpulkan semua node dan tandai mana yang gambar
  children.forEach(function (node) {
    if (node.nodeType === 3 && node.textContent.trim() === '') {
      return; // abaikan whitespace agar tidak memutus grup image berurutan
    }

    var isImage = isImageNode(node);

    if (isImage) {
      imageGroup.push(node);
    } else {
      // Abaikan elemen kosong (seperti <br> atau <p></p>) yang disisipkan oleh Tiptap
      // agar tidak memutus rentetan gambar.
      if (node.nodeType === 1 && node.textContent.trim() === '') {
        var hasImg = node.querySelector ? node.querySelector('img') : null;
        if (!hasImg) {
          return; // lewati elemen kosong ini
        }
      }

      if (imageGroup.length > 0) {
        toProcess.push({ type: 'images', nodes: imageGroup.slice() });
        imageGroup = [];
      }
      toProcess.push({ type: 'other', node: node });
    }
  });

  // Flush sisa group terakhir
  if (imageGroup.length > 0) {
    toProcess.push({ type: 'images', nodes: imageGroup.slice() });
  }

  // Bangun ulang konten container
  container.innerHTML = '';

  toProcess.forEach(function (item) {
    if (item.type === 'other') {
      container.appendChild(item.node);
    } else {
      if (item.nodes.length === 1) {
        // Biarkan gambar tunggal apa adanya (termasuk attribut width dari Tiptap)
        container.appendChild(item.nodes[0]);
      } else {
        var grid = buildImageGrid(item.nodes);
        container.appendChild(grid);
      }
    }
  });
}

function isImageNode(node) {
  // Cek apakah node adalah <img> langsung
  if (node.nodeType === 1 && node.tagName === 'IMG') return true;

  // Cek apakah node adalah <p> yang hanya berisi <img>
  if (node.nodeType === 1 && node.tagName === 'P') {
    var ch = Array.from(node.children);
    var textContent = node.textContent.trim();
    if (ch.length === 1 && ch[0].tagName === 'IMG' && textContent === '') {
      return true;
    }
    // p dengan hanya gambar-gambar (mungkin ada whitespace)
    if (ch.length > 0 && ch.every(function (c) { return c.tagName === 'IMG'; }) && textContent === '') {
      return true;
    }
  }

  // Cek apakah node adalah <figure> yang berisi <img>
  if (node.nodeType === 1 && node.tagName === 'FIGURE') {
    if (node.querySelector('img')) return true;
  }

  return false;
}

function getImgFromNode(node) {
  if (node.tagName === 'IMG') return node;
  return node.querySelector('img');
}

function getCaptionFromNode(node) {
  if (node.tagName === 'FIGURE') {
    var figcaption = node.querySelector('figcaption');
    return figcaption ? figcaption.textContent : null;
  }
  return null;
}

function buildImageGrid(nodes) {
  var count = nodes.length;

  // Tentukan jumlah kolom
  var cols;
  if (count === 1) cols = 1;
  else if (count === 2) cols = 2;
  else if (count === 4) cols = 2;
  else cols = 3;

  // Buat wrapper grid
  var wrapper = document.createElement('div');
  wrapper.className = 'prose-image-grid';
  wrapper.setAttribute('data-count', count);
  wrapper.setAttribute('data-cols', cols);

  var wrapperStyle = [
    'display: grid',
    'grid-template-columns: repeat(' + cols + ', 1fr)',
    'gap: 10px',
    'margin: 24px 0',
  ];
  if (count === 1) {
    wrapperStyle.push('max-width: 700px');
    wrapperStyle.push('margin-left: auto');
    wrapperStyle.push('margin-right: auto');
  }
  wrapper.style.cssText = wrapperStyle.join('; ');

  nodes.forEach(function (node) {
    var img = getImgFromNode(node);
    var caption = getCaptionFromNode(node);

    var cell = document.createElement('div');
    cell.style.cssText = 'overflow: hidden; border-radius: 8px;';

    if (img) {
      var clonedImg = img.cloneNode(true);
      clonedImg.style.cssText = [
        'width: 100%',
        'height: ' + (count === 1 ? '450px' : '220px'),
        'object-fit: cover',
        'display: block',
        'border-radius: 8px',
      ].join('; ');
      clonedImg.removeAttribute('width');
      clonedImg.removeAttribute('height');
      cell.appendChild(clonedImg);
    }

    if (caption) {
      var cap = document.createElement('p');
      cap.style.cssText = [
        'font-size: 12px',
        'color: var(--color-gray-400)',
        'text-align: center',
        'margin-top: 6px',
        'font-style: italic',
      ].join('; ');
      cap.textContent = caption;
      cell.appendChild(cap);
    }

    wrapper.appendChild(cell);
  });

  return wrapper;
}
