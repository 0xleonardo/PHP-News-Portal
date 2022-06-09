$(function() {
    $("form[name='forma']").validate({
      rules: {
        title: {
            required: true,
            minlength: 5,
            maxlength: 30,
        
        },

        about: {
            required: true,
            minlength: 10,
            maxlength: 100,
        
        },

        content: {
            required: true,
        },

        category:{
          required: true,
        }
      },
      messages: {
        title: {
          required: "",
          minlength: "",
          maxlength: "",
        },
        about: {
            required: "",
            minlength: "",
            maxlength: "",
        },
        content: {
            required: "",
        },
        category: {
            required: "",
        },
     },
      submitHandler: function(form) {
        form.submit();
      }
    });
  });