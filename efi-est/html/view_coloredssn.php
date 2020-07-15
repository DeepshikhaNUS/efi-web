<?php 
include_once '../includes/main.inc.php';
require_once(__BASE_DIR__ . "/includes/login_check.inc.php");

if ((!isset($_GET['id'])) || (!is_numeric($_GET['id']))) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    exit;
}


$is_example = isset($_GET["x"]);
$obj = job_factory::create($db, $_GET['id'], $is_example); // Creates a color SSN or a cluster analysis job

$key = $obj->get_key();
if ($key != $_GET['key']) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    //echo "No EFI-EST Selected. Please go back";
    exit;
}

if (!$is_example && $obj->is_expired()) {
    require_once("inc/header.inc.php");
    echo "<p class='center'><br>Your job results are only retained for a period of " . global_settings::get_retention_days(). " days";
    echo "<br>Your job was completed on " . $obj->get_time_completed();
    echo "<br>Please go back to the <a href='" . functions::get_server_name() . "'>homepage</a></p>";
    require_once("inc/footer.inc.php");
    exit;
}


$table_format = "html";
if (isset($_GET["as-table"])) {
    $table_format = "tab";
}
$table = new table_builder($table_format);

$metadata = $obj->get_metadata();
$job_name = $obj->get_uploaded_filename();
foreach ($metadata as $row) {
    if (strpos($row[0], '<a href') !== false)
        $table->add_row_html_only($row[0], $row[1]);
    else
        $table->add_row($row[0], $row[1]);
}

$table_string = $table->as_string();

if (isset($_GET["as-table"])) {
    $table_filename = functions::safe_filename($baseSsnName) . "_summary.txt";

    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $table_filename . '"');
    header('Content-Length: ' . strlen($table_string));
    ob_clean();
    echo $table_string;
    exit(0);
}


$est_id = $obj->get_id();
$uploadedFilename = $obj->get_uploaded_filename();

$url = $_SERVER['PHP_SELF'] . "?" . http_build_query(array('id'=>$obj->get_id(), 'key' => $key));
$baseUrl = functions::get_web_root() . "/results/" . $obj->get_output_dir();

$ex_param = $is_example ? "&x=1" : "";

$want_clusters_file = true;
$want_singles_file = false;
$baseSsnName = $obj->get_colored_xgmml_filename_no_ext();
$ssnFile = $obj->get_colored_ssn_web_path();
$ssnFileSize = format_file_size($obj->get_file_size($ssnFile));
$ssnFileZip = $obj->get_colored_ssn_zip_web_path();
$ssnFileZipSize = format_file_size($obj->get_file_size($ssnFileZip));
$uniprotNodeFilesZip = $obj->get_node_files_zip_web_path(colorssn::SEQ_NO_DOMAIN, colorssn::SEQ_UNIPROT);
$uniprotNodeFilesZipSize = format_file_size($obj->get_file_size($uniprotNodeFilesZip));
$uniprotDomainNodeFilesZip = $obj->get_node_files_zip_web_path(colorssn::SEQ_DOMAIN, colorssn::SEQ_UNIPROT);
$uniprotDomainNodeFilesZipSize = format_file_size($obj->get_file_size($uniprotDomainNodeFilesZip));
$uniref50NodeFilesZip = $obj->get_node_files_zip_web_path(colorssn::SEQ_NO_DOMAIN, colorssn::SEQ_UNIREF50);
$uniref50NodeFilesZipSize = format_file_size($obj->get_file_size($uniref50NodeFilesZip));
$uniref50DomainNodeFilesZip = $obj->get_node_files_zip_web_path(colorssn::SEQ_DOMAIN, colorssn::SEQ_UNIREF50);
$uniref50DomainNodeFilesZipSize = format_file_size($obj->get_file_size($uniref50DomainNodeFilesZip));
$uniref90NodeFilesZip = $obj->get_node_files_zip_web_path(colorssn::SEQ_NO_DOMAIN, colorssn::SEQ_UNIREF90);
$uniref90NodeFilesZipSize = format_file_size($obj->get_file_size($uniref90NodeFilesZip));
$uniref90DomainNodeFilesZip = $obj->get_node_files_zip_web_path(colorssn::SEQ_DOMAIN, colorssn::SEQ_UNIREF90);
$uniref90DomainNodeFilesZipSize = format_file_size($obj->get_file_size($uniref90DomainNodeFilesZip));
$fastaFilesUniProtZip = $obj->get_fasta_files_zip_web_path(colorssn::SEQ_NO_DOMAIN, colorssn::SEQ_UNIPROT);
$fastaFilesUniProtZipSize = format_file_size($obj->get_file_size($fastaFilesUniProtZip));
$fastaFilesUniProtDomainZip = $obj->get_fasta_files_zip_web_path(colorssn::SEQ_DOMAIN, colorssn::SEQ_UNIPROT);
$fastaFilesUniProtDomainZipSize = format_file_size($obj->get_file_size($fastaFilesUniProtDomainZip));
$fastaFilesUniRef90Zip = $obj->get_fasta_files_zip_web_path(colorssn::SEQ_NO_DOMAIN, colorssn::SEQ_UNIREF90);
$fastaFilesUniRef90ZipSize = format_file_size($obj->get_file_size($fastaFilesUniRef90Zip));
$fastaFilesUniRef90DomainZip = $obj->get_fasta_files_zip_web_path(colorssn::SEQ_DOMAIN, colorssn::SEQ_UNIREF90);
$fastaFilesUniRef90DomainZipSize = format_file_size($obj->get_file_size($fastaFilesUniRef90DomainZip));
$fastaFilesUniRef50Zip = $obj->get_fasta_files_zip_web_path(colorssn::SEQ_NO_DOMAIN, colorssn::SEQ_UNIREF50);
$fastaFilesUniRef50ZipSize = format_file_size($obj->get_file_size($fastaFilesUniRef50Zip));
$fastaFilesUniRef50DomainZip = $obj->get_fasta_files_zip_web_path(colorssn::SEQ_DOMAIN, colorssn::SEQ_UNIREF50);
$fastaFilesUniRef50DomainZipSize = format_file_size($obj->get_file_size($fastaFilesUniRef50DomainZip));
$tableFile = $obj->get_table_file_web_path();
$tableFileSize = format_file_size($obj->get_file_size($tableFile));
$tableFileDomain = $obj->get_table_file_web_path(true); // true = for domain file
$tableFileDomainSize = format_file_size($obj->get_file_size($tableFileDomain));
$statsFile = $obj->get_stats_web_path();
$statsFileSize = format_file_size($obj->get_file_size($statsFile));
$clusterSizesFile = $obj->get_cluster_sizes_web_path();
$clusterSizesFileSize = format_file_size($obj->get_file_size($clusterSizesFile));
$swissprotClustersDescFile = $obj->get_swissprot_desc_web_path($want_clusters_file);
$swissprotClustersDescFileSize = format_file_size($obj->get_file_size($swissprotClustersDescFile));
$swissprotSinglesDescFile = $obj->get_swissprot_desc_web_path($want_singles_file);
$swissprotSinglesDescFileSize = format_file_size($obj->get_file_size($swissprotSinglesDescFile));

$uniprotText = ($fastaFilesUniRef90ZipSize || $fastaFilesUniRef50ZipSize) ? "UniProt" : "";


$hmm_graphics = "";
$weblogo_graphics = "";
$lenhist_graphics = "";
$alignment_list = "";
$cr_list = "";
$logo_graphics_dir = "";
$num_map = "";
$hmmZipFileList = array();
if ($obj->is_hmm_and_stuff_job()) {
    $zipFile = $obj->get_hmm_zip_web_path("Full");
    if ($zipFile) {
        $zipFileSize = format_file_size($obj->get_file_size($zipFile));
        array_push($hmmZipFileList, array("path" => $zipFile, "size" => $zipFileSize, "text" => "HMMs for FASTA $uniprotText cluster (full length sequences)"));
    }
    $zipFile = $obj->get_hmm_zip_web_path("Domain");
    if ($zipFile) {
        $zipFileSize = format_file_size($obj->get_file_size($zipFile));
        array_push($hmmZipFileList, array("path" => $zipFile, "size" => $zipFileSize, "text" => "HMMs for FASTA $uniprotText cluster (domain sequences)"));
    }
    
    $weblogoZipFileList = array();
    $zipFile = $obj->get_weblogo_zip_web_path("Full");
    if ($zipFile) {
        $zipFileSize = format_file_size($obj->get_file_size($zipFile));
        array_push($weblogoZipFileList, array("path" => $zipFile, "size" => $zipFileSize, "text" => "WebLogos for FASTA $uniprotText cluster (full length sequences)"));
    }
    $zipFile = $obj->get_weblogo_zip_web_path("Domain");
    if ($zipFile) {
        $zipFileSize = format_file_size($obj->get_file_size($zipFile));
        array_push($weblogoZipFileList, array("path" => $zipFile, "size" => $zipFileSize, "text" => "WebLogos for FASTA $uniprotText cluster (domain sequences)"));
    }
    
    $msaZipFileList = array();
    $zipFile = $obj->get_msa_zip_web_path("Full");
    if ($zipFile) {
        $zipFileSize = format_file_size($obj->get_file_size($zipFile));
        array_push($msaZipFileList, array("path" => $zipFile, "size" => $zipFileSize, "text" => "MSAs for FASTA $uniprotText cluster (full length sequences)"));
    }
    $zipFile = $obj->get_msa_zip_web_path("Domain");
    if ($zipFile) {
        $zipFileSize = format_file_size($obj->get_file_size($zipFile));
        array_push($msaZipFileList, array("path" => $zipFile, "size" => $zipFileSize, "text" => "MSAs for FASTA $uniprotText cluster (domain sequences)"));
    }
    
    $lenHistZipFileList = array();
    $zipFile = $obj->get_lenhist_zip_web_path("Full", "UniProt");
    if ($zipFile) {
        $zipFileSize = format_file_size($obj->get_file_size($zipFile));
        array_push($lenHistZipFileList, array("path" => $zipFile, "size" => $zipFileSize, "text" => "Length Histograms for FASTA $uniprotText cluster (full length sequences, UniProt)"));
    }
    $zipFile = $obj->get_lenhist_zip_web_path("Full", "UniRef90");
    if ($zipFile) {
        $zipFileSize = format_file_size($obj->get_file_size($zipFile));
        array_push($lenHistZipFileList, array("path" => $zipFile, "size" => $zipFileSize, "text" => "Length Histograms for FASTA $uniprotText cluster (full length sequences, UniRef90)"));
    }
    $zipFile = $obj->get_lenhist_zip_web_path("Full", "UniRef50");
    if ($zipFile) {
        $zipFileSize = format_file_size($obj->get_file_size($zipFile));
        array_push($lenHistZipFileList, array("path" => $zipFile, "size" => $zipFileSize, "text" => "Length Histograms for FASTA $uniprotText cluster (full length sequences, UniRef50)"));
    }
    $zipFile = $obj->get_lenhist_zip_web_path("Domain", "UniProt");
    if ($zipFile) {
        $zipFileSize = format_file_size($obj->get_file_size($zipFile));
        array_push($lenHistZipFileList, array("path" => $zipFile, "size" => $zipFileSize, "text" => "Length Histograms for FASTA $uniprotText cluster (domain sequences, UniProt)"));
    }
    $zipFile = $obj->get_lenhist_zip_web_path("Domain", "UniRef90");
    if ($zipFile) {
        $zipFileSize = format_file_size($obj->get_file_size($zipFile));
        array_push($lenHistZipFileList, array("path" => $zipFile, "size" => $zipFileSize, "text" => "Length Histograms for FASTA $uniprotText cluster (domain sequences, UniRef90)"));
    }
    $zipFile = $obj->get_lenhist_zip_web_path("Domain", "UniRef50");
    if ($zipFile) {
        $zipFileSize = format_file_size($obj->get_file_size($zipFile));
        array_push($lenHistZipFileList, array("path" => $zipFile, "size" => $zipFileSize, "text" => "Length Histograms for FASTA $uniprotText cluster (domain sequences, UniRef50)"));
    }
    $hmm_graphics = $obj->get_hmm_graphics();
    $weblogo_graphics = $obj->get_weblogo_graphics();
    $lenhist_graphics = $obj->get_lenhist_graphics();
    $alignment_list = $obj->get_alignment_list();
    $cr_list = $obj->get_cr_results_list();
    $logo_graphics_dir = $obj->get_graphics_dir();
    $num_map = $obj->get_cluster_num_map();
}

$fileInfo = array();
array_push($fileInfo, array("Mapping Tables"));
array_push($fileInfo, array("UniProt ID-Color-Cluster number mapping table", $tableFile, $tableFileSize));
if ($tableFileDomain)
    array_push($fileInfo, array("UniProt ID-Color-Cluster number mapping table (with domain)", $tableFileDomain, $tableFileDomainSize));

array_push($fileInfo, array("ID Lists and FASTA Files per Cluster"));
if ($uniprotNodeFilesZip)
    array_push($fileInfo, array("UniProt ID lists per cluster", $uniprotNodeFilesZip, $uniprotNodeFilesZipSize));
if ($uniprotDomainNodeFilesZip)
    array_push($fileInfo, array("UniProt ID lists per cluster (with domain)", $uniprotDomainNodeFilesZip, $uniprotDomainNodeFilesZipSize));
if ($uniref90NodeFilesZip)
    array_push($fileInfo, array("UniRef90 ID lists per cluster", $uniref90NodeFilesZip, $uniref90NodeFilesZipSize));
if ($uniref90DomainNodeFilesZip)
    array_push($fileInfo, array("UniRef90 ID lists per cluster (with domain)", $uniref90DomainNodeFilesZip, $uniref90DomainNodeFilesZipSize));
if ($uniref50NodeFilesZip)
    array_push($fileInfo, array("UniRef50 ID lists per cluster", $uniref50NodeFilesZip, $uniref50NodeFilesZipSize));
if ($uniref50DomainNodeFilesZip)
    array_push($fileInfo, array("UniRef50 ID lists per cluster (with domain)", $uniref50DomainNodeFilesZip, $uniref50DomainNodeFilesZipSize));

array_push($fileInfo, array("FASTA files per $uniprotText cluster", $fastaFilesUniProtZip, $fastaFilesUniProtZipSize));
if ($fastaFilesUniProtDomainZip)
    array_push($fileInfo, array("FASTA files per $uniprotText cluster (with domain)", $fastaFilesUniProtDomainZip, $fastaFilesUniProtDomainZipSize));
if ($fastaFilesUniRef90Zip)
    array_push($fileInfo, array("FASTA files per UniRef90 cluster", $fastaFilesUniRef90Zip, $fastaFilesUniRef90ZipSize));
if ($fastaFilesUniRef90DomainZip)
    array_push($fileInfo, array("FASTA files per UniRef90 cluster (with domain)", $fastaFilesUniRef90DomainZip, $fastaFilesUniRef90DomainZipSize));
if ($fastaFilesUniRef50Zip)
    array_push($fileInfo, array("FASTA files per UniRef50 cluster", $fastaFilesUniRef50Zip, $fastaFilesUniRef50ZipSize));
if ($fastaFilesUniRef50DomainZip)
    array_push($fileInfo, array("FASTA files per UniRef50 cluster (with domain)", $fastaFilesUniRef50DomainZip, $fastaFilesUniRef50DomainZipSize));

array_push($fileInfo, array("Miscellaneous Files"));
if ($clusterSizesFile)
    array_push($fileInfo, array("Cluster sizes", $clusterSizesFile, $clusterSizesFileSize));
if ($swissprotClustersDescFile)
    array_push($fileInfo, array("SwissProt annotations by cluster", $swissprotClustersDescFile, $swissprotClustersDescFileSize));
if ($swissprotSinglesDescFile)
    array_push($fileInfo, array("SwissProt annotations by singletons", $swissprotSinglesDescFile, $swissprotSinglesDescFileSize));


require_once("inc/header.inc.php");

?>	

<h2>Download Colored SSN Files</h2>

<h3>Uploaded Filename: <?php echo $job_name; ?></h3>

<div>
    <p>
    The <b>Data File Download</b> tab provides the Color SSN along with folders with lists of IDs and 
    FASTA sequences for all clusters in the SSN. 
    </p>

    <p>
    The <b>WebLogos</b> tab provides the WebLogo and MSA for the node IDs in each cluster containing 
    greater than the specified "Minimum Node Count".   The MSA can be viewed with Jalview
    (<a href="https://www.jalview.org/">https://www.jalview.org/</a>).
    </p>

    <p>
    The <b>Consensus Residues</b> tab provides a tab-delimited text file with the number of the 
    conserved residues and their MSA positions for each specified residue in each cluster 
    containing greater than the specified "Minimum Node Count". 
    </p>

    <p>
    The <b>HMMs</b> tab provides the HMM for each cluster containing greater than the specified 
    "Minimum Node Count".   The Skylign download provides the Skylign image
    (<a href="https://skylign.org/">https://skylign.org/</a>)
    of the HMM.  The HMM text file can be viewed interactively by clicking on the Skylign
    link, or viewed on <a href="https://skylign.org/">https://skylign.org/</a>.
    </p>

    <p>
    The <b>Length Histograms</b> tab provides length histograms for each cluster containing greater 
    than the specified "Minimum Node Count".
    </p>

    <p>
    The SSN clusters are numbered using two conventions:  Sequence Cluster numbers are assigned 
    in order of decreasing number of UniProt IDs in the cluster; Node Cluster numbers are 
    assigned in order of decreasing number of nodes in the cluster.  Cytoscape arranges 
    clusters (top to bottom, left to right) in order of decreasing number of nodes.
    </p>

    <p>
    If the input SSN was generated using the "domain" option, the tabs include information for 
    the domains as well as the full-length sequences in the node IDs.
    </p>
</div>


<div class="tabs-efihdr tabs">
    <ul class="">
        <li class="ui-tabs-active"><a href="#info">Submission Summary</a></li>
        <li><a href="#data">Data File Download</a></li>
<?php if ($weblogo_graphics) { ?>
        <li><a href="#weblogo">WebLogos</a></li>
<?php } ?>
<?php if ($cr_list) { ?>
        <li><a href="#crinfo">Consensus Residues</a></li>
<?php } ?>
<?php if ($hmm_graphics) { ?>
        <li><a href="#hmm">HMMs</a></li>
<?php } ?>
<?php if ($lenhist_graphics) { ?>
        <li><a href="#lenhist">Length Histograms</a></li>
<?php } ?>
    </ul>
    <div>
        <!-- JOB INFORMATION -->
        <div id="info">
            <h4>Submission Summary Table</h4>
            <table width="100%" class="pretty no-stretch">
            <?php echo $table_string ?>
            </table>
            <div style="float:right"><a href='<?php echo $_SERVER['PHP_SELF'] . "?id=$est_id&key=$key&as-table=1$ex_param" ?>'><button class='normal'>Download Information</button></a></div>
            <div style="clear:both;margin-bottom:20px"></div>
        </div>
        <div id="data">
            <h4>Colored SSN</h4>
            <p>Each cluster in the submitted SSN has been identified and assigned a unique number and color.</p>

            <table width="100%" class="pretty">
                <thead>
                    <th></th>
                    <th>File Size (<?php echo $is_example ? "Zipped MB" : "Unzipped/Zipped MB"; ?>)</th>
                </thead>
                <tbody>
                    <tr style='text-align:center;'>
                        <td class="button-col">
<?php if (!$is_example) { ?>
                            <a href="<?php echo "$ssnFile"; ?>"><button class="mini">Download</button></a>
<?php } ?>
                            <a href="<?php echo "$ssnFileZip"; ?>"><button class="mini">Download ZIP</button></a>
                        </td>
                        <td>
                            <?php echo $is_example ? "$ssnFileZipSize MB" : "$ssnFileSize MB / $ssnFileZipSize MB"; ?>
                        </td>
                    </tr>
                </tbody>
            </table>


            <h4>Supplementary Files</h4>
            <table width="100%" class="pretty no-border">
<?php
                    $first = true;
                    foreach ($fileInfo as $info) {
                        if (count($info) == 1) {
                            if (!$first)
                                echo "                </tbody>\n";
                            $first = false;
                            echo <<<HTML
                <tbody>
                    <tr style="text-align:center;">
                        <td colspan="3" class="file-header-row">
                            $info[0]
                        </td>
                    </tr>
                </tbody>
                <tbody class="file-group">

HTML;
                        } else {
                            echo <<<HTML
                    <tr style="text-align:center;">

HTML;
                            if (is_array($info[1])) {
                                $f1 = $info[1][0];
                                $f2 = $info[1][1];
                                echo <<<HTML
                        <td>
                            <a href="$f1"><button class='mini'>Download</button></a>
                            <a href="$f2"><button class='mini'>Download (ZIP)</button></a>
                        </td>

HTML;
                            } else {
                                $text = substr($info[1], -4) == ".zip" ? "Download All (ZIP)" : "Download";
                                echo <<<HTML
                        <td><a href="$info[1]"><button class='mini'>$text</button></a></td>

HTML;
                            }
                            echo <<<HTML
                        <td>$info[0]</td>
                        <td>$info[2] MB</td>
                    </tr>

HTML;
                        }
                    }
                ?>
                </tbody>
            </table>

            <center>
                <a href="../efi-cgfp/index.php?<?php echo "est-id=$est_id&est-key=$key"; ?>"><button type="button" name="analyze_data" class="dark white">Run CGFP on Colored SSN</button></a>
            </center>
            
        </div>
<?php if ($weblogo_graphics) { ?>
        <div id="weblogo">
            <h4>WebLogos</h4>
            <p>
            If the WebLogo is missing for Node Cluster 1 (and additional clusters with large numbers of nodes),
            repeat the job with a "Maximum Node Count" in the Sequence Filter input window.  MUSCLE can fail
            with a "large" number of sequences (variable, anywhere from &gt;750 to &gt;1500).
            </p>
<?php outputZipFileTable($weblogoZipFileList); ?>
<?php outputZipFileTable($msaZipFileList); ?>
            <br><br>
<?php
                    $weblogo_output_fn = function($cluster_num, $data, $info = "", $type = "", $quality = "") use ($logo_graphics_dir, $est_id, $key, $alignment_list) {
                        $file = $data["path"];
                        $size_info = getClusterSizeInfo($data);
                        $class = $type ? "weblogo-$type-$quality" : "";
                        /*
                        $extra = <<<HTML
(<a href="$logo_graphics_dir/$file.afa">Download alignment FASTA</a>)
HTML;
                         */
                        $extra = "";
                        $type_html = $type ? '<div><b>'.ucfirst($type).' Sequences</b></div>' : "";
                        if (isset($alignment_list[$cluster_num][$type][$quality])) {
                            $afa_file = $alignment_list[$cluster_num][$type][$quality]["path"];
                            $extra = <<<HTML
<a href="save_logo.php?id=$est_id&key=$key&logo=$cluster_num-$type-$quality&f=png&t=afa">MSA <i class="fas fa-download"></i></a>
HTML;
                        }
                        return <<<HTML
<div class="$class " style="margin-bottom: 20px">
$type_html
<div class="cluster-size">$size_info</div>
<div>
<span style="margin-right: 20px">$extra</span>
<a href="save_logo.php?id=$est_id&key=$key&logo=$cluster_num-$type-$quality&f=png&t=w">PNG <i class="fas fa-download"></i></a>
</div>
<div style="clear: both">
<a href="$logo_graphics_dir/$file.png"><img src="$logo_graphics_dir/$file.png" width="50%" alt="Cluster $cluster_num" data-logo="$cluster_num-$type-$quality"></a>
</div>
</div>\n
HTML;
                    };

                    $weblogo_cb_id_list = output_graphics_html("Show WebLogos:", "weblogo", $weblogo_graphics, $num_map, $weblogo_output_fn);
?>
        </div>
<?php } ?>
<?php if ($cr_list) { ?> 
        <div id="crinfo">
            <h4>Consensus Residues</h4>
            
            <table width="100%" class="pretty no-border">
<?php
                    foreach ($cr_list as $aa => $seq_types) {
                        echo <<<HTML
                <tbody>
                    <tr style="text-align:center;">
                        <td colspan="3" class="file-header-row">
                            $aa
                        </td>
                    </tr>
                </tbody>
                <tbody class="file-group">
HTML;
                        foreach ($seq_types as $seq_type => $file_list) {
                            foreach ($file_list as $file_type => $info) {
                                $path = $info["path"];
                                $size_text = "&lt;1 MB";
                                $dl_btn_text = "Download";
                                //if ($file_type == "zip") {
                                //    $info_text = "ID lists grouped by consensus residue percentage and number of residues in cluster ($seq_type)";
                                //    $dl_btn_text = "Download All (ZIP)";
                                //}
                                //elseif ($file_type == "position") {
                                if ($file_type == "position") {
                                    $info_text = "Consensus residue position summary table ($seq_type)";
                                } else {
                                    continue;
                                }
                                //elseif ($file_type == "percentage") {
                                //    $info_text = "Consensus residue percentage summary table ($seq_type)";
                                //}
                                $dl_path = "$logo_graphics_dir/$path";
                                echo <<<HTML
                    <tr style="text-align:center;">
                        <td><a href="$dl_path"><button class='mini'>$dl_btn_text</button></a></td>
                        <td>$info_text</td>
                        <td>$size_text</td>
                    </tr>
HTML;
                            }
                        }
                        echo <<<HTML
                </tbody>
HTML;
                    }
?>
            </table>
        </div>
<?php } ?>
<?php if ($hmm_graphics) { ?>
        <div id="hmm">
            <h4>HMMs</h4>
            <p>
            If the HMM is missing for Node Cluster 1 (and additional clusters with large numbers of nodes),
            repeat the job with a "Maximum Node Count" in the Sequence Filter input window.  MUSCLE can fail
            with a "large" number of sequences (variable, anywhere from &gt;750 to &gt;1500).
            </p>
<?php outputZipFileTable($hmmZipFileList); ?>
            <br><br>

<?php
                    $output_fn = function($cluster_num, $data, $info = "", $type = "", $quality = "") use ($logo_graphics_dir, $est_id, $key) {
                        $file = $data["path"];
                        if (isset($data["length"]))
                            $info .= ", length=" . $data["length"];
                        $size_info = getClusterSizeInfo($data);
                        $class = $type ? "hmm-$type-$quality" : "";
                        $type_html = $type ? '<div><b>'.ucfirst($type).' Sequences</b></div>' : "";
                        return <<<HTML
<div class="$class " style="margin-bottom: 20px">
$type_html
<div class="cluster-size">$size_info</div>
<div>
<span style="margin-right: 20px"><a class="hmm-logo" data-logo="$cluster_num-$type-$quality">Skylign <i class="fas fa-eye"></i></a></span>
<span style="margin-right: 20px"><a href="save_logo.php?id=$est_id&key=$key&logo=$cluster_num-$type-$quality&t=hmm">HMM <i class="fas fa-download"></i></a></span>
<a href="save_logo.php?id=$est_id&key=$key&logo=$cluster_num-$type-$quality&t=hmm-png">PNG <i class="fas fa-download"></i></a>
</div>
<div>
<img src="$logo_graphics_dir/$file.png" width="100%" alt="Cluster $cluster_num">
</div>
</div>\n
HTML;
                    };

                    $hmm_cb_id_list = output_graphics_html("Show HMMs:", "hmm", $hmm_graphics, $num_map, $output_fn);
?>
        </div>
<?php } ?>
<?php if ($lenhist_graphics) { ?>
        <div id="lenhist">
            <h4>Length Histograms</h4>
<?php outputZipFileTable($lenHistZipFileList); ?>
            <br><br>
<?php
                    $lenhist_output_fn = function($cluster_num, $data, $info = "", $type = "", $quality = "") use ($logo_graphics_dir, $est_id, $key) {
                        $file = $data["path"];
                        $size_info = getClusterSizeInfo($data);
                        $class = $type ? "lenhist-$type-$quality" : "";
                        $type_html = $type ? '<div><b>'.ucfirst($type).' Sequences</b></div>' : "";
                        return <<<HTML
<div class="$class " style="float: left; width: 50%; margin-bottom: 20px">
$type_html
<div class="cluster-size">$size_info</div>
<div><a href="save_logo.php?id=$est_id&key=$key&logo=$cluster_num-$type-$quality&f=png&t=l">PNG <i class="fas fa-download"></i></a></div>
<div>
<a href="$logo_graphics_dir/$file.png"><img src="$logo_graphics_dir/$file.png" width="100%" alt="Cluster $cluster_num" data-logo="$cluster_num-$type-$quality"></a>
</div>
</div>
HTML;
                    };

                    $lenhist_cb_id_list = output_graphics_html("Show Length Histograms:", "lenhist", $lenhist_graphics, $num_map, $lenhist_output_fn);
?>
            <div style="clear: both"></div>
        </div>
<?php } ?>
    </div>
</div>
   
<script src="js/progress.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
    $(".tabs").tabs();

<?php
    //if ($weblogo_graphics) {
    //    output_graphics_js($weblogo_cb_id_list, "weblogo");
    //}
    //if ($lenhist_graphics) {
    //    output_graphics_js($lenhist_cb_id_list, "lenhist");
    //}
    if ($hmm_graphics) {
    //    output_graphics_js($hmm_cb_id_list, "hmm");
?>
    var progress = new Progress($("#progressLoader"));
    progress.start();
    $(".hmm-logo").click(function(evt) {
        var parm = $(this).data("logo");
        var windowSize = ["width=1500,height=600"];
        var url = "view_logo.php?<?php echo "id=$est_id&key=$key"; ?>" + "&logo=" + parm;
        var theWindow = window.open(url, "", windowSize);
        evt.preventDefault();
    });
    $(window)
        .on("load", function() { progress.stop(); })
        .on("error", function() { progress.stop(); });
    setTimeout(function() { progress.stop(); }, 4000);
<?php
    }
?>
});
</script>

<div id="progressLoader" class="progress-loader" style="display: none">
    <i class="fas fa-spinner fa-spin"></i>
    <div>Loading...</div>
</div>

<?php
require_once("inc/footer.inc.php");


function format_file_size($size) {
    $mb = round($size, 0);
    if ($mb == 0)
        return "&lt;1";
    return $mb;
}


function output_graphics_js($cb_id_list, $prefix) {
    foreach ($cb_id_list as $cb_id) {
        echo <<<HTML
    $("#$prefix-$cb_id").click(function() {
        if (this.checked) {
            $(".$prefix-$cb_id").show();
            $(".$prefix-cluster-heading").show();
        } else {
            $(".$prefix-$cb_id").hide();
        }
    });
HTML;
    }
}


function output_graphics_html($header, $prefix, $graphics, $num_map, $output_fn) {
    $cb_types = array();

    $clusters = array_keys($graphics);
    //sort($clusters);

    $html = "";
    for ($i = 0; $i < count($clusters); $i++) {
        $cluster = $clusters[$i];
        $num = isset($num_map[$cluster]) ? $num_map[$cluster] : 0;
        $num_html = "Sequence Cluster $cluster" . ($num ? " / Node Cluster $num" : "");
        $html .= "<div style=\"clear:both\">\n";
        $html .= "<h4 class=\"$prefix-cluster-heading \" style=\"margin-top: 30px\">$num_html</h4>\n";
        $html .= "</div>\n";
        $html .= "<div>\n";
        foreach ($graphics[$cluster] as $seq_type => $group_data) {
            foreach ($group_data as $quality => $data) {
                //$seq_info = "$seq_type, <b>$quality</b>";
                $seq_info = "";
                $html .= $output_fn($cluster, $data, $seq_info, $seq_type, $quality);
                $cb_types[$seq_type][$quality] = 1;
            }
        }
        $html .= "</div>\n";
    }

    $cb_id_list = array();
    //$html2 = "$header<br>\n";
    //foreach ($cb_types as $seq_type => $qdata) {
    //    foreach ($qdata as $quality => $junk) {
    //        $dash_type = $seq_type . "-" . $quality;
    //        $comma_type = $seq_type . ", " . $quality;
    //        $html2 .= "<input type=\"checkbox\" id=\"$prefix-$dash_type\" name=\"sel-hmm\" value=\"$dash_type\"><label for=\"$prefix-$dash_type\">$comma_type</label>" . PHP_EOL;
    //        array_push($cb_id_list, $dash_type);
    //    }
    //    $html2 .= "<br>\n";
    //}
    //$html2 .= "<br><br><br>";
    //echo $html2;

    echo $html;

    return $cb_id_list;
}

function outputZipFileTable($zipList) {
    echo <<<HTML
            <table width="100%" class="pretty no-border">
                <tbody class="file-group">
HTML;
    foreach ($zipList as $index => $zipData) {
        $path = $zipData["path"];
        $text = $zipData["text"];
        $size = $zipData["size"];
        echo <<<HTML
                    <tr style="text-align:center;">
                        <td><a href="$path"><button class='mini'>Download All (ZIP)</button></a></td>
                        <td>$text</td>
                        <td>$size MB</td>
                    </tr>
HTML;
    }
    echo <<<HTML
                </tbody>
            </table>
HTML;
}

function getClusterSizeInfo($data) {
    $info = array();
    if (isset($data["num_uniprot"]) && $data["num_uniprot"])
        array_push($info, "UniProt: " . number_format($data["num_uniprot"]));
    if (isset($data["num_uniref90"]) && $data["num_uniref90"])
        array_push($info, "UniRef90: " . number_format($data["num_uniref90"]));
    if (isset($data["num_uniref50"]) && $data["num_uniref50"])
        array_push($info, "UniRef50: " . number_format($data["num_uniref50"]));
    return "Number of IDs: " . implode(", ", $info);
}

?>

