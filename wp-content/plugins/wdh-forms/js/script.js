/**
 * Function for view form for email registration
 */
function add_form_email() {
  var block = '<form action="" name="login-form" method="post">';
  block = block + '<div class="row text-center login-form-title">';
  block = block + '<div class="col-lg-12">';
  block = block + "Sign up";
  block = block + "</div>";
  block = block + "</div>";
  block = block + '<div class="row text-center login-form-txt">';
  block = block + '<div class="col-lg-12">';
  block = block + "Enter your corporate email.";
  block =
    block +
    "<p>Public cloud domain mailboxes (gmail, yandex, etc.) are not accepted!";
  block = block + "</div>";
  block = block + "</div>";
  block = block + '<div class="row login-form-input">';
  block = block + '<div class="col-lg-12">';
  block =
    block +
    '<input type="email" name="email" class="login-form-email" placeholder="email">';
  block = block + "</div>";
  block = block + "</div>";
  block = block + '<div class="row row-login-form-button">';
  block = block + '<div class="col-lg-12 text-center">';
  block =
    block +
    '<input type="submit" name="login-butt" class="login-form-button" value="Complete">';
  block = block + "</div>";
  block = block + "</div>";
  block = block + "</form>";
  document.getElementById("sign-form").innerHTML = block;
}

/**
 * Function for view form to enter the code sent to the phone
 * */
function check_code() {
  var code = document.getElementById("usercode").value;
  var tel = document.getElementById("phone").value;
  var ajaxurl = "https://r.gorbunou.fvds.ru/wp-admin/admin-ajax.php";
  var check = 0;
  var data = {
    action: "wdh_check_code",
    code: code,
    tel: tel,
  };
  jQuery.post(ajaxurl, data, function (response) {
    console.log("wdh_check_code: " + response);
    response = response.substring(0, response.length - 1);
    if (response == "true") {
      var project = document.getElementById("project").value;
      console.log("project: " + project);
      window.location.href =
        "https://r.gorbunou.fvds.ru/projects/?id_project=" + project;
    } else {
      document.getElementById("usercode").classList.add("red");
    }
  });
}

function checkFormCode() {
  var code = document.getElementById("usercode").value;
  if (code.length == 4) {
    check_code();
  }
  console.log("checkFormCode: " + code);
}

/**
 * Function for view preloader
 */
function zebraGo() {
  let start = Date.now();
  var l = -100;

  let timer = setInterval(function () {
    let timePassed = Date.now() - start;

    //zebra.style.left = timePassed / 25 + '%';
    var zebra = document.getElementById("zebra");
    if (zebra != null) {
      zebra.style.left = l + 25 + "%";
      l = l + 25;

      if (timePassed > 2000) {
        clearInterval(timer);
        identMainForm();
      }
    }
  }, 500);
}

setTimeout(zebraGo, 3000);

/**
 * Function for view main form
 * */
function showMainForm(
  text1,
  text2,
  input2,
  text3,
  input3,
  text4,
  input4,
  text5,
  text6,
  input6
) {
  var main = "";
  main = main + '<div class="container-fluid">';
  main = main + '<div class="wdh-ready-form" id="wdh-ready-form">';
  main = main + '<div class="row">';
  main = main + '<div class="col-lg-12">';
  main = main + '<div class="r-ready">';
  main = main + '<div class="r-blue-title">';
  main = main + "R-r-ready!";
  main = main + "</div>";
  main = main + '<div class="r-black-title">';
  main = main + "We made calculations based on your questionnaire.";
  main = main + "</div>";
  main = main + '<div class="r-txt">';
  main =
    main +
    "Check the data for your project. At this stage, you can make changes to the project description.";
  main = main + "</div>";
  main = main + '<div class="r-button-row">';
  main =
    main +
    '<a href="javascript: showTelForm();" class="r-blue-button">Let\'s start developing</a>';
  //main = main + '<a class="r-white-button">Change</a>';
  main = main + "</div>";
  main = main + "</div>";
  main = main + "</div>";
  main = main + "</div>";
  main = main + "</div>";
  main = main + "</div>";

  main = main + '<div class="container-fluid wdh-container-fluid">';
  main = main + '<div class="container">';
  main = main + '<div class="row">';
  main = main + '<div class="col-lg-12">';
  main = main + '<div id="whd-vertical-wrap">';
  main = main + '<div class="whd-vertical"></div>';
  main = main + '<div class="wdh-quest-top">';
  main = main + text1;
  main = main + "</div>";

  main = main + '<div class="const01"></div>';
  main =
    main +
    '<div class="wdh-space-box02" id="wdh-quest02" data-bs-toggle="modal" data-bs-target="#staticQ02" onclick="hideban();">';
  main = main + "<h4>Technology stack</h4>" + '<p id="text2">' + text2 + "</p>";
  main = main + "</div>";
  main = main + "<!-- Modal -->";
  main =
    main +
    '<div class="modal fade" id="staticQ02" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticQ02Label" aria-hidden="true">';
  main = main + '<div class="modal-dialog">';
  main = main + '<div class="modal-content">';
  main = main + '<form action="">';
  main = main + '<div class="modal-header">';
  main =
    main + '<h1 class="modal-title fs-5" id="staticQ2Label">Edit quest</h1>';
  main =
    main +
    '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="showban();"></button>';
  main = main + "</div>";
  main = main + '<div class="modal-body">';
  main = main + input2;
  main = main + "</div>";
  main = main + '<div class="modal-footer">';
  main =
    main +
    '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="showban();">Close</button>';
  main =
    main +
    '<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="saveQuest(2);">Update</button>';
  main = main + "</div>";
  main = main + "</form>";
  main = main + "</div>";
  main = main + "</div>";
  main = main + "</div>";
  main = main + '<div class="const02"></div>';
  main =
    main +
    '<div class="wdh-space-box03" id="wdh-quest03" data-bs-toggle="modal" data-bs-target="#staticQ03" onclick="hideban();">';
  main = main + '<h4>Team</h4><p id="text3">' + text3 + "</p>";
  main = main + "</div>";
  main = main + "<!-- Modal -->";
  main =
    main +
    '<div class="modal fade" id="staticQ03" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticQ03Label" aria-hidden="true">';
  main = main + '<div class="modal-dialog">';
  main = main + '<div class="modal-content">';
  main = main + '<form action="">';
  main = main + '<div class="modal-header">';
  main =
    main + '<h1 class="modal-title fs-5" id="staticQ03Label">Edit quest</h1>';
  main =
    main +
    '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="showban();"></button>';
  main = main + "</div>";
  main = main + '<div class="modal-body">';
  main = main + input3;
  main = main + "</div>";
  main = main + '<div class="modal-footer">';
  main =
    main +
    '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="showban();">Close</button>';
  main =
    main +
    '<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="saveQuest(3);">Update</button>';
  main = main + "</div>";
  main = main + "</form>";
  main = main + "</div>";
  main = main + "</div>";
  main = main + "</div>";
  main = main + '<div class="const03"></div>';
  main =
    main +
    '<div class="wdh-space-box04" id="wdh-quest04" data-bs-toggle="modal" data-bs-target="#staticQ04" onclick="hideban();">';
  main =
    main +
    '<h4>Estimation of terms and readiness</h4><p id="text4">' +
    text4 +
    "</p>";
  main = main + "</div>";
  main = main + "<!-- Modal -->";
  main =
    main +
    '<div class="modal fade" id="staticQ04" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticQ04Label" aria-hidden="true">';
  main = main + '<div class="modal-dialog">';
  main = main + '<div class="modal-content">';
  main = main + '<form action="">';
  main = main + '<div class="modal-header">';
  main =
    main + '<h1 class="modal-title fs-5" id="staticQ04Label">Edit quest</h1>';
  main =
    main +
    '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="showban();"></button>';
  main = main + "</div>";
  main = main + '<div class="modal-body">';
  main = main + input4;
  main = main + "</div>";
  main = main + '<div class="modal-footer">';
  main =
    main +
    '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="showban();">Close</button>';
  main =
    main +
    '<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="saveQuest(4);">Update</button>';
  main = main + "</div>";
  main = main + "</form>";
  main = main + "</div>";
  main = main + "</div>";
  main = main + "</div>";

  main = main + '<div class="const04"></div>';
  main = main + '<div class="wdh-space-box05" id="wdh-quest05">';
  main = main + text5;
  main = main + "</div>";

  main = main + '<div class="const05"></div>';
  main =
    main +
    '<div class="wdh-space-box06" id="wdh-quest06" data-bs-toggle="modal" data-bs-target="#staticQ06" onclick="hideban();">';
  main = main + text6;
  main = main + "</div>";
  main = main + "<!-- Modal -->";
  main =
    main +
    '<div class="modal fade" id="staticQ06" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticQ06Label" aria-hidden="true">';
  main = main + '<div class="modal-dialog">';
  main = main + '<div class="modal-content">';
  main = main + '<form action="" name="sendForm" method="post">';
  main = main + '<div class="modal-header">';
  main =
    main + '<h1 class="modal-title fs-5" id="staticQ06Label">Edit quest</h1>';
  main =
    main +
    '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="showban();"></button>';
  main = main + "</div>";
  main = main + '<div class="modal-body">';
  main = main + input6;
  main = main + "</div>";
  main = main + '<div class="modal-footer">';
  main =
    main +
    '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" onclick="showban();">Close</button>';
  main =
    main +
    '<button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="saveQuest(6);">Update</button>';
  main = main + "</div>";
  main = main + "</form>";
  main = main + "</div>";
  main = main + "</div>";
  main = main + "</div>";
  main = main + '<div class="const06"></div>';
  main = main + "</div>";
  main = main + "</div>";
  main = main + "</div>";
  main = main + "</div>";
  main = main + "</div>";
  main = main + "<script>";
  return main;
}

/**
 * function for identificate main form
 */
function identMainForm() {
  var phone = document.getElementById("phone").value;
  //var budget = document.getElementById("budget").value;
  var budget = 50000; //base setup
  var platform = document.getElementById("platform").value;

  var arPlatform = platform.split(", ");
  var allPlatform =
    "Mobile iOS, Mobile Android, Crossplatform, Desktop, Middleware, IoT, Web";
  var arAllPlatform = allPlatform.split(", ");
  var input = "";
  arAllPlatform.forEach(function (elem) {
    let m = 0;
    arPlatform.forEach(function (elem2) {
      if (elem == elem2) {
        m = 1;
      }
    });
    if (m == 1) {
      input =
        input +
        '<input type="checkbox" name="platform" value="' +
        elem +
        '" checked>' +
        elem +
        "<br>";
    } else {
      input =
        input +
        '<input type="checkbox" name="platform" value="' +
        elem +
        '">' +
        elem +
        "<br>";
    }
  });

  var teamTxt = "1 TL - Tech lead<br>";
  teamTxt = teamTxt + "1 BE -  Back-end developer<br>";
  teamTxt = teamTxt + "1 FE - Front-end developer<br>";
  teamTxt = teamTxt + "1 UX - User interface designer<br>";
  teamTxt = teamTxt + "1 BA - Business and/or system analyst<br>";
  teamTxt = teamTxt + "1 PM - project manager<br>";
  teamTxt = teamTxt + "1 XQA -  manual quality assurance engineer<br>";
  teamTxt = teamTxt + "1 DevOps - System integration engineer";
  /*
  arPlatform.forEach(function (elem) {
    if (elem == "Mobile iOS") {
      teamTxt = teamTxt + "iOS developers <br>";
    }
    if (elem == "Mobile Android") {
      teamTxt = teamTxt + "Android developers <br>";
    }
    if (elem == "Crossplatform") {
      teamTxt = teamTxt + "Crossplatform developers <br>";
    }
    if (elem == "Desktop") {
      teamTxt = teamTxt + "Desktop developers <br>";
    }
    if (elem == "Middleware") {
      teamTxt = teamTxt + "Middleware developers <br>";
    }
    if (elem == "IoT") {
      teamTxt = teamTxt + "IoT developers <br>";
    }
    if (elem == "Web") {
      teamTxt = teamTxt + "Web developers <br>";
    }
  });
  */

  var text1 =
    "<h4>Product type and modules</h4><p>Lorem ipsum dolor sit amet consectetur. Ligula adipiscing scelerisque sit et nulla pulvinar mauris quis. Ultricies condimentum id duis massa ut laoreet eu pulvinar amet pretium ipsum rhoncus malesuada.</p>";
  var text2 = platform;
  var input2 = input;
  var text3 = teamTxt;
  var inputTeamTxt = teamTxt.replace("<br>", "\n");
  for (let i = 0; i <= 8; i++) {
    inputTeamTxt = inputTeamTxt.replace("<br>", "\n");
  }
  inputTeamTxt =
    '<textarea name="team" id="team">' + inputTeamTxt + "</textarea>";
  var input3 = inputTeamTxt;
  var text4 = "Start<br>Discovery<br>Development<br> Delivery";
  var input4 =
    '<label for="start">Start</label><input type="date" name="start" id="start"><br>';
  input4 =
    input4 +
    '<label for="discovery">Discovery</label><input type="date" name="discovery" id="discovery"><br>';
  input4 =
    input4 +
    '<label for="development">Development</label><input type="date" name="development" id="development"><br>';
  input4 =
    input4 +
    '<label for="delivery">Delivery</label><input type="date" name="delivery" id="delivery">';
  var text5 =
    "<h4>Development stages</h4><p>Analytic<br>UX/UI design<br>Development<br>Delivery";
  var text6 = '<h4>Budget</h4><p id="text6">' + budget + "</p>";
  var input6 =
    '<label for="budget">Budget</label><input type="number" value="' +
    budget +
    '" id="budgetForm">';
  document.getElementById("wdh-content").innerHTML = showMainForm(
    text1,
    text2,
    input2,
    text3,
    input3,
    text4,
    input4,
    text5,
    text6,
    input6
  );
}

/**
 * functions for view and hide modal window
 */
function hideban() {
  document.getElementById("wdh-ready-form").style.display = "none";
}
function showban() {
  document.getElementById("wdh-ready-form").style.display = "block";
}

/**
 * function for save data from modal
 */
function saveQuest(n) {
  //tech list
  if (n == 2) {
    var platform = document.getElementsByName("platform");
    var arPlatform = [];
    for (let i = 0; i < platform.length; i++) {
      if (platform[i].checked) {
        arPlatform.push(platform[i].value);
      }
    }
    var platformTxt = arPlatform.join(", ");
    document.getElementById("text2").innerHTML = platformTxt;
    document.getElementById("platform").value = platformTxt;
    //identMainForm();
    showban();
  }

  //team list
  if (n == 3) {
    var team = document.getElementById("team").value;
    var arTeam = team.split(" \n");
    var teamTxt = "";
    arTeam.forEach(function (elem) {
      teamTxt = teamTxt + elem + "<br>";
    });
    document.getElementById("text3").innerHTML = teamTxt;
    document.getElementById("userteam").value = arTeam;
    //identMainForm();
    showban();
  }

  //dates
  if (n == 4) {
    var start = document.getElementById("start").value;
    var discovery = document.getElementById("discovery").value;
    var development = document.getElementById("development").value;
    var delivery = document.getElementById("delivery").value;
    var datesTxt =
      start +
      " Start<br>" +
      discovery +
      " Discovery<br>" +
      development +
      " Development<br>" +
      delivery +
      " Delivery<br>";
    document.getElementById("text4").innerHTML = datesTxt;
    document.getElementById("userdates").value =
      start + "," + discovery + "," + development + "," + delivery;
    //identMainForm();
    showban();
  }

  //budget
  if (n == 6) {
    var budget = document.getElementById("budgetForm").value;
    document.getElementById("text6").innerHTML = budget;
    document.getElementById("budget").value = budget;
    //identMainForm();
    showban();
  }
}

/**
 * function for show telephone form
 */
function showFormTel() {
  var phone = document.getElementById("phone").value;
  var ft = "";
  ft =
    ft +
    '<div class="container" style="margin-top: 60px; background-color: #fff;">';
  ft = ft + '<div class="row justify-content-md-center">';
  ft = ft + '<div class="col-lg-8">';
  ft = ft + '<div class="sign-form">';
  ft = ft + '<form action="" name="login-form" method="post">';
  ft = ft + '<div class="row text-center login-form-title">';
  ft = ft + '<div class="col-lg-12">';
  ft = ft + "Sign up";
  ft = ft + "</div>";
  ft = ft + "</div>";
  ft = ft + '<div class="row text-center login-form-txt">';
  ft = ft + '<div class="col-lg-12">';
  ft = ft + "<p>To continue the project calculation, you need to register</p>";
  ft =
    ft +
    "<p>A code for further registration will be sent to the phone number you specified.</p>";
  ft = ft + "</div>";
  ft = ft + "</div>";
  ft = ft + '<div class="row login-form-input">';
  ft = ft + '<div class="col-lg-12">';
  ft =
    ft +
    '<input type="text" name="userphone" id="usertelephone" class="login-form-phone" placeholder="+___ __ ___ __ __" value="' +
    phone +
    '">';
  ft = ft + "</div>";
  ft = ft + "</div>";
  ft = ft + '<div class="row row-login-form-button">';
  ft = ft + '<div class="col-lg-12 text-center">';
  ft =
    ft +
    '<a href="javascript: showCode();" class="r-blue-button" style="padding: 14px 83px;">Next</a>';
  ft = ft + "</div>";
  ft = ft + "</div>";
  ft = ft + "</form>";
  ft = ft + "</div>";
  ft = ft + "</div>";
  ft = ft + "</div>";
  ft = ft + "</div>";
  ft = ft + "</div>";
  return ft;
}

/**
 * function for show code form
 */
function showFormCode() {
  var fm = "dasd";
  fm =
    fm +
    '<div class="container" style="background-color: #fff; margin-top: 60px">';
  fm = fm + '<div class="row justify-content-md-center">';
  fm = fm + '<div class="col-lg-8">';
  fm = fm + '<div class="sign-form" id="sign-form">';
  fm = fm + '<form action="" name="login-form" method="post">';
  fm = fm + '<div class="row text-center login-form-title">';
  fm = fm + '<div class="col-lg-12">';
  fm = fm + "Sign up";
  fm = fm + "</div>";
  fm = fm + "</div>";
  fm = fm + '<div class="row text-center login-form-txt">';
  fm = fm + '<div class="col-lg-12">';
  fm = fm + "<p>";

  fm = fm + "Enter the code we sent to your number ";
  phone = document.getElementById("phone").value;
  if (phone == "") {
    fm = fm + "+90 000 000 00 00";
  } else {
    fm = fm + phone;
  }
  fm = fm + "</p>";
  fm = fm + "</div>";
  fm = fm + "</div>";
  fm = fm + '<div class="row login-form-input">';
  fm = fm + '<div class="col-lg-12 text-center">';
  fm =
    fm +
    '<input id="usercode" type="text" name="usercode" class="sms-code" placeholder="____" oninput="checkFormCode();" />';
  fm = fm + "</div>";
  fm = fm + "</div>";
  fm = fm + '<div class="row row-login-form-button">';
  fm = fm + '<div class="col-lg-12 text-center">';
  fm = fm + '<a href="#" class="resend">Resend</a>';
  fm = fm + "</div>";
  fm = fm + "</div>";
  fm = fm + "</form>";
  fm = fm + '<div class="bottom-form"></div>';
  fm = fm + "</div>";
  fm = fm + "</div>";
  fm = fm + "</div>";
  fm = fm + "</div>";
  return fm;
}

function resendsms() {
  var userphone = document.getElementById("phone").value;
  var ajaxurl = "https://r.gorbunou.fvds.ru/wp-admin/admin-ajax.php";
  var data = {
    action: "wdh_sendnewsms",
    userphone: userphone,
  };
  jQuery.post(ajaxurl, data, function (response) {
    response = response.substring(0, response.length - 1);
  });
}

/**
 * function for identificate telephone form
 */
function showTelForm() {
  document.getElementById("wdh-content").innerHTML = showFormTel();
  var element = document.getElementById("usertelephone");
  var maskOptions = {
    mask: "+000 00 000 00 00",
  };
  var mask = IMask(element, maskOptions);
}

/**
 * function for identificate code form
 */
function showCode() {
  var userphone = document.getElementById("usertelephone").value;
  userphone = userphone.replace(" ", "");
  userphone = userphone.replace(" ", "");
  userphone = userphone.replace(" ", "");
  userphone = userphone.replace(" ", "");

  var email = document.getElementById("email").value;
  var budget = document.getElementById("budget").value;
  var platform = document.getElementById("platform").value;
  var userteam = document.getElementById("userteam").value;
  var userdates = document.getElementById("userdates").value;
  var auth = document.getElementById("auth").value;

  document.getElementById("phone").value = userphone;

  var ajaxurl = "https://r.gorbunou.fvds.ru/wp-admin/admin-ajax.php";
  var data = {
    action: "wdh_create_user",
    userphone: userphone,
    email: email,
    budget: budget,
    platform: platform,
    userteam: userteam,
    userdates: userdates,
    auth: auth,
  };
  jQuery.post(ajaxurl, data, function (response) {
    response = response.substring(0, response.length - 1);
    console.log("wdh_create_user: " + response);
    document.getElementById("project").value = response;
    if (auth == 1) {
      window.location.href = "https://r.gorbunou.fvds.ru/projects/";
    }
  });

  document.getElementById("wdh-content").innerHTML = showFormCode();
  var element = document.getElementById("usercode");
  var maskOptions = {
    mask: "0000",
  };
  var mask = IMask(element, maskOptions);
}
