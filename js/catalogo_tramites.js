/* 
 * INSTITUTO NACIONAL DE PATRIMONIO CULTURAL
 * Portal de Trámites 2020
 */
function mostrar_informacion(titulo,texto,idtitulo,iddescripcion){
    debugger
    $("#"+idtitulo).html(titulo);
    $("#"+iddescripcion).html(texto);
}
function cargar_requisitos(titulo,idtramite,idtitulo,iddescripcion){
    debugger
    $("#"+idtitulo).html(titulo);
    var res=""; /*PROCESO AJAX*/
    $("#"+iddescripcion).html(res);
}

