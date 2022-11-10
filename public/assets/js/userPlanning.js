let plusButton = document.querySelectorAll('.day-block');
let demandBlocks = document.querySelectorAll('.demand-block');
// for (let i = 0; i < plusButton.length; i++) {
//
//
//     });
// }
console.log(demandBlocks);
plusButton.addEventListener("click", function (event) {
    event.preventDefault();
    demandBlocks.classList.add('show-block');
})
