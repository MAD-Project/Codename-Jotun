class Cliente {
    constructor(nombre, correo, telefono, comentario, fecha, fechaEntrega, estado) {
        this.nombre = nombre;
        this.correo = correo;
        this.telefono = telefono;
        this.comentario = comentario;
        this.fecha = fecha;
        this.fechaEntrega = fechaEntrega;
        this.estado = estado;
    }

    getNombre() {
        return this.nombre;
    }

    getCorreo() {
        return this.correo;
    }

    getTelefono() {
        return this.telefono;
    }

    getComentario() {
        return this.comentario;
    }

    getFecha(){
        return this.fecha;
    }

    getFechaEntrega(){
        return this.fechaEntrega;
    }

    getEstado(){
        return this.estado;
    }

}