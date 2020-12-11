let keywoard = document.getElementById('keywoard');
let dataTable = document.getElementById('dataTable');

keywoard.addEventListener('keyup',()=> {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            dataTable.innerHTML = xhr.responseText;
        }
    }
    xhr.open('GET', 'ajax/mahasiswa.php?keywoard=' + keywoard.value, true);
    xhr.send()
})