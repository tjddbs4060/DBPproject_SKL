<!DOCTYPE>
<html>
<head>
<meta charset="utf-8">
<link rel = "stylesheet" type = "text/css" href = "Calendar.css"/>
</head>
<body style = "background-color : #f0f0f0;">
<table style = "width: 1100px; height: 800px; margin: 0 auto">
   <tr>
      <td style = "width: 800px; height: 100px">
      <div style = "text-align: center">
      <img src = "img/logo.png" height="120" width="200" alt="love">
      </div>
      </td>

      <td style = "width: 300px; height: 100px">
      <form action="login_proc.php" method="GET">
      <table cellspacing="10" style = "margin: 0 auto">
         <tr>
            <td>
               <p style = "font-size:20;">아이디</p>
            </td>
            <td>
               <input type = 'text' id='edge' name='username' pattern = ".{4,15}" title = "4~15자로 입력해주세요." style = "width: 180px; height: 40px" />
            </td>
         </tr>
         <tr>
            <td>
               <p style = "font-size:20;">비밀번호</p>
            </td>
            <td>
               <input type = 'password'  id='edge' name='password' pattern = ".{4,15}" title = "4~15자로 입력해주세요." style = "width: 180px; height: 40px" />
            </td>
         </tr>
         <tr>
            <td>
            </td>
            <td>
            <input type ='submit' value = '로그인하기' style = "width: 80px; height: 30px; background-color:#BEDFE1;" />
            </td>
         </tr>
      </table>
      </form>
      </td>
   </tr>
   <tr>
      <td>
         <h2>여러분이 하고 싶은일을 적어보세요</h2>
         <img src="img/im1.png" id=image alt="YsjImage" style="width:650px; height:550px;">
         <script>
         var myImage=document.getElementById("image");
         var imageArray=["img/im1.png","img/im2.png","img/im3.png","img/im4.png"];  //이미지배열을 만들어 넣어준다.
         var imageIndex=0;

         function changeImage(){
            myImage.setAttribute("src",imageArray[imageIndex]); //myImage의 src속성 값을 바꿔준다. 
            imageIndex++;
            if(imageIndex>=imageArray.length){ //이미지index값이 길이보다 커지면 index값을 0으로 바꿔준다
               imageIndex=0;
            }
         }
         setInterval(changeImage,2000); //일정한 시간간격으로 돌린다.
         </script>
      </td>

      <td>
      <form name="join" method="GET" action="membersave.php"> 
      <table cellspacing="20" style = "margin: 0 auto">
         <tr>
            <td>
               <input type="text" id='edge' name="newid" placeholder = "아이디" style = "width: 150px; height: 40px; font-size:18;"  pattern = ".{4,15}" title = "4~15자로 입력해주세요." >
            </td>
            <td>
               <input type="password" id='edge' name="newpwd" placeholder = "비밀번호" style = "width: 150px; height: 40px;  font-size:18;" pattern = ".{4,15}" title = "4~15자로 입력해주세요.">
            </td>
         </tr>

         <tr>
            <td colspan="2">
               <input type="text" id='edge' name="mail" pattern = ".{1,15}@.{1,15}\..{1,5}" title = "e-mail 주소를 정확하게 넣어주세요." placeholder = "e-mail" style = "width: 320px; height: 40px;  font-size:18;">
            </td>
         </tr>

         <tr>
            <td colspan="2">
               <input type="text" id='edge' name="phonenum" pattern = "[0-9]{3}-[0-9]{3,4}-[0-9]{4}" title = "번호를 정확하게 넣어주세요." placeholder = "000-0000-0000" style = "width: 320px; height: 40px; font-size:18;">
            </td>
         </tr>

         <tr>
            <td colspan="2">
               <font class = "sch"> 생일 </font>

               <script language = "javascript">
               var sel1, sel2, sel3;
               var today = new Date();
               var i=0;

               window.onload = function (){
               sel1 = document.join.year;   
               sel1.length = 0;
               for (var i = 0; i < 116; i++)
               sel1.add(new Option(1900+i+"년", 1900+i), i);

               sel2 = document.join.month;
               sel2.length = 0;
               for (var i = 0; i < 12; i++)
               sel2.add(new Option(1+i+"월", 1+i), i);
         
               sel3 = document.join.day;
               sel3.length = 0;
               for (var i = 0; i < 31; i++)
               sel3.add(new Option(1+i+"일", 1+i), i);
               }
               </script>
               <select name="year" id="button2" style = "width: 80px; height: 40px; font-size:14;"> </select>
               <select name="month" id="button2" style = "width: 80px; height: 40px; font-size:14;"> </select>
               <select name="day" id="button2" style = "width: 80px; height: 40px; font-size:14;"> </select>
            </td>
         </tr>

         <tr>
            <td colspan="2">
               <input type=submit value="가입하기" style = "width: 100px; height: 40px; background-color:#BEDFE1;">
            </td>
         </tr>
      </table>
      </form>
      </td>
   </tr>

   <tr>
      <td>
         <h3>지금 하고 있는 일들을 친구들과 공유해요</h3>
         <p>KSL © 2016</p>
         <p style="word-spacing:40px;"><strong>사용정보 지원 블로그 관련기사 개인정보보호 약관 언어</strong></p>
      </td>
      <td>

      </td>
   </tr>

</table>
</body>

</html>