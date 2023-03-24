
<!DOCTYPE html>
<html lang="ko">
  <?php
  require_once('m.dbcon.php');
  require_once('header_session.php');

  $USER_ID=$_SESSION["id"];
  $q="SELECT * FROM
        activity_item_log
        WHERE
        item_id=
            (SELECT id FROM `activity_item` 
            WHERE 
            user_id=$USER_ID
            AND
            status='ACTIVE')
        ORDER BY
        id
        DESC
        LIMIT 1";
  $query_result=sql_query($q);
  if ($query_result == true) 
  {
    $row = $query_result->fetch_array();
    $item_id=$row['item_id'];

    if($row['end_time']==null){
      $has_active=1;
    }else{
      $has_active=0;
    }
  }
  else
  {
    $has_active=0;
  }
  error_log("branch_id:$branch_id");
    $brand_name=$_SESSION['brandName'] ;
    $branch_name=$_SESSION['branchName'];
    $branch_id=$_SESSION['branchId'];
    $room_name= $_SESSION['roomName'] ;
    $seat_number = $_SESSION['seatNumber'];
    $brand_id = $_SESSION['brandId'];
    $hostname=$_SERVER["HTTP_HOST"];
    $exploded_hostname=explode('.',$hostname);
    $service_domain=$exploded_hostname[0];
  
?>
  <!--begin::Head-->
  <head>
    <base href="" />
    <!-- <title>겨울신록 ADMIN</title> -->
    <meta charset="utf-8" />
    <meta name="description" content="학원관리 솔루션" />
    <meta name="keywords" content="겨울신록, 학원 CRM, 학원운영, 학원관리" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta property="og:locale" content="ko_KR" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="겨울신록 ADMIN" />
    <!-- <meta property="og:url" content="https://keenthemes.com/metronic" /> -->
    <meta property="og:site_name" content="겨울신록 ADMIN" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <!-- <link rel="shortcut icon" href="assets/media/logos/favicon.ico" /> -->
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700"
    />
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
    <style>
      #radarchartdiv {
        width: 100%;
        height: 300px;
      }
      #solidchartdiv {
        width: 100%;
        height: 300px;
      }
      #wafflechartdiv{
        width: 90%;
        height: 300px;
        
        margin: 0 auto;
      }
      #stackedchartdiv{
        width: 90%;
        height: 300px;
        
        margin: 0 auto;
      }
      #animatedchartdiv{
        width: 100%;
        height: 250px;
      }
    </style>
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/layout.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/user_layout.css" rel="stylesheet" type="text/css" />
    <!-- timer css 추가 221130 -->
    <link href="assets/css/timer.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/calendar_popup.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/media_query.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/common.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <!-- <link rel="icon" type="image/png" href="<?=$favicon_img?>" /> -->
    <?php
      require_once('head.php');
    ?>
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
    class="app-default no-scroll"
  >
  <script>
    var user_id = <?=$_SESSION['id']?>;
    
  </script>
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
    <div class="d-flex flex-column flex-root app-root user_page_wrap user_study_timer_page" id="kt_app_root">
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

              <!-- <span class="fw-normal fs-1 ver_txt ms-7 logo_img"  > -->

                
              <?php
              error_log("user_study_timer logo_img: ".$logo_img);
              error_log("user_study_timer logo_img_flag: ".$logo_img_flag);
              error_log("user_study_timer service_brand_name: ".$serivce_brand_name);
              if($logo_img_flag){
                echo "<img src='$logo_img' />";
              }else{
                echo "<h1 style='color:white;'>$service_brand_name</h1>";
              }
              
              ?>
              <!-- </span> -->

              <!-- <span class="fw-normal fs-1 ver_txt ms-7" > <?=$brand_name?></span> -->
              <span class="fw-normal fs-1 ver_txt ms-7" > <?=$branch_name?></span>
              <span class="fw-normal fs-1 head_txt ms-7" > <?=$room_name?> - <?=$seat_number?></span>
              
            </div>
            <!--begin::sidebar mobile toggle-->
            <div
              class="d-flex align-items-center d-lg-none ms-n2 me-2"
              title="Show sidebar menu"
            >
            </div>
            <!--end::sidebar mobile toggle-->
            <!--begin::Mobile logo-->
            <!-- <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
              <a href="../../demo1/dist/index.html" class="d-lg-none">
                <img
                  alt="Logo"
                  src="assets/media/logos/default-small.svg"
                  class="h-30px"
                />
              </a>
            </div> -->
            <!--end::Mobile logo-->
            <!--begin::Header wrapper-->
            <!-- 23.01 flex-lg-grow-1 삭제/header_wrap 추가 -->
            <div
              class="d-flex align-items-stretch user_wrap justify-content-end"
              id="kt_app_header_wrapper"
            >
              <!--begin::Navbar-->
              <div class="app-navbar flex-shrink-0">
                <!--begin::User menu-->
                <div
                  class="app-navbar-item ms-1 ms-lg-3"
                  id="kt_header_user_menu_toggle"
                >
                  <!--begin::Menu wrapper-->
                  <div
                    class="cursor-pointer symbol symbol-35px symbol-md-40px d-flex navbar__item_user"
                    data-kt-menu-trigger="click"
                    data-kt-menu-attach="parent"
                    data-kt-menu-placement="bottom-end"
                  >
                    <img src="assets/media/images/icon_user.png" alt="user" />
                    <span class="d-flex align-items-center fs-1"
                      ><?=$_SESSION['realName']?></span
                    ><!-- 22.12 fs-4 > fs-1 변경 -->
                  </div>
                  <!--begin::User account menu-->
                  <div
                    class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                    data-kt-menu="true"
                    hidden
                  >
                    <!--begin::Menu item-->
                    <div class="menu-item px-3">
                      <div class="menu-content d-flex align-items-center px-3">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-50px me-5">
                          <img
                            alt="Logo"
                            src="assets/media/avatars/user_empty.png"
                          />
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Username-->
                        <div class="d-flex flex-column">
                          <div class="fw-bold d-flex align-items-center fs-5">
                            이름
                            <span
                              class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2"
                              >Pro</span
                            >
                          </div>
                          <a
                            href="#"
                            class="fw-semibold text-muted text-hover-primary fs-7"
                            >max@kt.com</a
                          >
                        </div>
                        <!--end::Username-->
                      </div>
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu separator-->
                    <div class="separator my-2"></div>
                    <!--end::Menu separator-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5 my-1">
                      <a
                        href="../../demo1/dist/account/settings.html"
                        class="menu-link px-5"
                        >내 정보 수정</a
                      >
                    </div>
                    <!--end::Menu item-->
                    <!--begin::Menu item-->
                    <div class="menu-item px-5">
                      <a
                        href="../../demo1/dist/authentication/layouts/corporate/sign-in.html"
                        class="menu-link px-5"
                        >로그아웃</a
                      >
                    </div>
                    <!--end::Menu item-->
                  </div>
                  <!--end::User account menu-->
                  <!--end::Menu wrapper-->
                </div>
                <!--end::User menu-->
                <!--begin::나가기 -->
                <div class="app-navbar-item"> <!-- 23.01 ms-15 삭제 -->
                  <div class="d-flex align-items-center">
                    <a href="logout.php">
                      <img src="assets/media/images/timer/btn_logout.png" alt="나가기">
                    </a>
                  </div>
                </div>
                <!--end::나가기 -->
              </div>
              <!--end::Navbar-->
            </div>
            <!--end::Header wrapper-->
          </div>
          <!--end::Header container-->
        </div>
        <!--end::Header-->
        <!--begin::Content wrapper-->
        
        <div class = "pop_wrap_cover">
          <div class = "pop_wrap" id = "popupstatus" style = "visibility:hidden">
            <div class="calender_wrap_popup" id = "popup" >
              <div class="popuptitle">
                <h1>학습계획
                </h1>
                <button onclick="popup()">
                  <span><img alt="닫기" src="/assets/media/images/timer/icon_close_on.png"></span>
                </button>
              </div>
              <div class="calender_content">
                <!--begin::Calendar-->
                <div id="kt_calendar_app"></div>
                <!--end::Calendar-->
              </div>
            </div>

            <div class="modal fade" id="kt_modal_add_event" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
              <div class="modal-dialog modal-dialog-centered mw-650px">
              <!--begin::Modal content-->
              <div class="modal-content">
              <!--begin::Form-->
              <form class="form" action="#" id="kt_modal_add_event_form">
              <!--begin::Modal header-->
              <div class="modal-header popupuptitle">
                <!--begin::Modal title-->
                <h2 class="fw-bold" data-kt-calendar="title">Add Event</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="항목 삭제" id="kt_modal_view_event_delete">
                  <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                  <span class="svg-icon svg-icon-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
                      <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
                      <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
                    </svg>
                  </span>
                  <!--end::Svg Icon-->
                </div>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" id="kt_modal_add_event_close" data-bs-dismiss="modal">
                  <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                  <span class="svg-icon svg-icon-1">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                      <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                    </svg>
                  </span>
                  <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
              </div>
              <!--end::Modal header-->
              <!--begin::Modal body-->
              <div class="modal-body py-10 px-lg-17">
                <!--begin::Input group-->
                
                <div class="fv-row mb-9">
                  <div class = "grid_container">
                      <!--begin::Label-->
                    <div class = "grid_item1">
                      <label class="fs-6 fw-semibold required mb-2">학습분류</label>
                      <select
                                            id = "eventCode"
                                            name="calendar_event_code"
                                            class="form-select form-select-solid mb-4"
                                            data-kt-select2="true"
                                            data-placeholder="선택"
                                            
                                            data-allow-clear="true"
                                            >
                                            </select>
                    </div>
                    <div class = "grid_item2">

                      <label class="fs-6 fw-semibold required mb-2">학습항목</label>
                      <!--end::Label-->
                      <!--begin::Input-->
                      <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_name" />
                      <!--end::Input-->
                    </div>
                  </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-9" hidden>
                  <!--begin::Label-->
                  <label class="fs-6 fw-semibold mb-2">Event Description</label>
                  <!--end::Label-->
                  <!--begin::Input-->
                  <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_description" />
                  <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-9" hidden>
                  <!--begin::Label-->
                  <label class="fs-6 fw-semibold mb-2">Event Location</label>
                  <!--end::Label-->
                  <!--begin::Input-->
                  <input type="text" class="form-control form-control-solid" placeholder="" name="calendar_event_location" />
                  <!--end::Input-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="fv-row mb-9" hidden>
                  <!--begin::Checkbox-->
                  <label class="form-check form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="" id="kt_calendar_datepicker_allday" />
                    <span class="form-check-label fw-semibold" for="kt_calendar_datepicker_allday">All Day</span>
                  </label>
                  <!--end::Checkbox-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row row-cols-lg-2 g-10">
                  <div class="col">
                    <div class="fv-row mb-9">
                      <!--begin::Label-->
                      <label class="fs-6 fw-semibold mb-2 required">학습일자</label>
                      <!--end::Label-->
                      <!--begin::Input-->
                      <input class="form-control form-control-solid" name="calendar_event_start_date" placeholder="Pick a start date" id="kt_calendar_datepicker_start_date" />
                      <!--end::Input-->
                    </div>
                  </div>
                  <div class="col" data-kt-calendar="datepicker">
                    <div class="fv-row mb-9">
                      <!--begin::Label-->
                      <label class="fs-6 fw-semibold mb-2">시작시간</label>
                      <!--end::Label-->
                      <!--begin::Input-->
                      <input class="form-control form-control-solid" name="calendar_event_start_time" placeholder="시작 시간을 선택해주세요" id="kt_calendar_datepicker_start_time" />
                      <!--end::Input-->
                    </div>
                  </div>
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row row-cols-lg-2 g-10">
                  <div class="col">
                    <div class="fv-row mb-9" hidden>
                      <!--begin::Label-->
                      <label class="fs-6 fw-semibold mb-2 required">종료일</label>
                      <!--end::Label-->
                      <!--begin::Input-->
                      <input class="form-control form-control-solid" name="calendar_event_end_date" placeholder="시작 시간을 선택해주세요" id="kt_calendar_datepicker_end_date" />
                      <!--end::Input-->
                    </div>
                  </div>
                  <div class="col" data-kt-calendar="datepicker">
                    <div class="fv-row mb-9">
                      <!--begin::Label-->
                      <label class="fs-6 fw-semibold mb-2">종료시간</label>
                      <!--end::Label-->
                      <!--begin::Input-->
                      <input class="form-control form-control-solid" name="calendar_event_end_time" placeholder="종료 시간을 선택해주세요" id="kt_calendar_datepicker_end_time" />
                      <!--end::Input-->
                    </div>
                  </div>
                </div>
                <!--end::Input group-->
              </div>
              <!--end::Modal body-->
              <!--begin::Modal footer-->
              <div class="modal-footer flex-center">
                <!--begin::Button-->
                <button type="reset" id="kt_modal_add_event_cancel" class="btn btn-light me-3">취소</button>
                <!--end::Button-->
                <!--begin::Button-->
                <button type="button" id="kt_modal_add_event_submit" class="btn btn-primary">
                  <span class="indicator-label">저장</span>
                  <span class="indicator-progress">저장
                  <!-- <span class="spinner-border spinner-border-sm align-middle ms-2"></span> -->
                  </span>
                </button>
                <!--end::Button-->
              </div>
              <!--end::Modal footer-->
            </form>
            <!--end::Form-->
            </div>
            </div>
            </div>
          
          
            <!--end::Modal - New Product-->
            <!--begin::Modal - New Product-->
            <div class="modal fade" id="kt_modal_view_event" tabindex="-1" aria-hidden="true">
              <!--begin::Modal dialog-->
              <div class="modal-dialog modal-dialog-centered mw-650px">
                <!--begin::Modal content-->
                <div class="modal-content">
                  <!--begin::Modal header-->
                  <div class="modal-header popupuptitle border-0 justify-content-end">
                    <!--begin::Edit-->
                    <h2>학습 항목</h2>
                    <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-primary me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="항목 수정" id="kt_modal_view_event_edit">
                      <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                      <span class="svg-icon svg-icon-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor" />
                          <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor" />
                        </svg>
                      </span>
                      <!--end::Svg Icon-->
                    </div>
                    <!--end::Edit-->
                    <!--begin::Edit-->
                    <div class="btn btn-icon btn-sm btn-color-gray-400 btn-active-icon-danger me-2" data-bs-toggle="tooltip" data-bs-dismiss="click" title="항목 삭제" id="kt_modal_view_event_delete">
                      <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                      <span class="svg-icon svg-icon-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
                          <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
                          <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
                        </svg>
                      </span>
                      <!--end::Svg Icon-->
                    </div>
                    <!--end::Edit-->
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-color-gray-500 btn-active-icon-primary" data-bs-toggle="tooltip" title="닫기" data-bs-dismiss="modal">
                      <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                      <span class="svg-icon svg-icon-1">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                          <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                      </span>
                      <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                  </div>
                  <!--end::Modal header-->
                  <!--begin::Modal body-->
                  <div class="modal-body pt-0 pb-20 px-lg-17">
                    <!--begin::Row-->
                    <div class="d-flex" style="margin-top: 60px;">
                      <!--begin::Icon-->
                      <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                      <span class="svg-icon svg-icon-1 svg-icon-muted me-5">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="currentColor" />
                          <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="currentColor" />
                          <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="currentColor" />
                        </svg>
                      </span>
                      <!--end::Svg Icon-->
                      <!--end::Icon-->
                      <div class="mb-9">
                        <!--begin::Event name-->
                        <div class="d-flex align-items-center mb-2">
                          <span class="fs-3 fw-bold me-3" data-kt-calendar="event_name"></span>
                          <span class="badge badge-light-success" data-kt-calendar="all_day"hidden></span>
                        </div>
                        <!--end::Event name-->
                        <!--begin::Event description-->
                        <div class="fs-6" data-kt-calendar="event_description"hidden></div>
                        <!--end::Event description-->
                      </div>
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="d-flex align-items-center mb-2">
                      <!--begin::Icon-->
                      <!--begin::Svg Icon | path: icons/duotune/abstract/abs050.svg-->
                      <span class="svg-icon svg-icon-1 svg-icon-success me-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                          <circle fill="currentColor" cx="12" cy="12" r="8" />
                        </svg>
                      </span>
                      <!--end::Svg Icon-->
                      <!--end::Icon-->
                      <!--begin::Event start date/time-->
                      <div class="fs-6">
                        <span class="fw-bold">시작시간</span>
                        <span data-kt-calendar="event_start_date"></span>
                      </div>
                      <!--end::Event start date/time-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="d-flex align-items-center mb-9">
                      <!--begin::Icon-->
                      <!--begin::Svg Icon | path: icons/duotune/abstract/abs050.svg-->
                      <span class="svg-icon svg-icon-1 svg-icon-danger me-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                          <circle fill="currentColor" cx="12" cy="12" r="8" />
                        </svg>
                      </span>
                      <!--end::Svg Icon-->
                      <!--end::Icon-->
                      <!--begin::Event end date/time-->
                      <div class="fs-6" >
                        <span class="fw-bold">종료시간</span>
                        <span data-kt-calendar="event_end_date"></span>
                      </div>
                      <!--end::Event end date/time-->
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="d-flex align-items-center">
                      <!--begin::Icon-->
                      <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                      <!-- <span class="svg-icon svg-icon-1 svg-icon-muted me-5">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="currentColor" />
                          <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="currentColor" />
                        </svg>
                      </span> -->
                      <!--end::Svg Icon-->
                      <!--end::Icon-->
                      <!--begin::Event location-->
                      <div class="fs-6" data-kt-calendar="event_location" hidden></div>
                      <!--end::Event location-->
                    </div>
                    <!--end::Row-->
                  </div>
                  <!--end::Modal body-->
                </div>
              </div>
            </div>
          </div>





          <!-- // 학습레포트 -->
          <div class = "reportPopWrap" id = "reportPopStatus" style = "visibility:hidden">
           
              
              <div id="popup_wrap">
                  <div class="popuptitle">				
                    <h2><img alt="리포트" src="/assets/media/images/timer/btn_report_on.png">Report</h2>
                    <button onclick="reportPop()">
                      <span><img alt="닫기" src="/assets/media/images/timer/icon_close_on.png"></span>
                    </button>
                  </div>
                  <!-- <div class = "reportTab">
                    
                    <div class = "tab_btn daily_btn on"><span class="btnText">Daily</span></div>
                    <div class = "tab_btn weekly_btn"><span class="btnText">Weekly</span></div>
                    <div class = "tab_btn monthly_btn"><span class="btnText">Monthly</span></div>
                    <div class = "tab_btn color_btn" id = "colorBtn" hidden>color</div>
                    
                    
                  </div> -->
                  <!-- <div id="report_tab">
                    <div class = "tab_btn daily_btn on"><span class="btnText">일간</span></div>
                    <div class = "tab_btn weekly_btn"><span class="btnText">주간</span></div>
                    <div class = "tab_btn monthly_btn"><span class="btnText">월간</span></div>
                    <div class = "tab_btn color_btn" id = "colorBtn" hidden>color</div>
                  </div>			   -->
                  <div id="report_tab">
                    <dd class="tab_on daily_btn"><a>일간</a></dd>
                    <dd class="tab_off weekly_btn">주간</dd>
                    <dd class="tab_off monthly_btn"><a>월간</a></dd>
                    <dd class = "tab_btn color_btn" id = "colorBtn" hidden>color</dd>
                  </div>			  
                  
                  <div id="report_contents">
                    <dr>
                    <dd class="report_left">
                      
                      <div id="kt_calendar_app_report"></div>
                      <!-- <table id="report_calender" width="200" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                          <th scope="col">일</th>
                          <th scope="col">월</th>
                          <th scope="col">화</th>
                          <th scope="col">수</th>
                          <th scope="col">목</th>
                          <th scope="col">금</th>
                          <th scope="col">토</th>
                        </tr>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>1</td>
                          <td>2</td>
                          <td>3</td>
                          <td>4</td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>6</td>
                          <td>7</td>
                          <td>8</td>
                          <td>9</td>
                          <td>10</td>
                          <td>11</td>
                        </tr>
                        <tr>
                          <td>12</td>
                          <td class="date_1h">13</td>
                          <td class="date_3h">14</td>
                          <td class="date_5h">15</td>
                          <td class="date_10h">16</td>
                          <td class="date_maxi">17</td>
                          <td>18</td>
                        </tr>
                        <tr>
                          <td>19</td>
                          <td>20</td>
                          <td>21</td>
                          <td>22</td>
                          <td>23</td>
                          <td>24</td>
                          <td>25</td>
                        </tr>
                        <tr>
                          <td>26</td>
                          <td>27</td>
                          <td>28</td>
                          <td>29</td>
                          <td>30</td>
                          <td>31</td>
                          <td>&nbsp;</td>
                        </tr>
                        </tbody>
                      </table> -->
                      <list class="calender_color">
                        <li><span class="date_1h"></span></li>
                        <li><span class="date_3h"></span></li>
                        <li><span class="date_5h"></span></li>
                        <li><span class="date_10h"></span></li>
                        <li><span class="date_maxi"></span></li>
                      </list>
                      <list class="calender_info">
                        <li>1h 미만</li>
                        <li>3h 미만</li>
                        <li>5h 미만</li>
                        <li>10h 미만</li>
                        <li>10h 이상</li>
                      </list>
                      <div class="report_date" id = "report_date"></div>
                      <table id="report_hours" width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tbody>
                        <tr>
                          <th scope="col" hidden>학습 시작</th>
                          <th scope="col">경과 시간</th>
                          <th scope="col">순공 시간</th>
                          <th scope="col">학습 만족도</th>
                        </tr>
                        
                          
                        <tr>
                          <td hidden><div class="report_time"id = "studyStartDateTime">10:10:12</div></td>
                          <td><div class="report_time" id = "totalStayTime">103:30:43</div></td>
                          <td><div class="report_time puretime" id = "totalStudyTime">71:55:12</div></td>
                          <td><div class="report_time " id = "avgStudyRate"></div></td>
                          
                        </tr>
                        </tbody>
                      </table>
                      <div class ="animated_graph">순공효율(%)</div>
                      <!-- 그래프 이미지로 자리만 잡았어요. 비슷한 사이즈로 넣어주세요. -->
                      <div class="report_graph">
                        <div class = "animatedChart " id="animatedchartdiv"></div>      
                      </div>
                    </dd>
                    <dd>
                      <h3>과목별 학습 만족도</h3>
                      <!-- 그래프 이미지로 자리만 잡았어요. 비슷한 사이즈로 넣어주세요. -->
                      <div class="report_graph">
                        <div class = "radarChart " id="radarchartdiv"></div>             
                      </div>
                      <h3>과목별 순공 와플차트</h3>
                      <!-- 그래프 이미지로 자리만 잡았어요. 비슷한 사이즈로 넣어주세요. -->
                      <div class="report_graph">
                        <div class = "waffleChart " id="wafflechartdiv"></div>            
                      </div>
                    </dd>
                    <dd>
                    <h3>과목별 목표대비 순공(%)</h3>
                      <!-- 그래프 이미지로 자리만 잡았어요. 비슷한 사이즈로 넣어주세요. -->
                      <div class="report_graph">
                        <div class = "solidChart " id="solidchartdiv"></div>
                        
                        
                      </div>
                      
                      <h3>주간 과목별 누적 순공 추이</h3>
                      <!-- 그래프 이미지로 자리만 잡았어요. 비슷한 사이즈로 넣어주세요. -->
                      <div class="report_graph">
                      <div class = "stackedChart " id="stackedchartdiv"></div>          
                      </div>					  
                    </dd>
                    </dr>
                  </div>
                </div>
              <!-- <div class = "reportContnet">
                <div class ="reportCalender" id="reportCalender">
                <div id="kt_calendar_app_report"></div>
                <div class = "calendarLengend">
                  <span> <span id ="square1">ㅁ</span>  ~1h</span>
                  <span><span id ="square2">ㅁ</span>  ~3h</span>
                  <span><span id ="square3">ㅁ</span>  ~5h</span>
                  <span><span id ="square4">ㅁ</span>  ~10h</span>
                  <span><span id ="square5">ㅁ</span>  10h~</span>
                </div>
                </div>
                <div class ="reportInfoWhole">
                  
                  <div class = "reportTab">
                    
                    <div class = "tab_btn daily_btn on"><span class="btnText">Daily</span></div>
                    <div class = "tab_btn weekly_btn"><span class="btnText">Weekly</span></div>
                    <div class = "tab_btn monthly_btn"><span class="btnText">Monthly</span></div>
                    <div class = "tab_btn color_btn" id = "colorBtn" hidden>color</div>
                    
                    
                  </div>
                  <div class = "reportPeriod_wrap">
                    <div class = "reportPeriod" id = "reportPeriod"></div>
                  </div>
                  <div class ="reportInfo">
                    <div class ="reportInfoLeft">
                      <div class ="reportInfoTime">
                        <span class = "reportInfoTimeTitle">순공시간/만족도</span>
                        <div class ="reportInfoTimeContent">
                          <span class = "flexcss">학습시작: <div id = "studyStartDateTime"></div></span>
                          <span class = "flexcss">경과시간: <div id = "totalStayTime"></div> </span>
                          <span class = "flexcss">순공시간: <div id = "totalStudyTime"></div> </span>
                          <span class = "flexcss">학습만족도: <div id = "avgStudyRate"></div></span>
                        </div>
                        <div class = "animatedChart " id="animatedchartdiv"></div>
                      </div>
                      <div class ="reportInfoRank">
                      <span class = "reportInfoTimeTitle">학습랭킹</span>
                      </div>
                    </div>
                    <div class ="reportInfoRight">
                      
                      
                      <div class="right1_up">
                      
                        <div class = "waffleChart " id="wafflechartdiv"></div>
                      </div>
                      <div class="right1_down">
                        <div class = "radarChart " id="radarchartdiv"></div>
                      </div>

                    </div>
                    <div class ="reportInfoRight">
                      <div class="right2_up">
                        <div class = "solidChart " id="solidchartdiv"></div>
                      </div>
                      <div class="right2_down">
                        <div class = "stackedChart " id="stackedchartdiv"></div>
                        
                      </div>
                        


                    </div>
                    <div class ="reportInfoRight">
                    <div class="right3_up">
                    <span class = "reportInfoTimeTitle dailyToDo " >공부 To Do</span>
                      <figure class="highcharts-figure hidden" id = "reportPieChart">
                            <div id="container"></div>
                            
                        </figure>
                    </div>
                      
                    <div class="right3_down">
                      
                    </div>
                      


                    </div>
                
                  </div>
                </div>
               
              </div> -->
           
          </div>


          <!-- 평점팝업 -->
          <div class = "starPopWrap" id = "starPopStatus" style = "visibility:hidden">
           <div class="star_wrap_popup" id = "popupStar">
              <div class="popuptitle">
                <h1>평점
                </h1>
                <button onclick="starPop()">
                  <span><img alt="닫기" src="/assets/media/images/timer/icon_close_on.png"></span>
                </button>
              </div>
              <div class = "startRadio_wrap"> 
                <div class="startRadio">
                  <label class="startRadio__box">
                    <input type="radio" name="star" value = "0.5"  id="" onclick = "starRate = this.value">
                    <span class="startRadio__img"><span class="blind">별 0.5개</span></span>
                  </label>
                  <label class="startRadio__box">
                    <input type="radio" name="star" value = "1" id="" onclick = "starRate = this.value">
                    <span class="startRadio__img"><span class="blind">별 1개</span></span>
                  </label>
                  <label class="startRadio__box">
                    <input type="radio" name="star" value = "1.5" id="" onclick = "starRate = this.value">
                    <span class="startRadio__img"><span class="blind">별 1.5개</span></span>
                  </label>
                  <label class="startRadio__box">
                    <input type="radio" name="star" value = "2" id="" onclick = "starRate = this.value">
                    <span class="startRadio__img"><span class="blind">별 2개</span></span>
                  </label>
                  <label class="startRadio__box">
                    <input type="radio" name="star" value = "2.5" id="" onclick = "starRate = this.value">
                    <span class="startRadio__img"><span class="blind">별 2.5개</span></span>
                  </label>
                  <label class="startRadio__box">
                    <input type="radio" name="star" value = "3" id="" onclick = "starRate = this.value">
                    <span class="startRadio__img"><span class="blind">별 3개</span></span>
                  </label>
                  <label class="startRadio__box">
                    <input type="radio" name="star" value = "3.5" id="" onclick = "starRate = this.value">
                    <span class="startRadio__img"><span class="blind">별 3.5개</span></span>
                  </label>
                  <label class="startRadio__box">
                    <input type="radio" name="star" value = "4" id="" onclick = "starRate = this.value">
                    <span class="startRadio__img"><span class="blind">별 4개</span></span>
                  </label>
                  <label class="startRadio__box">
                    <input type="radio" name="star"value = "4.5" id="" onclick = "starRate = this.value">
                    <span class="startRadio__img"><span class="blind">별 4.5개</span></span>
                  </label>
                  <label class="startRadio__box">
                    <input type="radio" name="star" value = "5" id="" onclick = "starRate = this.value">
                    <span class="startRadio__img"><span class="blind">별 5개</span></span>
                  </label>

                </div>
              </div>
              <div class = "evaluation_btn">
                <button type="button" class="btn btn-primary btn__slim " onclick="starRatePost()">
                      <!--begin::Svg Icon | path: icons/duotune/general/gen016.svg-->
                      <span class="svg-icon svg-icon-3">
                          <svg
                              width="24"
                              height="24"
                              viewbox="0 0 24 24"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M15.43 8.56949L10.744 15.1395C10.6422 15.282 10.5804 15.4492 10.5651 15.6236C10.5498 15.7981 10.5815 15.9734 10.657 16.1315L13.194 21.4425C13.2737 21.6097 13.3991 21.751 13.5557 21.8499C13.7123 21.9488 13.8938 22.0014 14.079 22.0015H14.117C14.3087 21.9941 14.4941 21.9307 14.6502 21.8191C14.8062 21.7075 14.9261 21.5526 14.995 21.3735L21.933 3.33649C22.0011 3.15918 22.0164 2.96594 21.977 2.78013C21.9376 2.59432 21.8452 2.4239 21.711 2.28949L15.43 8.56949Z"
                                  fill="currentColor"></path>
                                      <path
                                          opacity="0.3"
                                          d="M20.664 2.06648L2.62602 9.00148C2.44768 9.07085 2.29348 9.19082 2.1824 9.34663C2.07131 9.50244 2.00818 9.68731 2.00074 9.87853C1.99331 10.0697 2.04189 10.259 2.14054 10.4229C2.23919 10.5869 2.38359 10.7185 2.55601 10.8015L7.86601 13.3365C8.02383 13.4126 8.19925 13.4448 8.37382 13.4297C8.54839 13.4145 8.71565 13.3526 8.85801 13.2505L15.43 8.56548L21.711 2.28448C21.5762 2.15096 21.4055 2.05932 21.2198 2.02064C21.034 1.98196 20.8409 1.99788 20.664 2.06648Z"
                                          fill="currentColor"></path>
                                  </svg>
                        </span>
                              <!--end::Svg Icon-->
                        평가하기
                </button>
              </div>
           </div>
          </div>
        </div>

        <div class = "rpPopWrap" id = "rpPopStatus" style = "visibility:hidden">
           <div class="rp_wrap_popup" id = "popupRp">
              <div class="popuptitle">
                <h1><?=$_SESSION['realName']?>   상벌점 레포트
                </h1>
                <button onclick="rewardPointsPop()">
                  <span><img alt="닫기" src="/assets/media/images/timer/icon_close_on.png"></span>
                </button>
              </div>
              <div class = "rpContent">
                <div class = "rpHeader">
                  <div class="stdy_w_rpt_date d-flex align-items-center rpHeader">
                    <label
                      class="col-form-label date_label me-4"
                      for="example-date"
                      >시작일</label
                    >
                    <div class="date_div me-6">
                      <input
                        class="form-control input__slim"
                        type="date"
                        name="date"
                        id="startDate"
                      />
                    </div>
                    <label
                      class="col-form-label date_label me-4"
                      for="example-date"
                      >종료일</label
                    >
                    <div class="date_div">
                      <input
                        class="form-control input__slim"
                        type="date"
                        name="date"
                        id="endDate"

                      />
                    </div>
                    <button type="button" class="btn btn-primary btn__slim" onclick="dateClick()">
                      <!--begin::Svg Icon | path: icons/duotune/general/gen016.svg-->
                      <span class="svg-icon svg-icon-3">
                          <svg
                              width="24"
                              height="24"
                              viewbox="0 0 24 24"
                              fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                  d="M15.43 8.56949L10.744 15.1395C10.6422 15.282 10.5804 15.4492 10.5651 15.6236C10.5498 15.7981 10.5815 15.9734 10.657 16.1315L13.194 21.4425C13.2737 21.6097 13.3991 21.751 13.5557 21.8499C13.7123 21.9488 13.8938 22.0014 14.079 22.0015H14.117C14.3087 21.9941 14.4941 21.9307 14.6502 21.8191C14.8062 21.7075 14.9261 21.5526 14.995 21.3735L21.933 3.33649C22.0011 3.15918 22.0164 2.96594 21.977 2.78013C21.9376 2.59432 21.8452 2.4239 21.711 2.28949L15.43 8.56949Z"
                                  fill="currentColor"></path>
                                      <path
                                          opacity="0.3"
                                          d="M20.664 2.06648L2.62602 9.00148C2.44768 9.07085 2.29348 9.19082 2.1824 9.34663C2.07131 9.50244 2.00818 9.68731 2.00074 9.87853C1.99331 10.0697 2.04189 10.259 2.14054 10.4229C2.23919 10.5869 2.38359 10.7185 2.55601 10.8015L7.86601 13.3365C8.02383 13.4126 8.19925 13.4448 8.37382 13.4297C8.54839 13.4145 8.71565 13.3526 8.85801 13.2505L15.43 8.56548L21.711 2.28448C21.5762 2.15096 21.4055 2.05932 21.2198 2.02064C21.034 1.98196 20.8409 1.99788 20.664 2.06648Z"
                                          fill="currentColor"></path>
                                  </svg>
                        </span>
                              <!--end::Svg Icon-->
                              검색
                    </button>
                  </div>
                </div>
                <div class = "rpSummary">

                </div>
                <div class = "rpTable">

                </div>
              </div>
              
            
            </div>
        </div>
        
        <div class="content_wrap ">
          
          <ul class="local_navigation">
            <li class="lnb_li01 on">
              <a  onclick = popup()>
                <span class="lnb_icon lnb_icon01"></span>
                <span>학습계획</span>
              </a>
            </li>
            <li class="lnb_li02">
              <a href="#" onclick = reportPop()>
                <span class="lnb_icon lnb_icon02"></span>
                <span >학습레포트</span>
              </a>
            </li>
            <li class="lnb_li03">
              <a href="#" onclick = rewardPointsPop()>
                <span class="lnb_icon lnb_icon03"></span>
                <span>상벌점</span>
              </a>
            </li>
            <li class="lnb_li04">
              <a href="#">
                <span class="lnb_icon lnb_icon04"></span>
                <span>질문있어요</span>
              </a>
            </li>
            <li class="lnb_li05">
              <a href="#">
                <span class="lnb_icon lnb_icon05"></span>
                <span>Report</span>
              </a>
            </li>
          </ul>
        <div class="todo_list_wrap">
            <div class="todo_header">
                <p>To Do List</p>
                <button onclick = popup() id="btn_edit">edit</button>
            </div>
            <div class="list_area" >
                <ul class="todo_list" id = "listarray">
                    <!-- 마침 -->
                </ul>
            </div>
        </div>
        
        <div class="choose_btn_wrap">
            <button class="btn_choose">선택</button>
        </div>
          <div class="study_timer_wrap">
            <div class="timer_wrap">
              <div class="timer">
                <div class="circle_box">
                  <!-- 개발확인 여기 circle을 이용해서 라인을 채우시면 될 것 같습니다. -->
                  <!-- <div class="clock-container_wrap"> -->
                    <svg class="clock-container">
                      <circle class="clock-shape main-circle circle_big" cy="calc( 37.6rem / 2)" cx="calc( 37.5rem / 2)" r="calc(( 36.2rem / 2) - 3rem)" style="stroke-dasharray:0" stroke-width="100"></circle>
                      <circle class="clock-shape main-circle circle_sm" cy="calc( 25.6rem / 2)" cx="calc( 25.5rem / 2)" r="calc(( 26.2rem / 2) - 1rem)" style="stroke-dasharray:600" stroke-width="40"></circle>
                    </svg>
                  <!-- </div> -->
                  <!-- <div  class="clock-container">
                    <svg id="percent" xmlns="http://www.w3.org/2000/svg" height="100%" width="100%" viewBox="0 0 97 97">
                      <circle class="main-circle" stroke-dasharray="267" stroke-dashoffset="240.3" cx="48" cy="49" r="44.5" fill="none" stroke="red" stroke-width="9" stroke-linecap="round"></circle>
                    </svg>
                  </div> -->
                  <ul class="circle_dgin">
                    <!-- <li class="bg01"></li> -->
                    <li class="bg02"></li>
                  </ul>
                  <ul class="timer_time_wrap">
                    <li class="timer_total">
                      <span class="subject" id = "subject_name">선택하세요.</span>
                    </li>
                    <li class="timer_tit_1 timer_deadline">
                      <h5 id="timer_title">THIS TURN</h5>
                      <ul class="time_num">
                        <li class="num_real" id = "timer_play">00:00:00</li>
                      </ul>
                    </li>
                    <li class="timer_tit_2 timer_count">
                      <h5>TOTAL</h5>
                      <ul class="time_num">
                        <li class="num_real" id = "total_time">00:00:00</li>
                      </ul>
                    </li>
                    <!-- <li class="timer_now" style="visibility:hidden;">
                      <span class="am_pm" >AM</span> <span class="time_now">07:15</span>
                    </li> -->
                    <li id="up_down_button" class="timer_up" style="color:white;">
                      <input type="checkbox" class="timer_up" ><label for="ch1"></label></input>
                    </li>
                  </ul>
                </div>
              </div>
              <ul class="timer_btn_wrap">
                <li class="timer_btn start_timer">
                  <button class="t_btn btn_play" id= "timer_start">START</button>
                </li>
                <li class="timer_btn pause_timer">
                  <button class="t_btn btn_pause" id = "timer_pause">PAUSE</button>
                </li>
              </ul>
            </div>
          </div>
          <div class="overlay_timer"></div>
        </div>
        <!--end::Content wrapper-->
        <!--begin::footer-->
        <!-- <footer class="ft_commen_wrap">
          <ul class="ft_commen">
            <li class="ft_li01">
              <a href="#">
                <span class="ft_icon ft_icon01"></span>
                <span>Report</span>
              </a>
              
            </li>
          </ul>
        </footer>  -->
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
    <!--start::popup-->
   
    <!--end::Modal - New Product-->
    <!--end::Modals-->
        <!--end::Content wrapper-->
        <!--begin::footer-->
        <!-- <footer class="ft_commen_wrap">
          <ul class="ft_commen">
            <li class="ft_li01">
              <a href="#">
                <span class="ft_icon ft_icon01"></span>
                <span>Report</span>
              </a>
            </li>
            <li class="ft_li02 hidden">
              <a href="#">
                <span class="ft_icon ft_icon02 "></span>
                <span>To Do List</span>
              </a>
            </li>
          </ul>
        </footer>  -->
        <!--end::footer-->
      </div>
      <!--end::Page-->
    </div>
        <!-- <button type="button" class="btn_close">닫기</button> -->
      </div>
    </div>
    
    <!--end::popup-->
    <!--begin::Javascript-->
    <script>
      var hostUrl = "assets/";
      var all_time;
      var loggggg = "flaggggg";
      var itemid = -1;
      var arrr = [];
      var countFlag = "up";
      let starrate = 0
      // timer up / down 변경 
      $("#up_down_button").on('click', function()
      {
        console.log("CHANGE TIMER UP / DOWN");
        totalTimeEle = $("#total_time").text();
        var startVal = (parseInt(totalTimeEle.slice(-8, -6))*3600 + parseInt(totalTimeEle.slice(-5, -3))*60 + parseInt(totalTimeEle.slice(-2))) * 1000;
        let last1 = arrr[arrr.length - 1];
        let key = getKeyByValue(last1, pre_itemid);
        let last2 = last1[key];
        var totalVal = parseInt(new Date(last2.endTime) - new Date(last2.startTime));
     
        // 실행 되고 있던 bar 삭제
        if (bar)
          bar.stop();

        // class 추가
        if (countFlag == "up")
        {
          countFlag = "down";
          $(".timer_up").addClass("timer_down");
          $(".timer_up").removeClass("timer_up");

          $(".timer_tit_1").addClass("timer_count");
          $(".timer_tit_1").removeClass("timer_deadline");

          $(".timer_tit_2").addClass("timer_deadline");
          $(".timer_tit_2").removeClass("timer_count");
        }
        else if (countFlag == "down")
        {
          countFlag = "up";
          $(".timer_down").addClass("timer_up");
          $(".timer_down").removeClass("timer_down");

          $(".timer_tit_1").addClass("timer_deadline");
          $(".timer_tit_1").removeClass("timer_count");

          $(".timer_tit_2").addClass("timer_count");
          $(".timer_tit_2").removeClass("timer_deadline");
        }

        bar = new ProgressBar.Path('.main-circle', {
          easing: 'linear',
          duration: totalVal
        });

        // timer up / down 눌렀을 떄 bar 세팅
        if (countFlag == "up")
        {
          if (totalVal > startVal) bar.set(startVal / totalVal);
          else bar.set(1);

          if (use_bar == 0) document.getElementById("timer_play").innerHTML = "00"+":" +"00" + ":" + "00"  ;
          document.getElementById("timer_title").innerHTML = "THIS TERN";
        }
        else
        {
          if (totalVal > startVal)
          {
            
            var curVal = (totalVal - startVal)/1000;
            var cur_hour = parseInt(curVal/3600);
            var cur_min = parseInt((curVal - cur_hour * 3600)/60);
            var cur_sec = curVal % 60;
            var cur_hour_u = String("0"+cur_hour).slice(-2);
            var cur_min_u = String("0"+cur_min).slice(-2);
            var cur_sec_u = String("0"+cur_sec).slice(-2);
            
            bar.set(1 - startVal / totalVal);
            if (use_bar == 0) document.getElementById("timer_play").innerHTML = cur_hour_u + ":" + cur_min_u + ":" + cur_sec_u  ;
          }
          else 
          {
            bar.set(0);
            if (use_bar == 0) document.getElementById("timer_play").innerHTML = "00"+":" +"00" + ":" + "00"  ;
          }
          document.getElementById("timer_title").innerHTML = "TIMER";
        }
      });

      function getKeyByValue(obj, value) {
        return Object.keys(obj).find(key => obj[key]['id'] === value);
      }

      /* 22.12 추가 */
      var overlay = $('.overlay_timer, .timer_btn_wrap');
      $('.btn_play').on('click', function(){
        if(pre_itemid==itemid){
            if(overlay.hasClass('active') === false){
              overlay.addClass('active');
          };
        }else{
            alert("아이템을 먼저 선택해 주세요");
        }
      });
      $('.btn_pause').on('click', function(){
            if(overlay.hasClass('active') === true){
              overlay.removeClass('active');
          };
      });

      $(document).ready(function()
      {
        let today = new Date();   
        let year = today.getFullYear(); // 년도
        let month = today.getMonth() + 1;  // 월
        if(month<10){
          month='0'+month
        }
        let date = today.getDate();  // 날짜
        if(date<10){
          date='0'+date
        }
        //let day = today.getDay();  // 요일
        const studentData = {
          "studentId":<?=$_SESSION['id']?>,
          "fromDate": year+"-"+month+"-"+date,
          "toDate":year+"-"+month+"-"+date
        }
        $.ajax({
          url: "https://farm01.bitlworks.co.kr/api/v1/users/students/"+<?=$_SESSION['id']?>+"/study-plans",
          type: "get",
          contentType:"application/json",
          data:studentData,
          datatype: "JSON",
          success: function(obj){
            arrr.push(obj)
            viewToDoList(obj)
          },
          error: function(xhr, status, error){
            console.log(`error: ${error}`)
            console.log(`status: ${status}`)
            return
          }
        });
        makeCodeList(<?=$branch_id?>);
        reportcalendarcall()
      })

      function rewritelist()
      {
        console.log("RUN rewritelist");
        let today = new Date();   
        let year = today.getFullYear(); // 년도
        let month = today.getMonth() + 1;  // 월
        let date = today.getDate();  // 날짜

        if(month<10){
          month='0'+month
        }
        if(date<10){
          date='0'+date
        }

        const studentData ={
          "fromDate": year+"-"+month+"-"+date,
          "toDate":year+"-"+month+"-"+date
        }
        $.ajax({
          url: "https://farm01.bitlworks.co.kr/api/v1/users/students/"+<?=$_SESSION['id']?>+"/study-plans",
          type: "get",
          contentType:"application/json",
          data:studentData,
          datatype: "JSON",
          success: function(obj){
            arrr.push(obj)
            viewToDoList(obj)
          },
          error: function(xhr, status, error){
            console.log(`error: ${error}`)
            console.log(`status: ${status}`)
            return
          }
        });
      }

      let viewToDoList = function(arr)
      {
        $("#listarray").empty();
        $.each(arr, function(i,item)
        {
          let id=item['id']
          let li1 = $("<li ></li>");

          if(item.status=="미완료"){
              li1 = $(`<li class ='ing' id='${id}'></li>`);
          }else if(item.status=="진행중"){
              li1 = $(`<li class = 'ing'  vaule = "+i+" id='${id}'></li>`);
              //처음 렌더링 시 이미 진행중인게 있었다면 원상 복구
              itemid=id;
              pre_itemid=id;
              totals=item['totalTimeStudy'].split(":")
              title=item['title']
              document.getElementById("subject_name").innerHTML =   title;
              document.getElementById("total_time").innerHTML = totals[0]+":" +totals[1] + ":" + totals[2];
          }else if (item.status=="완료"){
              li1 = $(`<li class = 'done' id='${id}'></li>`);
          }else{
              li1 = $(`<li id='${id}'></li>`);
          }

          $.each(item, function(key,value)
          {
            if(key == "title" ){
              $("<div class = 'subject'></div>").html(value).appendTo(li1);
            }
            if(key == "id" ){
              $("<div class = 'id' hidden></div>").html(value).appendTo(li1);
            }
            if(key == "totalTimeStudy"){
              $("<div class = 'time' id = 'div_time'></div>").html(value).appendTo(li1);
              $("<div class = 'checkbox lkjl' ></div>").html("<input type = 'checkbox' /><label for = 'ch1'></label>").appendTo(li1);
            }
          });
          $("#listarray").append(li1);
        });
      }
      let td_done_id = 0
      // todo 리스트 완료했을 때, 
      $(document).on('click','.todo_list > li > .checkbox',function()
      {
        let done_button = $(this).find();
        let td_val = $(this).parents().find().prevObject[0].className;
        let td_val_2 = $(this).parents().find().prevObject[0].id;
        td_done_id = td_val_2
        if(td_val=="done"){
          console.log("done");
          $.ajax({
            url: `https://farm01.bitlworks.co.kr/api/v1/items/study-timers/${td_val_2}/finish?status=미완료`,
            type: "post",
            contentType:"application/json",
            datatype: "JSON",
            success: function(obj){
              rewritelist()
            },
            error: function(xhr, status, error){
              console.log(`error: ${error}`)
              console.log(`status: ${status}`)
              return
            }
          });
        }else{
          starPop()
          $.ajax({
            url: `https://farm01.bitlworks.co.kr/api/v1/items/study-timers/${td_val_2}/finish?status=완료`,
            type: "post",
            contentType:"application/json",
            datatype: "JSON",
            success: function(obj){
              rewritelist()
            },
            error: function(xhr, status, error){
              console.log(`error: ${error}`)
              console.log(`status: ${status}`)
              return
            }
          });
        }

        
      });
      
      $(document).on('click','.todo_list > .active',function()
      {
        let done_button = $(this).find();
        let td_val = $(this).find().prevObject[0].className;
        let td_val_2 = $(this).find().prevObject[0].id;

        if(td_val=="done active"){
          $.ajax({
            url: `https://farm01.bitlworks.co.kr/api/v1/items/study-timers/${td_val_2}/finish?status=미완료`,
            type: "post",
            contentType:"application/json",
            datatype: "JSON",
            success: function(obj){
              rewritelist()
            },
            error: function(xhr, status, error){
              console.log(`error: ${error}`)
              console.log(`status: ${status}`)
              return
            }
          });
        }else{
          $.ajax({
            url: `https://farm01.bitlworks.co.kr/api/v1/items/study-timers/${td_val_2}/finish?status=완료`,
            type: "post",
            contentType:"application/json",
            datatype: "JSON",
            success: function(obj){
              rewritelist()
            },
            error: function(xhr, status, error){
              console.log(`error: ${error}`)
              console.log(`status: ${status}`)
              return
            }
          });
        }
      });

      // todo 리스트 선택 시, 
      $(document).on('click','.btn_choose',function(e)
      {
        console.log("arrr",arrr);
        console.log("id",itemid);
        console.log("pre",pre_itemid);

        pre_itemid=itemid;
        if(pre_itemid!=-1){
          if (countFlag == "up")
          {
            document.getElementById("timer_play").innerHTML = "00"+":" +"00" + ":" + "00"  ;
          }
          else 
          {
            setTimeout(() => {
              totalTimeEle = $("#total_time").text();
              var startVal = (parseInt(totalTimeEle.slice(-8, -6))*3600 + parseInt(totalTimeEle.slice(-5, -3))*60 + parseInt(totalTimeEle.slice(-2))) * 1000;
              let last1 = arrr[arrr.length - 1];
              let key = getKeyByValue(last1, pre_itemid);
              let last2 = last1[key];
              var totalVal = parseInt(new Date(last2.endTime) - new Date(last2.startTime));
  
              if (totalVal >= startVal)
              {
                var curVal = (totalVal - startVal)/1000;
                var cur_hour = parseInt(curVal/3600);
                var cur_min = parseInt((curVal - cur_hour * 3600)/60);
                var cur_sec = curVal % 60;
                var cur_hour_u = String("0"+cur_hour).slice(-2);
                var cur_min_u = String("0"+cur_min).slice(-2);
                var cur_sec_u = String("0"+cur_sec).slice(-2);
    
                document.getElementById("timer_play").innerHTML = cur_hour_u + ":" + cur_min_u + ":" + cur_sec_u  ;
              }
              else
              {
                document.getElementById("timer_play").innerHTML = "00"+":" +"00" + ":" + "00"  ;
              }
            }, 100);
          }
          var inittime=1;
        }
        $.ajax({
          url: "https://farm01.bitlworks.co.kr/api/v1/items/study-timers/"+itemid+"/select",
          type: "post",
          contentType:"application/json",
          data:JSON.stringify({
            "itemId": itemid
          }),
          datatype: "JSON",
          success: function(obj){
          },
          error: function(xhr, status, error){
            console.log(`error: ${error}`)
            console.log(`status: ${status}`)
            return
          }
        });

        document.getElementById("subject_name").innerHTML =   title;
        document.getElementById("total_time").innerHTML = totals[0]+":" +totals[1] + ":" + totals[2]  ;

        // 선택 눌렀을 떄 bar 세팅
        totalTimeEle = $("#total_time").text();
        var startVal = (parseInt(totalTimeEle.slice(-8, -6))*3600 + parseInt(totalTimeEle.slice(-5, -3))*60 + parseInt(totalTimeEle.slice(-2))) * 1000;
        let last1 = arrr[arrr.length - 1];
        let key = getKeyByValue(last1, pre_itemid);
        let last2 = last1[key];
        var totalVal = parseInt(new Date(last2.endTime) - new Date(last2.startTime));
        bar = new ProgressBar.Path('.main-circle', {
          easing: 'linear',
          duration: totalVal
        });
        if (countFlag == "up")
        {
          if (totalVal > startVal) bar.set(startVal / totalVal);
          else bar.set(1);
        }
        else{
          if (totalVal > startVal) bar.set(1 - startVal / totalVal);
          else bar.set(0);
        }
      });

      var title;
      var prev_click;
      
      $(document).on('click','.todo_list > li',function(e){
        e.preventDefault();
        let id_div = $(this).find('div');
        total = id_div[2].innerText;
        title = id_div[1].innerText;
        totals = total.split(':');
        pre_itemid = itemid;
        itemid = id_div[0].innerText;

        hour_t = parseInt(totals[0]);
        min_t = parseInt(totals[1]);
        sec_t = parseInt(totals[2]);
        totaltime = hour_t*3600+min_t*60+sec_t;
        all_time = totaltime;
        $('.todo_list > li.active').removeClass('active');

        $(this).addClass('active');
        prev_click = itemid;
        
      })

      var use_bar = 0;
      var timer_running ;
      var inittime=1;
      var totaltime =0;
      var bar;
      
      function playtimer(){
        const itemData = {
          "itemId": itemid,
        }
        $.ajax({
          url: "https://farm01.bitlworks.co.kr/api/v1/items/study-timers/"+itemid+"/start",
          type: "post",
          contentType:"application/json",
          data:JSON.stringify(itemData),
          datatype: "JSON",
          success: function(obj){
            console.log(obj);
            console.log(`msg: ${obj['message']}`)
            
          },
          error: function(xhr, status, error){
            console.log(`error: ${error}`)
            console.log(`status: ${status}`)
            return
          }
        });
        console.log("start");
        var time = inittime;
        var totalTimeE = $("#total_time").text();
        var tot_time = (parseInt(totalTimeE.slice(-8, -6))*3600 + parseInt(totalTimeE.slice(-5, -3))*60 + parseInt(totalTimeE.slice(-2)));
        var min = "";
        var sec = "";
        var hour = "";
        var tot_min = "";
        var tot_sec = "";
        var tot_hour = "";
        var cur_time = "";

        // 타이머 진행 원형 bar
        totalTimeEle = $("#total_time").text();
        var startVal = (parseInt(totalTimeEle.slice(-8, -6))*3600 + parseInt(totalTimeEle.slice(-5, -3))*60 + parseInt(totalTimeEle.slice(-2))) * 1000;
        let last1 = arrr[arrr.length - 1];
        let key = getKeyByValue(last1, pre_itemid);
        let last2 = last1[key];
        var totalVal = parseInt(new Date(last2.endTime) - new Date(last2.startTime));
        if (countFlag == "up")
        {
          if (totalVal > startVal)
          {
            bar = new ProgressBar.Path('.main-circle', {
              easing: 'linear',
              duration: totalVal,
            });
            bar.set(startVal / totalVal);
            console.log("up");
            bar.animate(1);
            use_bar = 1;
          }
          else
          {
            bar.set(1);
          }
        }
        else
        {
          if (totalVal > startVal)
          {
            bar = new ProgressBar.Path('.main-circle', {
              easing: 'linear',
              duration: totalVal,
            });
            bar.set(1 - (startVal / totalVal));
            console.log("down");
            bar.animate(-1);
            use_bar = 1;
          }
          else bar.set(0);
        }
        $("#up_down_button").addClass("running");
        timer_running = setInterval(function()
        {
          console.log("countFlag",countFlag)
          // timer
          if (countFlag == "down")
            cur_time = totalVal / 1000 - tot_time -1;
            // if (cur_time <= 0) cur_time = 0;
          else
            cur_time = time;

          hour = parseInt(cur_time/3600);
          min = parseInt((cur_time - hour * 3600)/60);
          sec = (cur_time) % 60; 
          hour_u = String("0"+hour).slice(-2);
          min_u = String("0"+min).slice(-2);
          sec_u = String("0"+sec).slice(-2);
          if (cur_time <= 0) document.getElementById("timer_play").innerHTML = "00:00:00";
          else document.getElementById("timer_play").innerHTML = hour_u+":" +min_u + ":" + sec_u;
          
          // total
          tot_hour = parseInt(tot_time/3600);
          tot_min = parseInt((tot_time - tot_hour * 3600) / 60);
          tot_sec = tot_time%60+1; //1초 딜레이 빼기
          tot_hour_u = String("0"+tot_hour).slice(-2);
          tot_min_u = String("0"+tot_min).slice(-2);
          tot_sec_u = String("0"+tot_sec).slice(-2);
          document.getElementById("total_time").innerHTML = tot_hour_u+":" +tot_min_u + ":" + tot_sec_u  ;

          time++;
          tot_time++;
          inittime = time;

          $(".running").on('click', function(){
            if (bar)
                bar.stop();
            if (use_bar )
            { 
              console.log("running click");
              if (countFlag == "up")
                bar.animate(1);
              else
                bar.animate(-1);
            }
          });
        },1000);
      }

      function pausetimer()
      {
        $("#up_down_button").removeClass("running");
        console.log("stop", use_bar);

        if (use_bar)
        {
          bar.stop();
          use_bar = 0;
        }

        $.ajax({
          url: "https://farm01.bitlworks.co.kr/api/v1/items/study-timers/"+itemid+"/pause",
          type: "post",
          contentType:"application/json",
          data:JSON.stringify({
            itemId:itemid
          }),
          datatype: "JSON",
          success: function(obj){
            console.log(`msg: ${obj['message']}`)
            rewritelist();
            
          },
          error: function(xhr, status, error){
            console.log(`error: ${error}`)
            console.log(`status: ${status}`)
            
            return
          }
        });

        totaltime+=inittime-1;
        clearInterval(timer_running);
        hour_s = String("0"+parseInt(totaltime/3600)).slice(-2);
        min_s = String("0"+parseInt((totaltime%3600)/60)).slice(-2);
        sec_s = String("0"+parseInt(totaltime%60)).slice(-2);
        document.getElementById("total_time").innerHTML = hour_s+":" +min_s + ":" + sec_s  ;
        inittime = 1;
      }
    function popup(){
      const con = document.getElementById('popupstatus');
      var tag_hidden = document.createElement("hidden");
      var tag_visible = document.createElement("visible");
      if(con.style.visibility=="hidden"){
        loggggg = "open"
        const cal = document.getElementById('kt_calendar_app');
        
        con.setAttribute("style","visibility:visible");
      }else{
        con.setAttribute("style","visibility:hidden");
        rewritelist();
        loggggg = "close"
      }
    }
    function reportPop(){
      
      const conReport = document.getElementById('reportPopStatus');
      // var tag_hidden = document.createElement("hidden");
      // var tag_visible = document.createElement("visible");
      //나중에 전역을 꼭빼자
      let today = new Date();   
        let year = today.getFullYear(); // 년도
        let month = today.getMonth() + 1;  // 월
        let date = today.getDate();  // 날짜

        if(month<10){
          month='0'+month
        }
        if(date<10){
          date='0'+date
        }
      if(conReport.style.visibility=="hidden"){
        // loggggg = "open"
        // reportcalendarcall()
        cellColor()
        infoTimeContent("daily")
        
        //loadingAnimate(year+"-"+month+"-"+date,year+"-"+month+"-"+date)
        conReport.setAttribute("style","visibility:visible");
      }else{
        conReport.setAttribute("style","visibility:hidden");
        removeCharts()
        // loggggg = "close"
      }
      
    }
    function rewardPointsPop(){
      
      const rpReport = document.getElementById('rpPopStatus');
      // var tag_hidden = document.createElement("hidden");
      // var tag_visible = document.createElement("visible");
      if(rpReport.style.visibility=="hidden"){
        // loggggg = "open"
        // reportcalendarcall()
        
        rpReport.setAttribute("style","visibility:visible");
      }else{
        rpReport.setAttribute("style","visibility:hidden");
        
        // loggggg = "close"
      }
    }
    function getplan(e){
      let temp = ""
      $.ajax({
              url: "https://farm01.bitlworks.co.kr/api/v1/items/study-plans/"+e,
              type: "get",
              contentType:"application/json",
              async: false, 
              
              datatype: "JSON",
              success: function(obj){
                
                console.log("su:",obj);
                temp = obj
                
              },
              error: function(xhr, status, error){
                console.log(`error: ${error}`)
                console.log(`status: ${status}`)
                
                return;
              }
      });
      return temp
    }
    function starPop(){
      
      const conStar = document.getElementById('starPopStatus');
      // var tag_hidden = document.createElement("hidden");
      // var tag_visible = document.createElement("visible");
      if(conStar.style.visibility=="hidden"){
        // loggggg = "open"
        console.log("asdfasd")
        conStar.setAttribute("style","visibility:visible");
      }else{
        conStar.setAttribute("style","visibility:hidden");
        
        // loggggg = "close"
      }
    }

    function starRatePost(){
      
      console.log(td_done_id)
      let temp = ""
      temp = getplan(td_done_id)
      console.log(JSON.stringify({
                "place": temp.place,
                "title": temp.title,
                "description": temp.description,
                "startTime": temp.startTime,
                "endTime": temp.endTime,
                "isAllDay": temp.isAllDay,
                "itemCodeId": temp.itemCode.id,
                "rate": starRate
              }))
      $.ajax({
              url: "https://farm01.bitlworks.co.kr/api/v1/items/study-plans/"+temp.id,
              type: "put",
              contentType:"application/json",
              data:JSON.stringify({
                "place": temp.place,
                "title": temp.title,
                "description": temp.description,
                "startTime": temp.startTime,
                "endTime": temp.endTime,
                "isAllDay": temp.isAllDay,
                "itemCodeId": temp.itemCode.id,
                "rate": starRate
              })
              ,
              datatype: "JSON",
              success: function(obj){
                
                console.log("su:",obj);
                // window.location.reload();
              },
              error: function(xhr, status, error){
                console.log(`error: ${error}`)
                console.log(`status: ${status}`)
                
                return;
              }
      });

    }
    function makeCodeList(prop){
        let res;
        console.log("codeList",prop)
        $.ajax({
          url: "https://farm01.bitlworks.co.kr/api/v1/branches/"+prop+"/item-codes",
          type: "GET",
          contentType:"application/json",
          async: false, 
          datatype: "JSON",
          success: function(obj){
            console.log("codes",obj)
            res = obj
          },
          error: function(xhr, status, error){
            console.log("xhr: ", xhr);
            return
          }
        })
        newDiv = document.getElementById('eventCode');
        
        
        newDiv.innerHTML = ``;
        newDiv.innerHTML = `<option value=" ">기타</option>`;
        for (row in res){
          row_data = res[row];
          newDiv.innerHTML += `<option type="button" value="${row_data.id}">${row_data.name}</option>`;
        }
      }
    </script>
    <script>
    $('#timer_start').click( function () {
      if(pre_itemid==itemid)
      {
        playtimer();
      }
      else   
      {
        alert("아이템을 먼저 선택해 주세요");
      }
    });

    $('#timer_pause').click( function () {
        pausetimer();
    });

    $('#listclick').click( function () {
        console.log("click");
        console.log($(this).attr('value'));
        
    });
    </script>
    <script>

      $('.daily_btn').click(function(){
        console.log("dd");
        // cellColor()
        $(".weekly_btn ").removeClass("tab_on");
        $(".weekly_btn ").addClass("tab_off");
        $(".monthly_btn ").removeClass("tab_on");
        $(".monthly_btn ").addClass("tab_off");
        $(".daily_btn ").addClass("tab_on");
        $(".daily_btn ").removeClass("tab_off");
        
        $(".highcharts-figure").addClass("hidden");
        
        $(".dailyToDo").removeClass("hidden");


        // $(".radarChart").addClass("hidden");
        // $(".solidChart").addClass("hidden");
        // $(".waffleChart").addClass("hidden");
        // $(".stackedChart").addClass("hidden");
        
        removeCharts()
        
        
        infoTimeContent("daily")
        
      })
      $('.weekly_btn').click(function(){
        console.log("dd");
        $(".monthly_btn ").removeClass("tab_on");
        $(".monthly_btn ").addClass("tab_off");
        $(".daily_btn ").removeClass("tab_on");
        $(".daily_btn ").addClass("tab_off");
        $(".weekly_btn ").addClass("tab_on");
        $(".weekly_btn ").removeClass("tab_off");
        $(".dailyToDo").addClass("hidden");
        
        $(".highcharts-figure").removeClass("hidden");

        // $(".radarChart").removeClass("hidden");
        // $(".solidChart").removeClass("hidden");
        // $(".waffleChart").removeClass("hidden");
        // $(".stackedChart").removeClass("hidden");
        console.log("prev",am5.registry.rootElements)
        
          // removeCharts()
          removeCharts()
          
        
        
        
        infoTimeContent("weekly")
        console.log("post",am5.registry.rootElements)
      })
      $('.monthly_btn').click(function(){
        console.log("dd");
        $(".daily_btn ").removeClass("tab_on");
        $(".daily_btn ").addClass("tab_off");
        $(".weekly_btn ").removeClass("tab_on");
        $(".weekly_btn ").addClass("tab_off");
        $(".monthly_btn ").addClass("tab_on");
        $(".monthly_btn ").removeClass("tab_off");
        $(".dailyToDo").addClass("hidden");

        $(".highcharts-figure").removeClass("hidden");

        // $(".radarChart").removeClass("hidden");
        // $(".solidChart").removeClass("hidden");
        // $(".waffleChart").removeClass("hidden");
        // $(".stackedChart").removeClass("hidden");

        removeCharts()

        infoTimeContent("monthly")
      })
      $('.color_btn').click(function(){
        console.log("dasdfasdf")
        cellColor()
      })
      
      function removeCharts(divId){
        
      //   am5.array.each(am5.registry.rootElements, function(root,index) {
          
      //   if (root.dom.id === divId) {
      //     console.log("dispose",root,divId,index)
      //     root.dispose();
      //     console.log(am5.registry.rootElements)
      //   }
      // });
        am5.disposeAllRootElements()

      }
      function infoTimeContent(prop){
        
        
        let res;
        
        let today = new Date();   
        let todayyear = today.getFullYear(); // 년도
        let todaymonth = today.getMonth() + 1;  // 월
        if(todaymonth<10){
          todaymonth='0'+todaymonth
        }
        let todaydate = today.getDate();  // 날짜
        if(todaydate<10){
          todaydate='0'+todaydate
        }
        let studentData = {
          "studentId":<?=$_SESSION['id']?>,
          "fromDate": todayyear+"-"+todaymonth+"-"+todaydate,
          "toDate":todayyear+"-"+todaymonth+"-"+todaydate
        }

        


        let reportPeriodDiv = document.getElementById("report_date");
            
        console.log("reportPeriodDiv",reportPeriodDiv)
            
            
            
        reportPeriodDiv.innerText = todayyear+"-"+todaymonth+"-"+todaydate
        




        if(prop == "weekly"){
          let startweek = setToMonday(new Date());
          let weekyear = startweek.getFullYear()
          let weekstartmonth = startweek.getMonth()+1
          let weekstartday =startweek.getDate()
          // 만약에 오늘 날짜에서 구한 month가 3 인데 이번주의 월요일은 2월로 나온다면, 오늘 날짜에서 구한 달로 맟춰주기
          // 이 경우 date도 전 달로 넘어갔을 것임으로 1일로 고정
          if(todayyear!=weekyear){
            weekyear = todayyear
            weekstartmonth = parseInt(todaymonth)
            weekstartday = 1
          }

          else if(parseInt(todaymonth) != weekstartmonth){ 
            weekstartmonth = parseInt(todaymonth)
            weekstartday = 1
          }
          if(weekstartmonth<10){
            weekstartmonth='0'+weekstartmonth
          }
          if(weekstartday<10){
            weekstartday='0'+weekstartday
          }
          studentData.fromDate = weekyear+"-"+weekstartmonth+"-"+weekstartday
          let endweek = setToSunday(new Date())
          let endweekyear = endweek.getFullYear()
          let weekendmonth = endweek.getMonth()+1
          let weekendday =endweek.getDate()
          // 만약에 오늘 날짜에서 구한 month가 12 인데 이번주의 월요일은 1월로 나온다면, 오늘 날짜에서 구한 달로 맟춰주기
          // 이 경우 date도 뒷 달로 넘어갔을 것임으로 마지막 날짜로 고정
          if(todayyear!=endweekyear){
            endweekyear = todayyear
            weekendmonth = parseInt(todaymonth)
            weekendday = new Date(weekyear,weekendmonth,0)
            weekendday= weekendday.getDate()
          }else if(parseInt(todaymonth) != weekendmonth){
            weekendmonth = parseInt(todaymonth)
            weekendday = new Date(weekyear,weekendmonth,0)
            weekendday= weekendday.getDate()
          }
          if(weekendmonth<10){
            weekendmonth='0'+weekendmonth
          }
          if(weekendday<10){
            weekendday='0'+weekendday
          }
          studentData.toDate = endweekyear+"-"+weekendmonth+"-"+weekendday
          
          reportPeriodDiv.innerText = studentData.fromDate + " ~ " + studentData.toDate

          loadingAnimate(weekyear+"-"+weekstartmonth+"-"+weekstartday,endweekyear+"-"+weekendmonth+"-"+weekendday)
          loadingWaffle(weekyear+"-"+weekstartmonth+"-"+weekstartday,endweekyear+"-"+weekendmonth+"-"+weekendday)
          loadingRadar(weekyear+"-"+weekstartmonth+"-"+weekstartday,endweekyear+"-"+weekendmonth+"-"+weekendday)
          loadingSolid(weekyear+"-"+weekstartmonth+"-"+weekstartday,endweekyear+"-"+weekendmonth+"-"+weekendday)
          loadingStack(weekyear+"-"+weekstartmonth+"-"+weekstartday,"WEEKLY")
        }else if(prop == "monthly"){
          studentData.fromDate = todayyear+"-"+todaymonth+"-"+"01"
          let monthendday = new Date(todayyear,parseInt(todaymonth),0)
          studentData.toDate = todayyear+"-"+todaymonth+"-"+monthendday.getDate()
          reportPeriodDiv.innerText = studentData.fromDate + " ~ " + studentData.toDate
          loadingAnimate(studentData.fromDate,studentData.toDate)
          loadingWaffle(studentData.fromDate,studentData.toDate)
          loadingRadar(studentData.fromDate,studentData.toDate)
          loadingSolid(studentData.fromDate,studentData.toDate)
          loadingStack(studentData.toDate,"MONTHLY")
        }else{
          loadingAnimate(todayyear+"-"+todaymonth+"-"+todaydate,todayyear+"-"+todaymonth+"-"+todaydate)
          
          loadingRadar(todayyear+"-"+todaymonth+"-"+todaydate,todayyear+"-"+todaymonth+"-"+todaydate)
          
          loadingStack(todayyear+"-"+todaymonth+"-"+todaydate,"DAILY")

          loadingWaffle(todayyear+"-"+todaymonth+"-"+todaydate,todayyear+"-"+todaymonth+"-"+todaydate)
          loadingSolid(todayyear+"-"+todaymonth+"-"+todaydate,todayyear+"-"+todaymonth+"-"+todaydate)
        }
        
        
        
        console.log("infoTimeContent",studentData)
        $.ajax({
          url: "https://farm01.bitlworks.co.kr/api/v1/users/students/"+<?=$_SESSION['id']?>+"/study-status",
          type: "GET",
          contentType:"application/json",
          data:studentData,
          async: false, 
          datatype: "JSON",
          success: function(obj){
            console.log("순공순공",obj)
            res = obj

            let studyStartDateTimeDiv = document.getElementById("studyStartDateTime");
            let totalStayTimeDiv = document.getElementById("totalStayTime");
            let totalStudyTimeDiv = document.getElementById("totalStudyTime");
            let avgStudyRateDiv = document.getElementById("avgStudyRate");
            
            
            
            if(res.studyStartDateTime!=null){
              studyStartDateTimeDiv.innerText = res.studyStartDateTime.substr(0,10);
            }else{
              studyStartDateTimeDiv.innerText = "NOSTART"
            }
            
            totalStayTimeDiv.innerText = res.totalStayTime;
            totalStudyTimeDiv.innerText = res.totalStudyTime;
            avgStudyRateDiv.innerText = res.avgStudyRate.toFixed(1);



          },
          error: function(xhr, status, error){
            console.log("xhr: ", xhr);
            return
          }
        })
        
      }
      let stst = ""
      let enen = ""
      
      function setToMonday( date ) {
          var day = date.getDay() || 7;  
          if( day !== 1 ) {
            console.log("prevdate",day,date)
            date.setHours(-24 * (day - 1)); 
            console.log("postdate",day,date)
          }
              
          return date;
      }
      function setToSunday( date ) {
          var day = 7-(date.getDay() || 7);  
          if( day !== 7 ) {
            console.log("prevdate",day,date)
            date.setHours(24 * (day )); 
            console.log("postdate",day,date)
          }
              
          return date;
      }

      

    </script>

    

    <script type="text/javascript" src="https://rawgit.com/kimmobrunfeldt/progressbar.js/1.0.0/dist/progressbar.js"></script>
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
    <script src="assets/js/custom/apps/calendar/calendar.js"></script>
    
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
    




    <script>
      var target = document.querySelectorAll('.btn_open');
      var targetID;

      // 팝업 열기
      for(var i = 0; i < target.length; i++){
        target[i].addEventListener('click', function(){
          targetID = this.getAttribute('href');
          document.querySelector(targetID).style.display = 'block';
        });
      }
    </script>
    <script>
   
    function addplan(e){
      
      if(e.allDay == true){
        e.start = e.start.substr(0,10)+"T00:00:00";
        e.end = e.start.substr(0,10)+"T23:59:59";
      }
      console.log(e);
      console.log(<?=$USER_ID?>)
      $.ajax({
              url: "https://farm01.bitlworks.co.kr/api/v1/items/study-plans",
              type: "post",
              contentType:"application/json",
              
              data:JSON.stringify({
              
                "studentId": <?=$_SESSION['id']?>,
                "place": e.location,
                "title": e.title,
                "description": e.description,
                "isAllDay": e.allDay,
                "startTime": e.start,
                "endTime": e.end,
                "itemCodeId": e.itemCode,
              })
              ,
              datatype: "JSON",
              success: function(obj){
                
                console.log("su:",obj);
                console.log("data",JSON.stringify({
              
              "studentId": <?=$_SESSION['id']?>,
              "place": e.location,
              "title": e.title,
              "description": e.description,
              "isAllDay": e.allDay,
              "startTime": e.start,
              "endTime": e.end,
              "itemCodeId": e.itemCode,
            }))
                // window.location.reload();
              },
              error: function(xhr, status, error){
                console.log(`error: ${error}`)
                console.log(`status: ${status}`)
                
                return
              }
      });
      
      
    }
    function modifyplan(e){
      console.log(e);
      $.ajax({
              url: "https://farm01.bitlworks.co.kr/api/v1/items/study-plans/"+e.id,
              type: "put",
              contentType:"application/json",
              data:JSON.stringify({
                "place": e.location,
                "title": e.title,
                "description": e.description,
                "startTime": e.start,
                "endTime": e.end,
                "isAllDay": e.allDay,
                "itemCodeId": e.itemCode,
              })
              ,
              datatype: "JSON",
              success: function(obj){
                
                console.log("su:",obj);
                // window.location.reload();
              },
              error: function(xhr, status, error){
                console.log(`error: ${error}`)
                console.log(`status: ${status}`)
                
                return;
              }
      });
      

    }
    function deleteplan(e){
      console.log(e);
      
      $.ajax({
              url: "https://farm01.bitlworks.co.kr/api/v1/items/study-plans/"+e,
              type: "delete",
              contentType:"application/json",
              data:JSON.stringify({
                "itemId": e
              })
              ,
              datatype: "JSON",
              success: function(obj){
                console.log("su:",obj);
                // window.location.reload();
              },
              error: function(xhr, status, error){
                console.log(`error: ${error}`)
                console.log(`status: ${status}`)
                return
              }
      });
    }
  </script>



<script>
  function cellColor(){
      // setTimeout(() => {
      let one = document.getElementsByClassName('numOneColor');
      let two = document.getElementsByClassName('numTwoColor');
      let three = document.getElementsByClassName('numThreeColor');
      let four = document.getElementsByClassName('numFourColor');
      let five = document.getElementsByClassName('numFiveColor');
              // console.log("three",three[0].parentElement.parentElement.parentElement.parentElement.className)
      console.log("three",three,three.length)  
      if(one.length !=0){
        for (i = 0; i < one.length; i++) {
          one[i].parentElement.parentElement.parentElement.parentElement.className+= ' numOneColorCell' 
        } 
        
      }
      if(two.length !=0){
        for (i = 0; i < two.length; i++) {
          two[i].parentElement.parentElement.parentElement.parentElement.className+= ' numTwoColorCell'
        } 
        
      }
      if(three.length !=0){
        for (i = 0; i < three.length; i++) {
          
          three[i].parentElement.parentElement.parentElement.parentElement.className+= ' numThreeColorCell' 
        } 
        
      }
      if(four.length !=0){
        for (i = 0; i < four.length; i++) {
          four[i].parentElement.parentElement.parentElement.parentElement.className+= ' numFourColorCell'  
        } 
        
      }
      if(five.length !=0){
        for (i = 0; i < five.length; i++) {
          five[i].parentElement.parentElement.parentElement.parentElement.className+= ' numFiveColorCell' 
        } 
        
      }

    // }, 30); 
            
            
  }
 

</script>

<script src="assets/js/custom/apps/calendar/calendar_report.js"></script>
<script>
  
  
  $(document).on('click','.fc-next-button',function(e){
    let btngroup = document.getElementsByClassName('fc-button-group')
  
    console.log(document.getElementById("colorBtn"))
  document.getElementById("colorBtn").click();
        //cellColor()
  })
  $(document).on('click','.fc-prev-button',function(e){
    
    document.getElementById("colorBtn").click();
  })
  
  
  
</script>




<script src="assets/js/custom/radarChart.js"></script>
<script src="assets/js/custom/solidChart.js"></script>
<script src="assets/js/custom/waffleChart.js"></script>
<script src="assets/js/custom/stackedChart.js"></script>
<script src="assets/js/custom/animatedChart.js"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
  </body>

  <?php
  if($has_active==1){
    error_log("pause 필요함 : ".$item_id);
    echo("<script>let itemid=$item_id;</script>");
    echo ("<script> pausetimer();</script>");
  }
  ?>
  <!--end::Body-->
</html>
