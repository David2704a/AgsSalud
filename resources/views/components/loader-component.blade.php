<div class="loader-wrapper">
    <div class="loader"></div>
</div>
<style>
    /* Estilo para el contenedor de la animación de carga */
.loader-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgb(255, 254, 254);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

/* Estilo para la animación de carga */
.loader {
    border: 8px solid #bbbbbb;
    border-radius: 50%;
    border-top: 8px solid #3498db;
    width: 50px;
    height: 50px;
    animation: spin 1s linear infinite;
}

/* Animación de rotación */
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Ocultar el contenido principal mientras carga */
.content {
    display: none;
}

</style>
