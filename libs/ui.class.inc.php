<?php


class ui {
    public static function make_upload_box($title, $file_id, $progress_bar_id, $progress_num_id, $other, $site_url_prefix = "", $default_file = "") {
        global $maxFileSize;
        if (!isset($maxFileSize))
            $maxFileSize = ini_get('post_max_size');

        if (!$default_file)
            $default_file = "Choose a file&hellip;";

        return <<<HTML
                <div>
                    $title
                    <input type='file' name='$file_id' id='$file_id' data-url='server/php/' class="input_file">
                    <label for="$file_id" class="file_upload"><img src="$site_url_prefix/images/upload.svg" /> <span>$default_file</span></label>
                </div>
                $other <a class="question" title="Maximum size is $maxFileSize">?</a>
HTML;
    }
}

?>

