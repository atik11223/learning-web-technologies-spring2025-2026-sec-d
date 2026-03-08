// cache elements once
const btn = document.getElementById("btn");
const moveBtn = document.getElementById("btn1");
const username = document.getElementById("username");
const msg = document.getElementById("msg");
const head = document.querySelector("h1");
const circle = document.getElementById("d1");

// CHANGE BUTTON
btn.addEventListener("click", () => {
    const value = username.value.trim();

    if (!value) {
        msg.textContent = "please type username first!";
        return;
    }

    head.textContent = value;
    head.style.color = "red";
    msg.textContent = "";
});

// MOVE BUTTON
moveBtn.addEventListener("click", () => {
    let count = 0;

    const interval = setInterval(() => {
        if (count > 50) {
            clearInterval(interval);
            return;
        }

        let current = parseInt(getComputedStyle(circle).left) || 0;
        circle.style.left = current + 10 + "px";

        count++;
    }, 100);
});