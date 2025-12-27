import Alpine from 'alpinejs';

import intersect from '@alpinejs/intersect';
import Clipboard from '@ryangjchandler/alpine-clipboard';
import anchor from '@alpinejs/anchor';
import collapse from '@alpinejs/collapse';
import persist from '@alpinejs/persist'
import focus from '@alpinejs/focus'

Alpine.plugin(collapse);
Alpine.plugin(Clipboard);
Alpine.plugin(intersect);
Alpine.plugin(anchor);

Alpine.plugin(focus);

Alpine.plugin(persist);


import './livewire-datepicker-datepicker';
import 'livewire-sortable';



// core version + navigation, pagination modules:
import Swiper from 'swiper';
import {Autoplay, Navigation, Pagination, Scrollbar} from 'swiper/modules';
// import Swiper and modules styles
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/scrollbar';



// Replace the direct initialization with a function
const initSwiper = () => {
    return new Swiper(".product-swiper", {
        modules: [Navigation, Pagination, Scrollbar],
        loop: true,
        watchOverflow: true,  // Automatically hides arrows if only one slide
        navigation: {
            nextEl: '.next',
            prevEl: '.prev',
            hover: true
        },
        scrollbar: {
            el: '.swiper-scrollbar',
        },
    });
};

// Initialize on page load
let mySwiper = initSwiper();

// Listen for Livewire navigation events
document.addEventListener('livewire:navigated', () => {
    mySwiper = initSwiper();
});

// Also reinitialize when Livewire updates the DOM
document.addEventListener('livewire:dom-update', () => {
    mySwiper = initSwiper();
});


const homerslider = new Swiper('.homerslider', {
    modules: [Navigation, Autoplay, Pagination],
    loop: true,
    watchOverflow: true,  // Automatically hides arrows if only one slide
    navigation: {
        nextEl: '.next',
        prevEl: '.prev',
        hover: true
    },
    pagination: {
        el: '.swiper-pagination',
    },
});


const postSlider = new Swiper('.postSlider', {
    // configure Swiper to use modules
    modules: [Navigation],
    slidesPerView: 1, // try lowering this
    slidesPerGroup: 1, // and this too
    // pagination: {
    //     el: '.swiper-pagination',
    // },

    // Navigation arrows
    navigation: {
        nextEl: '.next',
        prevEl: '.prev',
    },

    // // And if we need scrollbar
    // scrollbar: {
    //     el: '.swiper-scrollbar',
    // },
});
