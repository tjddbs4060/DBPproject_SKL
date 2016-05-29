//전역 변수 선언 ymd = 선택되어 있는 날짜/ y_now 달력의 년도 / m_now 달력의 월
var ymd;
var y_now;
var m_now;

//이전 달 출력
function Cal_down() {
//출력되어 있는 달이 1월이면 년도를 줄이고 월을 12월로
	if (m_now == 1) {
		y_now--;
		m_now = 12;
	}
	else m_now--;

//페이지 리로드
	View_list(ymd);
}

//다음 달 출력
function Cal_up() {
//출력되어 있는 달이 12월이면 년도를 올리고 월을 1월로
	if (m_now == 12) {
		y_now++;
		m_now = 1;
	}
	else m_now++;

	View_list(ymd);
}

//달력 출력
function Calendar(id) {
//Cal이 아이디인 div
var draw = document.getElementById(id);

var last_day = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);	//월에대한 일들
if ((y_now%4 == 0 && y_now%100) || y_now%400 == 0) last_day[1] = 29;

//처음 요일과 마지막 요일 저장
d = new Date(y_now, m_now-1, 1);
var start_week = d.getDay();
d.setDate(last_day[m_now-1]);
var lastweek = d.getDay();

//이 달이 몇주인지 저장
var num_week = Math.ceil((last_day[m_now-1]+start_week)/7);

var day = 1;	//표를 채워 넣는데 사용할 변수

var string_cal = '<table>';
string_cal += '<tr height = "100px"> <th colspan = "1" width = "100px" onclick = "Cal_down();"> down </th>';
string_cal += ('<th colspan = "5" width = "500px"> <font class = "tit">'+y_now+'년 '+m_now+'월 </th>');
string_cal += '<th colspan = "1" width = "100px" onclick = "Cal_up();"> up </th> </tr>';
string_cal += '<tr class = "normal"> <th height = "50px"> <font color = "#FF0000"> 일 </th>';
string_cal += '<th> 월 </th> <th> 화 </th> <th> 수 </th> <th> 목 </th> <th> 금 </th>';
string_cal += '<th> <font color = "#0000FF"> 토 </th> </tr>';

//기념일과 해당 달의 일정 갯수를 배열로 가져옴
var anni_now = anni_col();
var anni_start = 0;
var anni_end = 0;
var sch_num = sch_num_col();

//기념의 배열의 형태 -> Array (월, 일, 내용, 월, 일, 내용 ...) 이렇게 달력 순서로 저장
for (var i = 0; i < anni_now.length; i += 3) {
	//이번 달의 시작 인덱스와 마지막 인덱스 번호
	if (anni_now[i] == m_now) anni_end += 3;
	else if (anni_now[i] < m_now) {anni_start += 3; anni_end += 3;}
	else break;
}

//달력 일 그리기
for (var i = 0; i < num_week; i++) {
	string_cal += '<tr class = "normal" height = "100px">';

	for (var j = 0; j < 7; j++) {
		string_date = y_now+"-"+m_now+"-"+day;
		string_cal += "<td";

		if (!((i == 0 && j < start_week) || last_day[m_now-1] < day)) {
			string_cal += (" id = '" + string_date + "' onclick = 'View_list(\"" + string_date + "\");' style = 'white-space : nowrap; overflow : hidden; text-overflow : ellipsis; vertical-align : top; text-align : left; min-width : 100px; min-height : 100px; max-width : 100px; max-height : 100px;'>");

			if (j == 0) string_cal += '<font color = "#FF0000">';
			else if (j == 6) string_cal += '<font color = "#0000FF">';

			string_cal += day+"<br>";

//기념일의 일과 같은 일에 기념일 출력
			while (anni_now[anni_start] == m_now && anni_now[anni_start+1] == day && anni_start <= anni_end) {
				anni_start += 2;
				string_cal += anni_now[anni_start]+" / </font>";
				anni_start++;
			}

//해당하는 날의 일정 갯수 출력
			if (sch_num[day-1]) string_cal += "</p>"+sch_num[day-1]+"개의 일정";
			day++;

			if (j == 0 || j == 6) string_cal += '</font>';
		}
		else string_cal += ">";
		string_cal += '</td>';
	}
	string_cal += '</tr>';
}

//Cal이 id인 div에 달력 그려넣기
draw.innerHTML = string_cal;	//div 에다가 넣기

}

//페이지 리로드
function View_list (value) {
	location.href="Calendar.php?value="+value+"&Y="+y_now+"&M="+m_now;
}

//일정 추가 버튼 클릭하면 발생
function add_sch() {
	document.getElementById("Add").style.visibility = "visible";
	document.getElementById("Anni").style.visibility = "hidden";
}

//기념일 추가버튼 클릭하면 발생
function add_anni() {
	document.getElementById("Anni").style.visibility = "visible";
	document.getElementById("Add").style.visibility = "hidden";
}