/**
 * Displays an alert if there is not an active question.
 */
function displayAlertIfThereIsNoActiveQuestion() {
    if (thereIsAnActiveQuestion()) {
        //alert("There is an active question");
        window.location.href = "activequestion.php";
    } else {
        alert("There is no active question");
    }
}
/**
 * Returns true if there is an active question, otherwise false.
 */
function thereIsAnActiveQuestion() {
    var thereIsActive = false;
    $.ajax({
        type: 'POST',
        async: false,
        url: '../Database_files/getactivequestion.php',
        data: {},
        success: function (result) {
            result = JSON.parse(result);
            if (result.length > 0) {
                thereIsActive = true;
            }
        },
    });
    return thereIsActive;
}