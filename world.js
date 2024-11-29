


document.addEventListener("DOMContentLoaded", function() {


    


function Lookupbtn (){

    let country = document.getElementById('country').value.trim();
    let url = 'http://localhost/info2180-lab5/world.php?country=' + encodeURIComponent(country);
    fetch(url)
    .then(response => response.text())
    .then(data=> {
        console.log(data)
        result.innerHTML = data
    })
    .catch(error => {
        alert(error)
    });

}

document.getElementById("lookup").addEventListener("click", Lookupbtn);






});