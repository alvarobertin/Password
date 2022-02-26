// Wait for the DOM to be ready
$(function() {
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "El nombre solo debe contener letras"); 
    
    $("form[name='ingreso']").validate({
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        nombre: {
            required: true,
            lettersonly: true
        },
        correo: {
          required: true,
          email: true
        },
        nombre: "required",
        area: "required",
        descr: "required",
        roles: "required"
      },
      // Specify validation error messages
      messages: {
        nombre: "Este campo es obligatorio",
        area: "Este campo es obligatorio",
        descr: "Este campo es obligatorio",
        roles: "Este campo es obligatorio",
        
        correo: {
          required: "Este campo es obligatorio",
          email: "Ingrese un email valido.",
        }
      },
      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }
    });
  })