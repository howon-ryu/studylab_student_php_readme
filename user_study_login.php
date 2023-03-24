<?php
  require_once('m.dbcon.php');


?>

<!DOCTYPE html>
<html lang="ko">
  <!--begin::Head-->
  <head>
    <base href="" />
    <?php
      require_once('head.php');
    ?>
    <meta charset="utf-8" />
    <meta name="description" content="관리형학원 학생관리 솔루션" />
    <meta name="keywords" content="학원CRM, LMS, 관리형 학원 술루션, 학원관리" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="ko_KR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="studylab console" />
    <!-- <meta property="og:url" content="https://keenthemes.com/metronic" /> -->
    <meta property="og:site_name" content="studylab console" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link href="assets/css/media_query.css" rel="stylesheet" type="text/css" />
    <!-- <link rel="shortcut icon" href="assets/media/logos/favicon.ico" /> -->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"
    />
    <!-- <link href="assets/css/timer.css" rel="stylesheet" type="text/css" /> -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@300;400;500;700;900&display=swap"
      rel="stylesheet"
    />
    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used by this page)-->
    <link
      href="assets/plugins/custom/fullcalendar/fullcalendar.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="assets/plugins/custom/datatables/datatables.bundle.css"
      rel="stylesheet"
      type="text/css"
    />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link
      href="assets/plugins/global/plugins.bundle.css"
      rel="stylesheet"
      type="text/css"
    />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/user_layout.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/common.js"></script>
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body
    id="kt_app_body"
    data-kt-app-layout="dark-sidebar"
    data-kt-app-header-fixed="true"
    data-kt-app-sidebar-enabled="true"
    data-kt-app-sidebar-fixed="true"
    data-kt-app-sidebar-hoverable="true"
    data-kt-app-sidebar-push-header="true"
    data-kt-app-sidebar-push-toolbar="true"
    data-kt-app-sidebar-push-footer="true"
    data-kt-app-toolbar-enabled="true"
    class="app-default"
  >
    <!--begin::Theme mode setup on page load-->
    <script>
      var defaultThemeMode = "light";
      var themeMode;
      if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-theme-mode")) {
          themeMode = document.documentElement.getAttribute("data-theme-mode");
        } else {
          if (localStorage.getItem("data-theme") !== null) {
            themeMode = localStorage.getItem("data-theme");
          } else {
            themeMode = defaultThemeMode;
          }
        }
        if (themeMode === "system") {
          themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches
            ? "dark"
            : "light";
        }
        document.documentElement.setAttribute("data-theme", themeMode);
      }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::App-->
    <div class="d-flex flex-column flex-root app-root user_page_wrap user_study_wkp_page" id="kt_app_root">
      <!--begin::Page-->
      <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
        <!--begin::Header-->
        <div id="kt_app_header" class="app-header_student">
          <!--begin::Header container-->
          <div
            class="app-container container-fluid d-flex align-items-stretch justify-content-end"
            id="kt_app_header_container"
          >
            <div class="header__navi_logo">
              <div>
                <button hidden>
                  <img src="assets/media/images/icon_menu_btn.svg" alt="">
                </button>
              </div>
              <!-- <img
                alt="Logo"
                src="<?=$logo_img?>"
                class="h-35px app-sidebar-logo-default ms-8"
              /><span class="fw-normal fs-1 ver_txt ms-7" hidden>행신점</span> -->

              <?php
              error_log("user_study_timer logo_img: ".$logo_img);
              error_log("user_study_timer logo_img_flag: ".$logo_img_flag);
              error_log("user_study_timer service_brand_name: ".$service_brand_name);
                if($logo_img_flag){
                  echo "<img class='login_logo' src='$logo_img' />";
                }else{
                  echo "<h1 style='color:white;'>$service_brand_name</h1>";
                }
              
              ?>




            </div>
            <!--begin::sidebar mobile toggle-->
            <div
              class="d-flex align-items-center d-lg-none ms-n2 me-2"
              title="Show sidebar menu"
            >
            </div>
            <!--end::sidebar mobile toggle-->
            <!--begin::Mobile logo-->
            <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
              <a href="../../demo1/dist/index.html" class="d-lg-none">
                <img
                  alt="Logo"
                  src="assets/media/logos/default-small.svg"
                  class="h-30px"
                  hidden
                />
              </a>
            </div>
            <!--end::Mobile logo-->
            <!--begin::Header wrapper-->
            <div
              class="d-flex align-items-stretch flex-lg-grow-1 justify-content-end"
              id="kt_app_header_wrapper"
            >
              <!--begin::Navbar-->
              <div class="app-navbar flex-shrink-0">
                <p class="befoer_login">로그인 하세요.</p>
              </div>
              <!--end::Navbar-->
            </div>
            <!--end::Header wrapper-->
          </div>
          <!--end::Header container-->
        </div>
        <!--end::Header-->
        <!--begin::Content wrapper-->
        <div class="content_wrap">
          <div class="study_login_wrap">
            <ul class="study_login_box">
              <li>
                <h1>
                  <b>WELCOME !</b><?php echo $abc?>
                  <!-- <b>WELCOME TO</b> WINTER GREEN <?php echo $abc?> -->
                  <!-- 문구 임시로 수정했습니다 230210 -->
                </h1>
              </li>
              <form method="post" action="user_study_login_check.php">

                <li class="login_id">
                  <input type="text" placeholder="아이디" name="loginId">
                </li>
                <li class="login_password">
                  <input type="password" placeholder="비밀번호" name="password">
                </li>
                <li>
                  <button type="submit">
                    LOGIN
                  </button>
                </form>
                <P>아이디 및 비밀번호 분실은 소속 학습관에 문의하세요.</P>
              </li>
            </ul>
          </div>
        </div>
        <!--end::Content wrapper-->
        <!--begin::footer-->
        <footer class="ft_commen_wrap">
          <ul class="ft_commen">
            <li class="ft_li01 hidden">
              <a href="#">
                <span class="ft_icon ft_icon01 "></span>
                <span>Report</span>
              </a>
            </li>
            <li class="ft_li02 hidden">
              <a href="#">
                <span class="ft_icon ft_icon02 "></span>
                <span>To Do List</span>
              </a>
            </li>
            <li class="ft_li03">
              <p>.</p>
            </li>
          </ul>
        </footer>
        <!--end::footer-->
      </div>
      <!--end::Page-->
    </div>
    <!--end::App-->
    <!--begin::Engage drawers-->
    <!--end::Engage drawers-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
      <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
      <span class="svg-icon">
        <svg
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <rect
            opacity="0.5"
            x="13"
            y="6"
            width="13"
            height="2"
            rx="1"
            transform="rotate(90 13 6)"
            fill="currentColor"
          />
          <path
            d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
            fill="currentColor"
          />
        </svg>
      </span>
      <!--end::Svg Icon-->
    </div>
    <!--end::Scrolltop-->

    <!--begin::Javascript-->
    <script>
      var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Vendors Javascript(used by this page)-->
    <script src="assets/plugins/custom/fullcalendar/fullcalendar.js"></script>
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="assets/plugins/custom/formrepeater/formrepeater.bundle.js"></script>
    <!--end::Vendors Javascript-->
    <!--begin::Custom Javascript(used by this page)-->
    <!-- <script src="assets/js/custom/apps/calendar/calendar.js"></script> -->
    <script src="assets/js/custom/apps/ecommerce/sales/save-order.js"></script>
    <script src="assets/js/custom/apps/projects/list/list.js"></script>
    <script src="assets/js/custom/apps/projects/users/users.js"></script>
    <script src="assets/js/widgets.bundle.js"></script>
    <script src="assets/js/custom/widgets.js"></script>
    <script src="assets/js/custom/apps/chat/chat.js"></script>
    <script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>
    <script src="assets/js/custom/utilities/modals/create-app.js"></script>
    <script src="assets/js/custom/utilities/modals/users-search.js"></script>
    <script src="assets/js/custom/utilities/modals/new-target.js"></script>
    

    <!--end::Javascript-->
  </body>
  <!--end::Body-->
</html>
