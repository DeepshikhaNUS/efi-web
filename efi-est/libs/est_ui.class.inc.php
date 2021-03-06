<?php

const RT_GENERATE = 1;
const RT_COLOR = 2;
const RT_ANALYSIS = 3;
const RT_NESTED_COLOR = 4;

class est_ui {
    

    public static function output_job_list($jobs, $show_archive = false, $toggle_id = "", $is_example = false, $show_all_ids = false) {
        $up = "&#x25B2;";
        $down = "&#x25BC;";
        if ($toggle_id)
            $toggle_id = <<<HTML
<span id="$toggle_id" class="sort-toggle" title="Click to toggle between primary job ordering (with analysis jobs grouped with primary job), or by most recent job activity from newest to oldest."><i class="fas fa-list-alt"></i></span> 
HTML;
        $html = <<<HTML
            <table class="pretty-nested" style="table-layout:fixed">
                <thead>
                    <th class="id-col">ID</th>
                    <th>Job Name</th>
                    <th class="date-col">$toggle_id Date Completed</th>
                </thead>
                <tbody>
HTML;

        $order = $jobs["order"];
        $cjobs = $jobs["color_jobs"];
        $gjobs = $jobs["generate_jobs"];
    
        $get_bg_color = new bg_color_toggle();
    
        for ($i = 0; $i < count($order); $i++) {
            $id = $order[$i];
    
            if (isset($gjobs[$id])) {
                $html .= self::output_generate_job($id, $gjobs[$id], $get_bg_color, $show_archive, $is_example, $show_all_ids);
            } elseif (isset($cjobs[$id])) {
                $html .= self::output_top_color_job($id, $cjobs[$id], $get_bg_color, $show_archive, $is_example);
            }
        }
        $html .= <<<HTML
                </tbody>
            </table>
HTML;
        return $html;
    }

    private static function output_top_color_job($id, $job, $get_bg_color, $show_archive, $is_example) {
        $bg_color = $get_bg_color->get_color();
        $link_class = "hl-color";
        $html = self::output_colorssn_row($id, $job, $bg_color, $show_archive, $is_example);
        return $html;
    }
    
    private static function output_generate_job($id, $job, $get_bg_color, $show_archive, $is_example, $show_all_ids = false) {
        $bg_color = $get_bg_color->get_color();
        $link_class = "hl-est";
        $html = self::output_generate_row($id, $job, $bg_color, $show_archive, $is_example);
    
        foreach ($job["analysis_jobs"] as $ajob) {
            $htmla = self::output_analysis_row($id, $job["key"], $ajob, $bg_color, $show_archive, $is_example, $show_all_ids);
            $html .= $htmla;
            if (isset($ajob["color_jobs"])) {
                foreach ($ajob["color_jobs"] as $cjob) {
                    $htmlc = self::output_nested_colorssn_row($cjob["id"], $cjob, $bg_color, $show_archive, $is_example, $show_all_ids);
                    $html .= $htmlc;
                }
            }
        }
        return $html;
    }

    private static function output_generate_row($id, $job, $bg_color, $show_archive, $is_example) {
        return self::output_row(RT_GENERATE, $id, NULL, $job["key"], $job, $bg_color, $show_archive, $is_example);
    }

    private static function output_colorssn_row($id, $job, $bg_color, $show_archive, $is_example) {
        return self::output_row(RT_COLOR, $id, NULL, $job["key"], $job, $bg_color, $show_archive, $is_example);
    }

    private static function output_nested_colorssn_row($id, $job, $bg_color, $show_archive, $is_example, $show_all_ids = false) {
        return self::output_row(RT_NESTED_COLOR, $id, NULL, $job["key"], $job, $bg_color, $show_archive, $is_example, $show_all_ids);
    }

    private static function output_analysis_row($id, $key, $job, $bg_color, $show_archive, $is_example, $show_all_ids = false) {
        return self::output_row(RT_ANALYSIS, $id, $job["analysis_id"], $key, $job, $bg_color, $show_archive, $is_example, $show_all_ids);
    }

    // $aid = NULL to not output an analysis (nested) job
    private static function output_row($row_type, $id, $aid, $key, $job, $bg_color, $show_archive, $is_example, $show_all_ids = false) {
        $script = global_settings::get_est_web_path() . "/" . self::get_script($row_type);
        $link_class = self::get_link_class($row_type);
    
        $name = $job["job_name"];
        $date_completed = $job["date_completed"];
        $is_completed = $job["is_completed"];
    
        $link_start = "";
        $link_end = "";
        $name_style = "";
        $data_aid = "";
        $archive_icon = "fa-stop-circle cancel-btn";
        if ($is_completed) {
            $aid_param = $row_type == RT_ANALYSIS ? "&analysis_id=$aid" : "";
            $ex_param = $is_example ? "&x=1" : "";
            $link_start = "<a href='$script?id=$id&key=${key}${aid_param}${ex_param}' class='$link_class'>";
            $link_end = "</a>";
            $archive_icon = "fa-trash-alt";
        } elseif ($date_completed == __FAILED__) {
            $archive_icon = "fa-trash-alt";
        }
        $id_text = "$link_start${id}$link_end";
    
        if ($row_type == RT_ANALYSIS) {
            $name_style = "style=\"padding-left: 35px;\"";
            if (!$show_all_ids)
                $id_text = "";
            else
                $id_text = $aid;
            $data_aid = "data-analysis-id='$aid'";
        } elseif ($row_type == RT_NESTED_COLOR) {
            $name_style = "style=\"padding-left: 70px;\"";
            if (!$show_all_ids)
                $id_text = "";
            else
                $id_text = $id;
        }
        $name = "<span title='$id'>$name</span>";
    
        $status_update_html = "";
        if ($show_archive)
            $status_update_html = "<div style='float:right' class='archive-btn' data-type='gnn' data-id='$id' data-key='$key' $data_aid title='Archive Job'><i class='fas $archive_icon'></i></div>";
    
        return <<<HTML
                    <tr style="background-color: $bg_color">
                        <td>$id_text</td>
                        <td $name_style>$link_start${name}$link_end</td>
                        <td>$date_completed $status_update_html</td>
                    </tr>
HTML;
    }

    private static function get_script($row_type) {
        switch ($row_type) {
        case RT_GENERATE:
            return "stepc.php";
        case RT_ANALYSIS:
            return "stepe.php";
        case RT_COLOR:
        case RT_NESTED_COLOR:
            return "view_coloredssn.php";
        default:
            return "";
        }
    }
    
    private static function get_link_class($row_type) {
        switch ($row_type) {
        case RT_COLOR:
        case RT_NESTED_COLOR:
            return "hl-color";
        default:
            return "hl-est";
        }
    }

}


class bg_color_toggle {

    private $last_bg_color = "#eee";

    // Return the color and then toggle it.
    public function get_color() {
        if ($this->last_bg_color == "#fff")
            $this->last_bg_color = "#eee";
        else
            $this->last_bg_color = "#fff";
        return $this->last_bg_color;
    }
}

?>
