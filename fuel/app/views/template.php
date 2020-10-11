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
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->

  <script type="text/javascript">
    /*
     *
     * Custom Scripts
     *
     */

    function sendChat() {
      /*
       * send chat by url
       */
      $.get(url);
    }


    // send button click event

    /*
     *
     * Custom Scripts
     *
     */
  </script>
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
          <a href="index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
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
          <div class="image">
            <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Starter Pages
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Active Page</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Inactive Page</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Simple Link
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li>
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
            <div class="col-lg-6">



              <div class="card" dir="rtl" style="text-align: justify">
                <div class="card-header">
                  <h5 class="m-0">ورود کاربر فقط با یوزرنیم(بدون پسورد) و نمایش اسم آن بعد از ورود</h6>
                </div>
                <div class="card-body">
                  <p class="card-text">

                  </p>

                  <div class="card-footer" dir="ltr">
                    <form action="#" metod="post">
                      <div class="input-group">
                        <input type="text" name="message" placeholder="نام کاربری" class="form-control">
                        <span class="input-group-append">
                          <button type="submit" class="btn btn-primary">ورود</button>
                        </span>
                      </div>
                    </form>
                  </div>
                  <!-- /.card-footer-->
                </div>
              </div>

              <div id="ajax-chats-loads-here" class="card card-prirary cardutline direct-chat direct-chat-primary">
                <div class="card-header">
                  <h3 class="card-title">Direct Chat</h3>

                  <div class="card-tools">
                    <span data-toggle="tooltip" title="3 New Messages" class="badge bg-primary">3</span>
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
                    <!-- Message. Default to the left -->
                    <div class="direct-chat-msg">
                      <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">Alexander Pierce</span>
                        <span class="direct-chat-timestamp float-right">شنبه 5 فرودین 1400</span>
                      </div>
                      <!-- /.direct-chat-infos -->
                      <img class="direct-chat-img" src="./dist/img/user1-128x128.jpg" alt="Message User Image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        سلام!
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->

                    <!-- Message to the right -->
                    <div class="direct-chat-msg right">
                      <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right">Sarah Bullock</span>
                        <span class="direct-chat-timestamp float-left">شنبه 5 فرودین 1400</span>
                      </div>
                      <!-- /.direct-chat-infos -->
                      <img class="direct-chat-img" src="./dist/img/user3-128x128.jpg" alt="Message User Image">
                      <!-- /.direct-chat-img -->
                      <div class="direct-chat-text">
                        You better believe it!
                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->
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
                <div class="card-footer">
                  <form action="#" metod="post">
                    <div class="input-group">
                      <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                      <span class="input-group-append">
                        <button type="submit" class="btn btn-primary">Send</button>
                      </span>
                    </div>
                  </form>
                </div>
                <!-- /.card-footer-->
              </div>


              <div class="card" dir="rtl" style="text-align: justify">
                <div class="card-header">
                  <h5 class="m-0">کاربران پر چت (گزارش کاربران با تعداد چت بیشتر از یک) + تعداد چت</h5>
                  <h6 class="m-0">به ترتیب بیشترین چت از بالا(بیشترین) به پایین(کمترین)</h6>
                </div>
                <div class="card-body">
                  <p class="card-text">
                    <ul dir="ltr">
                      <li>[14]Chat: Admin system</li>
                      <li>[CountOfChats]Chat: The Customer</li>
                    </ul>
                  </p>
                </div>
              </div>



            </div>
            <!-- /.col-md-6 -->


            <div class="col-lg-6" dir="rtl" style="text-align: justify">
              <div class="card">
                <div class="card-header">
                  <h5 class="m-0">موارد مهم و نکات آزمون</h5>
                </div>
                <div class="card-body">
                  <p class="card-text">
                    <ol>
                      <li>فریم ورک استفاده در این پروژه FuelPHP نام دارد و داکیومنت آن در وب سایتش قابل دسترسی است.</li>
                      <li>قالب استفاده در این آزمون AdminLTE نسخه 3 هست که جعبه ابزار ابزارک ها و رنگ ها و داکیومنت آن با جستجو در وب قابل دسترسی است.</li>
                      <li> زمان شروع پروژه را ثبت نمایید زیرا مدت زمان انجام پروژه اهمیت بالایی دارد و در پایان مدت زمان انجام پروژه را برای ما ارسال کنید.</li>
                      <li>ساختار دیتابیس این پروژه را خودتان طراحی و پیاده سازی می کنید</li>
                      <!-- <li></li>
                      <li></li>
                      <li></li>
                      <li></li> -->
                    </ol>
                  </p>
                </div>
              </div>

              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="m-0">امکانات درخواستی در پروژه</h5>
                </div>
                <div class="card-body">
                  <p class="card-text">
                    <ul>
                      <li>با رفتن موس روی دکمه send در چت دکمه به صورت متحرک کمی بزرگ شود و با خارج شدن موس با انیمیشن به حالت اول برگردد. راهنمایی: از css3 استفاده کنید.</li>
                      <li>دو کاربر admin و customer تعریف کنید که بتوان فقط با ورود نام کاربری به آنها لاگین کرد. تصویر ادمین به صورت ثابت آقا باشد و تصویر مشتری خانم.</li>
                      <li>دکمه خروج از حساب کاربری طراحی کنید</li>
                      <li>کاربری که لاگین نکرده نمی تواند چتی اضافه کند و باید به صورت مناسب این موضوع به کاربر اطلاع رسانی شود</li>
                      <li>کاربر توسط username به سیستم وارد می شود و پس از ورود یوزرنیم و نام آن که با username با یک پیغام خوش آمد گویی نمایش داده می شود.</li>
                      <li>چت های ادمین در سمت چپ و چت های مشتری در سمت راست نمایش داده شوند.</li>
                      <li>بتواند متن، ایموجی های تلگرام و هر کاراکتری را در چت ارسال کند، در سرور ذخیره شود</li>
                      <li>متنی که به تازگی ارسال می شود می بایست در صفحه چت نمایش داده شود</li>
                      <li>چت ها به صورت هر 15 ثانیه یکبار تازه سازی شوند تا اگر چت جدیدی اضافه شده باشد، نمایش داده شود.</li>
                      <li>امکان جستجو با کوئری سمت سرور و نمایش نتایج آن در صفحه وجود داشته باشد</li>
                      <li>بتواند یک تصویر در چت ارسال کند و آن تصویر در متن نمایش داده شود</li>
                      <li>با کلیک بر روی تصویر در چت، تصویر عدم نمایش شود. این کار را با جیکوئری و با کلاس دادن به عکس انجام دهید.</li>
                      <li>گزارش تعداد کاربرای که بیش از یک چت در یک دقیقه گذشته داشته اند نمایش داده شود.</li>
                      <!-- <li></li>
                      <li></li>
                      <li></li>
                      <li></li>
                      <li></li>
                      <li></li> -->
                    </ul>
                  </p>
                </div>
              </div>
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