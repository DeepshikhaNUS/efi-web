<?php

$colors = array();
#$colors = array("#1B386A","#2A4563","#415958","#506651","#677A46","#76873F","#8D9B35","#9CA92E","#B3BC23","#C2CA1C","#D9DD11","#E8EB0A","#FFFF00","#FFF801","#FFEB04","#FFD709","#FFCA0C","#FFB611","#FFA914","#FF9519","#FF871D","#FF7421","#FF6625","#FF5329","#FF452D","#FF3232","#FF3035","#FF2E3B","#FF2A45","#FF274B","#FF2355","#FF215B","#FF1D65","#FF1A6C","#FF1675","#FF147C","#FF1085","#FF0D8C","#FF0A96");
#$colors = array("#14326E","#1B386A","#223E67","#294464","#304A60","#37515D","#3E575A","#455D56","#4C6353","#546950","#5B704C","#627649","#697C46","#708242","#77883F","#7E8F3C","#859538","#8D9B35","#94A132","#9BA82E","#A2AE2B","#A9B428","#B0BA24","#B7C021","#BEC71E","#C6CD1A","#CDD317","#D4D914","#DBDF10","#E2E60D","#E9EC0A","#F0F206","#F7F803","#FFFF00","#FFFF00","#FFF801","#FFF203","#FFEC04","#FFE606","#FFDF07","#FFD909","#FFD30A","#FFCD0C","#FFC70D","#FFC00F","#FFBA10","#FFB412","#FFAE13","#FFA815","#FF9B18","#FF9519","#FF8F1B","#FF881C","#FF821E","#FF7C1F","#FF7621","#FF7022","#FF6924","#FF6325","#FF5D27","#FF5728","#FF512A","#FF4A2B","#FF442D","#FF3E2E","#FF3830","#FF3232","#FF3232","#FF3035","#FF2F38","#FF2E3B","#FF2D3E","#FF2B41","#FF2A44","#FF2947","#FF284A","#FF274D","#FF2550","#FF2453","#FF2356","#FF2259","#FF215C","#FF1F5F","#FF1E62","#FF1D65","#FF1C68","#FF1A6B","#FF196E","#FF1871","#FF1774","#FF1677","#FF147A","#FF137D","#FF1280","#FF1183","#FF1086","#FF0E89","#FF0D8C","#FF0C8F","#FF0A96");
#$colors = array("#14326E","#14326D","#15336D","#16336D","#16346C","#17356C","#18356C","#18366B","#19366B","#1A376B","#1B386A","#1B386A","#1C396A","#1D3A69","#1D3A69","#1E3B69","#1F3B68","#1F3C68","#203D68","#213D67","#223E67","#223E67","#233F66","#244066","#244066","#254165","#264265","#274265","#274364","#284364","#294464","#294563","#2A4563","#2B4663","#2B4662","#2C4762","#2D4862","#2E4861","#2E4961","#2F4A61","#304A60","#304B60","#314B60","#324C5F","#334D5F","#334D5F","#344E5E","#354E5E","#354F5E","#36505D","#37505D","#37515D","#38525C","#39525C","#3A535C","#3A535B","#3B545B","#3C555B","#3C555A","#3D565A","#3E565A","#3F5759","#3F5859","#405859","#415958","#415A58","#425A58","#435B57","#435B57","#445C57","#455D56","#465D56","#465E56","#475E55","#485F55","#486055","#496054","#4A6154","#4B6254","#4B6253","#4C6353","#4D6353","#4D6452","#4E6552","#4F6552","#4F6651","#506651","#516751","#526850","#526850","#536950","#546A4F","#546A4F","#556B4F","#566B4E","#576C4E","#576D4E","#586D4D","#596E4D","#596E4D","#5A6F4C","#5B704C","#5B704C","#5C714B","#5D724B","#5E724B","#5E734A","#5F734A","#60744A","#607549","#617549","#627649","#637649","#637748","#647848","#657848","#657947","#667A47","#677A47","#677B46","#687B46","#697C46","#6A7D45","#6A7D45","#6B7E45","#6C7E44","#6C7F44","#6D8044","#6E8043","#6F8143","#6F8243","#708242","#718342","#718342","#728441","#738541","#738541","#748640","#758640","#768740","#76883F","#77883F","#78893F","#788A3E","#798A3E","#7A8B3E","#7B8B3D","#7B8C3D","#7C8D3D","#7D8D3C","#7D8E3C","#7E8E3C","#7F8F3B","#7F903B","#80903B","#81913A","#82923A","#82923A","#839339","#849339","#849439","#859538","#869538","#879638","#879637","#889737","#899837","#899836","#8A9936","#8B9A36","#8B9A35","#8C9B35","#8D9B35","#8E9C34","#8E9D34","#8F9D34","#909E33","#909E33","#919F33","#92A032","#93A032","#93A132","#94A231","#95A231","#95A331","#96A330","#97A430","#97A530","#98A52F","#99A62F","#9AA62F","#9AA72E","#9BA82E","#9CA82E","#9CA92D","#9DAA2D","#9EAA2D","#9FAB2C","#9FAB2C","#A0AC2C","#A1AD2B","#A1AD2B","#A2AE2B","#A3AE2A","#A3AF2A","#A4B02A","#A5B029","#A6B129","#A6B229","#A7B228","#A8B328","#A8B328","#A9B427","#AAB527","#ABB527","#ABB626","#ACB626","#ADB726","#ADB825","#AEB825","#AFB925","#AFBA24","#B0BA24","#B1BB24","#B2BB24","#B2BC23","#B3BD23","#B4BD23","#B4BE22","#B5BE22","#B6BF22","#B7C021","#B7C021","#B8C121","#B9C220","#B9C220","#BAC320","#BBC31F","#BBC41F","#BCC51F","#BDC51E","#BEC61E","#BEC61E","#BFC71D","#C0C81D","#C0C81D","#C1C91C","#C2CA1C","#C3CA1C","#C3CB1B","#C4CB1B","#C5CC1B","#C5CD1A","#C6CD1A","#C7CE1A","#C7CE19","#C8CF19","#C9D019","#CAD018","#CAD118","#CBD218","#CCD217","#CCD317","#CDD317","#CED416","#CFD516","#CFD516","#D0D615","#D1D615","#D1D715","#D2D814","#D3D814","#D3D914","#D4DA13","#D5DA13","#D6DB13","#D6DB12","#D7DC12","#D8DD12","#D8DD11","#D9DE11","#DADE11","#DBDF10","#DBE010","#DCE010","#DDE10F","#DDE20F","#DEE20F","#DFE30E","#DFE30E","#E0E40E","#E1E50D","#E2E50D","#E2E60D","#E3E60C","#E4E70C","#E4E80C","#E5E80B","#E6E90B","#E7EA0B","#E7EA0A","#E8EB0A","#E9EB0A","#E9EC09","#EAED09","#EBED09","#EBEE08","#ECEE08","#EDEF08","#EEF007","#EEF007","#EFF107","#F0F206","#F0F206","#F1F306","#F2F305","#F3F405","#F3F505","#F4F504","#F5F604","#F5F604","#F6F703","#F7F803","#F7F803","#F8F902","#F9FA02","#FAFA02","#FAFB01","#FBFB01","#FCFC01","#FCFD00","#FDFD00","#FEFE00","#FFFF00","#FFFF00","#FFFE00","#FFFD00","#FFFD00","#FFFC00","#FFFB00","#FFFB00","#FFFA01","#FFFA01","#FFF901","#FFF801","#FFF801","#FFF701","#FFF601","#FFF602","#FFF502","#FFF502","#FFF402","#FFF302","#FFF302","#FFF203","#FFF203","#FFF103","#FFF003","#FFF003","#FFEF03","#FFEE03","#FFEE04","#FFED04","#FFED04","#FFEC04","#FFEB04","#FFEB04","#FFEA04","#FFEA05","#FFE905","#FFE805","#FFE805","#FFE705","#FFE605","#FFE606","#FFE506","#FFE506","#FFE406","#FFE306","#FFE306","#FFE206","#FFE207","#FFE107","#FFE007","#FFE007","#FFDF07","#FFDE07","#FFDE07","#FFDD08","#FFDD08","#FFDC08","#FFDB08","#FFDB08","#FFDA08","#FFDA09","#FFD909","#FFD809","#FFD809","#FFD709","#FFD609","#FFD609","#FFD50A","#FFD50A","#FFD40A","#FFD30A","#FFD30A","#FFD20A","#FFD20A","#FFD10B","#FFD00B","#FFD00B","#FFCF0B","#FFCE0B","#FFCE0B","#FFCD0C","#FFCD0C","#FFCC0C","#FFCB0C","#FFCB0C","#FFCA0C","#FFCA0C","#FFC90D","#FFC80D","#FFC80D","#FFC70D","#FFC60D","#FFC60D","#FFC50D","#FFC50E","#FFC40E","#FFC30E","#FFC30E","#FFC20E","#FFC20E","#FFC10F","#FFC00F","#FFC00F","#FFBF0F","#FFBE0F","#FFBE0F","#FFBD0F","#FFBD10","#FFBC10","#FFBB10","#FFBB10","#FFBA10","#FFBA10","#FFB910","#FFB811","#FFB811","#FFB711","#FFB611","#FFB611","#FFB511","#FFB512","#FFB412","#FFB312","#FFB312","#FFB212","#FFB212","#FFB112","#FFB013","#FFB013","#FFAF13","#FFAE13","#FFAE13","#FFAD13","#FFAD13","#FFAC14","#FFAB14","#FFAB14","#FFAA14","#FFAA14","#FFA914","#FFA815","#FFA815","#FFA715","#FFA615","#FFA615","#FFA515","#FFA515","#FFA416","#FFA316","#FFA316","#FFA216","#FFA216","#FFA116","#FFA016","#FFA017","#FF9F17","#FF9E17","#FF9E17","#FF9D17","#FF9D17","#FF9C18","#FF9B18","#FF9B18","#FF9A18","#FF9A18","#FF9818","#FF9819","#FF9719","#FF9619","#FF9619","#FF9519","#FF9519","#FF9419","#FF931A","#FF931A","#FF921A","#FF921A","#FF911A","#FF901A","#FF901B","#FF8F1B","#FF8E1B","#FF8E1B","#FF8D1B","#FF8D1B","#FF8C1B","#FF8B1C","#FF8B1C","#FF8A1C","#FF8A1C","#FF891C","#FF881C","#FF881C","#FF871D","#FF861D","#FF861D","#FF851D","#FF851D","#FF841D","#FF831E","#FF831E","#FF821E","#FF821E","#FF811E","#FF801E","#FF801E","#FF7F1F","#FF7E1F","#FF7E1F","#FF7D1F","#FF7D1F","#FF7C1F","#FF7B1F","#FF7B20","#FF7A20","#FF7A20","#FF7920","#FF7820","#FF7820","#FF7721","#FF7621","#FF7621","#FF7521","#FF7521","#FF7421","#FF7321","#FF7322","#FF7222","#FF7222","#FF7122","#FF7022","#FF7022","#FF6F22","#FF6E23","#FF6E23","#FF6D23","#FF6D23","#FF6C23","#FF6B23","#FF6B24","#FF6A24","#FF6A24","#FF6924","#FF6824","#FF6824","#FF6724","#FF6625","#FF6625","#FF6525","#FF6525","#FF6425","#FF6325","#FF6325","#FF6226","#FF6226","#FF6126","#FF6026","#FF6026","#FF5F26","#FF5E27","#FF5E27","#FF5D27","#FF5D27","#FF5C27","#FF5B27","#FF5B27","#FF5A28","#FF5A28","#FF5928","#FF5828","#FF5828","#FF5728","#FF5628","#FF5629","#FF5529","#FF5529","#FF5429","#FF5329","#FF5329","#FF522A","#FF522A","#FF512A","#FF502A","#FF502A","#FF4F2A","#FF4E2A","#FF4E2B","#FF4D2B","#FF4D2B","#FF4C2B","#FF4B2B","#FF4B2B","#FF4A2B","#FF4A2C","#FF492C","#FF482C","#FF482C","#FF472C","#FF462C","#FF462D","#FF452D","#FF452D","#FF442D","#FF432D","#FF432D","#FF422D","#FF422E","#FF412E","#FF402E","#FF402E","#FF3F2E","#FF3E2E","#FF3E2E","#FF3D2F","#FF3D2F","#FF3C2F","#FF3B2F","#FF3B2F","#FF3A2F","#FF3A30","#FF3930","#FF3830","#FF3830","#FF3730","#FF3630","#FF3630","#FF3531","#FF3531","#FF3431","#FF3331","#FF3331","#FF3231","#FF3232","#FF3232","#FF3132","#FF3132","#FF3132","#FF3133","#FF3133","#FF3133","#FF3134","#FF3134","#FF3034","#FF3035","#FF3035","#FF3035","#FF3035","#FF3036","#FF3036","#FF3036","#FF2F37","#FF2F37","#FF2F37","#FF2F38","#FF2F38","#FF2F38","#FF2F38","#FF2F39","#FF2E39","#FF2E39","#FF2E3A","#FF2E3A","#FF2E3A","#FF2E3B","#FF2E3B","#FF2E3B","#FF2E3B","#FF2D3C","#FF2D3C","#FF2D3C","#FF2D3D","#FF2D3D","#FF2D3D","#FF2D3E","#FF2D3E","#FF2C3E","#FF2C3E","#FF2C3F","#FF2C3F","#FF2C3F","#FF2C40","#FF2C40","#FF2C40","#FF2B41","#FF2B41","#FF2B41","#FF2B41","#FF2B42","#FF2B42","#FF2B42","#FF2B43","#FF2B43","#FF2A43","#FF2A44","#FF2A44","#FF2A44","#FF2A44","#FF2A45","#FF2A45","#FF2A45","#FF2946","#FF2946","#FF2946","#FF2947","#FF2947","#FF2947","#FF2947","#FF2948","#FF2848","#FF2848","#FF2849","#FF2849","#FF2849","#FF284A","#FF284A","#FF284A","#FF284A","#FF274B","#FF274B","#FF274B","#FF274C","#FF274C","#FF274C","#FF274D","#FF274D","#FF264D","#FF264D","#FF264E","#FF264E","#FF264E","#FF264F","#FF264F","#FF264F","#FF2550","#FF2550","#FF2550","#FF2550","#FF2551","#FF2551","#FF2551","#FF2552","#FF2552","#FF2452","#FF2453","#FF2453","#FF2453","#FF2453","#FF2454","#FF2454","#FF2454","#FF2355","#FF2355","#FF2355","#FF2356","#FF2356","#FF2356","#FF2356","#FF2357","#FF2257","#FF2257","#FF2258","#FF2258","#FF2258","#FF2259","#FF2259","#FF2259","#FF2259","#FF215A","#FF215A","#FF215A","#FF215B","#FF215B","#FF215B","#FF215C","#FF215C","#FF205C","#FF205C","#FF205D","#FF205D","#FF205D","#FF205E","#FF205E","#FF205E","#FF1F5F","#FF1F5F","#FF1F5F","#FF1F5F","#FF1F60","#FF1F60","#FF1F60","#FF1F61","#FF1F61","#FF1E61","#FF1E62","#FF1E62","#FF1E62","#FF1E62","#FF1E63","#FF1E63","#FF1E63","#FF1D64","#FF1D64","#FF1D64","#FF1D65","#FF1D65","#FF1D65","#FF1D65","#FF1D66","#FF1C66","#FF1C66","#FF1C67","#FF1C67","#FF1C67","#FF1C68","#FF1C68","#FF1C68","#FF1C68","#FF1B69","#FF1B69","#FF1B69","#FF1B6A","#FF1B6A","#FF1B6A","#FF1B6B","#FF1B6B","#FF1A6B","#FF1A6B","#FF1A6C","#FF1A6C","#FF1A6C","#FF1A6D","#FF1A6D","#FF1A6D","#FF196E","#FF196E","#FF196E","#FF196E","#FF196F","#FF196F","#FF196F","#FF1970","#FF1970","#FF1870","#FF1871","#FF1871","#FF1871","#FF1871","#FF1872","#FF1872","#FF1872","#FF1773","#FF1773","#FF1773","#FF1774","#FF1774","#FF1774","#FF1774","#FF1775","#FF1675","#FF1675","#FF1676","#FF1676","#FF1676","#FF1677","#FF1677","#FF1677","#FF1677","#FF1578","#FF1578","#FF1578","#FF1579","#FF1579","#FF1579","#FF157A","#FF157A","#FF147A","#FF147A","#FF147B","#FF147B","#FF147B","#FF147C","#FF147C","#FF147C","#FF137D","#FF137D","#FF137D","#FF137D","#FF137E","#FF137E","#FF137E","#FF137F","#FF137F","#FF127F","#FF1280","#FF1280","#FF1280","#FF1280","#FF1281","#FF1281","#FF1281","#FF1182","#FF1182","#FF1182","#FF1183","#FF1183","#FF1183","#FF1183","#FF1184","#FF1084","#FF1084","#FF1085","#FF1085","#FF1085","#FF1086","#FF1086","#FF1086","#FF1086","#FF0F87","#FF0F87","#FF0F87","#FF0F88","#FF0F88","#FF0F88","#FF0F89","#FF0F89","#FF0E89","#FF0E89","#FF0E8A","#FF0E8A","#FF0E8A","#FF0E8B","#FF0E8B","#FF0E8B","#FF0D8C","#FF0D8C","#FF0D8C","#FF0D8C","#FF0D8D","#FF0D8D","#FF0D8D","#FF0D8E","#FF0D8E","#FF0C8E","#FF0C8F","#FF0C8F","#FF0C8F","#FF0C8F","#FF0C90","#FF0C90","#FF0C90","#FF0B91","#FF0B91","#FF0B91","#FF0B92","#FF0B92","#FF0B92","#FF0B92","#FF0B93","#FF0A93","#FF0A93","#FF0A94","#FF0A94","#FF0A94","#FF0A95","#FF0A95","#FF0A96");


?>


<html>
<style>
.color {
width: 200px;
height: 50px;
}
</style>
<body>
<?php
if (false) {//!isset($_POST["colors"])) {
?>
<form action="" method="POST">
<textarea name="colors" rows="20" cols="80">
</textarea>
<br>
<button type="submit">Submit</button>
</form>
<?php
} else if (count($colors)) {
    for ($i = 0; $i < count($colors); $i++) {
        echo "<div class='color' style='background-color: ".$colors[$i]."'>".$i." ".$colors[$i]."</div>";
    }
} else {
    //    $colors = preg_split('/[\r\n]+/', $_POST["colors"]);
    $lines = file("/home/groups/efi/databases/support/colors.tab");
    for ($i = 0; $i < count($lines); $i++) {
        $parts = explode("\t", $lines[$i]);
        echo "<div class='color' style='background-color: $parts[1]'>$parts[0] $parts[1] </div>";
    }
}

?>
</body>
</html>
