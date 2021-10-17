
function self_sleep(miliseconds) {
    const currentTime = new Date().getTime();
    while (currentTime + miliseconds >= new Date().getTime()) {
    }
}

const call = (details) => {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            alert(this.responseText);
            if(this.responseText.includes("Error:")){
              // Incorrect user
              alert("Unverified user. Don't allow!!");
            }
            else{
              // Correct user
              alert("Verified user");
            }
        }
    }
    xhttp.open("POST", "Action/scanner_check.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("details="+details);
}

function onScanSuccess(decodedText, decodedResult) {
    // Handle on success condition with the decoded text or result.
    console.log(`Scan result: ${decodedText}`, decodedResult);
    // html5QrcodeScanner.clear();
    // ^ this will stop the scanner (video feed) and clear the scan area.
    
    call(decodedText);
    // It is used to stop the loop for some time.
    // self_sleep(4000);
    // console.log("After");
}
  
function onScanError(errorMessage) {
    // handle on error condition, with error message
    console.log(errorMessage);
}
  
var html5QrcodeScanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });
html5QrcodeScanner.render(onScanSuccess, onScanError);

//   .then((ignore) => {
//     console.log("QR Code scanning is stopped");
//   }).catch((err) => {
//     console.log("Stop failed, handle it");
//   });
  
//   Section to perform different styling using js

let divs = document.getElementsByTagName("DIV");
divs[3].setAttribute("style", "display:none");
divs[divs.length-1].setAttribute("style", "display:none");
  
  