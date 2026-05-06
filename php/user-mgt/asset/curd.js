function sendAjax(payloadObject, callback) {
    let data = JSON.stringify(payloadObject); 
    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/curd_api.php', true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.send('payload=' + data); 

    xhttp.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200) {
            let response = JSON.parse(this.responseText);
            callback(response);
        }
    }
}

function loadUsers() {
    let payload = { action: 'read' };
    sendAjax(payload, function(response) {
        let tbody = document.getElementById('userTableBody');
        tbody.innerHTML = ''; 
        if(response.data) {
            response.data.forEach(user => {
                tbody.innerHTML += `
                    <tr>
                        <td>${user.id}</td>
                        <td>${user.username}</td>
                        <td>${user.email}</td>
                        <td>
                            <button onclick="editUser('${user.id}', '${user.username}', '${user.email}')">Edit</button>
                            <button onclick="deleteUser('${user.id}')">Delete</button>
                        </td>
                    </tr>
                `;
            });
        }
    });
}

function saveUser() {
    let id = document.getElementById('userId').value;
    let username = document.getElementById('username').value;
    let email = document.getElementById('email').value;

    if(username === "" || email === "") {
        document.getElementById('msg').innerHTML = "Fields cannot be empty!";
        return;
    }

    let payload = {
        action: id ? 'update' : 'create',
        user: { id: id, username: username, email: email }
    };

    sendAjax(payload, function(response) {
        document.getElementById('msg').innerHTML = response.message;
        document.getElementById('crudForm').reset();
        document.getElementById('userId').value = ""; 
        loadUsers(); 
    });
}

function editUser(id, username, email) {
    document.getElementById('userId').value = id;
    document.getElementById('username').value = username;
    document.getElementById('email').value = email;
}

function deleteUser(id) {
    if(confirm("Are you sure you want to delete this user?")) {
        let payload = { action: 'delete', id: id };
        sendAjax(payload, function(response) {
            document.getElementById('msg').innerHTML = response.message;
            loadUsers(); 
        });
    }
}

window.onload = loadUsers;