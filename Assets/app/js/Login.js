//el boton va a ejecutar una funcion
document.querySelector("#loginForm").addEventListener("submit", function (e) {
  e.preventDefault();
  login();
});

  async function login() {
  let loginForm = document.querySelector("#loginForm");
  const datos = new FormData(loginForm); //contenido del formulario que se envia a la aync
  try {
    const url = `${base_url}/login/ingresar`;//comillas template string para inyectar variables
    const respuesta = await fetch(url, {
      method: "POST",
      body: datos,
    });
    const resultado = await respuesta.json();

    console.log(resultado);

    if (resultado.error) {
      new Noty({
        type: "error",
        text: `${resultado.error}`,
        layout: "topCenter",
        theme: "relax",
        timeout: 1200,
      }).show();
    } else {
      new Noty({
        type: "success",
        text: `${resultado.msg}`,
        layout: "topCenter",
        theme: "relax",
        timeout: 1200,
      }).show();

      setTimeout(() => {
        window.location.href = `${base_url}/perfil`;
      }, 2000);

    }
  } catch (err) {
    console.log(err);
  }
}
