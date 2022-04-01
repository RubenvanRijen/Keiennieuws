import Splide from '@splidejs/splide';
window.onload = () => {
    const options = {
        type: 'slide',
        perPage: 4,
        rewind: true,
        perMove: 1,
        gap: 20,
        arrows: false,
        pagination: true,
        drag: true,
        autoplay: true,
        pauseOnHover: true,
        lazyLoad: true,
        breakpoints: {
            1400: {
                arrows: 'slider',

                perPage: 3
            },
            1020: {
                perPage: 2
            },
            768: {
                perPage: 1
            }
        }
    }
    const splide = new Splide('.splide', options);


    splide.mount();

};