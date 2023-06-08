
var scanner = new Instascan.Scanner({
    video: document.getElementById('preview'),
    scanPeriod: 5,
});

var cameras = [];

Instascan.Camera.getCameras().then(function(camerasArray) {
    cameras = camerasArray;

    // Detectar si el usuario está accediendo desde un dispositivo móvil
    let cameraIndex = 0;
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        if (cameras.length > 1) {
            cameraIndex = 1; // Usar cámara trasera por defecto si hay disponible
        }
    }

    // Iniciar el escaneo
    if (cameras.length > 0) {
        scanner.start(cameras[cameraIndex]);
    } else {
        alert('No se encontró ninguna cámara en el dispositivo');
    }
}).catch(function(e) {
    console.error(e);
});
    scanner.addListener('scan', function(c) {
        document.getElementById('clave_vehiculo').value = c;
        document.forms[0].submit();
        var audio = new Audio('Imagenes/sonido.mp3');
        audio.play();
        scanner.stop();
    })
document.getElementById("frontal").addEventListener("click", function() {
    if (cameras.length > 0 && cameras[0] != null) {
        scanner.stop();
        scanner.start(cameras[0]);
    } else {
        alert('No se encontró cámara frontal en el dispositivo');
    }
});

document.getElementById("trasera").addEventListener("click", function() {
    if (cameras.length > 1 && cameras[1] != null) {
        scanner.stop();
        scanner.start(cameras[1]);
    } else {
        alert('No se encontró cámara trasera en el dispositivo');
    }
});

document.getElementById("stop").addEventListener("click", function() {
    scanner.stop();
});

