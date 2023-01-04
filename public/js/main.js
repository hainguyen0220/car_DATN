//

// // Hover category
let sliderLinks = document.querySelectorAll(".content__slider-link");
let contentPopup = document.querySelector(".content-popup");
for (let sliderItem of sliderLinks) {
    sliderItem.onmouseover = function () {
        contentPopup.style.display = "flex";
    };
    sliderItem.onmouseout = function () {
        contentPopup.style.display = "none";
    };
    contentPopup.onmouseover = function () {
        this.style.display = "flex";
    };
    contentPopup.onmouseout = function () {
        this.style.display = "none";
    };
}

$(document).ready(function () {
    $(".content__slider-top-active").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 3000,
        prevArrow:
            "<button type='button' class='slick-prev slick-arrow'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
        nextArrow:
            "<button type='button' class='slick-next slick-arrow'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
    });
});

//Slide book new
$(document).ready(function () {
    $(".content__slider-sale_list-product-wrap").slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: true,
        autoplay: true,
        autoplaySpeed: 3000,
        prevArrow:
            "<button type='button' class='slick-prev slick-arrow'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
        nextArrow:
            "<button type='button' class='slick-next slick-arrow'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
    });
});

const categoryApi = "get-category-detail";

async function getCategory() {
    const response = await fetch(categoryApi);
    const data = await response.json();
    const category = JSON.stringify(data);
    window.localStorage.setItem("category", category);
}

getCategory();

const data = JSON.parse(localStorage.getItem("category"));

let contentItems = document.querySelectorAll(".content__slider-item");
for (let contentItem of contentItems) {
    contentItem.onmouseover = function () {
        let categoryName = this.querySelector(".data").value;
        createClass(categoryName, data);
    };
}

async function createClass(categoryName, data) {
    let category = data.find((value) => {
        return value.category_name === categoryName;
    });
    let categoryDetailList = document.querySelector(".content__category-list");
    let htmls = category.category_detail.map((value) => {
        return `<li class="content__category-item">
        <a href="/search?category_detail=${value.category_detail_name}" class="content__category-item-link">
        ${value.category_detail_name}
        </a>
        </li>`;
    });
    var html = htmls.join("");
    categoryDetailList.innerHTML = html;
}
