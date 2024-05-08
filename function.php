<?php
function grab_url($site){
    $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $site );
        curl_setopt($ch, CURLOPT_TIMEOUT, 40);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_VERBOSE,1);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; .NET CLR 1.0.3705; .NET CLR 1.1.4322; Media Center PC 4.0)');
        curl_setopt($ch, CURLOPT_REFERER,'http://www.google.com');  //any fake referer
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CAINFO, '/cacert.pem');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 20);
    ob_start();
    return curl_exec ($ch);
    ob_end_clean();
    curl_close ($ch);
}

function get_page($grade,$subject,$chapter_id,$level){
    $url = 'http://tracnghiem.itrithuc.vn/tra-cuu-cau-hoi?grade='.$grade.'&subject='.$subject.'&chapter_id='.$chapter_id.'&level='.$level;
    $site_data = grab_url($url);
    $site_html = str_get_html($site_data);
    @$data = $site_html->find('li.page-nav-item a');
    @$data = $site_html->find('li.page-nav-item a',(count($data)-1))->href;
    $data = get_quest_id($data);
    $page = $data->page;
    if ($page == null) {
        $page = 1;
    }
    return $page;
}
function get_quest_data($site){
    $site_data = grab_url($site);
    $site_html = str_get_html($site_data);
    $data = $site_html->find('div.view-question');
    return $data;
}
function get_quest_id($site){
    $parts = @parse_url($site);
    @parse_str($parts['query'], $query);
    if (!isset($data)) $data = new stdClass();
    @$data->grade_id = $query['grade'];
    @$data->subject_id = $query['subject'];
    @$data->level_id = $query['level'];
    @$data->chapter_id = $query['chapter_id'];
    @$data->page = $query['page'];
    return $data;
}
function get_quest_content($data){
    $regex = '/<\/b>(.*?)<\/p>/';
    preg_match_all($regex, $data, $matches);
    return $matches[1][0];
}
function get_quest_answer_a($data){
    $regex = '/<\/b>(.*?)<\/p>/';
    preg_match_all($regex, $data, $matches);
    return $matches[1][0];
}
function get_quest_answer_b($data){
    $regex = '/<\/b>(.*?)<\/p>/';
    preg_match_all($regex, $data, $matches);
    return $matches[1][0];
}
function get_quest_answer_c($data){
    $regex = '/<\/b>(.*?)<\/p>/';
    preg_match_all($regex, $data, $matches);
    return $matches[1][0];
}
function get_quest_answer_d($data){
    $regex = '/<\/b>(.*?)<\/p>/';
    preg_match_all($regex, $data, $matches);
    return $matches[1][0];
}
function get_quest_answer($data,$a,$b,$c,$d){
    $regex = '/<b>Đáp án\s(.*?)<\/b>/';
    preg_match_all($regex, $data, $matches);
    switch ($matches[1][0]) {
        case 'A':
            $answer = $a;
            break;
        case 'B':
            $answer = $b;
            break;
        case 'C':
            $answer = $c;
            break;
        case 'D':
            $answer = $d;
            break;
        
        default:
            $answer = $a;
            break;
    }
    return $answer;
}

function dom_chap_list_mangazuki($site_html){
    $url_chap_list = array();
    $list_chap = $site_html->find('div.page-content-listing li.wp-manga-chapter');
    foreach ($list_chap as $list_chap_key => $list_chap_value) {
        array_push($url_chap_list, $list_chap_value->find('a',0)->href);
    }
    return $url_chap_list;
}
function dom_image_list_mangazuki($chap_html){
    $image_chap_list = array();
    $list_image = $chap_html->find('img.wp-manga-chapter-img');
    foreach ($list_image as $list_image_key => $list_image_value) {
        array_push($image_chap_list, $list_image_value->src);
    }
    return $image_chap_list;
}
function check_site($site){
    if (strpos($site, 'mangazuki.club') !== false) {
        return 0;
    }
    if (strpos($site, 'lhscan.net') !== false) {
        return 1;
    }
}
function check_chap($site){ 
    if (preg_match("/chap-[0-9]{1,9}(?=\/p\/)/",$site)) {
        return 1;
    } else {
        return 0;
    }
}
function get_chap_list($site){
	$site_data = grab_url($site);
	$site_html = str_get_html($site_data);
    if (check_site($site) == 0) {
        $chap_list = dom_chap_list_mangazuki($site_html);
    }
	return $chap_list;
}
function get_image_chap($chap_data,$site){
    $chap_html = str_get_html($chap_data);
    if (check_site($site) == 0) {
        $image_list = dom_image_list_mangazuki($chap_html);
    }
    return $image_list;
}
function get_all_image_chap_mangazuki($site){
    $image_p_list = array();
    $chap_data = grab_url($site);
    $image_chap = get_image_chap($chap_data,$site);
    $image_p_list = array_merge($image_p_list,$image_chap);
    $p = get_p_mangazuki($chap_data);
    for ($n=2; $n <= $p; $n++) { 
        $chap_data = grab_url(substr($site, 0, -2).$n);
        $image_chap = get_image_chap($chap_data,$site);
        $image_p_list = array_merge($image_p_list,$image_chap); 
    }
    return $image_p_list;
}
function get_image_all_chap($site){
    $chap_list = get_chap_list($site);
    $image_chap_list = array();
    if (check_site($site) == 0) {
        for ($i=(count($chap_list)-1); $i >= 0; $i--) { 
            $image_p_list = get_all_image_chap_mangazuki($chap_list[$i]);
            array_push($image_chap_list, $image_p_list);
            process(0,count($chap_list),(count($chap_list)-$i));
        }
    }
    return $image_chap_list;
}
function process($status,$total=0,$index=0,$chap=0){
    $dir = 'download/process.json';
    $array_process = array(
        'status' => $status,
        'total' => $total,
        'index' => $index,
        'chap' => $chap
    );
    file_put_contents($dir,json_encode($array_process));
    return 1;
}
function get_p_mangazuki($html){
    $data_html = str_get_html($html);
    $p = $data_html->find('div.selectpicker_page select.selectpicker',0)->find('option');
    return count($p);
}
function clean_string($site){
    if (check_site($site) == 0) {
        $regex = '/(?<=manga\/)([\s\S]*?)(?(?=\/)(?=\/)|$)/';
    }
    preg_match_all($regex, $site, $site_regex);
    $site_clean = str_replace(' ', '-', $site_regex[0][0]);
    return preg_replace('/[^A-Za-z0-9\-]/', '', $site_clean);

}
function get_num_chap($site){
    if (check_site($site) == 0) {
        $regex = '/[1-9]{1,9}(?=\/p\/)/m';
    }
    preg_match_all($regex, $site, $site_regex);
    return $site_regex[0][0];
}
function download_image_list($list_image,$dir,$chap){
    $total_image = count($list_image);
    $c = str_pad($chap,5,'0',STR_PAD_LEFT);
    if(!is_dir('../../DOWNLOAD/'.$dir)){
        mkdir('../../DOWNLOAD/'.$dir, 0755, true);
    } 
    for ($i=0; $i < $total_image ; $i++) { 
        $n=str_pad($i,5,'0',STR_PAD_LEFT);
        if(!is_dir('../../DOWNLOAD/'.$dir.'/'.$c)){
            mkdir('../../DOWNLOAD/'.$dir.'/'.$c, 0755, true);
        } 
        $newfile = $c.'_'.$n.'.png';
        if (!file_exists('../../DOWNLOAD/'.$dir.'/'.$c.'/'.$newfile)) {
          copy($list_image[$i], '../../DOWNLOAD/'.$dir.'/'.$c.'/'.$newfile);
        }
        process(1,$total_image-1,$i,$chap);
    }
}
function main_download_all($site){
    $image_chap_list = get_image_all_chap($site);
    $total_chap = count($image_chap_list);
    $dir = clean_string($site);
    for ($i=0; $i < $total_chap; $i++) { 
        download_image_list($image_chap_list[$i],$dir,$i);
    }
    process(2);
    return 1;
}
function main_download_one($site){
    if (check_site($site) == 0) {
        $image_chap_list = get_all_image_chap_mangazuki($site);
    }
    $dir = clean_string($site);
    download_image_list($image_chap_list,$dir,get_num_chap($site));
    process(2);
    return 1;
}
?>