<?php

if (empty($_SESSION['email']) AND empty($_SESSION['level']) AND $_SESSION['login'] != TRUE){
    echo "<script type='text/javascript'>alert('Harap Login Terlebih dahulu');window.location.href='".site_url('utama/login')."'</script>";
}
else{
?>
<html>
<header>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="description"  content=""/>
<meta name="keywords" content=""/>
<meta http-equiv="imagetoolbar" content="no"/>
<title>.::Halaman Tugas / Quiz::.</title>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
<link rel="stylesheet" href="css/reset.css" type="text/css"/>
<link rel="stylesheet" href="<?= base_url('assets/css/screen.css'); ?>" type="text/css"/>
<link href="<?= base_url();?>/RuangAdmin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="css/fancybox.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.wysiwyg.css" type="text/css"/>
<link rel="stylesheet" href="css/jquery.ui.css" type="text/css"/>
<link rel="stylesheet" href="css/visualize.css" type="text/css"/>
<link rel="stylesheet" href="css/visualize-light.css" type="text/css"/>


<script src="<?= base_url();?>RuangAdmin/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.visualize.js"></script>
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript" src="js/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/jquery.idtabs.js"></script>
<script type="text/javascript" src="js/jquery.datatables.js"></script>
<script type="text/javascript" src="js/jquery.jeditable.js"></script>
<script type="text/javascript" src="js/jquery.ui.js"></script>
<script type="text/javascript" src="js/clock.js"></script>

<script type="text/javascript" src="js/excanvas.js"></script>
<script type="text/javascript" src="js/cufon.js"></script>
<script type="text/javascript" src="js/Geometr231_Hv_BT_400.font.js"></script>

<script language="javascript" type="text/javascript">
    tinyMCE_GZ.init({
    plugins : 'style,layer,table,save,advhr,advimage, ...',
        themes  : 'simple,advanced',
        languages : 'en',
        disk_cache : true,
        debug : false
});
</script>
<script language="javascript" type="text/javascript"
src="../tinymcpuk/tiny_mce_src.js"></script>
<script type="text/javascript">
tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        plugins : "table,youtube,advhr,advimage,advlink,emotions,flash,searchreplace,paste,directionality,noneditable,contextmenu",
        theme_advanced_buttons1_add : "fontselect,fontsizeselect",
        theme_advanced_buttons2_add : "separator,preview,zoom,separator,forecolor,backcolor,liststyle",
        theme_advanced_buttons2_add_before: "cut,copy,paste,separator,search,replace,separator",
        theme_advanced_buttons3_add_before : "tablecontrols,separator,youtube,separator",
        theme_advanced_buttons3_add : "emotions,flash",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        extended_valid_elements : "hr[class|width|size|noshade]",
        file_browser_callback : "fileBrowserCallBack",
        paste_use_dialog : false,
        theme_advanced_resizing : true,
        theme_advanced_resize_horizontal : false,
        theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;",
        apply_source_formatting : true
});

    function fileBrowserCallBack(field_name, url, type, win) {
        var connector = "../../filemanager/browser.html?Connector=connectors/php/connector.php";
        var enableAutoTypeSelection = true;

        var cType;
        tinymcpuk_field = field_name;
        tinymcpuk = win;

        switch (type) {
            case "image":
                cType = "Image";
                break;
            case "flash":
                cType = "Flash";
                break;
            case "file":
                cType = "File";
                break;
        }

        if (enableAutoTypeSelection && cType) {
            connector += "&Type=" + cType;
        }

        window.open(connector, "tinymcpuk", "modal,width=600,height=400");
    }
</script>

<style type="text/css">
<!--
.style3 {
    color: #62A621;
    font-weight: bold;
}
.garisbawah {
    padding-bottom: 5px;
    border-bottom: 1px dotted #CCC;
}
table td, table td * {
    vertical-align: top;
}
-->
</style>
<script>

var waktunya;
waktunya = <?php echo "$_POST[waktu]" * 60; ?>;
var waktu;
var jalan = 0;
var habis = 0;
function init(){
    checkCookie()
    mulai();
}
function keluar(){
    if(habis==0){
        setCookie('waktux',waktu,365);
    }else{
        setCookie('waktux',0,-1);
    }
}
function mulai(){
    jam = Math.floor(waktu/3600);
    sisa = waktu%3600;
    menit = Math.floor(sisa/60);
    sisa2 = sisa%60
    detik = sisa2%60;
    if(detik<10){
        detikx = "0"+detik;
    }else{
        detikx = detik;
    }
    if(menit<10){
        menitx = "0"+menit;
    }else{
        menitx = menit;
    }
    if(jam<10){
        jamx = "0"+jam;
    }else{
        jamx = jam;
    }
    document.getElementById("divwaktu").innerHTML = jamx+" H : "+menitx+" M : "+detikx +" S";
    waktu --;
    if(waktu>0){
        t = setTimeout("mulai()",1000);
        jalan = 1;
    }else{
        if(jalan==1){
            clearTimeout(t);
        }
        habis = 1;
        document.getElementById("formulir").submit();
        
    }
}
function selesai(){    
    if(jalan==1){
            clearTimeout(t);
        }
        habis = 1;
    document.getElementById("formulir").submit();
    
}
function getCookie(c_name){
    if (document.cookie.length>0){
        c_start=document.cookie.indexOf(c_name + "=");
        if (c_start!=-1){
            c_start=c_start + c_name.length+1;
            c_end=document.cookie.indexOf(";",c_start);
            if (c_end==-1) c_end=document.cookie.length;
            return unescape(document.cookie.substring(c_start,c_end));
        }
    }
    return "";
}

function setCookie(c_name,value,expiredays){
    var exdate=new Date();
    exdate.setDate(exdate.getDate()+expiredays);
    document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}

function checkCookie(){
    waktuy=getCookie('waktux');
    if (waktuy!=null && waktuy!=""){
        waktu = waktuy;
    }else{
        waktu = waktunya;
        setCookie('waktux',waktunya,7);
    }
}
</script>
<script type="text/javascript">
    window.history.forward();
    function noBack(){ window.history.forward(); }
</script>
<script type="text/javascript">
function tombol()
{
document.getElementById("tombol").innerHTML= "<input type='button' class='btn btn-primary' value='Simpan' onclick='selesai()'>";
}
function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault();};
$(document).ready(function(){ 
    $(document).on("keydown", disableF5);
})
</script>
</header>
<body onload="init(),noBack();" onpageshow="if (event.persisted) noBack(); if(window.event.)" onunload="keluar()">
<div class="sidebar">
        <div class="logo2 clear">
            <img src="<?= base_url('assets/pendidikan.png'); ?>" alt="" style="margin-top:10px;margin-left:60;" width="150" height="150" />
        </div>
        <div class="waktu">
          <ul>
            <li><a>Sisa Waktu Anda</a>
                  <div id='divwaktu' style="background-color: white;"></div>
            </li>
          </ul>
        </div>
</div>


    <div class="main"> <!-- *** mainpage layout *** -->
    <div class="main-wrap">
        <div class="header clear">
        </div>

        <div class="page clear">
            <!-- MODAL WINDOW -->
            <div id="modal" class="modal-window">
                <!-- <div class="modal-head clear"><a onclick="$.fancybox.close();" href="javascript:;" class="close-modal">Close</a></div> -->


            </div>

            <!-- CONTENT BOXES -->
            <!-- end of content-box -->
<div class="notification note-success">
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td width="2%">&nbsp;</td>
      <td width="95%">

<form action='<?= site_url('siswa/nilai');?>' method='post' id='formulir'>

<?php
$user = $this->db->get_where('user',['level' => $this->session->userdata('level')])->row();

$cek_siswa = $this->db->query("SELECT * FROM siswa_mengerjakan WHERE topik_tugas_id='$_POST[id]' AND siswa_id='$user->is_siswa'");
$info_siswa = $cek_siswa->row_array();
if ($info_siswa <= 0){
    // $hits = 1;
    // $this->db->query("INSERT INTO siswa_mengerjakan (topik_tugas_id,siswa_id,hits)
    //                                     VALUES ('$_POST[id]','$user->is_siswa','$hits')");
}
elseif ($info_siswa > 0){
    echo "<script>alert('Ujian Telah Dilakukan');window.location.href='".site_url('siswa/tugas')."'</script>";
}

$soal = $this->db->query("SELECT * FROM quiz_pilganda where topik_tugas_id='$_POST[id]' ORDER BY rand()");
$pilganda = $soal->num_rows();
$soal_esay = $this->db->query("SELECT * FROM quiz_essay WHERE topik_tugas_id='$_POST[id]'");
$esay = $soal_esay->num_rows();
if (!empty($pilganda) || !empty($esay)){
echo "<br><b class='judul'>Daftar Soal Pilihan Ganda</b><br><p class='garisbawah'></p>
    <table><input type=hidden name=id_topik value='$_POST[id]'>";

$no = 1;
// while($s = mysqli_fetch_array($soal)){
foreach ($soal->result_array() as $s) {
    if ($s['gambar']!=''){
    echo "<tr><td rowspan=6 width='1px'><h6>$no.</h6></td><td><h6>".$s['pertanyaan']."</h6></td></tr>";
    echo "<tr><td><img src='".base_url().$s['gambar']."' height='300' width='300'></td></tr>";    
    echo "<tr><td><input type=radio name=soal_pilganda[".$s['id']."] value='A'>A. ".$s['pil_a']."</td></tr>";
    echo "<tr><td><input type=radio name=soal_pilganda[".$s['id']."] value='B'>B. ".$s['pil_b']."</td></tr>";
    echo "<tr><td><input type=radio name=soal_pilganda[".$s['id']."] value='C'>C. ".$s['pil_c']."</td></tr>";
    echo "<tr><td><input type=radio name=soal_pilganda[".$s['id']."] value='D'>D. ".$s['pil_d']."</td></tr>";
    }else{
        echo "<tr><td rowspan=5 width='1px'><h6>$no.</h6></td><td><h6>".$s['pertanyaan']."</h6></td></tr>";        
        echo "<tr><td><input type=radio name=soal_pilganda[".$s['id']."] value='A'>A. ".$s['pil_a']."</td></tr>";
        echo "<tr><td><input type=radio name=soal_pilganda[".$s['id']."] value='B'>B. ".$s['pil_b']."</td></tr>";
        echo "<tr><td><input type=radio name=soal_pilganda[".$s['id']."] value='C'>C. ".$s['pil_c']."</td></tr>";
        echo "<tr><td><input type=radio name=soal_pilganda[".$s['id']."] value='D'>D. ".$s['pil_d']."</td></tr>";
    }
    $no++;
}
echo "</table>";
echo "<br><b class='judul'>Daftar Soal Essay</b><br><p class='garisbawah'></p>
    <table>";
$no2=1;
// while($e=  mysqli_fetch_array($soal_esay)){
foreach ($soal_esay->result_array() as $e) {
    if (!empty($e['gambar'])){
    echo "<tr><td rowspan=4 width='1px'><h6>$no2.</h6></td><td><h6>".$e['pertanyaan']."</h6></td></tr>";
    echo "<tr><td><img src='".base_url().$e['gambar']."' height='300' width='300'></td></tr>";
    echo "<tr><td>Jawaban : </td></tr>";
    echo "<tr><td><textarea name=soal_esay[".$e['id']."] cols=95 rows=5></textarea></td></tr>";
    }else{
        echo "<tr><td rowspan=3 width='1px'><h6>$no2.</h6></td><td><h6>".$e['pertanyaan']."</h6></td></tr>";
        echo "<tr><td>Jawaban : </td></tr>";
        echo "<tr><td><textarea name=soal_esay[".$e['id']."] cols=95 rows=5></textarea></td></tr>";
    }
    $no2++;
}
echo "</table>";
$jumlahsoal = $no - 1;
echo "<input type=hidden name=jumlahsoalpilganda value=$jumlahsoal>";
}
elseif (empty($pilganda) AND empty($esay)){
    echo "<script>window.alert('Maaf belum ada soal di Topik Ini.');
            window.location.href='".site_url('siswa/tugas')."')</script>";
}
?>
<br><p class='garisbawah'></p>
<h6>Apakah anda sudah yakin dengan jawaban anda dan ingin menyimpannya?  <button type=button class='btn btn-warning' onclick="tombol()">Ya</button></h6>
<h3 id="tombol"></h3>
</form>
</td>
      <td width="3%">&nbsp;</td>
    </tr>
  </table>
</div>
            <div class="clear">
                <!-- end of content-box -->

        </div><!-- end of page -->

        <div class="footer clear"></div>
    </div>
    </div>
</div>
</body>
</html>
<?php }?>
