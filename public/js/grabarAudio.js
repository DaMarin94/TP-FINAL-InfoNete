const init = () => {
    const tieneSoporteUserMedia = () =>
        !!(navigator.mediaDevices.getUserMedia)

    if (typeof MediaRecorder === "undefined" || !tieneSoporteUserMedia())
        return alert("Tu navegador web no cumple los requisitos; por favor, actualiza a un navegador decente como Firefox o Google Chrome");

    // Declaración de elementos del DOM
    const $listaDeDispositivos = document.querySelector("#listaDeDispositivos"),
        $duracion = document.querySelector("#duracion"),
        $btnComenzarGrabacion = document.querySelector("#btnComenzarGrabacion"),
        $btnDetenerGrabacion = document.querySelector("#btnDetenerGrabacion");


    const limpiarSelect = () => {
        for (let x = $listaDeDispositivos.options.length - 1; x >= 0; x--) {
            $listaDeDispositivos.options.remove(x);
        }
    }

    const segundosATiempo = numeroDeSegundos => {
        let horas = Math.floor(numeroDeSegundos / 60 / 60);
        numeroDeSegundos -= horas * 60 * 60;
        let minutos = Math.floor(numeroDeSegundos / 60);
        numeroDeSegundos -= minutos * 60;
        numeroDeSegundos = parseInt(numeroDeSegundos);
        if (horas < 10) horas = "0" + horas;
        if (minutos < 10) minutos = "0" + minutos;
        if (numeroDeSegundos < 10) numeroDeSegundos = "0" + numeroDeSegundos;

        return `${horas}:${minutos}:${numeroDeSegundos}`;
    };

    let tiempoInicio, mediaRecorder, idIntervalo;
    const refrescar = () => {
        $duracion.textContent = segundosATiempo((Date.now() - tiempoInicio) / 1000);
    }

    const llenarLista = () => {
        navigator
            .mediaDevices
            .enumerateDevices()
            .then(dispositivos => {
                limpiarSelect();
                dispositivos.forEach((dispositivo, indice) => {
                    if (dispositivo.kind === "audioinput") {
                        const $opcion = document.createElement("option");
                        $opcion.text = dispositivo.label || `Dispositivo ${indice + 1}`;
                        $opcion.value = dispositivo.deviceId;
                        $listaDeDispositivos.appendChild($opcion);
                    }
                })
            })
    };

    const comenzarAContar = () => {
        tiempoInicio = Date.now();
        idIntervalo = setInterval(refrescar, 500);
    };

    const comenzarAGrabar = () => {
        if (!$listaDeDispositivos.options.length) return alert("No hay dispositivos");
        // No permite que se grabe doblemente
        if (mediaRecorder) return alert("Ya se está grabando");

        navigator.mediaDevices.getUserMedia({
            audio: {
                deviceId: $listaDeDispositivos.value,
            }
        })
            .then(
                stream => {
                    // Comenzar a grabar
                    mediaRecorder = new MediaRecorder(stream);
                    mediaRecorder.start();
                    comenzarAContar();

                    const fragmentosDeAudio = [];
                    // Escuchar cuando haya datos disponibles
                    mediaRecorder.addEventListener("dataavailable", evento => {
                        // Y agregarlos a los fragmentos
                        fragmentosDeAudio.push(evento.data);
                    });
                    // Cuando se detenga (haciendo click en el botón) se ejecuta esto
                    mediaRecorder.addEventListener("stop", () => {
                        // Detener el stream
                        stream.getTracks().forEach(track => track.stop());
                        // Detener la cuenta regresiva
                        detenerConteo();
                        // Convertir los fragmentos a un objeto binario
                        const blobAudio = new Blob(fragmentosDeAudio);

                        // Crear una URL o enlace para descargar
                        const urlParaDescargar = URL.createObjectURL(blobAudio);
                        // Crear un elemento <a> invisible para descargar el audio
                        let a = document.createElement("a");
                        document.body.appendChild(a);
                        a.style = "display: none";
                        a.href = urlParaDescargar;
                        a.download = "grabacion.mp3";
                        // Hacer click en el enlace
                        a.click();
                        // Y remover el objeto
                        window.URL.revokeObjectURL(urlParaDescargar);
                    });
                }
            )
            .catch(error => {
                console.log(error)
            });
    };


    const detenerConteo = () => {
        clearInterval(idIntervalo);
        tiempoInicio = null;
        $duracion.textContent = "";
    }

    const detenerGrabacion = () => {
        if (!mediaRecorder) return alert("No se está grabando");
        mediaRecorder.stop();
        mediaRecorder = null;
    };

    $btnComenzarGrabacion.addEventListener("click", comenzarAGrabar);
    $btnDetenerGrabacion.addEventListener("click", detenerGrabacion);
    llenarLista();
}

document.addEventListener("DOMContentLoaded", init);