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
        url: 'Database_files/attempttoactivatequestion.php',
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

}
function deactivateQuestion() {
    var buttonElement = document.getElementById("button2");
    buttonElement.disabled = true;
    var buttonElement = document.getElementById("button");
    buttonElement.disabled = false;
    document.getElementById("timer").innerHTML += " Time ended";
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
    document.getElementById("display").innerHTML = "At this time, there is no data to display for " + 
        $("#selector option:selected").text() + ".";
}
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}