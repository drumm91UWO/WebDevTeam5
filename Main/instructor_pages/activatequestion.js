function activateQuestion(id) {
    var buttonElement = document.getElementById("button");
    buttonElement.disabled = true;
    var buttonElement = document.getElementById("button2");
    buttonElement.disabled = false;
    attemptToActivateQuestion(id);
}
function attemptToActivateQuestion(id) {
    $.ajax({
        type: 'POST',
        data: {questionId: id},
        url: '../Database_files/attempttoactivatequestion.php',
        success: function (data) {
            //alert(data);
            displayAnswers();
            startTimer();
            updateSelector();
        },
        error: function (xhr) {
            alert("error");
        }
    });
}
function updateSelector() {
    $.ajax({
        type: 'POST',
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
                //alert("trying to add question " + questions[i].description);
                //alert("Adding " + questions[i].id + " to the value of " + questions[i].description + " on selector");
                selector.append('<option value=' + questions[i].id + '>' + questions[i].description + '</option>');
            }
        },
    });
}
function deactivateQuestion() {
    var buttonElement = document.getElementById("button2");
    buttonElement.disabled = true;
    var buttonElement = document.getElementById("button");
    buttonElement.disabled = false;
    document.getElementById("timer").innerHTML += " Time ended";
    $.ajax({
        type: 'POST',
        data: {},
        url: '../Database_files/attempttoactivatequestion.php',
        success: function (data) {
            //alert(data);
        },
        error: function (xhr) {
            alert("error");
        }
    });
    updateSelector();
}
async function startTimer() {
    document.getElementById("timer").innerHTML = "0";
    await sleep(1000);
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
function displayAnswers() {
    //insert a flag here to not display answers

    //get current answer data to $("#selector option:selected").value() <--question id
        //note: what that is going to look like is the number 15
        //note: this will be an ajax query. ajax queries use php. You would probably use a new php file.
        //note: use updateSelector() method for inspiration
    var id = document.getElementById('selector').value;
    $.ajax({
        type: 'POST',
        url: '../Database_files/getscoresfordisplay.php',
        data: {questionId: id},
        success: function (result) {
            alert(result);
            if (!result.includes("Aborting")) {
                var scores = JSON.parse(result);
                if (scores.length > 0) {
                    var chart = new CanvasJS.Chart("barchart", {
                        animationEnabled: true,

                        title: {
                            text: "Live Answers"
                        },
                        axisX: {
                            interval: 1
                        },
                        axisY2: {
                            interlacedColor: "rgba(1,77,101,.2)",
                            gridColor: "rgba(1,77,101,.1)",
                            title: "Number of Companies"
                        },
                        data: [{
                            type: "bar",
                            name: "companies",
                            axisYType: "secondary",
                            color: "#014D65",
                            dataPoints: [
                                { y: 3, label: "Sweden" },
                                { y: 7, label: "Taiwan" },
                                { y: 5, label: "Russia" },
                                { y: 9, label: "Spain" }
                            ]
                        }]
                    });
                    chart.render();
                }
            }
            
        },
    });
    
    //don't really want to make changes here
    //code here will run if successful or not
    
    sleep(1000);//sleep for 1 second
    displayAnswers();
}
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}
