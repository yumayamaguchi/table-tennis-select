<?php
print('<div class="images col-md-3">');
    print('<div class="image_1">');
        print('<a href="./racket/rubber_detail.php?id=' . $rubber['id'] . '">');
            print('<img src="images/rubber-' .$rubber['id']. '/rubber1.jpg" alt="' . $rubber['name'] . '" height="230" width="230">');
            print('<div>' . $rubber['name'] . '<br>価格：' . $rubber['price'] . '円(税込)<br>反発性：' . $rubber['repulsion'] . '<br>振動特性：' . $rubber['vibration'] . '</div>');
            print('</a>');
        print('</div>');
    print('</div>');
?>