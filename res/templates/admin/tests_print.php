

<!DOCTYPE html>
<html>
<head>
<title>ANI - TEST LAB</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.A4 {
  background: white;
  width: 21cm;
  height: 29.7cm;
  display: block;
  margin: 0 auto;
  padding: 10px 25px;
  margin-bottom: 0.5cm;
  box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);
  box-sizing: border-box;
  font-size: 8pt;
}
.MJXc-display {
    display: block;
    text-align: left !important;
    margin: 0em 0 !important;
    padding: 0;
}
  p {
    margin-block-start: 3px;
    margin-block-end: 3px;
    margin-inline-end: 30px;
  }
@media print {
  .page-break {
    display: block;
    page-break-before: always;
  }
  size: A4 portrait;
}
.answer-reset {
  float: left;
  margin-inline-end: 5px;
}

@media print {
  body {
    margin: 0;
    padding: 0;
  }
  .A4 {
    box-shadow: none;
    margin: 0;
    width: auto;
    height: auto;
    overflow: hidden;
    font-size: 8pt;
  }
  .noprint {
    display: none;
  }
  .enable-print {
    display: block;
  }
  p {
    margin-block-start: 3px;
    margin-block-end: 3px;
    margin-inline-end: 30px;
  }
}

.footer-count {
    margin-top: 25px;
    margin-left: 95%;
}

#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
img {
  float: left!important;
}
#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 1px;
  width: 50px;
  text-align: center;
}
* {
    font-size: 8pt !important;
    font-family: Verdana,sans-serif !important;
}
#customers th {

  padding-top: 3px;
  padding-bottom: 3px;
  text-align: center;
  background-color: #4CAF50;
  color: white;
}
</style>
<script src="https://code.jquery.com/jquery-3.1.0.min.js" type="text/javascript"></script>
</head>
<body>
<div class="A4">
<p>
<span style="float: left;font-size: 12pt;text-align: center;" >SỞ GD & ĐT ĐẮK LẮK</br>TRƯỜNG <b id="a">Tên trường</b>
</br><i style="text-decoration: underline;">ĐỀ CHÍNH THỨC</i>
</span>
<span style="float: right;text-align: center;font-size: 12pt;" ><b id="b">Tên đề</b>
</br>
<b>MÔN:</b><b id="c">Tên môn</b>
</br>
<span>Thời gian làm bài: </span><span id="d">Thời gian</span>
</br>
<span>Số câu hỏi: </span><span id="e"><?=count($questions)?></span>
</span>
</p>
</br>
<p style="padding-top: 40px;">
</p>
<br/>
<br/>
<span style="margin-right:5%;font-size: 12pt;" ><b>Họ Tên:</b>.................................................................... </span> <span style="margin-right:1%;font-size: 12pt;" ><b>SBD:</b>........................... </span> <span style="margin-right:1%;font-size: 12pt;" ><b>Lớp:</b>............. </span>
<br/>
<table id="customers">
  <tr>
  	<th>:)</th>
  <?php for($i=0;$i<20;$i++){ 
    echo "<th>".($i+1)."</th>";
  } ?>
  </tr>
  <tr>
    <td>A</td>
  <?php 
  for($i=0;$i<20;$i++){ 
    echo "<td>O</td>";
  }?>
  </tr>
  <tr>
    <td>B</td>
    <?php 
  for($i=0;$i<20;$i++){ 
    echo "<td>O</td>";
  }?>
  </tr>
  <tr>
    <td>C</td>
    <?php 
  for($i=0;$i<20;$i++){ 
    echo "<td>O</td>";
  }?>
  </tr>
  <tr>
    <td>D</td>
    <?php 
  for($i=0;$i<20;$i++){ 
    echo "<td>O</td>";
  }?>
  </tr>
</table>
<table id="customers">
  <tr>
  	<th>:)</th>
    <?php for($i=20;$i<40;$i++){ 
    echo "<th>".($i+1)."</th>";
  } ?>
  </tr>
  <tr>
    <td>A</td>
    <?php 
  for($i=0;$i<20;$i++){ 
    echo "<td>O</td>";
  }?>
  </tr>
  <tr>
    <td>B</td>
    <?php 
  for($i=0;$i<20;$i++){ 
    echo "<td>O</td>";
  }?>
  </tr>
  <tr>
    <td>C</td>
    <?php 
  for($i=0;$i<20;$i++){ 
    echo "<td>O</td>";
  }?>
  </tr>
  <tr>
    <td>D</td>
    <?php 
  for($i=0;$i<20;$i++){ 
    echo "<td>O</td>";
  }?>
  </tr>
</table>
<br/>
<?php
function randomGen($min, $max, $quantity) {
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}
$count_questions = count($questions);
$random_quest = randomGen(0,$count_questions-1,$count_questions); 
for ($i=0; $i < $count_questions; $i++) {

    $data_quest = '<b>Câu '.($i+1).'. </b>'.$questions[$random_quest[$i]]->question_content;

    $answer_a = removeTags($questions[$random_quest[$i]]->answer_a);
    $answer_b = removeTags($questions[$random_quest[$i]]->answer_b);
    $answer_c = removeTags($questions[$random_quest[$i]]->answer_c);
    $answer_d = removeTags($questions[$random_quest[$i]]->answer_d);

    $answer = array();
    array_push($answer,$answer_a,$answer_b,$answer_c,$answer_d);
    shuffle($answer);

    $quest_html = '
    <div>
        <div>
            <p>'.$data_quest.'</p>
        </div>
        <div class="w3-row">
            <div class="w3-col s6">
                <p class="answer-reset"><b>A. </b>'.$answer[0].'</p>
            </div>
            <div class="w3-col s6">
                <p class="answer-reset"><b>B. </b>'.$answer[1].'</p>
            </div>
        </div>
        <div class="w3-row">
            <div class="w3-col s6">
                <p class="answer-reset"><b>C. </b>'.$answer[2].'</p>
            </div>
            <div class="w3-col s6">
                <p class="answer-reset"><b>D. </b>'.$answer[3].'</p>
            </div>
        </div>
    </div>
    ';
    echo $quest_html;
}
?>
<center>

<p><span style="font-size: 16pt;text-align: center;" >=== HẾT ===</span></p>
<p><span style="font-size: 16pt;text-align: center;" >Thí sinh không được sử dụng tài liệu. Cán bộ coi thi không giải thích gì thêm.</span></p>
</center>

</div>
<script type="text/x-mathjax-config">
    MathJax.Hub.Config({
      tex2jax: {inlineMath: [['$','$'], ['\\(','\\)']]}
    });
</script>
<script type="text/javascript" async src="//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-MML-AM_CHTML">
</script>

<script type="text/javascript">
    var max_pages = 100;
    var page_count = 0;
    var a,b,c,d;
    load();
    set();

    function snipMe() {
      page_count++;
      if (page_count > max_pages) {
        return;
      }
      var long = $(this)[0].scrollHeight - Math.ceil($(this).innerHeight());
      var children = $(this).children().toArray();
      var removed = [];
      while (long > 0 && children.length > 0) {
        var child = children.pop();
        $(child).detach();
        removed.unshift(child);
        long = $(this)[0].scrollHeight - Math.ceil($(this).innerHeight());
      }
      if (removed.length > 0) {
        var a4 = $('<div class="A4"></div>');
        a4.append(removed);
        $(this).after(a4);
        snipMe.call(a4[0]);
      }
    }

    $(document).ready(function() {
      $('.A4').each(function() {
        snipMe.call(this);
      });
    });

    function save(a,b,c,d) {
      localStorage.setItem("a", a);
      localStorage.setItem("b", b);
      localStorage.setItem("c", c);
      localStorage.setItem("d", d);
    }

    function load() {
      a = localStorage.getItem("a");
      b = localStorage.getItem("b");
      c = localStorage.getItem("c");
      d = localStorage.getItem("d");
    }

    function set(){ 
      $("#a").text(a);
      $("#b").text(b);
      $("#c").text(c);
      $("#d").text(d);
    }

    function KeyPress(e) {
      var evtobj = window.event? event : e
      if (evtobj.keyCode == 90 && evtobj.ctrlKey) 
      {
        a = prompt("Nhập tên trường học ", "THPT Trần Phú");
        b = prompt("Nhập tên đề thi ", "KIỂM TRA CUỐI HỌC KÌ I NH: 2021-2022");
        c = prompt("Nhập tên Môn Thi ", "Vật lý");
        d = prompt("Nhập thời gian làm bài ", "45 phút");
        save(a,b,c,d);
        set();
      }
    }


document.onkeydown = KeyPress;

</script>
</body>
</html>


<?php

function removeTags($string) {
  $string = str_replace('<p></p>', "", $string);
  $string = str_replace('<p>&nbsp;</p>', "", $string);
  $string = str_replace('<p style="text-align:justify">&nbsp;</p>', "", $string);
  return $string;
}