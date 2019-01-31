class Cliente {
    constructor(nombre, correo, telefono, comentario) {
        this.nombre = nombre;
        this.correo = correo;
        this.telefono = telefono;
        this.comentario = comentario;
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

}