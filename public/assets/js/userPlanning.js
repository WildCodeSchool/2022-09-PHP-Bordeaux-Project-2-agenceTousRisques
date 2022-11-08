let $dayBlock = Document.getElementsByClassName('day-block');
let $demandText = Document.getElementsByClassName('demandText');
console.log($demandText);
if ($demandText.classList.contains('helper')) {
    $dayBlock.classList.add('helper')
}
