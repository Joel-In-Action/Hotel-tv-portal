const tiles = document.querySelectorAll('.tile');
let index = 0;
const columns = 4;

if (tiles.length > 0) {
    tiles[index].focus();
}

document.addEventListener('keydown', e => {
    switch (e.key) {
        case 'ArrowRight':
            index++;
            break;
        case 'ArrowLeft':
            index--;
            break;
        case 'ArrowDown':
            index += columns;
            break;
        case 'ArrowUp':
            index -= columns;
            break;
        default:
            return;
    }

    if (index < 0) index = 0;
    if (index >= tiles.length) index = tiles.length - 1;

    tiles[index].focus();
});
