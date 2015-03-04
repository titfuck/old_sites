<?php $page_id="brothers"; $page_title="Brothers"; require_once('top.php'); ?>
<!-- brothers.php -->
<link rel="stylesheet" type="text/css" media="screen,print" href="/tdc/brothers.css" />
<h1>TDC Brothers</h1>
<div class="image">
  <img src="/tdc/images/pledge_hike/pledge_hike05.jpg"/>
  <div>Group picture from Pledge Hike 2005.  Try to find Sam Phillips.  Then proceed to laugh.</div>
</div>
<div id="classes">
  <div class="row">
    <div class="bro_class" id="co2008">
      <div class="class_year">Class of 2008</div>
      <img class="class_pic" src="/tdc/images/brothers/2008classpic.jpg"/>
      <?php require_once('brothers/bronav.php'); print_year(2008, 7); ?>
    </div>
    <div class="bro_class" id="co2009">
      <div class="class_year">Class of 2009</div>
      <img class="class_pic" src="/tdc/images/brothers/2009classpic.jpg"/>
      <?php require_once('brothers/bronav.php'); print_year(2009, 7); ?>
    </div>
  </div>
  <div class="row">
    <div class="bro_class" id="co2010">
      <div class="class_year">Class of 2010</div>
      <img class="class_pic" src="/tdc/images/brothers/2010classpic.jpg"/>
      <?php require_once('brothers/bronav.php'); print_year(2010, 7); ?>
    </div>
    
    <div class="bro_class" id="co2011">
      <div class="class_year">Class of 2011</div>
      <img class="class_pic" src="/tdc/images/brothers/2011classpic.jpg"/>
      <?php require_once('brothers/bronav.php'); print_year(2011, 7); ?>
    </div>
  </div>
  <div class="row">
    <div class="bro_class" id="co2012">
      <div class="class_year">Class of 2012</div>
      <img class="class_pic" src="/tdc/images/brothers/2012classpic.jpg"/>
      <?php require_once('brothers/bronav.php'); print_year(2012, 7); ?>
    </div>
  </div>
</div>
<a href="brothers/archive.php">Older classes...</a>
<?php require_once('footer.php'); ?>