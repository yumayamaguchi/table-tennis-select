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
  }
  ]
});


// racket.phpのタブに関するプログラム

// const showTab = (selector) => {
//   console.log(selector);

//   // 一旦activeクラスの削除
//   $('.tabs-menu > li').removeClass('active');

//   // $('.tabs-content > div').hide();

//   //selectorに該当するものだけactive要素を追加
//   $(`.tabs-menu a[href="${selector}"]`)
//     .parent('li')
//     .addClass('active');

//   // selectorに該当するものだけを表示
//   // $(selector).show();
// };
// $('.tabs-menu a').on('click', (e) => {
//   // e.preventDefault();

//   //クリックされたhref要素の取得
//   const selector = $(e.target).attr('href');
//   // showTab(selector);
// });

// // showTab('.tabs-1');

$('.star1').raty({
  click: function (score, evt) {
    $.post('racket_1_post.php', { score: score, url: evt.currentTarget.baseURI });
  }
});



// グラフchart.jsに関するプログラム

const ctx = document.getElementById('myChart').getContext('2d');

const myRadarChart = new Chart(ctx, {
  type: 'radar',
  data: {
    labels: ['スピード', 'スピン', '安定', '価格'],
    datasets: [{
      label: 'フォア',
      data: [100, 13, 14, 15],
      borderColor: 'red',
      backgroundColor: 'rgba(255,0,0,0.2)',
      borderWidth: '1px',
    },
      {
        label: 'バック',
        data: [100, 90, 90, 90],
        borderColor: 'blue',
        backgroundColor: 'rgba(12,77,162,0.2)',
        borderWidth: '1px',
    }]
  },
  options: {
    title: {
      display: true,
      text: '線グラフの例'
    }
  }
});

const ctx_1 = document.getElementById('myChart-1').getContext('2d');

const myRadarChart_1 = new Chart(ctx_1, {
  type: 'radar',
  data: {
    labels: ['スピード', 'スピン', '安定', '価格'],
    datasets: [{
      label: 'フォア',
      data: [100, 13, 14, 15],
      borderColor: 'red',
      backgroundColor: 'rgba(255,0,0,0.2)',
      borderWidth: '1px',
    },
      {
        label: 'バック',
        data: [100, 90, 90, 90],
        borderColor: 'blue',
        backgroundColor: 'rgba(12,77,162,0.2)',
        borderWidth: '1px',
    }]
  },
  options: {
    title: {
      display: true,
      text: '線グラフの例'
    }
  }
});

