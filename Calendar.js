//���� ���� ���� ymd = ���õǾ� �ִ� ��¥/ y_now �޷��� �⵵ / m_now �޷��� ��
var ymd;
var y_now;
var m_now;

//���� �� ���
function Cal_down() {
//��µǾ� �ִ� ���� 1���̸� �⵵�� ���̰� ���� 12����
	if (m_now == 1) {
		y_now--;
		m_now = 12;
	}
	else m_now--;

//������ ���ε�
	View_list(ymd);
}

//���� �� ���
function Cal_up() {
//��µǾ� �ִ� ���� 12���̸� �⵵�� �ø��� ���� 1����
	if (m_now == 12) {
		y_now++;
		m_now = 1;
	}
	else m_now++;

	View_list(ymd);
}

//�޷� ���
function Calendar(id) {
//Cal�� ���̵��� div
var draw = document.getElementById(id);

var last_day = new Array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);	//�������� �ϵ�
if ((y_now%4 == 0 && y_now%100) || y_now%400 == 0) last_day[1] = 29;

//ó�� ���ϰ� ������ ���� ����
d = new Date(y_now, m_now-1, 1);
var start_week = d.getDay();
d.setDate(last_day[m_now-1]);
var lastweek = d.getDay();

//�� ���� �������� ����
var num_week = Math.ceil((last_day[m_now-1]+start_week)/7);

var day = 1;	//ǥ�� ä�� �ִµ� ����� ����

var m_now_en;
var m_next;
var m_before;
switch(m_now) {
	case 1: 
		m_now_en = 'January';
		m_next = 'Feb';
		m_before = 'Dec';
		break;
	case 2: 
		m_now_en = 'February';
		m_next = 'Mar';
		m_before = 'Jan';
		break;
	case 3: 
		m_now_en = 'March';
		m_next = 'Apr';
		m_before = 'Feb';
		break;
	case 4: 
		m_now_en = 'April';
		m_next = 'May';
		m_before = 'Mar';
		break;
	case 5: 
		m_now_en = 'May';
		m_next = 'Jun';
		m_before = 'Apr';
		break;
	case 6: 
		m_now_en = 'June';
		m_next = 'Jul';
		m_before = 'May';
		break;
	case 7: 
		m_now_en = 'July';
		m_next = 'Aug';
		m_before = 'Jun';
		break;
	case 8: 
		m_now_en = 'August';
		m_next = 'Sep';
		m_before = 'Jul';
		break;
	case 9: 
		m_now_en = 'September';
		m_next = 'Oct';
		m_before = 'Aug';
		break;
	case 10: 
		m_now_en = 'October';
		m_next = 'Nov';
		m_before = 'Sep';
		break;
	case 11: 
		m_now_en = 'November';
		m_next = 'Dec';
		m_before = 'Oct';
		break;
	case 12: 
		m_now_en = 'December';
		m_next = 'Jan';
		m_before = 'Nov';
		break;
}

var string_cal = '<table style = "border-collapse: collapse; border : #5ac7db 5px solid;">';
string_cal += '<tr height = "100px"> <td colspan = "2" width = "200px" style = "text-align : left; padding-left : 30px"> <font class = "tit">'+y_now+'</font></td>';
string_cal += '<td class = "tit" colspan = "3" width = "300px" style = "text-align : center"> <font class = "tit" color = "#e42fdb"> '+m_now_en+'</font> </td>';
string_cal += '<td colspan = "1" width = "100px" style = "text-align : center;" onclick = "Cal_down();"> <b>'+m_before+'</b> </td>';
string_cal += '<td colspan = "1" width = "100px" style = "text-align : center;" onclick = "Cal_up();"> <b>'+m_next+'</b> </td> </tr>';
string_cal += '<tr class = "day" valign = "top" style = "text-align : center;"> <td height = "30px"> <font color = "#FF0000"> Sun </td>';
string_cal += '<td> Mon </td> <td> Tue </td> <td> Wed </td> <td> Tur </td> <td> Fri </td>';
string_cal += '<td> <font color = "#0000FF"> Sat </td> </tr>';

//����ϰ� �ش� ���� ���� ������ �迭�� ������
var anni_now = anni_col();
var anni_start = 0;
var anni_end = 0;
var sch_num = sch_num_col();

//����� �迭�� ���� -> Array (��, ��, ����, ��, ��, ���� ...) �̷��� �޷� ������ ����
for (var i = 0; i < anni_now.length; i += 3) {
	//�̹� ���� ���� �ε����� ������ �ε��� ��ȣ
	if (anni_now[i] == m_now) anni_end += 3;
	else if (anni_now[i] < m_now) {anni_start += 3; anni_end += 3;}
	else break;
}

//�޷� �� �׸���
for (var i = 0; i < num_week; i++) {
	string_cal += '<tr class = "normal" style = "height : 103px;">';

	for (var j = 0; j < 7; j++) {
		string_date = y_now+"-"+m_now+"-"+day;
		string_cal += "<td";

		if (!((i == 0 && j < start_week) || last_day[m_now-1] < day)) {
			string_cal += (" id = '" + string_date + "' onclick = 'View_list(\"" + string_date + "\");' style = 'white-space : nowrap; overflow : hidden; text-overflow : ellipsis; vertical-align : top; text-align : left; min-width : 101px; max-width : 101px;'>");

			if (j == 0) string_cal += '<font color = "#FF0000">';
			else if (j == 6) string_cal += '<font color = "#0000FF">';

			string_cal += day+"<br>";

//������� �ϰ� ���� �Ͽ� ����� ���
			while (anni_now[anni_start] == m_now && anni_now[anni_start+1] == day && anni_start <= anni_end) {
				anni_start += 2;
				string_cal += anni_now[anni_start]+" / </font>";
				anni_start++;
			}

//�ش��ϴ� ���� ���� ���� ���
			if (sch_num[day-1]) string_cal += "</p>"+sch_num[day-1]+"���� ����";
			day++;

			if (j == 0 || j == 6) string_cal += '</font>';
		}
		else string_cal += ">";
		string_cal += '</td>';
	}
	string_cal += '</tr>';
}

//Cal�� id�� div�� �޷� �׷��ֱ�
draw.innerHTML = string_cal;	//div ���ٰ� �ֱ�

}

//������ ���ε�
function View_list (value) {
	location.href="Calendar.php?value="+value+"&Y="+y_now+"&M="+m_now;
}

//���� �߰� ��ư Ŭ���ϸ� �߻�
function add_sch() {
	document.getElementById("Add").style.visibility = "visible";
	document.getElementById("Anni").style.visibility = "hidden";
}

//����� �߰���ư Ŭ���ϸ� �߻�
function add_anni() {
	document.getElementById("Anni").style.visibility = "visible";
	document.getElementById("Add").style.visibility = "hidden";
}