function submit() {
    //gather input
    var id = document.getElementById("selector").value;
    var status = document.getElementsByName("status").value;
    var questionStatement = document.getElementsByName("questionStatement").value;
    var correctAnswerIsExactly = document.getElementsByName("correctAnswerIsExactly").value;
    var numberOfPoints = document.getElementsByName("numberOfPoints").value;
    var description = document.getElementsByName("description").value;
    var keywords = document.getElementsByName("keywords").value;
    var sectionNumber = document.getElementsByName("sectionNumber").value;
    var phpGraderCode = document.getElementsByName("phpGraderCode").value;
    //post
    $.ajax({
        type: 'POST',
        data: {
            id: id,
            status: status,
            questionStatement: questionStatement,
            correctAnswerIsExactly: correctAnswerIsExactly,
            numberOfPoints: numberOfPoints,
            description: description,
            keywords: keywords,
            sectionNumber: sectionNumber,
            phpGraderCode: phpGraderCode
        },
        url: '../Database_files/submitquestionedit.php',
        success: function (data) {
            //alert();
        },
        error: function (xhr) {
            alert("error");
        }
    });
}
//could add code that loads selected question
//data into inputs here