// --- 1. DOM Elements ---
const cells = document.querySelectorAll('.cell');
const statusText = document.getElementById('statusText');
const resetBtn = document.getElementById('resetBtn');
const scoreXDisplay = document.getElementById('scoreX');
const scoreODisplay = document.getElementById('scoreO');

// --- 2. Game State Variables ---
let board = ["", "", "", "", "", "", "", "", ""];
let currentPlayer = "X";
let gameActive = true;
let scoreX = 0;
let scoreO = 0;

// All possible winning combinations (indices of the board array)
const winConditions = [
    [0, 1, 2], [3, 4, 5], [6, 7, 8], // Rows
    [0, 3, 6], [1, 4, 7], [2, 5, 8], // Columns
    [0, 4, 8], [2, 4, 6]             // Diagonals
];

// --- 3. Initialization ---
function initializeGame() {
    cells.forEach(cell => cell.addEventListener('click', cellClicked));
    resetBtn.addEventListener('click', restartGame);
    statusText.textContent = `Player ${currentPlayer}'s turn`;
}

// --- 4. Core Gameplay Logic ---
function cellClicked() {
    // 'this' refers to the specific cell element that was clicked
    const cellIndex = this.getAttribute('data-index');

    // Prevent marking if cell is full or game is over
    if (board[cellIndex] !== "" || !gameActive) {
        return; 
    }

    updateCell(this, cellIndex);
    checkWinner();
}

function updateCell(cell, index) {
    // Update internal state
    board[index] = currentPlayer;
    
    // Update DOM (UI)
    cell.textContent = currentPlayer;
    
    // Add styling and animation classes
    cell.classList.add('pop');
    cell.classList.add(currentPlayer === 'X' ? 'x-mark' : 'o-mark');
}

function changePlayer() {
    currentPlayer = (currentPlayer === "X") ? "O" : "X";
    statusText.textContent = `Player ${currentPlayer}'s turn`;
}

// --- 5. Win & Draw Detection ---
function checkWinner() {
    let roundWon = false;
    let winningCells = [];

    // Loop through all winning combinations
    for (let i = 0; i < winConditions.length; i++) {
        const condition = winConditions[i];
        const cellA = board[condition[0]];
        const cellB = board[condition[1]];
        const cellC = board[condition[2]];

        // If any cell in a combination is empty, nobody has won yet
        if (cellA === "" || cellB === "" || cellC === "") {
            continue;
        }

        // If all three match, we have a winner
        if (cellA === cellB && cellB === cellC) {
            roundWon = true;
            winningCells = condition;
            break;
        }
    }

    if (roundWon) {
        statusText.textContent = `Player ${currentPlayer} Wins!`;
        gameActive = false;
        updateScore();
        highlightWinningCells(winningCells);
    } else if (!board.includes("")) {
        // If there are no empty strings in the board array, it's a draw
        statusText.textContent = "It's a Draw!";
        gameActive = false;
    } else {
        // If no win and no draw, keep playing
        changePlayer();
    }
}

// --- 6. Helper Functions ---
function updateScore() {
    if (currentPlayer === "X") {
        scoreX++;
        scoreXDisplay.textContent = scoreX;
    } else {
        scoreO++;
        scoreODisplay.textContent = scoreO;
    }
}

function highlightWinningCells(winningCells) {
    winningCells.forEach(index => {
        cells[index].classList.add('win-highlight');
    });
}


function restartGame() {
    // Reset state variables
    currentPlayer = "X";
    board = ["", "", "", "", "", "", "", "", ""];
    gameActive = true;
    statusText.textContent = `Player ${currentPlayer}'s turn`;

    // Reset DOM
    cells.forEach(cell => {
        cell.textContent = "";
        cell.className = "cell"; // Removes pop, x-mark, o-mark, and win-highlight classes
    });
}
// Function 1: Just clears the board for the next round
function restartGame() {
    currentPlayer = "X";
    board = ["", "", "", "", "", "", "", "", ""];
    gameActive = true;
    statusText.textContent = `Player ${currentPlayer}'s turn`;

    cells.forEach(cell => {
        cell.textContent = "";
        cell.className = "cell"; 
    });
}

// Function 2: Wipes the scores back to 0, THEN clears the board
function resetScores() {
    scoreX = 0;
    scoreO = 0;
    
    scoreXDisplay.textContent = scoreX;
    scoreODisplay.textContent = scoreO;
    
    // Call restartGame() to clear the board at the same time!
    restartGame(); 
}
function initializeGame() {
    cells.forEach(cell => cell.addEventListener('click', cellClicked));
    
    // Listeners for BOTH buttons
    resetBtn.addEventListener('click', restartGame);
    resetScoreBtn.addEventListener('click', resetScores); 
    
    statusText.textContent = `Player ${currentPlayer}'s turn`;
}

// Start the game!
initializeGame();