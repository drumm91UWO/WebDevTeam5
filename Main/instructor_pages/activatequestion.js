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
                alert("trying to add question " + questions[i].description);
                selector.append('<option value="' + questions[i].id + '">' + questions[i].description + '</option>');
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
    //get current answer data to $("#selector option:selected").value() <--question id
        //note: what that is going to look like is the number 15
        //note: this will be an ajax query. ajax queries use php. You would probably use a new php file.
        //note: use updateSelector() method for inspiration
    /*
    var id = $("#selector option:selected").value()
    $.ajax({
        type: 'POST',
        url: '../Database_files/getscoresfordisplay.php',
        data: {questionId: id},
        success: function (result) {
            //result should be a JSON object of scores
            //this is where you use canvas
            //use canvas to genereate an html bar graph with this data
            //set the inner html of display div to the bar graph
            //code here will only run if successful
        },
    });
    */
    //don't really want to make changes here
    //code here will run if successful or not
    document.getElementById("display").innerHTML = "At this time, there is no data to display for " + 
        $("#selector option:selected").text() + ".";
    sleep(1000);//sleep for 1 second
    displayAnswers();
}
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}
