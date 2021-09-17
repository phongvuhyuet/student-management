<h1>Nhắc nhở tình hình học tập</h1>

<p>
    Xin chào, {{ $name }}. <br>
    Bạn đang thuộc diện sinh viên có nguy cơ nghỉ học cao, thông tin về kết quả học tập của bạn như sau: <br>
    GPA: {{ $gpa }} <br>
    Số lần bị nhắc nhở: {{ round($soLanNhacNho / 3)}} <br>
    Số tín chỉ đang nợ: {{ $soTinNo }}
</p>
