<?php
print('<div class="images col-md-3">');
    print('<div class="image_1">');
        print('<a href="./racket/racket-' . $racket['number'] . '/racket_' . $racket['number'] . '.php?number=' . $racket['number'] . '">');
            print('<img src="images/racket' . $racket['number'] . '.jpg" alt="' . $racket['name'] . '" height="230" width="230">');
            print('<div>' . $racket['name'] . '<br>価格：' . $racket['price'] . '円(税込)<br>反発性：' . $racket['repulsion'] . '<br>振動特性：' . $racket['vibration'] . '</div>');
            print('</a>');
        print('</div>');
    print('</div>');
?>