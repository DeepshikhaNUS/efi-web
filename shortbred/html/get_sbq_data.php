<?php

require_once("../includes/main.inc.php");
require_once("../libs/identify.class.inc.php");
require_once("../libs/quantify.class.inc.php");

$is_error = false;
$the_id = "";
$q_id = "";
$job_obj = NULL;

if (isset($_POST["id"]) && is_numeric($_POST["id"]) && isset($_POST["key"])) {
    $the_id = $_POST["id"];
#    if (isset($_POST["quantify-id"]) && is_numeric($_POST["quantify-id"])) {
#        $q_id = $_POST["quantify-id"];
#        $job_obj = new quantify($db, $q_id);
#    } else {
        $job_obj = new identify($db, $the_id);
#    }

    if ($job_obj->get_key() != $_POST["key"]) {
        $is_error = true;
    } elseif (time() < $job_obj->get_time_completed() + settings::get_retention_days()) {
        $is_error = true;
    } else {
        $is_error = false;
    }
}

$result = array("valid" => false);

if ($is_error) {
    echo json_encode($result);
    exit(0);
}

$id_dir = $job_obj->get_results_path();
$clust_file = $id_dir . "/" . quantify::get_genome_normalized_cluster_file_name();

if (!file_exists($clust_file)) {
    echo json_encode($result);
    exit(0);
}

$req_clusters = array();
if (isset($_POST["clusters"])) {
    $req_clusters = parse_clusters($_POST["clusters"]);
}


$fh = fopen($clust_file, "r");

if ($fh) {
    $header_line = trim(fgets($fh));
    $headers = explode("\t", $header_line);
    $start_idx = 1;
    if (in_array("Cluster Size", $headers))
        $start_idx = 2;

    $metagenomes = array_slice($headers, $start_idx);

    // SORT AND MAP METAGENOMES SO THAT THEY CAN BE GROUPED BY BODY SITE
    $mg_lookup_temp = array();
    for ($i = 0; $i < count($metagenomes); $i++) {
        $mg_lookup_temp[$metagenomes[$i]] = $i;
    }
    $site_info = get_mg_db_info();
    $sort_fn = function($a, $b) use ($site_info) {
        if (!isset($site_info["site"][$a])) return 0;
        elseif (!isset($site_info["site"][$b])) return 0;
        $cmp = strcmp($site_info["site"][$a], $site_info["site"][$b]);
        if ($cmp != 0) return $cmp;
        $cmp = strcmp($site_info["gender"][$a], $site_info["gender"][$b]);
        if ($cmp != 0) return $cmp;
        $cmp = strcmp($a, $b);
        return $cmp;
    };
    usort($metagenomes, $sort_fn);
    $mg_lookup = array();
    for ($i = 0; $i < count($metagenomes); $i++) {
        $mg_lookup[$mg_lookup_temp[$metagenomes[$i]]] = $i;
    }
#    var_dump($mg_lookup);
#    die();

    $clusters = array();

    while (($line = fgets($fh)) !== false) {
        $line = trim($line);
        $parts = explode("\t", $line);
        $cluster = $parts[0];

        if ($cluster == "#N/A")
            continue;
        // If the user requested specific clusters, only return results for those clusters.
        if (count($req_clusters) && !isset($req_clusters[$cluster]))
            continue;

        $info = array("number" => $cluster, "abundance" => array_fill(0, count($metagenomes), 0));
        $sum = 0;
        for ($i = 0; $i < count($metagenomes); $i++) {
            $mg_idx = $mg_lookup[$i];
#            print $metagenomes[$i] . " $mg_idx\n";
            $info["abundance"][$mg_idx] = $parts[$start_idx + $i];
            $sum += $parts[1 + $i];
#            var_dump($info);
#           die();
        }
#        var_dump($info);
#        die();

        if ($sum >= 1e-6)
            array_push($clusters, $info);
    }


    $result["clusters"] = $clusters;
    $result["metagenomes"] = $metagenomes;
    $result["site_info"] = $site_info;
    $result["valid"] = true;
    
    fclose($fh);
} else {
}

echo json_encode($result);






function parse_clusters($params) {
    $params = str_replace(" ", "", $params);
    $parts = explode(",", $params);
    $nums = array();
    foreach ($parts as $part) {
        if (is_numeric($part)) {
            $nums[$part] = true;
        } else {
            $range_parts = explode("-", $part);
            if (count($range_parts) == 2) {
                $the_range = range($range_parts[0], $range_parts[1]);
                foreach ($the_range as $range_val)
                    $nums[$range_val] = true;
            }
        }
    }
    return $nums;
}



function get_mg_db_info() {
    $mg_dbs = settings::get_metagenome_db_list();

    $mg_db_list = explode(",", $mg_dbs);

    $info = array("site" => array(), "gender" => array());

    foreach ($mg_db_list as $mg_db) {
        $fh = fopen($mg_db, "r");
        if ($fh === false)
            continue;

        while (($data = fgetcsv($fh, 1000, "\t")) !== false) {
            if (isset($data[0]) && $data[0] && $data[0][0] == "#")
                continue; // skip comments

            $pos = strpos($data[1], "-");
            $site = trim(substr($data[1], $pos+1));
            $info["site"][$data[0]] = $site;
            $info["gender"][$data[0]] = $data[2];
        }

        fclose($fh);
    }

    return $info;
}

?>
