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


/**
 * フェードインする関数です。
 */
 const fadein = () => {
    const FADEIN_SECOND = 0.2;
    const fadeinTarget = document.querySelector(".center");
    fadeinTarget.style.transition = `all ${FADEIN_SECOND}s`;
    fadeinTarget.style.opacity = 1;
  };
  
  /**
   * フェードアウトする関数です。
   * @returns {Promise}
   */
  const fadeout = () => {
    return new Promise((resolve) => {
      const FADEOUT_SECOND = 0.1;
      const fadeinTarget = document.querySelector(".center");
      fadeinTarget.style.transition = `all ${FADEOUT_SECOND}s`;
      fadeinTarget.style.opacity = 0;
      setTimeout(() => {
        resolve();
      }, FADEOUT_SECOND * 1000);
    });
  };
  
  /**
   * ファイルを取得する関数です。
   * 取得するファイルは第1引数で指定してください。
   * @param {String} filePath
   * @returns {Promise}
   */
  const getFileByXMLHttpRequest = (filePath) => {
    return new Promise((resolve) => {
      const xhr = new XMLHttpRequest();
      xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
          resolve(xhr.responseText);
        }
      };
      xhr.open("GET", filePath);
      xhr.send(); 
    });
  };
  
  /**
   * 自サイトのURLかどうか判定する関数です。
   * 自サイトならばtrueを返します。
   * @param {String} URL
   * @returns {Boolean}
   */
  
  
  /**
   * Webページを書き換える関数です。
   * 書き換え後のHTMLは第1引数で指定してください。
   * @param {String} HTMLString
   */
  const rewritePage = (HTMLString) => {
    const temporaryWrapper = document.createElement("div");
    temporaryWrapper.innerHTML = HTMLString;
    for (const ELEMENT_TO_REWRITING of ["title", ".center"]) {
      document.querySelector(ELEMENT_TO_REWRITING).innerHTML = temporaryWrapper.querySelector(ELEMENT_TO_REWRITING).innerHTML;
    }
  };
  
  /**
   * 非同期遷移処理です。
   * @author tomomoss
   */
  
  // <a>タグをクリックしたときの非同期遷移処理です。
  window.addEventListener("load", () => {
    for (const anchor of document.querySelectorAll(".index_1")) {
      anchor.addEventListener("click", (event) => {
        
        event.preventDefault();
        Promise.all([fadeout(), getFileByXMLHttpRequest(anchor.href)]).then((result) => {
          history.pushState(null, null, location.href);
          history.replaceState(null, null, anchor.href);
          rewritePage(result);
          fadein();
        });
      });
    }
  });
  
  // ブラウザの進む・戻る処理に対応した非同期遷移処理です。
  window.addEventListener("popstate", () => {
    Promise.all([fadeout(), getFileByXMLHttpRequest(location.href)]).then((result) => {
      rewritePage(result);
      fadein();
    });
  });