const itemArr = Array.from(document.querySelectorAll('.gallery__item'));
const lightbox = document.querySelector('.gallery__lightbox');
const lightboxImg = document.querySelector('#lightboxImg');
const lightboxText = document.querySelector('.lightbox-text');
const offBtn = document.querySelector('.gallery__offBtn');
const arrowNext = document.querySelector('.gallery__arrow-right');
const arrowPrev = document.querySelector('.gallery__arrow-left');

let nextItem = null;
let prevItem = null;

for (let i = 0; i < itemArr.length; i++) {
    let item = itemArr[i];
    const image = item.querySelector('img')
    const source = image.src;
    const parent = item.closest(".gallery-wrapper");
    const heading = parent.querySelector('.gallery__h2').innerHTML;
    

    item.addEventListener("click", function() {
        lightbox.classList.add('gallery__active');
        lightboxImg.src = source;
        lightboxText.innerHTML = heading;

        nextItem = itemArr[i + 1];
        prevItem = itemArr[i - 1];

        // console.log(item.nextElementSibling.childNodes[1].src)
    })
} 

offBtn.addEventListener("click", function() {
    lightbox.classList.remove('gallery__active');
    lightboxImg.src = '';
    lightboxText.innerHTML = '';
});

arrowNext.addEventListener('click', function() {
    const image = nextItem.querySelector('img');
    lightboxImg.src = image.src;
})

// for (let i = 0; i < itemArr.length; i++) {
//     let item = itemArr[i];
//     arrowNext.addEventListener('click', function(i) {
//         const nextPhotoSrc = item.nextElementSibling.childNodes[1].src;
//         lightboxImg.src = nextPhotoSrc;
//         console.log(item[0].nextSibling)
//     })
// }

// arrowPrev.addEventListener('click', function() {
//     // if (lightboxImg.src = )
//     // const prevImg = prevItem.childNodes[1].src;
//     // lightboxImg.src = prevImg;
//     // const empty = function () {
//     //     lightboxImg.src=""
//     // }
//     // console.log(lightboxImg.src)
// })
