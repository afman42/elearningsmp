<?php

function alert($data,$tipe){
    if(isset($data) && isset($tipe)) {
        echo '<div class="alert alert-'.$tipe; echo' alert-dismissible fade show" role="alert">';
        echo $data;
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>';
    }
}

function agama($id = null){
    echo '<option value="islam"'; if(isset($id) && $id =='islam'){ echo 'selected';} echo '>Islam</option>';
    echo '<option value="yahudi"'; if(isset($id) && $id =='yahudi'){ echo 'selected';} echo '>Yahudi</option>';
    echo '<option value="protestan"'; if(isset($id) && $id =='protestan'){ echo 'selected';} echo '>Protestan</option>';
    echo '<option value="konghucu"'; if(isset($id) && $id == 'konghucu'){ echo 'selected';} echo '>Konghucu</option>';
    echo '<option value="kristen"'; if(isset($id) && $id =='kristen'){ echo 'selected';} echo '>Kristen</option>';
}

function hari($id = null){
    echo '<option value="senin"'; if(isset($id) && $id =='senin'){ echo 'selected';} echo '>Senin</option>';
    echo '<option value="selasa"'; if(isset($id) && $id =='selasa'){ echo 'selected';} echo '>Selasa</option>';
    echo '<option value="rabu"'; if(isset($id) && $id =='rabu'){ echo 'selected';} echo '>Rabu</option>';
    echo '<option value="kamis"'; if(isset($id) && $id == 'kamis'){ echo 'selected';} echo '>Kamis</option>';
    echo '<option value="jumat"'; if(isset($id) && $id =='jumat'){ echo 'selected';} echo '>Jumat</option>';
    echo '<option value="sabtu"'; if(isset($id) && $id =='sabtu'){ echo 'selected';} echo '>Sabtu</option>';
}

function ubah_date_time($timestamp){
    return date('Y-m-d H:i:s', strtotime($timestamp));
}

function pilihan_jawaban($selected = NULL){
    echo "<option value=''> -- Pilihan Jawaban -- </option>";
    echo "<option value='A' "; if (isset($selected) && $selected == 'A') { echo 'selected'; }; echo ">A</option>";
    echo "<option value='B' "; if (isset($selected) && $selected == 'B') { echo 'selected'; }; echo ">B</option>";    
    echo "<option value='C' "; if (isset($selected) && $selected == 'C') { echo 'selected'; }; echo ">C</option>";    
    echo "<option value='D' "; if (isset($selected) && $selected == 'D') { echo 'selected'; }; echo ">D</option>";
}

function first_kata_tinymce($str, $value){
    if ($value == 'a.' || $value == 'b.' || $value == 'c.' || $value == 'd.') {
        return ltrim($str, $value);
    }
}

function active_link($url){
    $ci =& get_instance();
    $uri = $ci->uri->segment(2);
    if ($uri == $url) {
        echo 'active';
    }
}