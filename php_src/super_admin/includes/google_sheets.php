
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<div class="container my-5">

  <div class="row">

    <div class="col-md-12 mb-4 mb-md-0">

      <!-- <div class="text-center mb-4">
        <a class="btn btn-primary mb-4" target="_blank" href="https://docs.google.com/spreadsheets/d/1ZIptCxioF5KBj0T76F3lILNvne35EhLhFrdrNccOC8A/edit?usp=sharing" role="button"
           >Click to see the source sheet</a
          >

        <p>The data in the table below was imported from Google Spreadsheet. Thanks to this, they can be edited by editing this sheet, and the changes will be reflected in the html table.</p>

      </div> -->

      <!-- Table -->
      <?php

$link = '1poWH6T4eTBfesN0md1LRtKdxD7EjSFPDyd2ZcESZvKk';
$link2 = '1Jlstm_vvWToNyX7dQWGmNSqIjmgZX8_BkaBKsjltwOA';




if(isset($_POST["submitted"])){
  $email =  $_POST["email"];
  echo $email;
}

       ?>


      <table class="table table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>Domain</th>
            <th>options</th>
          </tr>
        </thead>
        <tbody id="demo"></tbody>
      </table>

    </div>
    <div class="col-md-12">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>

            <th>options</th>
          </tr>
        </thead>
        <tbody id="demo2"></tbody>
      </table>
    </div>

    <!-- <div class="col-md-5 mb-4 mb-md-0 text-center">

      <p class="font-weight-bold"><strong>Watch the tutorial </strong></p>

      <div class="embed-responsive embed-responsive-16by9 z-depth-2 rounded">
        <iframe
          class="embed-responsive-item"
          src="https://www.youtube.com/embed/iJdg9vGCnX4"
          title="YouTube video"
          allowfullscreen
          >
        </iframe>
      </div>

    </div> -->

  </div>

  <hr class="mt-5">

  <!-- <p>Built with <a target="_blank" href="https://mdbootstrap.com/docs/standard/">Material Design for Bootstrap</a> - free and powerful Bootstrap UI KIT</p>

  <a class="btn btn-primary me-2" href="https://mdbootstrap.com/docs/standard/getting-started/installation/" target="_blank" role="button">Download MDB UI KIT <i class="fas fa-download"></i></a>
  <a class="btn btn-danger me-2" target="_blank" href="https://mdbootstrap.com/docs/standard/" role="button">Learn more</a>
  <a class="btn btn-success me-2" target="_blank" href="https://mdbootstrap.com/docs/standard/getting-started/" role="button">Tutorials</a>
  <a class="btn btn-dark me-2" target="_blank" href="https://github.com/mdbootstrap/mdb-ui-kit" role="button">GitHub <i class="fab fa-github ms-2"></i></a>

  <hr class="mb-5"/>

  <div class="text-center">
    <p class="font-weight-bold">
      Download Free MDB UI KIT to find more useful solutions for web
      development
    </p>

    <a
       class="btn btn-danger btn-lg"
       target="_blank"
       href="https://mdbootstrap.com/docs/standard/getting-started/installation/"
       role="button"
       >Download free MDB UI KIT<i class="fas fa-download ms-2"></i
      ></a>
  </div>

</div> -->


<script type="text/javascript">
let xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function () {
if (this.readyState == 4 && this.status == 200) {
  let data = JSON.parse(this.responseText).feed.entry;

  let i;
  for (i = 0; i < data.length; i++) {
    let name = data[i]["gsx$name"]["$t"];
    let age = data[i]["gsx$score"]["$t"];
    let email = data[i]["gsx$email"]["$t"];
    let domain = data[i]["gsx$domain"]["$t"];


    document.getElementById("demo").innerHTML +=
      "<tr>" +
      "<td>" +
      name +
      "</td>" +
      "<td>" +
      age +
      "</td>" +
      "<td>" +
      email +
      "</td>" +
      "<td>" +
      domain +
      "</td>" +

      "<td>" +
    '<form class="" action="" method="post">  <input type="hidden" name="email" value= '+ email +'>  <input type="submit" name="submitted" value="Edit " class="btn btn-primary "></form>' +
      "</td>" +

      "</tr>";
  }
}
};
// var link = ;
// console.log(link);
// "https://spreadsheets.google.com/feeds/list/1ZIptCxioF5KBj0T76F3lILNvne35EhLhFrdrNccOC8A/od6/public/values?alt=json",
xmlhttp.open(
"GET",
"https://spreadsheets.google.com/feeds/list/<?php echo $link; ?>/od6/public/values?alt=json",
true
);
xmlhttp.send();




















let xmlhttp2 = new XMLHttpRequest();
xmlhttp2.onreadystatechange = function () {
if (this.readyState == 4 && this.status == 200) {
  let data = JSON.parse(this.responseText).feed.entry;

  let i;
  for (i = 0; i < data.length; i++) {
    let name = data[i]["gsx$name"]["$t"];
    let age = data[i]["gsx$score"]["$t"];
    let email = data[i]["gsx$mail"]["$t"];



    document.getElementById("demo2").innerHTML +=
      "<tr>" +
      "<td>" +
      name +
      "</td>" +
      "<td>" +
      age +
      "</td>" +
      "<td>" +
      email +
      "</td>" +


      "<td>" +
    '<form class="" action="" method="post">  <input type="hidden" name="email" value= '+ email +'>  <input type="submit" name="submitted" value="Edit " class="btn btn-primary "></form>' +
      "</td>" +

      "</tr>";
  }
}
};
// var link = ;
// console.log(link);
// "https://spreadsheets.google.com/feeds/list/1ZIptCxioF5KBj0T76F3lILNvne35EhLhFrdrNccOC8A/od6/public/values?alt=json",
xmlhttp2.open(
"GET",
"https://spreadsheets.google.com/feeds/list/<?php echo $link2; ?>/od6/public/values?alt=json",
true
);
xmlhttp2.send();







</script>
