

function validation(fields, fields2) {
    let errors = {};
    var regexNumText = /^([a-zA-Z0-9]+)$/;
    for (let item of fields) {

        if (item.name && !item.disabled) {
            if (item.className.includes('required') && item.value.length == 0) {
                errors[item.name] = 'Este campo es requerido. ';
            } else if (item.className.includes('number') && isNaN(item.value)) {
                errors[item.name] = 'Este campo debe ser un número. ';

            } else if (item.className.includes('number&text') && !regexNumText.test(item.value)) {
                errors[item.name] = "Este campo solo debe tener números y letras. ";
            } else {
                if (item.className.toString().includes('min(')) {
                    let string = item.className.split('min(');
                    let position = string[1].indexOf(')');
                    string = string[1].substring(0, position);
                    if (item.value.length < parseInt(string)) {
                        errors[item.name] = "Este campo debe tener mínimo " + string + " caracteres. ";
                    }
                }
                if (item.className.toString().includes('max(')) {

                    let string = item.className.split('max(');
                    let position = string[1].indexOf(')');
                    string = string[1].substring(0, position);
                    if (item.value.length > parseInt(string)) {
                        errors[item.name] = "Este campo debe tener máximo " + string + " caracteres. ";
                    }
                }
                if (item.className.toString().includes('minnumber(')) {
                    let string = item.className.split('minnumber(');
                    let position = string[1].indexOf(')');
                    string = string[1].substring(0, position);
                    if (parseFloat(item.value) < parseInt(string)) {
                        errors[item.name] = "Este campo debe tener un valor mínimno de " + string;
                    }
                }
                if (item.className.toString().includes('maxnumber(')) {
                    let string = item.className.split('maxnumber(');
                    let position = string[1].indexOf(')');
                    string = string[1].substring(0, position);
                    if (parseFloat(item.value) > parseInt(string)) {
                        errors[item.name] = "Este campo debe tener un valor máximo de " + string;
                    }
                }

            }

            if (item.type == 'date') {
                if (item.value || item.className.includes('required')) {
                    var regEx = /^\d{4}-\d{2}-\d{2}$/;
                    if (!item.value.match(regEx)) {
                        errors[item.name] = "Formato de fecha incorrecto";
                        console.log("dañado");
                        console.log(item.name);
                    }
                }
            }


        } else {
            console.log('algun campo falta por nombre');
        }
    }
    for (let item of fields2) {
        if (item.name && !item.disabled) {
            if (item.className.includes('required') && item.value.length == 0) {
                errors[item.name] = 'Este campo es requerido. ';
            } else if (item.className.includes('number') && isNaN(item.value)) {
                errors[item.name] = 'Este campo debe ser un número. ';

            } else if (item.className.includes('number&text') && !regexNumText.test(item.value)) {
                errors[item.name] = "Este campo solo debe tener números y letras. ";
            } else {
                if (item.className.toString().includes('min(')) {
                    let string = item.className.split('min(');
                    let position = string[1].indexOf(')');
                    string = string[1].substring(0, position);
                    if (item.value.length < parseInt(string)) {
                        errors[item.name] = "Este campo debe tener mínimo " + string + " caracteres. ";
                    }
                }
                if (item.className.toString().includes('max(')) {

                    let string = item.className.split('max(');
                    let position = string[1].indexOf(')');
                    string = string[1].substring(0, position);
                    if (item.value.length > parseInt(string)) {
                        errors[item.name] = "Este campo debe tener máximo " + string + " caracteres. ";
                    }
                }
                if (item.className.toString().includes('minnumber(')) {
                    let string = item.className.split('minnumber(');
                    let position = string[1].indexOf(')');
                    string = string[1].substring(0, position);
                    if (parseFloat(item.value) < parseInt(string)) {
                        errors[item.name] = "Este campo debe tener un valor mínimno de " + string;
                    }
                }
                if (item.className.toString().includes('maxnumber(')) {
                    let string = item.className.split('maxnumber(');
                    let position = string[1].indexOf(')');
                    string = string[1].substring(0, position);
                    if (parseFloat(item.value) > parseInt(string)) {
                        errors[item.name] = "Este campo debe tener un valor máximo de " + string;
                    }
                }

            }

            if (item.type == 'date') {
                if (item.value || item.className.includes('required')) {
                    var regEx = /^\d{4}-\d{2}-\d{2}$/;
                    if (!item.value.match(regEx)) {
                        errors[item.name] = "Formato de fecha incorrecto";
                        console.log("dañado");
                        console.log(item.name);
                    }
                }
            }


        } else {
            console.log('algun campo falta por nombre');
        }
    }
    return errors;
}





function validation2(value, validations) {

    if (value) {
        var errors = "";
        var nullable = false;
        validations.filter((type, index) => {
            if (type == 'number') {
                if (isNaN(value)) {
                    errors += 'Este campo debe ser un número. ';
                }
            } else if (type.includes('min:')) {
                let val = type.replace("min:", "");
                val = parseInt(val);

                if (value.length < val) {
                    errors += "Este campo debe tener mínimo: " + val + " caracteres. ";
                }
            } else if (type == "nullable") {
                if (value.length == 0) {
                    nullable = true
                }

            } else if (type == 'number&text') {
                var regex = /^([a-zA-Z0-9 _-]+)$/;
                var isValid = regex.test(value);

                if (!isValid) {
                    errors += "Este campo solo debe tener números y letras. ";
                }

            }
        });
        if (nullable) {
            errors = "";
        }
        return errors;
    }

}

export { validation, validation2 };