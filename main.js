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

window.addEventListener("load", () => {
    //querySelectorAll("a")=>a要素に合致する全ての要素を取得
    //「配列」の値を1つずつ「変数」へ代入してくれる
    //for ( 変数 of 配列 ) {

   // 繰り返しの処理を書く  }
    for (const anchor of document.querySelectorAll(".index_1")) {
        anchor.addEventListener("click", (e) => {
            //同期処理を止める
            e.preventDefault();

            //非同期的に遷移先のページを取得
            //オブジェクトの作成
            const xhr = new XMLHttpRequest();
            //通信状態が変化した時にイベントが発生
            xhr.onreadystatechange = () => {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    //動的なHTML要素の作成
                    const temporaryWrapper = document.createElement("div");
                    //HTML要素の中身の変更
                    //サーバーから受けとったテキストを返す
                    temporaryWrapper.innerHTML = xhr.responseText;
                    for (const ELEMENT_TO_REWRITING of ["title", ".main_visual"]) {
                        //title,mainを取得
                        document.querySelector(ELEMENT_TO_REWRITING).innerHTML = temporaryWrapper.querySelector(ELEMENT_TO_REWRITING).innerHTML;
                    }
                }
            };
            xhr.open("GET", anchor.href);
            xhr.send();
        }).then((result) => {

            //現在のページをブラウザ履歴に追加
            history.pushState(null, null, location.href);

            //遷移後のページをURLに書き換え
            history.resplaceState(null, null, anchor.href);

            const temporaryWrapper = document.createElement("div");
            temporaryWrapper.innerHTML = result;
            for (const ELEMENT_TO_REWRITING of ["title", ".main_visual"]) {
                document.querySelector(ELEMENT_TO_REWRITING).innerHTML = temporaryWrapper.querySelector(ELEMENT_TO_REWRITING).innerHTML;
            }
        });
    }
});