
//Opne slider cart and overlay
const btnListCategory = document.querySelector('.btn__list_category-js')
const contentSliderCart = document.querySelector('.content__slider-cart')
const contentCartOverlay = document.querySelector('.content__cart-overlay')
btnListCategory.onclick = function() {
  contentSliderCart.classList.add('open')
  contentCartOverlay.classList.add('open')
}
contentCartOverlay.onclick = function() {
  contentSliderCart.classList.remove('open')
  contentCartOverlay.classList.remove('open')
}

// Tăng giảm số lượng sản phẩm
const btnTangs = document.querySelectorAll('.btn__increase')
const btnGiams = document.querySelectorAll('.btn__reduction')

btnTangs.forEach(function(btnTang) {
       btnTang.onclick = function() {
        let inputElement = btnTang.parentElement.querySelector('.content__cart-list-product-item__price__pick-quantity__input')
        let value = parseInt(inputElement.value)
        if(value >=10) return
        else inputElement.value = value + 1;
       }
})

btnGiams.forEach(function(btnGiam) {
  btnGiam.onclick = function() {
   let inputElement = btnGiam.parentElement.querySelector('.content__cart-list-product-item__price__pick-quantity__input')
   let value = parseInt(inputElement.value)
   if(value <= 1) return
   else inputElement.value = value - 1;
  }
})



