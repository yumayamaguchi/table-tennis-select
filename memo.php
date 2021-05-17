//グラフの書き込み
//number消す

create table ra {
  id int(11) AUTO_INCREMENT,
  racket_id int(11) not null,
  rubber_four_id int(11) not null,
  rubber_back_id int(11) not null,
  four_speed int(11) not null,
  four_spin int(11) not null,
  four_stable int(11) not null,
  four_price int(11) not null,
  back_speed int(11) not null,
  back_spin int(11) not null,
  back_stable int(11) not null,
  back_price int(11) not null,
  PRIMARY KEY (id)
}
