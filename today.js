window.onload = function() {
	d = new Date();		//오늘 날짜

	Calendar("Cal");
}

var d;
var php_date;

function Cal_down() {
	var year = d.getFullYear();
	var mon = d.getMonth();

	if (mon == 0) {
		year--;
		mon = 11;
	}
	else mon--;

	d = new Date(year+"-"+(mon+1));

	Calendar("Cal");
}

function Cal_up() {
	var year = d.getFullYear();
	var mon = d.getMonth();

	if (mon == 11) {
		year++;
		mon = 0;
	}
	else mon++;

	d = new Date(year+"-"+(mon+1));

	Calendar("Cal");
}

function Calendar(id) {

var draw = document.getElementById(id);

var year = d.getFullYear();	//현재 년도
var mon = d.getMonth();	//현재 월

var last_day = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);	//월에대한 일들
if ((year%4 == 0 && year %100) || year%400 == 0) last_day[1] = 29;

d.setDate(1);			//1일의 요일
var start_week = d.getDay();
d.setDate(last_day[mon]);	//마지막 날의 요일
var last_week = d.getDay();
var num_week = Math.ceil((last_day[mon]+start_week)/7);

var day = 1;	//표를 채워 넣는데 사용할 변수
							//달력 요일 그리기
var string_cal = '<table border = "1" cellpadding = "0" cellspacing = "1">';
string_cal += '<tr height = "100px"> <th colspan = "1" width = "100px" onclick = "Cal_down();"> down </th>';
string_cal += ('<th colspan = "5" width = "500px"> <font size = "10px">'+year+'년 '+(mon+1)+'월 </th>');
string_cal += '<th colspan = "1" width = "100px" onclick = "Cal_up();"> up </th> </tr>';
string_cal += '<tr> <th height = "50px"> <font color = "#FF0000"> 일 </th>';
string_cal += '<th> 월 </th> <th> 화 </th> <th> 수 </th> <th> 목 </th> <th> 금 </th>';
string_cal += '<th> <font color = "#0000FF"> 토 </th> </tr>';

for (var i = 0; i < num_week; i++) {		//달력 일 그리기
	string_cal += '<tr height = "100px">';
	var string_date;

	for (var j = 0; j < 7; j++) {
		string_date = year+"-"+(mon+1)+"-"+day;
		string_cal += "<td";

		if (!((i == 0 && j < start_week) || last_day[mon] < day)) {
			string_cal += (" id = '" + string_date + "' onclick = 'View_list(\"" + string_date + "\");' style = 'vertical-align : top; text-align : left;''>");

			if (j == 0) string_cal += '<font color = "#FF0000">';
			else if (j == 6) string_cal += '<font color = "#0000FF">';

			string_cal += day++;

			if (j == 0 || j == 6) string_cal += '</font>';
		}
		else string_cal += ">";
		string_cal += '</td>';
	}
	string_cal += '</tr>';
}

draw.innerHTML = string_cal;	//div 에다가 넣기

}

function View_list (value) {
	location.href="Calendar.php?value="+value;
}
