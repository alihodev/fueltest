<?php
  session_start();
  require_once("./dbconfig.php");
  $page = isset($_GET['page']) ? $_GET['page'] : "login";
  $users = [
    "admin" => [
      "access" => "admin"
    ],
    "customer" => [
      "access" => "customer"
    ]
  ];

  if($page == "login" && !empty($_POST['username']))
  {
      if(!empty($users[$_POST['username']]))
      {
        
        $_SESSION['login'] = [
          "access" => $users[$_POST['username']]['access'],
          "username" => $_POST['username'],
          "islogin" => true
        ];

        exit(header("location: ?page=chat&message=welcome"));
      }else{
        $login_error = "نام کاربری وارد شده در پایگاه داده وجود ندارد.";
      }
  }elseif($page == "logout")
  {
    session_destroy();
    exit(header("location: ?page=login"));
  }elseif($page == "send")
  {
    if(!empty($_SESSION['login']) && !empty($_POST['message']))
    {
      $sendTime = time();
      $sendTimeFormatted = date("Y/m/d H:i:s",$sendTime);

      $stmt = $conn->prepare("INSERT INTO chats (username, message, time_created)
            VALUES (:username, :message, :time_created)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':time_created', $time_created);

        $username = $_SESSION['login']['username'];
        $message = $_POST['message'];
        $time_created = $sendTime;
        $insert = $stmt->execute();
        if ($insert) {
            $id = $conn->lastInsertId();
            if($_SESSION['login']['access'] == "admin")
            {
              $message = '
                <div class="direct-chat-msg" id="'.$id.'">
                  
                  <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-left">مدیر</span>
                    <span class="direct-chat-timestamp float-right">'. $sendTimeFormatted .'</span>
                  </div>

                  <img class="direct-chat-img" src="./dist/img/avatar5.png" alt="مدیر">
                  <div class="direct-chat-text">
                    '.$_POST['message'].'
                  </div>
                </div>
              ';
            }elseif($_SESSION['login']['access'] == "customer")
            {
              $message = '
                <div class="direct-chat-msg right"  id="'.$id.'">
                  <div class="direct-chat-infos clearfix">
                    <span class="direct-chat-name float-right">مشتری</span>
                    <span class="direct-chat-timestamp float-left">'. $sendTimeFormatted .'</span>
                  </div>
                  <img class="direct-chat-img" src="./dist/img/avatar3.png" alt="Message User Image">
                  <div class="direct-chat-text">
                  '.$_POST['message'].'
                  </div>
                </div>
            ';
            }
            die($message);
        }else{
          die("");
        }
    }else{
      die("");
    }
  }elseif($page == "chat")
  {
    if(empty($_SESSION['login']))
    {
      exit(header("location: ?page=login"));
    }

    $serachQuery = "";
    if(!empty($_POST['q']))
    {
      $serachQuery = " and message like '%".$_POST['q']."%'";
    }

    $stmt = $conn->prepare("SELECT * FROM chats where 1 $serachQuery order by time_created asc");
    $stmt->execute(); 
    $chatlist = $stmt->fetchAll();
  }elseif($page == "chat_new" && !empty($_GET['last_id']) && !empty($_SESSION['login']))
  {
    $stmt = $conn->prepare("SELECT * FROM chats where username != :username and id > :id order by time_created asc");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':id', $chat_id);
    $username = $_SESSION['login']['username'];
    $chat_id = $_GET['last_id'];
    $stmt->execute(); 
    $chatlist = $stmt->fetchAll();

    $final_chat_list = "";
    foreach($chatlist as $row) { 
      $rowAccess = "customer";
      if(!empty($users[$row['username']]))
      {
        $rowAccess = $users[$row['username']]['access'];
      }
      $sendTimeFormatted = date("Y/m/d H:i:s",$row['time_created']);


      if($rowAccess == "admin")
      {
        $message = '
          <div class="direct-chat-msg" id="'.$row['id'].'">
            
            <div class="direct-chat-infos clearfix">
              <span class="direct-chat-name float-left">مدیر</span>
              <span class="direct-chat-timestamp float-right">'. $sendTimeFormatted .'</span>
            </div>

            <img class="direct-chat-img" src="./dist/img/avatar5.png" alt="مدیر">
            <div class="direct-chat-text">
              '.$row['message'].'
            </div>
          </div>
        ';
      }elseif($rowAccess == "customer")
      {
        $message = '
          <div class="direct-chat-msg right"  id="'.$row['id'].'">
            <div class="direct-chat-infos clearfix">
              <span class="direct-chat-name float-right">مشتری</span>
              <span class="direct-chat-timestamp float-left">'. $sendTimeFormatted .'</span>
            </div>
            <img class="direct-chat-img" src="./dist/img/avatar3.png" alt="مشتری">
            <div class="direct-chat-text">
            '.$row['message'].'
            </div>
          </div>
        ';
      }
      $final_chat_list .= $message;
    }
    die($final_chat_list);
  }elseif($page == "logs")
  {
    $stmt = $conn->prepare("SELECT count(*) as count,username FROM chats where time_created between :one_minute_before  and :current_time group by username order by count desc");
    $stmt->bindParam(':current_time', $current_time);
    $stmt->bindParam(':one_minute_before', $one_minute_before);
    $current_time = time();
    $one_minute_before = strtotime("-1 minute");
    $stmt->execute(); 
    $chatlist = $stmt->fetchAll();
  }


  
?>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>آزمون فنی</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <link rel="stylesheet" href="dist/css/emojionearea.min.css">
  <script src="dist/js/emojionearea.min.js"></script>

  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->

  <script type="text/javascript"></script>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="?page=chat" class="nav-link">چت</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <!-- Message Start -->
              <div class="media">
                <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Nora Silvester
                    <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                  </h3>
                  <p class="text-sm">The subject goes here</p>
                  <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
              <!-- Message End -->
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i class="fas fa-th-large"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          
        <?php if(!empty($_SESSION['login'])) { ?> 

          <?php if($_SESSION['login']['access'] == "admin"){ ?> 
            <div class="image">
              <img src="dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">مدیر</a>
            </div>
          <?php }elseif($_SESSION['login']['access'] == "customer"){  ?>
            <div class="image">
              <img src="dist/img/avatar3.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block">مشتری</a>
            </div>
          <?php } ?>

        <?php }else{ ?>
          <div class="image">
            <img src="dist/img/boxed-bg.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">نامشخص</a>
          </div>
        <?php } ?>
          
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              
               <?php if(!empty($_SESSION['login'])) { ?> 
                  <li class="nav-item has-treeview menu-open">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                      چت
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="?page=chat" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p> چت روم </p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="?page=logs" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>تاریخچه</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="?page=logout" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      خروج
                    </p>
                  </a>
                </li>
            <?php }else{ ?> 
                <li class="nav-item">
                  <a href="?page=login" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                      ورود
                    </p>
                  </a>
                </li>
            <?php } ?>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">آزمون تعیین سطح فنی شرکت فاطر تجارت</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">خانه</a></li>
                <li class="breadcrumb-item active">صفحه اول</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">



            <?php if($page == "login"){ ?> 
                <div class="card" dir="rtl" style="text-align: justify">
                  <div class="card-header">
                    <h5 class="m-0">ورود به چت روم</h6>
                  </div>
                  <div class="card-body">
                    <p class="card-text">
                        <?php if(!empty($login_error)){ ?>
                          <div class="alert alert-danger">
                              <?php echo $login_error; ?>
                          </div>
                        <?php } ?>
                    </p>

                    <div class="card-footer" dir="ltr">
                      <form action="login.php?page=login" method="post" enctype="multipart/form-data">
                        <div class="input-group">
                          <input type="text" name="username" placeholder="نام کاربری" class="form-control">
                          <span class="input-group-append">
                            <button type="submit" class="btn btn-primary">ورود</button>
                          </span>
                        </div>
                      </form>
                    </div>
                    <!-- /.card-footer-->
                  </div>
                </div>
              <?php } ?>

              <?php if(!empty($_GET['message']) && $_GET['message'] == "welcome"){ ?>
                <div class="alert alert-success">
                    کاربر عزیز به سیستم پیغام رسانی خوش آمدید.
                </div>
              <?php } ?>

              <?php if($page == "chat"){ ?> 
                <div id="ajax-chats-loads-here" class="card card-prirary cardutline direct-chat direct-chat-primary">
                <form class="search-box" action="?page=chat" method="post" <?php if(empty($_POST['q'])){?> style="display: none" <?php } ?>>
                  <div class="input-group search-box">
                      <input type="text" name="q" value="<?php echo @$_POST['q']; ?>" placeholder="جستجو..." class="form-control">
                      <span class="input-group-append">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                        <a href="?page=chat" class="btn btn-danger"><i class="fas fa-times"></i></a>
                      </span>
                  </div> 
                </form> 
                <div class="card-header">
                      
                    <h3 class="card-title">
                      گفتگو بر خط
                    </h3>

                    <div class="card-tools">
                      
                      <!-- <span data-toggle="tooltip" title="3 New Messages" class="badge bg-primary">3</span> -->
                      <button type="button" class="btn btn-tool" data-card-widget="search"><i class="fas fa-search"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle">
                        <i class="fas fa-comments"></i></button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages">
                      
                        <?php foreach($chatlist as $rowKey => $row) { 
                            $rowAccess = "customer";
                            if(!empty($users[$row['username']]))
                            {
                              $rowAccess = $users[$row['username']]['access'];
                            }
                            $sendTimeFormatted = date("Y/m/d H:i:s",$row['time_created']);


                            if($rowAccess == "admin")
                            {
                              $message = '
                                <div class="direct-chat-msg" id="'.$row['id'].'">
                                  
                                  <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left">مدیر</span>
                                    <span class="direct-chat-timestamp float-right">'. $sendTimeFormatted .'</span>
                                  </div>

                                  <img class="direct-chat-img" src="./dist/img/avatar5.png" alt="مدیر">
                                  <div class="direct-chat-text">
                                    '.$row['message'].'
                                  </div>
                                </div>
                              ';
                            }elseif($rowAccess == "customer")
                            {
                              $message = '
                                <div class="direct-chat-msg right"  id="'.$row['id'].'">
                                  <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-right">مشتری</span>
                                    <span class="direct-chat-timestamp float-left">'. $sendTimeFormatted .'</span>
                                  </div>
                                  <img class="direct-chat-img" src="./dist/img/avatar3.png" alt="مشتری">
                                  <div class="direct-chat-text">
                                  '.$row['message'].'
                                  </div>
                                </div>
                            ';
                            }
                            echo $message;
                          ?>
                                          
                        <?php } ?>

                        <?php if(count($chatlist) == 0) { ?> 
                          <div class="alert alert-info text-center">
                            گفتگویی برای نمایش وجود ندارد.
                          </div>
                        <?php } ?>
                    
                    </div>
                    <!--/.direct-chat-messages-->

                    <!-- Contacts are loaded here -->
                    <div class="direct-chat-contacts">
                      <ul class="contacts-list">
                        <li>
                          <a href="#">
                            <img class="contacts-list-img" src="./dist/img/user1-128x128.jpg">

                            <div class="contacts-list-info">
                              <span class="contacts-list-name">
                                Count Dracula
                                <small class="contacts-list-date float-right">2/28/2015</small>
                              </span>
                              <span class="contacts-list-msg">How have you been? I was...</span>
                            </div>
                            <!-- /.contacts-list-info -->
                          </a>
                        </li>
                        <!-- End Contact Item -->
                      </ul>
                      <!-- /.contatcts-list -->
                    </div>
                    <!-- /.direct-chat-pane -->
                  </div>
                  <!-- /.card-body -->

                  <style>
                    .attach-image{
                        position: absolute;
                        right: 7px;
                        z-index: 100000;
                        top: 30px;
                        opacity: 0.4;
                        cursor: pointer;
                    }

                    .attach-image:hover{
                      opacity: 0.7;
                    }                 

                    .emojionearea .emojionearea-editor .attach-img{
                      max-width: 120px;
                      max-height: auto;
                    }

                    .direct-chat-msg .direct-chat-text .attach-img.invalid{
                        opacity: 0;
                    }

                    #message-send{
                      height: 40px;
                      transition: width 1s, height 1s;
                    }
                    #message-send:hover{
                      height: 50px;
                      transition: width 1s, height 1s;
                    }

                  </style>

                  <div class="card-footer">
                      <div class="input-group" style="position: relative;">
                        <i class="fa fa-image attach-image"></i>
                        <textarea name="message" id="message-text" placeholder="پیغام خود را بنویسید..." class="form-control"></textarea>
                        <button id="message-send" type="button" class="btn btn-primary btn-block">ارسال</button>
                        <input type="file" class="message-image" style="display: none" accept="jpg,png,gif,jpeg,bmp" />
                      </div>
                  </div>
                  <!-- /.card-footer-->
                </div>

                <script>
                  $(document).ready(function() {
                    $("#message-text").emojioneArea();
                    $(".direct-chat-messages").stop().animate({ scrollTop: $(".direct-chat-messages")[0].scrollHeight}, 1000);
                  });

                  $(document).on("click","#message-send",function(){
                    if($("#message-text").next(".emojionearea").find(".emojionearea-editor").html() != "")
                    {
                        $.post("?page=send",{message: $("#message-text").next(".emojionearea").find(".emojionearea-editor").html()},function(data){
                          if(data != "")
                          {
                            if(get_last_message_id() == 0)
                            {
                              $(".direct-chat-messages").html("");
                            }
                            
                            $(".direct-chat-messages").append(data);
                            $("#message-text").val("");
                            $("#message-text").next(".emojionearea").find(".emojionearea-editor").html("");
                            $(".direct-chat-messages").stop().animate({ scrollTop: $(".direct-chat-messages")[0].scrollHeight}, 1000);
                          }
                        })
                    }
                  });

                  $(document).on("click",".btn-tool",function(){
                    if($(this).data("card-widget") == "search")
                    {
                        $(".search-box").slideDown();
                    }
                  })

                  $(document).on("click",".attach-image",function(){
                     $(".message-image").trigger("click");
                  })

                  function get_last_message_id(){
                    var lastId = 0;
                    $(".direct-chat-msg").each(function(){
                      lastId = $(this).prop("id");
                    })
                    return lastId;
                  }

                  setInterval(function(){
                    var query = "<?php echo @$_POST['q']; ?>";
                    if(query == "")
                    {
                        $.get("?page=chat_new&last_id=" + get_last_message_id(),{message: $("#message-text").next(".emojionearea").find(".emojionearea-editor").html()},function(data){
                          if(data != "")
                          {
                            $(".direct-chat-messages").append(data);
                            $(".direct-chat-messages").stop().animate({ scrollTop: $(".direct-chat-messages")[0].scrollHeight}, 1000);
                          }   
                        })
                    }
                                        
                  },15000)


                  function readURL(input) {
                    if (input.files && input.files[0]) {
                      var reader = new FileReader();
                      
                      reader.onload = function(e) {
                        compress(e);
                        // $("#message-text").next(".emojionearea").find(".emojionearea-editor").append("<img src='"+e.target.result+"' class='attach-img' />");
                        // $('#blah').attr('src', e.target.result);
                      }
                      
                      reader.readAsDataURL(input.files[0]);
                    }
                  }

                  $(document).on("change",".message-image",function() {
                    compress(this);
                  });

                  $(document).on("click",".direct-chat-msg .attach-img",function(){
                    if(!$(this).hasClass("invalid"))
                    {
                      $(this).addClass("invalid");
                    }else{
                      $(this).removeClass("invalid");
                    }
                  })

                  function ff(height,width,percentage){   
                      var newHeight= 150;
                      var newWidth= 150;
                      return [newWidth,newHeight]; 
                  }

                  function compress(e) {
                      const fileName = e.files[0].name;
                      const reader = new FileReader();
                      reader.readAsDataURL(e.files[0]);
                      reader.onload = event => {
                          const img = new Image();
                          img.src = event.target.result;
                          img.onload = () => {
                                  var newPercent = ff(this.innerHeight,this.innerWidth);
                                  const elem = document.createElement('canvas');
                                  elem.width = newPercent[0];
                                  elem.height = newPercent[1];
                                  const ctx = elem.getContext('2d');

                                  ctx.drawImage(img, 0, 0, newPercent[0], newPercent[1]);
                                  $("#message-text").next(".emojionearea").find(".emojionearea-editor").append("<img src='"+ctx.canvas.toDataURL()+"' class='attach-img' />");
                                  $(".message-image").val("");
                              },
                              reader.onerror = error => console.log(error);
                      };
                  }

                </script>
              <?php } ?>

              <?php if($page == "logs"){ ?> 
              <div class="card" dir="rtl" style="text-align: justify">
                <div class="card-header">
                  <h5 class="m-0">گزارش تعداد چت کاربران در یک دقیقه اخیر</h5>
                </div>
                <div class="card-body">
                  <p class="card-text">
                    <ul dir="ltr">
                      <?php foreach($chatlist as $row){ ?> 
                        <li><?php echo $row['username']; ?> (<?php echo $row['count']; ?> پیغام)</li>
                      <?php } ?>
                      <?php if(count($chatlist) == 0){ ?> 
                        گفتگویی در یک دقیقه اخیر وجود نداشته است.  
                      <?php } ?>
                    </ul>
                  </p>
                </div>
              </div>
              <?php } ?>



            </div>
            <!-- /.col-md-6 -->



          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">
        Anything you want
      </div>
      <!-- Default to the left -->
      <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
</body>

</html>