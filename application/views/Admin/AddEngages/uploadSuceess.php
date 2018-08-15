<?php
$filename = "./uploads/".$upload_data["file_name"];
$data = simplexml_load_file($filename);

$daysdefs = $data->daysdefs;
$subjects = $data->subjects;
$lessons = $data->lessons;
$cards = $data->cards;
$teachers = $data->teachers;
$periods = $data->periods;
$classes = $data->classrooms;

$type  = "'class'";   
$this->db->delete("permanent_engages", "engage_type = ".$type);
$value = "'program_officer'";
$this->db->delete("classess", "added_by = ".$value);
$this->db->delete("busy_classes", "added_by = ".$value);

$classesParsed = array();
foreach ($classes->children() as $class) {
$classId= $class["id"];
$classesParsed["$classId"]["name"] = $class["name"];
$className = $class["name"];
$data = array(
   'class_id'=>"$classId",
   'class_name'=>"$className",
   'added_by'=>"program_officer");
    $this->db->set($data); 
    $this->db->insert("classess", $data);
}

$periodsParsed = array();
foreach ($periods->children() as $period) {
   $id = $period["period"];
   $periodsParsed["$id"]["starttime"] = $period["starttime"];
   $periodsParsed["$id"]["endtime"] = $period["endtime"];


}

$teachersParsed = array();
foreach ($teachers->children() as $teacher) {
   $id = $teacher["id"];
   $teachersParsed["$id"] = $teacher["mobile"];
}


$daysParsed = array();
foreach ($daysdefs->children() as $daysdef) {
   $id = $daysdef["days"];
   $daysParsed["$id"] = $daysdef["name"];
}

$subjectsParsed = array();
foreach ($subjects->children() as $subject) {
   $id = $subject["id"];
   $subjectsParsed["$id"] = $subject["name"];
}

foreach ($teachers->children() as $teacher) {

//$teacher["mobile"];
//$teacher["name"];
   if ($teacher["mobile"] != "") {
       $query = $this->db->query("SELECT * FROM users WHERE id = '".$teacher["mobile"]."'");
            if($query->num_rows() ==0){
                  $data = array(
                     'id'=>$teacher["mobile"],
                     'password'=>$teacher["mobile"],
                     'name'=>$teacher["name"]);
                     $this->db->set($data); 
            $this->db->insert("users", $data);
            }
   }
}


$lessonsForTeachers = array();
$lessonsForSubjects = array();
foreach ($lessons->children() as $lesson) {
   $id = $lesson["id"];
   $teacherId = $lesson["teacherids"];
   if ($teacherId == "") {
   $lessonsForTeachers["$id"] = NULL;
   continue;
   }
   $teacherids = explode(",",$teacherId);
   $insIds = array();
   foreach ($teacherids as $key => $value) {
      $insIds[] = $teachersParsed["$value"];
   }
   $finalINSCommaSep = implode(",",$insIds);
   $lessonsForTeachers["$id"] = $finalINSCommaSep; 
   $subjectid= $lesson["subjectid"];
   $lessonsForSubjects["$id"] = $subjectsParsed["$subjectid"];
}

foreach ($cards->children() as $card) {
   $lessonID = $card["lessonid"];
   $class = $card["classroomids"];
   $teacherId = $lessonsForTeachers["$lessonID"];
   if ($teacherId != null) {
   $subject = $lessonsForSubjects["$lessonID"];
   $dayID = $card["days"];
   $day = $daysParsed["$dayID"];
   $periodId = $card["period"];
   $endtime = $periodsParsed["$periodId"]["endtime"];
   $starttime = $periodsParsed["$periodId"]["starttime"];
       //start_time and end_time are timestamps..Remember 
      $engage_type = "class";
      $start_time =  strtotime("01/01/2000 ". $starttime);
      $start_timestamp =  date('Y-m-d H:i:s', $start_time);
      $end_time =  strtotime("01/01/2000 ". $endtime);
      $end_timestamp =  date('Y-m-d H:i:s', $end_time); 
      //echo "$teacherId $subject $day $start_timestamp $end_timestamp<br>"; 
      $data = array(
         'user_id'=>"$teacherId",
         'description'=>"$subject",
         'day'=>"$day",
         'start_time'=>"$start_timestamp",
         'end_time'=>"$end_timestamp",
         'engage_type'=>"$engage_type");
      $this->db->set($data); 
      $this->db->insert("permanent_engages", $data);

      $data = array(
       'class_id'=>"$class",
       'day'=>"$day",
       'start_time'=>"$start_timestamp",
       'end_time'=>"$end_timestamp",
       'added_by'=>"program_officer",
      'description'=> "$teacherId");
       $this->db->set($data); 
       $this->db->insert("busy_classes", $data);
   }
}
?>
<!DOCTYPE html>
<html lang="en">
   <head></head>
   <body>
      <div id="page-wrapper">
         <div class="row">
            <div class="col-lg-12">
               <h1 class="page-header">Added Engages</h1>
            </div>
            <!-- /.col-lg-12 -->
         </div>
         <!-- /.row -->
         <div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  
                  <div class="panel-body">
                     <div class="row">
                     
                        <h3>Your file was successfully uploaded!</h3>

                        <ul>
                        <?php foreach ($upload_data as $item => $value):?>
                        <li><?php echo $item;?>: <?php echo $value;?></li>
                        <?php endforeach; ?>
                        </ul>

                        <p><?php echo anchor('AddEngages', 'Upload Another File!'); ?></p>

                  </div>
                  <!-- /.col-lg-6 (nested) -->
                  <!-- /.row (nested) -->
               </div>   
               <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
         </div>
         <!-- /.col-lg-12 -->
      </div>
      <!-- /.row -->
      </div>
      <!-- /#page-wrapper -->
      </div>
      <!-- /#wrapper -->
   </body>
</html>
