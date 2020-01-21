<?php
$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
$length = 10;
$dat = 'aaa bbb ccc fdfd dfgkno erjng';
$array = (str_word_count($dat, 1));
$word = '';
foreach ($array as $value) {
  $word = $word . substr($value, 0, 1);
}
if (strlen($word) < $length) {
  $length = $length - strlen($word);
  $word = $word . substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}
echo $word.' - '.strlen($word);