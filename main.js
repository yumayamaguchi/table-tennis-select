$('.racket_1').on('click', (e) => {
    e.preventDefault();
    const rackets_1 = $('.rackets_1').offset().top;

    $('html,body').animate({ scrollTop: rackets_1 }, 600);
});

$('.racket_2').on('click', (e) => {
    e.preventDefault();
    const rackets_2 = $('.rackets_2').offset().top;
    
    $('html,body').animate({ scrollTop: rackets_2 }, 600);
});

$('.racket_3').on('click', (e) => {
    e.preventDefault();
    const rackets_3 = $('.rackets_3').offset().top;

    $('html,body').animate({ scrollTop: rackets_3 }, 600);
});

// ペンバージョンも組み込む

$('.page_top').on('click', (e) => {
    e.preventDefault();
    
    $('html,body').animate({ scrollTop: 0 }, 600);
});