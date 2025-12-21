const focusable = document.querySelectorAll('a.tile');
let index = 0;

if (focusable.length > 0) {
    focusable[index].focus();
}

document.addEventListener('keydown', e => {
    const cols = 3;

    if (e.key === 'ArrowRight') index++;
    if (e.key === 'ArrowLeft') index--;
    if (e.key === 'ArrowDown') index += cols;
    if (e.key === 'ArrowUp') index -= cols;

    if (index < 0) index = 0;
    if (index >= focusable.length) index = focusable.length - 1;

    focusable[index].focus();
});
