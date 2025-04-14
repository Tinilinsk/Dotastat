let defaultFontSize = 16;

function changeFontSize(action) {
  let body = document.body;
  let currentSize = parseFloat(window.getComputedStyle(body).fontSize);

  if (action === 'increase') {
    body.style.fontSize = (currentSize * 1.1) + 'px';
  } else if (action === 'decrease') {
    body.style.fontSize = (currentSize / 1.1) + 'px';
  } else if (action === 'reset') {
    body.style.fontSize = defaultFontSize + 'px';
  }
}

function toggleTheme() {
  document.body.classList.toggle('dark-theme');
}
