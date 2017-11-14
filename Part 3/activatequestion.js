function activateQuestion() {
    var buttonElement = document.getElementById("button");
    buttonElement.disabled = true;
    var buttonElement = document.getElementById("button2");
    buttonElement.disabled = false;
    displayAnswers();
    startTimer();
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
    document.getElementById("display").innerHTML = "No data to display at this time.";
}
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}