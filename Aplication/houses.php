<?PHP
$allhouses = new OTS_HousesList($config['site']['server_path'].$config['site']['houseXML_file_subdir']);
$main_content .= '<center><h2>List of houses on '.$config['server']['serverName'].'</h2></center><TABLE BORDER=0 CELLSPACING=0 CELLPADDING=0 WIDTH=100%>';
$main_content .= '<tr bgcolor="'.$config['site']['vdarkborder'].'"><td><font color="white"><b>Name</b></font></td><td><font color="white"><b>Size</b></font></td><td><font color="white"><b>Rent</b></font></td><td><font color="white"><b>City</b></font></td><td><font color="white"><b>Owner</b></font></td></tr>';
$number_of_rows = 1;
foreach($allhouses as $house) {
if(is_int($number_of_rows / 2)) { $bgcolor = $config['site']['darkborder']; } else { $bgcolor = $config['site']['lightborder']; } $number_of_rows++;
$main_content .= '<tr bgcolor="'.$bgcolor.'"><td>'.$house->getName().'</td><td>'.$house->getSize().'</td><td>'.$house->getRent().'</td><td>'.$towns_list[$house->getTownId()].'</td><td>';
$owner = $house->getOwner();
if($owner != '') {
$owner_name = $owner->getName();
$main_content .= '<a href="index.php?subtopic=characters&name='.$owner_name.'">'.$owner_name.'</a>';
} else {
$main_content .= 'Empty';
}
$main_content .= '</td></tr>';
}
$main_content .= '</TABLE>';
?>