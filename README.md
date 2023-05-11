

# 🖊️[studylab_student_php](https://student.here.study/student/)  스터디카페 학생 페이지  🖊️
  

  
![version](https://img.shields.io/badge/version-0.4.0-blue.svg) 

![Image](https://user-images.githubusercontent.com/75923078/226610348-a62f98af-7913-4ea1-aa09-ad87c726dccd.png)

studylab student 는 php 와 html/js/css를 기반으로 하는 스터티카페 학생 학습 페이지입니다.  
studylab 에 소속된 학생들은   
자신의 계정으로 로그인하여 자신이 공부할 일정을 등록/수정/삭제가 가능합니다.  
등록된 일정은 타이머를 통해서 공부시간을 체크하고 저장합니다.  
완료한 학습은 각각에 대한 평점을 기록합니다.  
일/주/월 로 누적된 학습 시간을 amchart의 다양한 통계 그래프를 이용하여 시각적으로 볼 수 있습니다.  

## ✈주요기능

**▷일정(edit or 계획)**  
  
<img src="https://user-images.githubusercontent.com/75923078/226615816-1bdf9a37-81f9-4519-96df-6499f2e680cc.png" width="300" height="200" />   
  
fullcalendar를 바탕으로 합니다  
해당 일자에 시간을 클릭하면 일정을 등록할 수 있습니다.  
등록 팝업에서 타이틀과 분류코드 세부 시간을 설정 할 수 있습니다.  
등록된 일정을 클릭하면 수정과 삭제를 할 수 있습니다.  
수정에서는 타이틀, 분류코드, 시간을 변경 할 수 있습니다.

<br>

**▷타이머()**
  
<img src="https://user-images.githubusercontent.com/75923078/226616896-0a808fbf-58fa-47d8-b2f8-f5b6ac0b88ce.png" width="200" height="200" />   
  
to do list에 있는 일정을 클릭 후 '선택' 버튼을 누르면 타이머를 사용할 수 있습니다.
타이머를 실행하면 공부 시간이 측정되며, 이 시간은 순공시간으로 저장됩니다.
reverse 버튼을 통해 스톱워치 모드로 변경 할 수 도 있습니다.

<br>

**▷평점(done 버튼)**

<img src="https://github.com/howon-ryu/studylab_student_php_readme/assets/75923078/538c87ba-f5e4-4c4c-914c-9e49e506dcf1" width="300" height="200" /> 

to do list 에 있는 일정에 done 버튼을 클릭하면 평점을 설정할수 있습니다.
1~5 점까지 0.5 사이의 점수를 해당 일정에 매길 수 있습니다.
메긴 평점은 학습레포트에서 일/주/월 별로 볼 수 있습니다.

<br>

**▷레포트(학습 레포트)**
  
<img src="https://user-images.githubusercontent.com/75923078/226617312-1e5d4113-c93d-4d5d-a46c-c18b920b5c9b.png" width="300" height="200" />   
  
학습 레포트 버튼을 누르면 볼 수 있습니다.
일/주/월 별로 누적된 공부 시간을 볼 수 있으며, amchart를 통한 가시적인 통계를 제공합니다.
레포트 안에 있는 달력은 fullcalendar를 바탕으로 하며, 해당 날짜 클릭시 클릭된 날짜에 맞는 일/주/월 정보를 제공합니다.

<br>

**▷상벌점(예정)**




<br>


**▷HELPFUL LINKS**

- View [Github Repository](https://github.com/howon-ryu/studylab_console_php) - 스터디카페 관리 콘솔
<br>


**▷Special thanks

이 프로젝트를 개발하면서 사용한 외부 소스 입니다.   

- [Fullcalendar](https://fullcalendar.io/) - 일정 계획 및 레포트 보기 달력
- [NHN_TOAST_SMS](https://docs.nhncloud.com/ko/Notification/SMS/ko/Overview/) - 레포트 sms 전송
- [AmCharts](https://www.amcharts.com/) - 레포트 가시화

  
    <br>
      
## 📌 팀원 정보

😆 류호원 [@howon-ryu][https://github.com/howon-ryu]

👨 정민석 [@JamesDev51][https://github.com/JamesDev51]

  <br>
    

## 🛠 사용 기술


- ### **프론트엔드** - js, html, css

- ### **백엔드** - spring ,php


 
