function greetByTime() {
    var curr_date = new Date();
    var curr_time = curr_date.getHours();
    var greeting; // Initialize greeting 
    if (curr_time >= 6 && curr_time < 12) {
        greeting = "Good Morning!";
    } else if (curr_time >= 12 && curr_time < 18) {
        greeting = "Good Afternoon!";
    } else {
        greeting = "Welcome to Late Night Live!";
    }
    document.getElementById("greet-by-time").innerText = greeting;
}
greetByTime();