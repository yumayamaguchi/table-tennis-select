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
$('.racket_4').on('click', (e) => {
    e.preventDefault();
    const rackets_4 = $('.rackets_4').offset().top;

    $('html,body').animate({ scrollTop: rackets_4 }, 600);
});

$('.racket_5').on('click', (e) => {
    e.preventDefault();
    const rackets_5 = $('.rackets_5').offset().top;

    $('html,body').animate({ scrollTop: rackets_5 }, 600);
});

$('.page_top').on('click', (e) => {
    e.preventDefault();

    $('html,body').animate({ scrollTop: 0 }, 600);
});





//   racket.php

$('.slick01').slick({
    dots: true,
    arrows: true,
    slidesToShow: 3,
    autoplay: true,
    autoplaySpeed: 2000,
    prevArrow: '<div class="prev"><i class="fas fa-chevron-left"></i></div>',
    nextArrow: '<div class="next"><i class="fas fa-chevron-right"></i></div>',
    responsive: [{
        breakpoint: 768,
        settings: {
            slidesToShow: 2,
        }
    }]
});


$('.star1').raty({
    click: function(score, evt) {
        $.post('racket_post.php', { score: score, url: evt.currentTarget.baseURI });
    }
});



// グラフchart.jsに関するプログラム

// ----------------------------------------------------------------------
//  bar_graph.js
//
//                  May/16/2017
// ----------------------------------------------------------------------
// jQuery(function() {
//     const config = {
//         type: 'radar',
//         data: barChartData,
//         responsive: true
//     }

//     const context = jQuery("#myChart")
//     const chart = new Chart(context, config)
// })

// // ----------------------------------------------------------------------
// const barChartData = {
//     labels: ['スピード', 'スピン', '安定', '価格'],
//     datasets: [{
//             label: "フォア",
//             backgroundColor: "rgba(179,181,198,0.5)",
//             data: [$(element).data('score')],
//             //dataの数値をhtml側から取得し、反映させたい
//         },
//         {
//             label: "バック",
//             backgroundColor: "rgba(255,99,132,0.5)",
//             data: [10, 54, 77, 32]
//         }
//     ]
// }

// ----------------------------------------------------------------------


const ctx_1 = document.getElementById('myChart-1').getContext('2d');
const myChart1Element = document.getElementById('myChart-1');

const myRadarChart_1 = new Chart(ctx_1, {
    type: 'radar',
    data: {
        labels: ['スピード', 'スピン', '安定', '価格'],
        datasets: [{
                label: 'フォア',
                data: [myChart1Element.getAttribute("data-four-speed"), myChart1Element.getAttribute("data-four-spin"), myChart1Element.getAttribute("data-four-stable"), myChart1Element.getAttribute("data-four-price")],
                borderColor: 'red',
                backgroundColor: 'rgba(255,0,0,0.2)',
                borderWidth: '1px',
            },
            {
                label: 'バック',
                data: [myChart1Element.getAttribute("data-back-speed"), myChart1Element.getAttribute("data-back-spin"), myChart1Element.getAttribute("data-back-stable"), myChart1Element.getAttribute("data-back-price")],
                borderColor: 'blue',
                backgroundColor: 'rgba(12,77,162,0.2)',
                borderWidth: '1px',
            }
        ]
    },
    options: {
        title: {
            display: true,
            text: '線グラフの例'
        }
    }
});