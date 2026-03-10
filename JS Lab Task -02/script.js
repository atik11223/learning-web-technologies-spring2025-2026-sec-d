// --- 1. DOM Elements ---
const cells = document.querySelectorAll('.cell');
const statusText = document.getElementById('statusText');
const resetBtn = document.getElementById('resetBtn');
const resetScoreBtn = document.getElementById('resetScoreBtn'); // ADDED THIS LINE
const scoreXDisplay = document.getElementById('scoreX');
const scoreODisplay = document.getElementById('scoreO');

// --- 2. Game State Variables ---
let board = ["", "", "", "", "", "", "", "", ""];
let currentPlayer = "X";
let startingPlayer = "X"; 
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
    
    // Listeners for BOTH buttons
    resetBtn.addEventListener('click', restartGame);
    resetScoreBtn.addEventListener('click', resetScores); 
    
    statusText.textContent = `Player ${currentPlayer}'s turn`;
}

// --- 4. Core Gameplay Logic ---
function cellClicked() {
    const cellIndex = this.getAttribute('data-index');

    if (board[cellIndex] !== "" || !gameActive) {
        return; 
    }

    updateCell(this, cellIndex);
    checkWinner();
}

function updateCell(cell, index) {
    board[index] = currentPlayer;
    cell.textContent = currentPlayer;
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

    for (let i = 0; i < winConditions.length; i++) {
        const condition = winConditions[i];
        const cellA = board[condition[0]];
        const cellB = board[condition[1]];
        const cellC = board[condition[2]];

        if (cellA === "" || cellB === "" || cellC === "") {
            continue;
        }

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
        statusText.textContent = "It's a Draw!";
        gameActive = false;
    } else {
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

// Function 1: Clears the board for the next round
function restartGame() {
    startingPlayer = (startingPlayer === "X") ? "O" : "X";
    currentPlayer = startingPlayer;
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
    
    // Set to "O" so that when restartGame runs, it toggles back to "X"
    startingPlayer = "O"; 
    
    restartGame(); 
}

// Start the game!
initializeGame();