<!DOCTYPE>
<html>
<head>
	<style type = "text/css">
	</style>
</head>
<body>
<table style = "width: 1100px; height: 800px; margin: 0 auto">
	<tr>
		<td style = "width: 800px; height: 100px">
		<div style = "text-align: center">
		<img src = "loginimg/sns.png" height="120" width="200" alt="love">
		</div>
		</td>

		<td style = "width: 300px; height: 100px">
		<form action="login_proc.php" method="GET">
		<table style = "margin: 0 auto">
			<tr>
				<td>
					<P>아이디</P>
				</td>
				<td>
					<input type = 'text' name='username' pattern = ".{4,15}" title = "4~15자로 입력해주세요." />
				</td>
			</tr>
			<tr>
				<td>
					<p>비밀번호</p>
				</td>
				<td>
					<input type = 'password' name='password' pattern = ".{4,15}" title = "4~15자로 입력해주세요." />
				</td>
			</tr>
			<tr>
				<td>
				</td>
				<td>
				<input type ='submit' value = '로그인하기'/>
				</td>
			</tr>
		</table>
		</form>
		</td>
	</tr>
	<tr>
		<td>
			<img src="loginimg/image1.png" id=image alt="YsjImage" style="width:650px; height:550px;">
			<script>
			var myImage=document.getElementById("image");
			var imageArray=["loginimg/image1.png","loginimg/image2.jpg","loginimg/image3.jpg","loginimg/image4.jpg"];  //이미지배열을 만들어 넣어준다.
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
		<table style = "margin: 0 auto">
			<tr>
				<td>
					<input type="text" name="newid" placeholder = "아이디" style = "width: 150px; height: 40px"  pattern = ".{4,15}" title = "4~15자로 입력해주세요." >
				</td>
				<td>
					<input type="password" name="newpwd" placeholder = "비밀번호" style = "width: 150px; height: 40px" pattern = ".{4,15}" title = "4~15자로 입력해주세요." >
				</td>
			</tr>

			<tr>
				<td colspan=2>
					<input type="text" name="mail" pattern = ".{1,15}@.{1,15}\..{1,5}" title = "e-mail 주소를 정확하게 넣어주세요." placeholder = "e-mail" style = "width: 300px; height: 40px">
				</td>
			</tr>

			<tr>
				<td colspan=2>
					<input type="text" name="phonenum" pattern = "[0-9]{3}-[0-9]{3,4}-[0-9]{4}" title = "번호를 정확하게 넣어주세요." placeholder = "000-0000-0000" style = "width: 300px; height: 40px ">
				</td>
			</tr>

			<tr>
				<td colspan=2>
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

					<select name="year" id="years" style = "width: 80px; height: 40px"> </select>
					<select name="month" id="months" style = "width: 80px; height: 40px"> </select>
					<select name="day" id="days" style = "width: 80px; height: 40px"> </select>
				</td>
			</tr>

			<tr>
				<td colspan=2>
					<input type=submit value="가입하기" style = "width: 100px; height: 40px">
				</td>
			</tr>

			<tr>
				<td colspan=2>
				</td>
			</tr>
		</table>
		</form>
		</td>
	</tr>
</table>
</body>

</html>