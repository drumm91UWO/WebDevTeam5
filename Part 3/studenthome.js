/**
 * Displays an alert if there is not an active question.
 */
function displayAlertIfThereIsNoActiveQuestion() {
    if (!thereIsAnActiveQuestion()) {
        alert("There is no active question but I'll show you one anyways because this is part 3 of the individual project.");
    }
    window.location.href = "Q1.html";//to be removed
}
/**
 * Returns true if there is an active question, otherwise false.
 */
function thereIsAnActiveQuestion() {
    return false;
}