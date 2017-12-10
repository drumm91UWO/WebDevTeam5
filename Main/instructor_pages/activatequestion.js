var uniqueData = null;
var chart = null;
var scores = null;
var id = null;
function activateQuestion(qId) {
    id = qId;
    var buttonElement = document.getElementById("button");
    buttonElement.disabled = true;
    var selectorElement = document.getElementById("selector");
    selectorElement.disabled = true;
    var buttonElement = document.getElementById("button2");
    buttonElement.disabled = false;
    var buttonElement = document.getElementById("button3");
    buttonElement.disabled = false;
    attemptToActivateQuestion(id);
}
function attemptToActivateQuestion(id) {
    var recieved = false;
    $.ajax({
        type: 'POST',
        data: { questionId: id },
        async: false,
        url: '../Database_files/attempttoactivatequestion.php',
        success: function (data) {
            recieved = true;
        },
        error: function (xhr) {
            alert("error");
        }
    });
    if (recieved) {
        displayAnswers(id);
        startTimer();
    }
}
function updateSelector() {
    $.ajax({
        type: 'POST',
        async: false,
        url: '../Database_files/updateselector.php',
        data: {},
        success: function (result) {
            var questions = JSON.parse(result);
            var selector = $('#selector')
                .find('option')
                .remove()
                .end()
                ;
            for (var i = 0; i < questions.length; i++){
                selector.append('<option value=' + questions[i].id + '>' + questions[i].description + '</option>');
            }
        },
    });
}
function deactivateQuestion() {
    var buttonElement = document.getElementById("button2");
    buttonElement.disabled = true;
    var buttonElement = document.getElementById("button3");
    buttonElement.disabled = true;
    var selectorElement = document.getElementById("selector");
    selectorElement.disabled = false;
    document.getElementById("timer").innerHTML += " Time ended";
    $.ajax({
        type: 'POST',
        data: {},
        async: false,
        url: '../Database_files/attempttoactivatequestion.php',
        success: function (data) {
            updateSelector();
            var buttonElement = document.getElementById("button");
            buttonElement.disabled = false;
        },
        error: function (xhr) {
            alert("error");
        }
    });
}
async function startTimer() {
    document.getElementById("timer").innerHTML = "0";
    wait(1000);
    setTimeout(incrementTime(), 1000);
}
function incrementTime() {
    var timeElement = document.getElementById("timer");
    if (timeElement.innerHTML.includes("Time ended")) {

    } else {
        var time = parseInt(timeElement.innerHTML);
        time = time + 1;
        timeElement.innerHTML = time.toString();
        setTimeout(incrementTime, 1000);
    }
}
function displayAnswers(id) {
    //insert a flag here to not display answers

    //get current answer data to $("#selector option:selected").value() <--question id
        //note: what that is going to look like is the number 15
        //note: this will be an ajax query. ajax queries use php. You would probably use a new php file.
        //note: use updateSelector() method for inspiration
    $.ajax({
        type: 'POST',
        async: false,
        url: '../Database_files/getscoresfordisplay.php',
        data: {questionId: id},
        success: function (result) {
            //alert(result);
            if (!result.includes("Aborting")) {
                scores = JSON.parse(result);
                //if (scores.length > 0) {
                uniqueData = getUniqueData(scores);
                chart = new CanvasJS.Chart("barchart", {
                    animationEnabled: false,
                    title: {
                        text: "Unique Answers"
                    },
                    axisX: {
                        interval: 1
                    },
                    axisY2: {
                        interlacedColor: "rgba(1,77,101,.2)",
                        gridColor: "rgba(1,77,101,.1)",
                        title: "Number of Instances"
                    },
                    data: [{
                        type: "bar",
                        name: "answers",
                        axisYType: "secondary",
                        color: "#014D65",
                        dataPoints: uniqueData
                    }]
                });
                chart.render();
            }
            
        },
    });
}
function displayAnswersAgain(/*id, chart, scores, uniqueData*/) {
    if (id && chart && scores && uniqueData) {
        $.ajax({
            type: 'POST',
            async: false,
            url: '../Database_files/getscoresfordisplay.php',
            data: { questionId: id },
            success: function (result) {
                if (!result.includes("Aborting")) {
                    scores = JSON.parse(result);
                    if (scores.length > 0) {
                        uniqueData = getUniqueData(scores);
                        chart.options.data[0].dataPoints = uniqueData;
                        chart.render();
                    }
                }
            },
        });
    }
}
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}
function wait(ms) {
    var start = Date.now(),
        now = start;
    while (now - start < ms) {
        now = Date.now();
    }
}
function getUniqueData(scores) {
    //goal
    /*
    dataPoints: [
        { y: 3, label: "Sweden" },
        { y: 7, label: "Taiwan" },
        { y: 5, label: "Russia" },
        { y: 9, label: "Spain" }
    ]*/
    var uniqueData = new Array();
    for (var i = 0; i < scores.length; i++) {
        var unique = true;
        for (var j = 0; j < uniqueData.length; j++){
            if (uniqueData[j].label == scores[i].answer) {
                unique = false;
                uniqueData[j].y++;
            }
        }
        if (unique) {
            uniqueData.push({ y: 1, label: scores[i].answer });
        }
    }
    return uniqueData;
}